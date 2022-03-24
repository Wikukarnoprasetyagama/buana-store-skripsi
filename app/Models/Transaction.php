<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'order_id',
        'code_product',
        'code_unique',
        'total_price',
        'admin_fee',
        'payment_status',
        'midtrans_url',
        // 'quantity',
        // 'products_id',
        // 'notes',
        // 'payment_status',
        // 'shipping_status',
        // 'name',
        // 'phone',
        // 'street',
        // 'village',
        // 'address',
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
