<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Offer;
use App\Models\Addition;
use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Dish extends Model
{
    use HasUuids;
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
        return $this->belongsToMany(OrderItem::class, 'order_items');
    }
    public function offer()
    {
        return $this->hasMany(Offer::class);
    }
    public function restaurants()
    {
        return $this->belongsToMany(
            Restaurant::class,
            'dishes_restaurants',
            'restaurants_id',
            'dishes_id'
        );
    }
    public function Additions(){
        return $this->belongsToMany(Addition::class,'dishes_additions','additions_id','dishes_id');
    }
}
