<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gamil.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gamil.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('user');

        $yhoiki = User::create([
            'name' => 'yhoiki',
            'email' => 'yhoiki@gamil.com',
            'password' => bcrypt('password')
        ]);
        $yhoiki->assignRole('yhoiki');
    }
}
