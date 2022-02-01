<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'products_id', 'users_id', 'quantity'
    ];

    // public static function userCartItems()
    // {
    //     if (Auth::check()) {
    //         $userCartItems = Cart::where('users_id', Auth::user()->id)->get()->toArray();
    //     }
    //     return $userCartItems;
    // }

    public function product(){
        return $this->hasOne(Products::class, 'id', 'products_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
