<?php
namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{use ApiResponseTrait;
    public function validate(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            return $this->unauthenticated();
        }
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();
        if (! $coupon) {
            return $this->notFound('This coupon is not valid');
        }
        if (! $coupon->is_active) {
            return $this->errorResponse('This coupon has been disabled');
        }
        if ($coupon->expires_at && now()->greaterThan($coupon->expires_at)) {
            return $this->errorResponse('This coupon has expired');

        }
        if ($coupon->users()->where('user_id', $user->id)->count() == $coupon->max_uses) {
            return $this->errorResponse('You have already used this coupon');

        }
        return response()->json([
            'message'        => 'Coupon applied successfully.',
            'discount_value' => $coupon->discount_value,
            'discount_type'  => $coupon->discount_type,
            'code'           => '200',
        ]);
    }
 public function getUsersCoupons()
 {
    $user=Auth::user();
    $coupons= $user->coupons()->get();
    return $coupons;

 }



 
}
