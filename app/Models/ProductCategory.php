<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    /**
         * The attributes that are mass assignable.
         *
         * @var string[]
     */
    protected $fillable=[
        'user_id',
        'name',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'category', 'id');
    }
}
