<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
     protected $fillable = [
        'title',
        'description',
        'image',
        'discount_type',
        'is_active',
        'start_at',
        'end_at',
        'restaurants_id',
        'dishes_id'
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function dishe(){
        return $this->belongsTo(Dish::class);
    }
}
