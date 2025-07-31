<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'plus_code',
        'formatted_address',
        'street',
        'city',
        'country',
        'address_details',
        'latitude',
        'longitude',
        'is_default',
        'user_id'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
