<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
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
        'company_id',
        'username',
        'email',
        'phone',
        'address',
        'type',
        'company_name',
        'company_address',
        'company_phone',
        'company_landline',
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
        2 => 'Shop Keeper',
        3 => 'Supplier'
    ];

     public function getTypeTextAttribute()
     {
        return User::$types[$this->type] ?? 'Admin';
     }

     public function getAvatarUrlAttribute()
    {
        if($this->profile_image && Storage::disk('public')->exists($this->profile_image['server_path'])){
            return Storage::url($this->profile_image['server_path']);
        }else{
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=FFFFFF&background=C9A44A&size=256';
        }

    }
    public function getNameAttribute()
    {
        return trim($this->fname) ." ". trim($this->lname);
    }

    public function getInitialsAttribute()
    {
        return strtoupper(trim($this->fname)[0] . trim($this->lname)[0]);
    }
}
