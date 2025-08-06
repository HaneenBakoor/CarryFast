<?php

namespace App\Http\Controllers\api;
// use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Throwable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleAuthentication()
    {
        try {
            $google_user = Socialite::driver('google')->stateless()->user();
            $existingUser = User::where('email', $google_user->email)->first();
            if ($existingUser) {
                Auth::login($existingUser);
                $token = $existingUser->createToken('google-token')->plainTextToken;

                return response()->json([
                    'message' => 'Login successfully',
                ])->header('token', $token);;
            } else {
                $newUser = User::create([
                    'email' => $google_user->email,
                    'name' => $google_user->name,
                    'password' => bcrypt(Str::random(16)),
                    'google_id'=>$google_user->id,
                    'image' => $google_user->avatar,
                    'email_verified_at' => now(),

                ]);
                Auth::login($newUser);
                $token = $newUser->createToken('google-token')->plainTextToken;
                return response()->json([
                    'message' => 'Login successfully',
                ])->header('token', $token);
                // dd($google_user);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Logedin failed ' . $e->getMessage(),
            ]);
        }
    }
}
