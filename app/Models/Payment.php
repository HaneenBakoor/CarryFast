<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'payment_method_id',
        'status'
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function order()
    {
        return $this->belongsTo(Order::class);
    }
     public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
