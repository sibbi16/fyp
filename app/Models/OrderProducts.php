<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'product_id',
        'name',
        'price',
        'quantity',
    ];

   public $timestamps = false;

   public function order()
   {
       return $this->belongsTo(Orders::class,'order_id','id');
   }

   public function product()
   {
       return $this->belongsTo(Products::class,'product_id','id');
   }

}
