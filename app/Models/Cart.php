<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;


class Cart extends Model
{ use HasUuids;
    protected $fillable = [
        'user_id',
        'dishes_id',
        'quantity',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function dishe()
    {
        return $this->belongsTo(Dish::class);
    }



    protected static function boot()
{
    parent::boot();
    static::creating(function ($model) {
        $model->id = (string) Str::uuid();
    });
}

}
