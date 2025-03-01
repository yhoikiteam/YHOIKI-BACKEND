<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Mail\FA2Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email Atau Password Salah'], 401);
        }

        if ($user->fa2_enabled) {
            $fa2_code = $this->FA2_code();

            $user->fa2_code = $fa2_code;
            $user->fa2_expires_at = now()->addMinutes(2);
            $user->last_login_time = now();
            $user->save();

            Mail::to($user->email)->send(new FA2Mail($fa2_code));
            $token = $user->createToken('auth_token', ['expires_at' => now()->addHours(24)])->plainTextToken;
            return response()->json([
                'message' => 'Login berhasil, dan Kode FA2 telah dikirim ke email.',
                'token' => $token,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request, User $user)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout successful']);
    }
}