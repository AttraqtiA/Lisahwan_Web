<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'product_id', 'id');
    }

    public function testimony()
    {
        return $this->hasMany(Testimony::class, 'product_id', 'id');
    }

    public function production()
    {
        return $this->hasMany(Production::class, 'product_id', 'id');
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
    public function cart_detail()
    {
        return $this->hasMany(CartDetail::class, 'product_id', 'id');
    }

    public function countDiscount()
    {
        $discountedPrice = $this->price - ($this->price * ($this->discount / 100));
        return max($discountedPrice, 0); // Harga diskon tidak boleh kurang dari 0
    }
}
