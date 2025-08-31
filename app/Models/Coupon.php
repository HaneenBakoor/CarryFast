<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasUlids;
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'max_uses',
        'is_active',
        'expires_at',
    ];

    public function Orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_coupons');
    }
}
