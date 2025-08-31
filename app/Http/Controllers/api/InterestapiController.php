<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InterestapiController extends Controller
{
  public function showallintrests($userId){

    $interst = User::where('user_Id', $userId)->get();
     if ($interst->isEmpty()) {
        return response()->json([
            'message' => 'No items found in cart for this user.'
        ], 404);
    }
 return response()->json([
        'message' => 'User interst retrieved successfully.',
        'interst' => $interst
    ], 200);      }




 public function store(Request $request, $userid)
{
    $validated = $request->validate([
        'subcategory_id' => 'required|exists:sub_categories,id',
    ]);

    $user = User::where('id', $userid)->first();
    if (!$user) {
        return response()->json([
            'message' => 'User not found.'
        ], 404);
    }

    $userInterestsCount = Interest::where('user_id', $userid)->count();

    if ($userInterestsCount >= 3) {
        return response()->json([
            'message' => 'User cannot have more than 3 interests.',
            'current_count' => $userInterestsCount
        ], 422);
    }

    $existingInterest = Interest::where('user_id', $userid)
                                ->where('subcategory_id', $validated['subcategory_id'])
                                ->first();



    $interest = new Interest();
    $interest->user_id = $userid;
    $interest->subcategory_id = $validated['subcategory_id'];
    $interest->save();

    return response()->json([
        'message' => 'Interest added successfully!',
        'remaining_slots' => 3 - ($userInterestsCount + 1),
        'data' => $interest
    ], 201);
}
public function destroyByUserId($userId)
{
    $interest = Interest::where('user_id', $userId)->get();

    if ($interest->isEmpty()) {
        return response()->json([
            'message' => 'No interest items found for this user.'
        ], 404);
    }

    Interest::where('user_id', $userId)->delete();

    return response()->json([
        'message' => 'All interest items deleted successfully for the user.'
    ], 200);
}


public function update(Request $request, $userid, $id)
{
    $validated = $request->validate([
        'subcategory_id' => 'required|exists:sub_categories,id',
    ]);

    $interest = Interest::where('user_id', $userid)->find($id);

    if (!$interest) {
        return response()->json([
            'message' => 'Interest item not found for this user.'
        ], 404);
    }



    $updated = $interest->update([
        'subcategory_id' => $validated['subcategory_id']
    ]);


    return response()->json([
        'message' => 'Interest updated successfully!',
        'data' => $interest->fresh()
    ], 200);
}
}
