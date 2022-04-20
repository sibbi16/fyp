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
<<<<<<< HEAD

=======

>>>>>>> efacc76b033c000880aa91d7cbf5910f00b9721a
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouses::class);
    }
}
