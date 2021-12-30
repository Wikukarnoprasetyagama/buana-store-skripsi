<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'products_id', 'users_id', 'quantity'
    ];

    public function product(){
        return $this->hasOne(Products::class, 'id', 'products_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
