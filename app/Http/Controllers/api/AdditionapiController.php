<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use Illuminate\Http\Request;

class AdditionapiController extends Controller
{
     public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurants_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $addition = Addition::create($validated);

        return response()->json([
            'message' => 'Addition created successfully!',
            'addition' => $addition
        ], 201);
    }
}
