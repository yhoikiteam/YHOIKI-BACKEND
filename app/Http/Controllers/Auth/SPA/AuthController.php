<?php

namespace App\Http\Controllers\Auth\SPA;

use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Cek apakah email sudah diverifikasi
            if (is_null($user->email_verified_at)) {
                return response()->json([
                    'message' => 'Email not verified',
                    'status' => 'error',
                ], 403);
            }

            // Ambil role user, cek jika role ada
            $role = $user->roles->first();
            $roleName = $role ? $role->name : 'No Role';

            return response()->json([
                'message' => 'Login successful',
                'status' => 'success',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $roleName,
                ]
            ], 200);
        }

        return response()->json([
            'message' => 'Login failed',
            'status' => 'error',
        ], 401);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
