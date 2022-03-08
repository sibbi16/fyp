<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fname',
        'lname',
        'username',
        'email',
        'phone',
        'address',
        'type',
        'company_address',
        'company_phone',
        'profile_image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile_image' =>'array',
    ];

    public static $types = [
        1 => 'Company',
        2 => 'Individual',
        3 => 'Shop Keeper',
    ];

     // setting slug
     public function setSlugAttribute($username)
     {
         $this->username = str_replace(" " , "-" , strtolower($username));
     }

     public function getTypeTextAttribute()
     {
         return User::$types[$this->type] ?? 'Admin';
     }
}
