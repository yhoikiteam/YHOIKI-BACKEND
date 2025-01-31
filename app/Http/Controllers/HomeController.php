<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function login(){
        return Inertia::render('Login');
    }

    public function home(){
        $user = Auth::user();
        $roleName = $user->roles->first()->name;
        return Inertia::render('Home', [
            'role' => $roleName
        ]);
    }
}
