<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DishRestaurant extends Model
{
    use HasUuids;
    protected $table = 'dishes_restaurants';

    protected $fillable = [
        'restaurants_id',
        'dishes_id'

    ];
}
