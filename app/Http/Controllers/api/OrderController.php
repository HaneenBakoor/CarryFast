<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResourse;
use App\Models\Order;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{use ApiResponseTrait;
    public function getOrderHistory()
    {
        $user = Auth::user();
        if (! $user) {
            return $this->unauthenticated();
        }

        $orders = Order::where('user_id', $user->id)
            ->Where('state', 'delivered')
            ->get();

        return $this->successResponse(OrderResourse::collection($orders));

    }
    public function getOrderState()
    {
        $user = Auth::user();
        if (! $user) {
            return $this->unauthenticated();
        }

        $orders = Order::where('user_id', $user->id)
            ->whereIn('state', ['pending', 'on_the_way'])
            ->get();

        return $this->successResponse(OrderResourse::collection($orders));

    }}
