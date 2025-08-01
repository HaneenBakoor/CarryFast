<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'delivery_id', 'total_price', 'state', 'delivery_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_id', 'id');
    }
    public function userRate()
    {
        return $this->belongsToMany(User::class, 'order_rate');
    }
    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
    public function hasItems()
    {
        return $this->belongsToMany(OrderItem::class,'order_items');
    }
}
