<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Warehouses extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable=[
        'warehouse_id',
        'company_id',
        'warehouse_name',
        'warehouse_address',
        'warehouse_phone',
        'warehouse_image',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'warehouse_image' =>'array',
    ];

    public function getAvatarUrlAttribute()
    {
        if($this->warehouse_image && Storage::disk('public')->exists($this->warehouse_image['path'])){
            return Storage::url($this->warehouse_image['path']);
        }else{
            return asset('images/warehouse.jpg');
        }
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'warehouse_id', 'id');
    }

}
