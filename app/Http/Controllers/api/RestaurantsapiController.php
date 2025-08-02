<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantsapiController extends Controller
{
    public function indxe(){
        $restaurant=Restaurant::all();
        return response()->json($restaurant);

    }
}
