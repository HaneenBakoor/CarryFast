<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'delivery'=>$this->delivery->name?? null ,
             'total_price'=>$this->total_price,
              'state'=>$this->state,
              'discount_amount'=>$this->discount_amount,
              'currency'=>$this->currency->code,
              'coupon'=>$this->coupon->code??null,

        ];
    }
}
