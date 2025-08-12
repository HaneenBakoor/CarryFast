<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InterestapiController extends Controller
{
    public function store(Request $request,$userid)
{
    $validated = $request->validate([
        'user_id' => 'required',
        'price' => 'required',
    ]);

    $userid = User::where('user_id', $userid)->get();
   /* if (!$userid) {
        return response()->json([
            'message' => 'user not found.'
        ], 404);
    }*/

    $interst = new Interest();
    $interst->user_id=  $validated['user_id'];
    $interst->subcategory_id = $validated['subcategory_id'];
    $interst->save();

    return response()->json([
        'message' => 'interst added successfully!',
        'interst' => $interst
    ], 201);
}
public function destroy(){


}

}
