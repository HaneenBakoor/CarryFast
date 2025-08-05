<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DishAddition extends Model
{
    use HasUuids;
    protected $table = 'dishes_additions';

    protected $fillable = [
        'additions_id',
        'dishes_id'

    ];
}
