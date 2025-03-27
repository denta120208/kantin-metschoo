<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'class', 'product_id', 'quantity', 'total_price'];

    // Tambahkan eager loading agar tidak N+1 Query
    protected $with = ['user:id,name', 'product:id,name,price'];  

    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'name']); 
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->select(['id', 'name', 'price']); 
    }
}
