<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Orders extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'price',
        'quantity',
        'total',
        'image',
        'status',
    ];

    protected $casts=[
        'image' => 'array',
        'status' =>'boolean',
    ];

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image['path']);
    }
}
