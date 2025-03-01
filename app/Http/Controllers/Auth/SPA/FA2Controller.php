<?php

namespace App\Http\Controllers\Auth\SPA;

use App\Http\Controllers\Controller;
use App\Mail\FA2Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FA2Controller extends Controller
{
    public function toggleFA2(Request $request)
    {
        $request->validate([
            'toggle' => 'required|in:hidup,mati',
        ]);
        $fa2_code = $this->FA2_code();
        $user = Auth::user();
        $data = User::find($user->id);
        // dd($user);
        if ($request->toggle === 'hidup') {

            $data->fa2_code = $fa2_code;
            $data->fa2_expires_at = now()->addMinutes(2);
            $data->fa2_enabled = 1;
            $data->last_login_time = now();
            $data->save();

            // Kirim email ke user
            Mail::to($user->email)->send(new FA2Mail($fa2_code));

            return response()->json([
                'message' => 'FA2 diaktifkan',
                'fa2_enabled' => $data->fa2_enabled,
            ]);
        }

        if ($request->toggle === 'mati') {

            $data->fa2_code = null;
            $data->fa2_expires_at = null;
            $data->fa2_enabled = 0;
            $data->last_login_time = now();
            $data->save();

            return response()->json([
                'message' => 'FA2 dinonaktifkan',
                'fa2_enabled' => $data->fa2_enabled,
            ]);
        }
    }

    public function FA2_verifikasi(Request $request)
    {
        $request->validate([
            'fa2_code' => 'required',
        ]);

        $user = Auth::user();

        if (!$user || $user->fa2_code !== $request->fa2_code || now()->gt($user->fa2_expires_at)) {
            return response()->json([
                'message' => 'Kode tidak valid atau telah kedaluwarsa.',
            ], 401);
        }

        // Reset kode FA2 setelah verifikasi sukses
        $user->update([
            'fa2_code' => null,
            'fa2_expires_at' => null,
            'last_login_time' => now(),
        ]);

        return response()->json([
            'message' => 'FA2 berhasil diverifikasi.',
            'token' => $token,
            'fa2_enabled' => $user->fa2_enabled,
        ]);
    }
}
