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
        'phone',
        'email',
        'password',
        'fb_id',
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


    public function orders(){
        return $this->hasMany(CustomerOrder::class);
    }


    public function reviews(){
        return $this->hasMany(UserProductReview::class , 'user_id');
    }

    public function favourites(){
        return $this->hasMany(UserFavourite::class , 'user_id');
    }

    public function carts(){
        return $this->hasMany(Cart::class , 'user_id');
    }

    public function searches(){
        return $this->hasMany(SearchHistory::class , 'user_id');
    }

}



