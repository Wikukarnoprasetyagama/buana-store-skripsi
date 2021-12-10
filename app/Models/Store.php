<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'name_store',
        'photo_profile',
        'photo_shop',
        'phone',
        'village',
        'address', 
    ];


    public function store()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
