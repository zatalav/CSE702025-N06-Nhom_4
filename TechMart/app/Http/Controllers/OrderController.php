<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $orders = Auth::user()->orders()
                     ->with(['orderItems.variant.product'])
                     ->orderBy('order_date', 'desc')
                     ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        
        $order->load(['orderItems.variant.product', 'user']);
        
        return view('orders.show', compact('order'));
    }
}