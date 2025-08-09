<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Location;
use App\Models\User;
use App\Notifications\SendOtpEmailNotification;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function SignUp(SignUpRequest $request)
    {
        try {
            $validator = $request->validated();
            $user      = User::create([
                'name'             => $validator['name'],
                'email'            => $validator['email'],
                'password'         => bcrypt($validator['password']),
                'role'             => $validator['role'],
                'phone_number'     => $validator['phone_number'],
                'bike_type'        => $validator['bike_type'] ?? null,
                'fuel_consumption' => $validator['fuel_consumption'] ?? null,

            ]);
            $location = Location::create([
                'user_id'         => $user->id,
                'plus_code'       => $validator['plus_code'],
                'area'            => $validator['area'],
                'city'            => $validator['city'],
                'country'         => $validator['country'],
                'address_details' => $validator['address_details'] ?? null,
                'latitude'        => $validator['latitude'] ?? null,
                'longitude'       => $validator['longitude'] ?? null,
                'is_default'      => true,
            ]);
            $this->sendOtp($user);
            return $this->successResponse(" تم تسجيل الدخول بنجاح");
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
    public function Login(LoginRequest $request)
    {
        $validator = $request->validated();

        $login_credential = $validator['login_credential'];
        $password         = $validator['password'];

        $field = filter_var($login_credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        $credentials = [
            $field     => $login_credential,
            'password' => $password,
        ];

        if (! Auth::attempt($credentials)) {
            return $this->errorResponse("Incorrect credentials");
        }

        $user = Auth::user();

        if (! $user->is_active) {

            $this->sendOtp($user);
            return $this->errorResponse("You have to verify your email");

        }
        $token = $user->createToken('auth-token')->plainTextToken;
        return $this->successResponse("Logged in successfully")->header('Authorization', $token);
    }
    public function Logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return $this->successResponse("loged out successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    protected function sendOtp(User $user)
    {
        $otp                  = (string) rand(100000, 999999);
        $user->otp_code       = $otp;
        $user->otp_expires_at = \Illuminate\Support\Carbon::now()->addMinutes(5);
        $user->save();
        $user->notify(new SendOtpEmailNotification($otp));
    }
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|string|digits:6',
        ]);
        $validated = $validator->validated();

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $email = $validated['email'];
        $otp   = $validated['otp'];

        $user = User::where('email', $email)->first();

        if (! $user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->is_active) {
            return response()->json(['message' => 'Account is already active.'], 422);
        }
        if ($user->otp_attempts >= 5) {
            return response()->json(['message' => 'Too many OTP attempts. Please request a new OTP.'], 422);
        }

        if ($user->otp_code === $request->otp && Carbon::parse($user->otp_expires_at)->isFuture()) {
            $user->is_active      = true;
            $user->otp_code       = null;
            $user->otp_expires_at = null;
            $user->otp_attempts   = 0;
            if ($user->email) {
                $user->email_verified_at = now();
            }
            $user->save();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Account activated successfully.',
            ], 200)->header('Authorization', $token);
        }
        $user->increment('otp_attempts');
        $user->save();

        return response()->json(['message' => 'Invalid or expired OTP.'], 422);
    }

    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)
            ->first();

        if (! $user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->is_active) {
            return response()->json(['message' => 'Account is already active.'], 422);
        }
        $user->otp_attempts = 0;
        $user->save();

        $this->sendOtp($user);

        return response()->json(['message' => 'New OTP sent successfully.'], 200);
    }
}
