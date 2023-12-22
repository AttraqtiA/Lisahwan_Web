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
        'name',
        'role_id',
        'is_login',
        'is_active',
        'email',
        'password',
        'phone_number',
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


    public function isOwner(): bool
    {
        if ($this->role_id === 1) {
            return true;
        }
        return false;
    }

    public function isAdmin(): bool
    {
        if ($this->role_id === 2) {
            return true;
        }
        return false;
    }

    public function isMember(): bool
    {
        if ($this->role_id === 3) {
            return true;
        }
        return false;
    }
}
