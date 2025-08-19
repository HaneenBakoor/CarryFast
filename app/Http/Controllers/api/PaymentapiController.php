<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentapiController extends Controller
{
 public function storePaymentMethod(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'order_id' => 'required|exists:orders,id',
        'payment_method_id' => 'required|exists:restaurant_payment_methods,id',
        'amount' => 'required|numeric',
    ]);

    try {
        $payment = new Payment();
        $payment->user_id = $validated['user_id'];
        $payment->order_id = $validated['order_id'];
        $payment->payment_method_id = $validated['payment_method_id'];
        $payment->amount = $validated['amount'];
        $payment->status = 'pending';
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment method stored successfully!',
            'status' => $payment->status
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error storing payment method: ' . $e->getMessage(),
        ], 500);
    }
}

public function deletePaymentMethod($id){
    $payment=Payment::where('id',$id)->delete();
    return response()->json([
        'message'=>'has deleted successfully!'
    ],200);

}

public function updatePaymentMethod(Request $request, $userId, $id)
{
    $validated = $request->validate([
        'order_id' => 'required|exists:orders,id',
        'payment_method_id' => 'required|exists:restaurant_payment_methods,id',
        'status' => 'required|in:pending,paid,failed,refunded',
        'amount' => 'required|numeric|min:0',
    ]);

    $payment = Payment::where('user_id', $userId)->where('id', $id)->first();

    if (!$payment) {
        return response()->json([
            'message' => 'Payment not found or you do not have permission to update it.'
        ], 404);
    }

    // تحديث يدوي (مضمون حتى لو fillable ناقص)
    $payment->order_id = $validated['order_id'];
    $payment->payment_method_id = $validated['payment_method_id'];
    $payment->status = $validated['status'];
    $payment->amount = $validated['amount'];

    $payment->save();

    return response()->json([
        'message' => 'Payment updated successfully!',
        'data' => $payment->fresh() 
    ], 200);
}


}
