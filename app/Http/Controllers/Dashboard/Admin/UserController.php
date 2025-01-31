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
            $users = User::role($role)->get();   
            $data[$role] = $users;   
        }
        if ($data) {
            return response()->json([
                'massage' => 'data berhasil di temukan',
                'data' => $data,
                'roles' => $roles,
            ]);
        }else{
            return response()->json([
               'message' => 'data gagal di temukan',
            ]);
        }
    }
}
