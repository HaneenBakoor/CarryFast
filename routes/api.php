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


Route::get('/categories', [CategoryapiController::class, 'index']);
Route::get('/subcategories', [SubCategoryapiController::class, 'index']);
Route::get('/restaurants', [RestaurantsapiController::class, 'index']);
//Route::post('/interst',[InterestapiController::class,'store']);

/****Cart apis****/
Route::get('/user/{userId}/cart', [CartapiController::class, 'getUserCart']);
Route::post('/addtocart',[CartapiController::class,'store']);
Route::delete('/carts/delete/{id}', [CartapiController::class, 'destroy']);
Route::put('/carts/ubdate/{id}', [CartapiController::class, 'update']);

Route::post('/register', [AuthController::class, 'SignUp']);
Route::post('/login', [AuthController::class, 'Login']);
Route::post('/logout', [AuthController::class, 'Logout']);
Route::get('/restaurant/{restaurants_id}/sub_categories', [RestaurantsapiController::class, 'show']);
Route::get('/restaurant/{restaurants_id}/sub_categories/{sub_category_id}/dishes', [RestaurantsapiController::class, 'getDishes']);

/****additions apis****/
Route::post('/additions', [AdditionapiController::class, 'store']);
