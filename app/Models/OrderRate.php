<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderRate extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'driver_rate',
        'order_rate',

    ];
}
