<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RestaurantSubcategory extends Model
{
    use HasUuids;
    protected $table = 'restaurants_subcategories';

    protected $fillable = [
        'restaurants_id',
        'sub_categories_id'

    ];
}
