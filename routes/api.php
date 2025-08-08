<?php

use App\Http\Controllers\API\AdditionapiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\API\CartapiController;
use App\Http\Controllers\api\CategoryapiController;
use App\Http\Controllers\API\InterestapiController;
use App\Http\Controllers\api\RestaurantsapiController;
use App\Http\Controllers\api\SubCategoryapiController;
// Haneen Apis
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoryapiController::class, 'index']);
    Route::get('/subcategories', [SubCategoryapiController::class, 'index']);
    Route::get('/restaurants', [RestaurantsapiController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'Logout']);
    Route::get('/restaurants/{restaurant_id}/subCategories', [RestaurantsapiController::class, 'show']);
    Route::get('/restaurants/{restaurant_id}/subCategories/{sub_category_id}/dishes', [RestaurantsapiController::class, 'getDishes']);
    Route::get('/restaurants/{restaurants_id}/dishes/{dish_id}/addition', [RestaurantsapiController::class, 'getAddition']);
});

Route::post('/register', [AuthController::class, 'SignUp']);
Route::post('/login', [AuthController::class, 'Login']);















//fatema Apis
Route::get('/cart', [CartapiController::class, 'index']);
Route::post('/addtocart', [CartapiController::class, 'store']);
Route::delete('/carts/{id}', [CartapiController::class, 'destroy']);
Route::put('/carts/{id}', [CartapiController::class, 'update']);

Route::get('/user/{userId}/cart', [CartapiController::class, 'getUserCart']);
Route::post('/addtocart',[CartapiController::class,'store']);
Route::delete('/user/{userId}/cart', [CartapiController::class, 'destroyByUserId']);
Route::put('/user/{userid}/cart/{cartId}', [CartapiController::class, 'update']);


/****additions apis****/
Route::post('/{resturantsID}/additions', [AdditionapiController::class, 'store']);
//=======


/*intrest apis */
Route::post('/{userId}/intrests', [InterestapiController::class, 'store']);
