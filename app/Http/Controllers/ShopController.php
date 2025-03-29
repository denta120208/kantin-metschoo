<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        // Using select to limit columns retrieved
        // No need for eager loading here as we're only fetching Products
        $products = Product::select(['id', 'name', 'price', 'image'])->get();
        
        return view('shop.index', compact('products'));
    }
    
    public function buy(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $total_price = $product->price * $request->quantity;
        
        Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'class' => $request->class,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ]);
        
        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }
    
    // Add more methods that would benefit from eager loading
    public function userOrders()
    {
        // Eager load product data when showing orders
        $orders = Order::with(['product:id,name,price,image'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
            
        return view('shop.orders', compact('orders'));
    }
    
    public function orderDetail($id)
    {
        // Eager load product and user data for order detail
        $order = Order::with(['product:id,name,price,image', 'user:id,name,email'])
            ->findOrFail($id);
            
        return view('shop.order_detail', compact('order'));
    }
}
