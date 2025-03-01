<?php

namespace App\Http\Controllers\Auth\SPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Token;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerifyController extends Controller
{
    public function index()
    {
        return view('verify');
    }
    public function store(Request $request)
    {
        $request->validate(['token' => 'required']);

        $auth = Auth::user();
        $user = User::find($auth->id);
        $token = Token::where('user_id', $user->id)->first();

        if (!$token || $token->token !== $request->token) {
            return response()->json(['message' => 'Invalid token.'], 404);
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('dashboard.view')->with('success', 'email berhasil di verifikasi');
    }
    public function resend()
    {
        $user = Auth::user();
        $token = $this->generateToken();
        Token::where('user_id', $user->id)->delete();
        $tbToken = Token::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);
        // kirim email verifikasi ke user
        Mail::to($user->email)->send(new \App\Mail\VerifyEmail($token));
        return redirect()->route('verification.notice')->with('success', 'berhasil di kirim');
    }
}
