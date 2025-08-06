<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Models\Restaurant;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class AdditionapiController extends Controller
{
   public function store(Request $request, $restaurantId)
{
    // التحقق من صحة البيانات المدخلة
    $validated = $request->validate([
        'name' => 'required|string|max:255', // التحقق من صحة اسم الإضافة
        'price' => 'required|numeric|min:0', // التحقق من صحة السعر
    ]);

    // التحقق من وجود المطعم في جدول restaurants
    $restaurant = Restaurant::find($restaurantId);
    if (!$restaurant) {
        return response()->json([
            'message' => 'Restaurant not found.'
        ], 404);
    }

    // إنشاء الإضافة الجديدة للمطعم
    $addition = new Addition();
    $addition->restaurants_id = $restaurantId;
    $addition->name = $validated['name'];
    $addition->price = $validated['price'];
    $addition->save();

    return response()->json([
        'message' => 'Addition added successfully!',
        'addition' => $addition
    ], 201);
}

}
