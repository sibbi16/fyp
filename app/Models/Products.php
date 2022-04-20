<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'warehouse_id',
        'name',
        'slug',
        'description',
        'category',
        'price',
        'image',
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'array',
    ];
    public function getProductImageAttribute()
    {
        return Storage::url($this->image['path']);

    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouses::class);
    }
}
