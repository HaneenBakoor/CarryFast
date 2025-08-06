<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use Twilio\Rest\Client;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function SignUp(SignUpRequest $request)
    {
        try {
            $validator = $request->validated();
            $user = User::create([
                'name' => $validator['name'],
                'email' => $validator['email'],
                'password' => bcrypt($validator['password']),
                'role' => $validator['role'],
                'phone_number' => $validator['phone_number'],
                'bike_type' => $validator['bike_type'] ?? null,
                'fuel_consumption' => $validator['fuel_consumption'] ?? null

            ]);
            $location = Location::create([
                'user_id' => $user->id,
                'plus_code' => $validator['plus_code'],
                'area' => $validator['area'],
                'city' => $validator['city'],
                'country' => $validator['country'],
                'address_details' => $validator['address_details'] ?? null,
                'latitude' => $validator['latitude'] ?? null,
                'longitude' => $validator['longitude'] ?? null,
                'is_default' => true
            ]);
            // $user->sendTestSms();
            return $this->successResponse("تم تسجيل الدخول بنجاح");
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
    public function Login(LoginRequest $request)
    {
        $validator = $request->validated();

        $login_credential = $validator['login_credential'];
        $password = $validator['password'];

        $field = filter_var($login_credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        $credentials = [
            $field => $login_credential,
            'password' => $password,
        ];

        if (!Auth::attempt($credentials)) {
            return $this->errorResponse("Incorrect credentials");
        }

        $user = Auth::user();

        if (!$user->email_verified_at) {
            return $this->errorResponse("You have to verify your email");
        }
        $token = $user->createToken('auth-token')->plainTextToken;
        return $this->successResponse("Logged in successfully")->header('Authorization', $token);
    }
    function Logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return $this->successResponse("loged out successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
