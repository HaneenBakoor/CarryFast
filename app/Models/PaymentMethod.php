<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaymentMethod extends Model
{ use HasUuids;
    protected $fillable = [
        'restaurant_id',
        'payment_type',
        'account_number',
        'is_active'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
}
