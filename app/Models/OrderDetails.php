<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';

    public function order(){
        return $this->belongsTo(Order::class , 'order_id');
    }

    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

}
