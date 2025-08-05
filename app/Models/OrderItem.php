<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OrderItem extends Model
{ use HasUuids;
        protected $fillable = ['order_id', 'dishes_id', 'unit_price', 'quantity'];

}
