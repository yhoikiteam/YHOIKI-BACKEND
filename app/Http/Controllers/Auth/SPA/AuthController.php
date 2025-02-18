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
    public function loginView(){
        return view('login');
    }
    public function dashboard(){
        $user = Auth::user();
        $role = $user->roles->first();
        $roleName = $role ? $role->name : 'No Role';

        // dd($user);
        return view('admin.dashbaord',[
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'role' => $roleName,
            ]
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/test/dashbaord');
        }

        return redirect()->back()->with('message', 'Login failed');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
