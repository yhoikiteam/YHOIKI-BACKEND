<?php

namespace App\Http\Controllers\Auth\SPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        return response()->json([
            'message' => 'Login successful',
            'status' => 'success',
        ]);
        }
        return response()->json([
            'message' => 'Login failed',
            'status' => 'error',
        ]);
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
