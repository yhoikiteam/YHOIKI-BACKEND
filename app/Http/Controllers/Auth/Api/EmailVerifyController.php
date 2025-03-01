<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerifyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['token' => 'required']);

        $auth = Auth::user();
        $user = User::find($auth->id);
        // dd($user);
        $token = Token::where('user_id', $user->id)->first();

        if (!$token || $token->token !== $request->token) {
            return response()->json(['message' => 'Invalid token.'], 404);
        }

        $user->email_verified_at = now();
        $user->save();

        return response()->json(['message' => 'Email verified successfully.'], 200);
    }
    public function resend()
    {
        $token = $this->generateToken();
        $user = Auth::user();
        Token::where('user_id', $user->id)->delete();
        $tbToken = Token::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);
        // kirim email verifikasi ke user
        Mail::to($user->email)->send(new \App\Mail\VerifyEmail($token));
        return response()->json(['message' => 'berhasil mengirim ulang code.']);
    }
}
