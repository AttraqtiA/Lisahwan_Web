<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getShipmentPrice()
    {
        return 25000;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cart_detail()
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'id');
    }
}
