<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\GoogleAuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('web')->group(function () {
    Route::get('/auth/google', [GoogleAuthController::class, 'googleLogin'])->name('auth.google');
    Route::get('/api/auth/google/callback', [GoogleAuthController::class, 'googleAuthentication'])->name('auth.google.callback');
});
