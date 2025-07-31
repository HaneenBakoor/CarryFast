<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
     protected $fillable = [
        'name',
        'price',
        'restuarant_id'
    ];

    public function restuarant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
