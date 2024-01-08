<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    protected $guarded = [];


    public function category(){
        return $this->belongsTo(Category::class , 'category_id');
    }



    public function orders(){
        return $this->belongsToMany(CustomerOrder::class , 'order_details');
    }


    public function product_images(){
        return $this->hasMany(ProductImage::class , 'product_id');
    }

    


    public function reviews(){
        return $this->hasMany(UserProductReview::class , 'product_id');
    }


    public function favourites(){
        return $this->hasMany(UserFavourite::class , 'product_id');
    }

    public function carts(){
        return $this->hasMany(Cart::class , 'product_id');
    }

    public function order_details(){
        return $this->hasOne(OrderDetails::class , 'product_id');
    }

}
