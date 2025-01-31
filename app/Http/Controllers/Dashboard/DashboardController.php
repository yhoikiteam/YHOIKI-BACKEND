<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $userData;

    public function __construct()
    {
        $user = Auth::user();
        $this->userData = [
            'name' => $user->name,
            'role' => $user->roles->first()->name,
        ];
    }
    public function user()
    {
        return Inertia::render('Dashboard/User', [
            'data' => $this->userData,
        ]);
    }

    public function admin()
    {
        return Inertia::render('Dashboard/admin', [
            'data' => $this->userData,
        ]);
    }
}