<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with(['variant.product'])->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        $total = $cartItems->sum('subtotal');
        
        return view('checkout.index', compact('cartItems', 'total'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
        ]);
        
        $cartItems = Auth::user()->cartItems()->with(['variant.product'])->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        // Check stock availability for all items
        foreach ($cartItems as $cartItem) {
            if ($cartItem->variant->stock_quantity < $cartItem->quantity) {
                return back()->with('error', "Insufficient stock for {$cartItem->variant->product->name}.");
            }
        }
        
        $total = $cartItems->sum('subtotal');
        
        DB::transaction(function () use ($request, $cartItems, $total) {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'status' => 'pending',
            ]);
            
            // Create order items and update stock
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'variant_id' => $cartItem->variant_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->variant->total_price,
                ]);
                
                // Update stock
                $cartItem->variant->decrement('stock_quantity', $cartItem->quantity);
                
                // Remove from cart
                $cartItem->delete();
            }
        });
        
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}