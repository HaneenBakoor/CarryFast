<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;
    protected $fillable = ['user_id', 'delivery_id', 'total_price', 'state','discount_amount','currency_id','coupon_id'];


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
        return $this->belongsToMany(OrderItem::class, 'order_items');
    }
     public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
     public function currency()
    {
        return $this->belongsTo(currency::class);
    }
}
