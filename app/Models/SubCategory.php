<?php

namespace App\Models;

use App\Models\Dish;
use App\Models\User;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'name',
        'image',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'interests');
    }
    public function restuarants()
    {
        return $this->belongsToMany(Restaurant::class,'restaurant_subcategory');
    }
}
