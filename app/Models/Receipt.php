<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'customer_name',
        'phone',
        'services',
        'subtotal',
        'discount_percent',
        'total',
        'payment_method',
    ];

    protected $casts = [
        'services' => 'array',
    ];
}
