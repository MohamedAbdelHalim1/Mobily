<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProductReview extends Model
{
    use HasFactory;

    protected $table = 'user_product_reviews';

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
    
    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }
}
