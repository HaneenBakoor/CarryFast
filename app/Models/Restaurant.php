<?php

namespace App\Models;

use App\Models\Dish;
use App\Models\User;
use App\Models\Addition;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Restaurant extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'description',
        'image',
        'opening_time',
        'closing_time',
        'estimated_delivery_time',
        'minimum_order_value',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function additions()
    {
        return $this->hasMany(Addition::class);
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'favourites');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'restaurnats_rate')->withPivot('rate');
    }
    public function subCategories()
    {
        return $this->belongsToMany(
            SubCategory::class,
            'restaurants_subcategories',
            'restaurants_id',
            'sub_categories_id'
        );
    }
    public function dishes()
    {
        return $this->belongsToMany(
            Dish::class,
            'dishes_restaurants',
            'restaurants_id',
            'dishes_id'
        );
    }
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function offer()
    {
        return $this->hasMany(Offer::class);
    }
}
