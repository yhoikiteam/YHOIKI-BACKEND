<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;


class RegisterController extends Controller
{
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

            $user->assignRole('user');
            $roleName = $user->roles->first()->name;
            return response()->json([
                'message' => 'User registered successfully',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'updated_at' => $user->updated_at,
                    'created_at' => $user->created_at,
                    'id' => $user->id,
                ],
                'role' => $roleName,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "validasi gagal",
                'errors' => $e->errors()
            ], 422);
        }
    }

}
