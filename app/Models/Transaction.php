<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // 'users_id',
        // 'products_id',
        // 'code_transaction',
        // 'shipping_price',
        // 'quantity',
        // 'total_price',
        // 'payment_status',
        'users_id',
        'products_id',
        'quantity',
        'total_price',
        'payment_status',
        'midtrans_products_code',
        'midtrans_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }

}
