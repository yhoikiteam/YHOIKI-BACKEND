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
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('user');
        $user2 = User::create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('password')
        ]);
        $user2->assignRole('user');

        $yhoiki = User::create([
            'name' => 'yhoiki',
            'email' => 'yhoiki@gmail.com',
            'password' => bcrypt('password')
        ]);
        $yhoiki->assignRole('yhoiki');
    }
}
