<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartapiController extends Controller
{
    public function getUserCart($userId)
{
    $cart = Cart::where('user_id', $userId)->get();

    if ($cart->isEmpty()) {
        return response()->json([
            'message' => 'No items found in cart for this user.'
        ], 404);
    }

    return response()->json([
        'message' => 'User cart retrieved successfully.',
        'cart' => $cart
    ], 200);
}



   public function store(Request $request)
    {
     logger('Store method reached');
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'dishes_id' => 'required|exists:dishes,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $cart = new Cart();
    $cart->user_id = $validated['user_id'];
    $cart->dishes_id = $validated['dishes_id'];
    $cart->quantity = $validated['quantity'];
    $cart->save();


    return response()->json([
        'message' => 'Item added to cart successfully!',
        'cart' => $cart
    ], 201);
}

public function destroy($id)
{
    $cart = Cart::find($id);
    if (!$cart) {
        return response()->json([
            'message' => 'Cart item not found.'
        ], 404);
    }
    $cart->delete();
    return response()->json([
        'message' => 'Cart item deleted successfully.'
    ], 200);
}



public function update(Request $request, $id)
{
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);
    $cart = Cart::find($id);
    if (!$cart) {
        return response()->json([
            'message' => 'Cart item not found.'
        ], 404);
    }
    $cart->quantity = $validated['quantity'];
    $cart->save();
    return response()->json([
        'message' => 'Cart item updated successfully.',
        'cart' => $cart
    ], 200);
}


}
