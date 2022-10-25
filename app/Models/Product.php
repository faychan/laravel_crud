<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'image',
        'barcode',
        'buy_price',
        'sell_price',
        'quantity',
        'status'
    ];
}
