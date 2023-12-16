<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'phone_number',
        'is_login',
        'is_active',
        'profile_picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }

    public function testimony()
    {
        return $this->hasMany(Testimony::class, 'user_id', 'id');
    }

    public function address()
    {
        return $this->HasMany(Address::class, 'user_id', 'id');
    }

    public function order()
    {
        return $this->HasMany(Order::class, 'user_id', 'id');
    }

    public function cart()
    {
        return $this->HasMany(Cart::class, 'user_id', 'id');
    }
}
