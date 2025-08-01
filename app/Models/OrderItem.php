<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
        protected $fillable = ['order_id', 'dishes_id', 'unit_price', 'quantity'];

}
