<?php

use App\Http\Controllers\api\CategoryapiController;
use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\API\FuelController;
use App\Http\Controllers\API\InterestapiController;
use App\Http\Controllers\api\RestaurantsapiController;
use App\Http\Controllers\api\SubCategoryapiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/categories', [CategoryapiController::class, 'index']);
Route::get('/subcategories', [SubCategoryapiController::class, 'index']);
Route::get('/restaurants', [RestaurantsapiController::class,'index']);
Route::post('/interests', [InterestapiController::class, 'store']);

Route::post('/convert-currency', [CurrencyController::class, 'convert']);


Route::get('/fuel', [CurrencyController::class, 'calculateFuelPrice']);

?>
