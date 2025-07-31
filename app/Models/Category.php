<?php

namespace App\Models;

use App\Models\Restaurant;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
