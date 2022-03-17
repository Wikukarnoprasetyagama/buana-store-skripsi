<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'roles',
        'email',
        'password',
        'photo_profile',    
        'photo_shop',
        'name_store',   
        'name_bank',   
        'account_number',   
        'phone',    
        'village',  
        'street',  
        'address',  
        'status',  
        'reg_status',
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
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'users_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'users_id', 'id');
    }
}
