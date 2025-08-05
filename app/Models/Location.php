<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Location extends Model
{
    use HasUuids;
    protected $fillable = [
        'plus_code',
        'area',
        'city',
        'country',
        'address_details',
        'latitude',
        'longitude',
        'is_default',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
