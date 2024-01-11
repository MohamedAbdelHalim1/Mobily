<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id ','address','phone_number','total_price','quantity','status','city','shipping','subtotal'];
    protected $orderstatus = [
        'status' => orderstatus::class
    ];


    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function order_details(){
        return $this->hasMany(OrderDetails::class , 'order_id');
    }

}
