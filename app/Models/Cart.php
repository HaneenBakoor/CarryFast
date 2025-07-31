<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'dishes_id',
        'quantity',
        'price',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function dishe()
    {
        return $this->belongsTo(Dish::class);
    }
}
