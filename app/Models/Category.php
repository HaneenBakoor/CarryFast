<?php

namespace App\Models;

use App\Models\Restaurant;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Category extends Model
{ use HasUuids;
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
