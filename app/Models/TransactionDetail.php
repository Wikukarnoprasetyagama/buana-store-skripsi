<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'transactions_id',
        'products_id',
        'code_product',
        'quantity',
        'shipping_status',
        'notes',
        'price',
        'name',
        'phone',
        'street',
        'village',
        'address',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'id', 'transactions_id');
    }
}
