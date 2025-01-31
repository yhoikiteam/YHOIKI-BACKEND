<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index() {
        $roles = Role::all()->pluck('name');
        $data = [];

        foreach ($roles as $role) {
            $users = User::role($role)->get(); // Mengambil user berdasarkan role
            $data[$role] = $users; // Menyimpan hasilnya dalam array
            // dd($data);
        }
        dd($data);
    }
}
