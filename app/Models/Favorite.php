<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Favorite extends Model
{

    use HasFactory, HasUuids;
    protected $fillable = [
        'user_id',
        'favoritable_id',
        'favoritable_type',
    ];

    public function favoritable()
    {
        return $this->morphTo();
    }
}
