<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'roles',
        'photo_profile',    
        'name_store',   
        'phone',    
        'photo_shop',
        'village',  
        'street',  
        'address',  
        'status',  
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
