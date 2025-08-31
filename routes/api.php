<?php

use App\Http\Controllers\API\AdditionapiController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\API\CartapiController;
use App\Http\Controllers\api\CategoryapiController;
use App\Http\Controllers\API\InterestapiController;
use App\Http\Controllers\API\PaymentapiController;
use App\Http\Controllers\api\RestaurantsapiController;
use App\Http\Controllers\api\SubCategoryapiController;
use Illuminate\Support\Facades\Route;



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
Route::post('/auth/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/auth/resend-otp', [AuthController::class, 'resendOtp']);

//fatema Apis


Route::get('/user/{userId}/cart', [CartapiController::class, 'getUserCart']);
Route::post('/addtocart', [CartapiController::class, 'store']);
Route::delete('/user/{userId}/cart', [CartapiController::class, 'destroyByUserId']);
Route::put('/user/{userid}/cart/{cartId}', [CartapiController::class, 'update']);

Route::get('/interests/{user_Id}', [InterestapiController::class, 'showallintrests']);
Route::post("/user/interests/{user_id}",[InterestapiController::class,'store']);
Route::delete('/user/{userId}/interests', [InterestapiController::class, 'destroyByUserId']);
Route::put('/user/{userid}/interests/{interestsId}', [InterestapiController::class, 'update']);


/****test apis****/
Route::post('/additions', [AdditionapiController::class, 'store']);
Route::post('/payments/store', [PaymentapiController::class, 'storePaymentMethod']);
Route::delete('/payments/{id}', [PaymentapiController::class, 'deletePaymentMethod']);
Route::put('/user/{userid}/payment/{id}',[PaymentapiController::class,'updatePaymentMethod']);
