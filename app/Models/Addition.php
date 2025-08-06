<?php

namespace App\Models;

use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Addition extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'price',
        'restuarant_id'
    ];

    public function restuarant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dishes_additions', 'additions_id', 'dishes_id');
    }

     protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
