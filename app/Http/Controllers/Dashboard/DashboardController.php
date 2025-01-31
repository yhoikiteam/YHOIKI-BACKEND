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
        return Inertia::render('Dashboard/User', [
            'name' => $user->name,
            'role' => $roleName,
        ]);
    }

    public function Admin() {
        $user = Auth::user();
        $roleName = $user->roles->first()->name;
        return Inertia::render('Dashboard/Admin', [
            'name' => $user->name,
            'role' => $roleName,
        ]);
    }
}