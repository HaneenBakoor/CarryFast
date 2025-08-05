<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
  
public function convert(Request $request)
    {

        // التحقق من البيانات المدخلة
        $request->validate([
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3',
            'amount' => 'required|numeric|min:0.01',
        ]);
        // إرسال طلب إلى FastForex API
        $response = Http::get('https://api.fastforex.io/convert', [
            'from' => strtoupper($request->from),
            'to' => strtoupper($request->to),
            'amount' => $request->amount,
            'api_key' => 'ec909ab298-139aac52cc-t0fk2b' // 🔑 استبدليها بمفتاحك
        ]);
        // التحقق من حالة الاستجابة
        if ($response->failed()) {
            return response()->json(['message' => 'Failed to connect to FastForex API'], 500);
        }

        // إرجاع النتيجة كما هي
        return response()->json($response->json());
    }

    public function calculateFuelPrice(Response $response)
    {

    }
}
