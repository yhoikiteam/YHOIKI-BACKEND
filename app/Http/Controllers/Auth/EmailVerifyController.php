<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\RedirectResponse;

class EmailVerifyController extends Controller
{
    public function index(){
        return view('verify');
    }
    public function store(Request $request)
    {
        $request->validate(['token' => 'required']);

        $user = Auth::user();
        $token = Token::where('user_id', $user->id)->first();

        if (!$token || $token->token !== $request->token) {
            return response()->json(['message' => 'Invalid token.'], 404);
        }

        $user->email_verified_at = now();
        $user->save();
        // $user->update([
        //     'email_verified_at' => now(),
        // ]);

        return response()->json(['message' => 'Email verified successfully.'], 200);
    }
}
