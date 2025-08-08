<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestapiController extends Controller
{
    public function store(Request $request,$userId)
    {
        // التحقق من صلاحية البيانات
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
        ]);

        // التحقق إذا كان لدى المستخدم 3 اهتمامات بالفعل
        $interestCount = Interest::where('user_id', $request->user_id)->count();

        if ($interestCount >= 3) {
            return response()->json([
                'message' => 'You cannot have more than 3 interests.',
            ], 400); // رد برسالة خطأ إذا تخطى الـ 3 اهتمامات
        }

        // إضافة الاهتمام الجديد
        $interest = Interest::create([
            'user_id' => $request->user_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        // إرجاع رد بتأكيد إضافة الاهتمام
        return response()->json([
            'message' => 'Interest saved successfully.',
            'interest' => $interest,
        ], 201);
    }

}
