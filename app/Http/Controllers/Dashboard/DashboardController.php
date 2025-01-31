<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function user() {
        $user = Auth::user();
        $roleName = $user->roles->first()->name;
        // dd($roleName);
        if ($roleName = 'admin') {
            return Inertia::render('Dashboard/Admin', [
                'name' => $user->name,
                'role' => $roleName,
            ]);
        }elseif($roleName = 'user') {
            return Inertia::render('Dashboard/User', [
                'name' => $user->name,
                'role' => $roleName,
            ]);
        }else{
            return Inertia::render('Dashboard/Yhoiki', [
                'name' => $user->name,
                'role' => $roleName,
            ]);
        }
    }
}