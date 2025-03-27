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
    
        $total_price = $product->price * $request->quantity; // Hitung total harga
    
        Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'class' => $request->class,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $total_price, // Masukkan total harga
        ]);
    
        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }
    
}