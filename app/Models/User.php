<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Order;
use App\Models\Payment;
use Twilio\Http\Client;
use App\Models\Location;
use App\Models\Restaurant;
use App\Models\SubCategory;
use App\Models\Interest;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = [

        'name',
        'email',
        'password',
        'image',
        'phone_number',
        'role',
        'google_id',
        'bike_type',
        'is_active',
        'fuel_consumption',
        'email_verified_at'

    ];
    public function intrests()
    {
        return $this->hasMany(Interest::class,'user_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
    public function deliver()
    {
        return $this->hasMany(Order::class, 'delivery_id');
    }
    public function interest()
    {
        return $this->belongsToMany(SubCategory::class, 'interests');
    }
    public function favourit()
    {
        return $this->belongsToMany(Restaurant::class, 'favourites');
    }
    public function location()
    {
        return $this->hasMany(Location::class);
    }
    public function restuarants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurnats_rate')->withPivot('rate');
    }
    public function OrderRates()
    {
        return $this->belongsToMany(Order::class, 'order_rate');
    }
    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
