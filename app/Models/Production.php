<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function production_product()
    {
        return $this->hasMany(ProductionProduct::class, 'production_id', 'id');
    }
}
