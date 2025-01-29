<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Http\RedirectResponse;

class EmailVerifyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['token' => 'required|string']);

        $user = User::where('email_verified_token', $request->token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid token.'], 404);
        }

        $user->update([
            'email_verified_token' => null,
            'email_verified_at' => now(),
        ]);

        return response()->json(['message' => 'Email verified successfully.'], 200);
    }
}
