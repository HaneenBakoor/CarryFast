<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
     protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'sub_category_id'
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
     public function Items()
    {
        return $this->belongsToMany(OrderItem::class,'order_items');
    }
    public function offer()
    {
        return $this->hasMany(Offer::class);
    }
}
