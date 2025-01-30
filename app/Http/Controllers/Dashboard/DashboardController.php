<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function user() {
        return Inertia::render('Dashboard/User');
    }
    public function admin() {
        $user = Auth::user();
        $roleName = $user->roles->first()->name;
        return Inertia::render('Dashboard/Admin', [
            'name' => $user->name,
            'role' => $roleName,
        ]);
    }
}
