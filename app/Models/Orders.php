<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Orders extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'total_price',
        'pickup_person_name',
        'pickup_person_phone',
        'shipping_address',
        'status',
    ];

    protected $casts=[
        'status' =>'boolean',
    ];

    public function products()
    {
        return $this->hasMany(OrderProducts::class,'order_id','id');
    }
}
