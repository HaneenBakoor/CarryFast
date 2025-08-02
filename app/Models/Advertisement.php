<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
     protected $fillable = [
        'title',
        'description',
        'image',
        'location',
        'is_active',
        'start_at',
        'end_at'

    ];
}
