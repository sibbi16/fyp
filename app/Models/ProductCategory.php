<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'slug',
        'image',
    ];

    protected $casts=[
        'image' =>'array',
    ];

    public function getImageUrlAttribute()
    {
        if($this->image && Storage::disk('public')->exists($this->image['path'])){
            return Storage::url($this->image['path']);
        }else{
            return asset('images/warehouse.jpg');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
