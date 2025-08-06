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

//<<<<<<< HEAD
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoryapiController::class, 'index']);
    Route::get('/subcategories', [SubCategoryapiController::class, 'index']);
    Route::get('/restaurants', [RestaurantsapiController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'Logout']);
});
//=======

Route::get('/categories', [CategoryapiController::class, 'index']);
Route::get('/subcategories', [SubCategoryapiController::class, 'index']);
Route::get('/restaurants', [RestaurantsapiController::class, 'index']);
//Route::post('/interst',[InterestapiController::class,'store']);

/****Cart apis****/
Route::get('/user/{userId}/cart', [CartapiController::class, 'getUserCart']);
Route::post('/addtocart',[CartapiController::class,'store']);
Route::delete('/user/{userId}/cart', [CartapiController::class, 'destroyByUserId']);
Route::put('/user/{userid}/cart/{cartId}', [CartapiController::class, 'update']);

//>>>>>>> 91dd05f25f0607388d08ad13aac43c51ab0f0e0e
Route::post('/register', [AuthController::class, 'SignUp']);
Route::post('/login', [AuthController::class, 'Login']);
//<<<<<<< HEAD
Route::post('/logout', [AuthController::class, 'Logout']);
Route::get('/restaurant/{restaurants_id}/sub_categories', [RestaurantsapiController::class, 'show']);
Route::get('/restaurant/{restaurants_id}/sub_categories/{sub_category_id}/dishes', [RestaurantsapiController::class, 'getDishes']);

/****additions apis****/
Route::post('/additions', [AdditionapiController::class, 'store']);
//=======

//>>>>>>> 85be7c73ca2028a7ee80470f9b7e5550da632468
