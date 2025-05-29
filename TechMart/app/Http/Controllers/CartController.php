<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with(['variant.product'])->get();
        $total = $cartItems->sum('subtotal');
        
        return view('cart.index', compact('cartItems', 'total'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,variant_id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $variant = ProductVariant::findOrFail($request->variant_id);
        
        // Check stock availability
        if ($variant->stock_quantity < $request->quantity) {
            return back()->with('error', 'Insufficient stock available.');
        }
        
        $existingCartItem = CartItem::where('user_id', Auth::id())
                                   ->where('variant_id', $request->variant_id)
                                   ->first();
        
        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $request->quantity;
            
            if ($variant->stock_quantity < $newQuantity) {
                return back()->with('error', 'Cannot add more items. Insufficient stock.');
            }
            
            $existingCartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
            ]);
        }
        
        return back()->with('success', 'Item added to cart successfully!');
    }
    
    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorize('update', $cartItem);
        
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        if ($cartItem->variant->stock_quantity < $request->quantity) {
            return back()->with('error', 'Insufficient stock available.');
        }
        
        $cartItem->update(['quantity' => $request->quantity]);
        
        return back()->with('success', 'Cart updated successfully!');
    }
    
    public function destroy(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);
        
        $cartItem->delete();
        
        return back()->with('success', 'Item removed from cart!');
    }
}