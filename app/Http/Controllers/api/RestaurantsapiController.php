<?php

namespace App\Http\Controllers\api;

use App\Models\Dish;
use App\Models\Addition;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;

class RestaurantsapiController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $restaurant = Restaurant::all();
        return response()->json($restaurant);
    }
    public function show($restaurants_id)
    {
        $restaurant = Restaurant::findorfail($restaurants_id);
        $sub_categories = $restaurant->subCategories()
            ->get();

        return $this->successResponse(SubCategoryResource::collection($sub_categories));
    }

    public function getDishes($restaurants_id, $sub_category_id)
    { // return Dish::with('restaurants:id,name,image')->get();
        return Dish::whereHas('restaurants', function ($query) use ($restaurants_id) {
            $query->where('restaurants.id', $restaurants_id);
        })
            ->whereHas('subCategory', function ($query) use ($sub_category_id) {
                $query->where('id', $sub_category_id);
            })
            ->with('additions')
            ->get();
    }

   public function getAddition($restaurant_id,$dish_id)
 {  
    return Addition::whereHas('restaurant', function ($query) use ($restaurant_id) {
        $query->where('id', $restaurant_id);
    })
    ->whereHas('dishes', function ($query) use ($dish_id) {
        $query->where('dishes.id', $dish_id);
    })
    ->get();
}

}
