<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{use HasUuids;
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'exchange_rate',
        'is_default',
        'fuel_price_per_liter',
    ];
    public function Orders()
    {
        return $this->belongsToMany(Order::class);
    }}
