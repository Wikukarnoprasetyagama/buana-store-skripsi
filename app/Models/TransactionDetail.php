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
        'price',
        'notes',
        'name',
        'phone',
        'street',
        'village',
        'address',
        'midtrans_url',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
