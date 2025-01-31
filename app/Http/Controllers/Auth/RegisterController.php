<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;


class RegisterController extends Controller
{
    // private function generateToken()
    // {
    //     $token = Str::random(32);
    //     return $token;
    // }
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);
            // $token = $this->generateToken();
            // dd($token);
            // Mail::to($user->email)->send(new \App\Mail\VerifyEmail($token));

            $user->assignRole('user');
            $roleName = $user->roles->first()->name;
            return response()->json([
                'message' => 'User registered successfully please verify email',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'updated_at' => $user->updated_at,
                    'created_at' => $user->created_at,
                    'id' => $user->id,
                ],
                'role' => $roleName,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "validasi gagal",
                'errors' => $e->errors()
            ]);
        }
    }

    
}
