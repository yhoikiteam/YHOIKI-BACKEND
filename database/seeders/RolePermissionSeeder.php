<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPermissions = [
            'edit' => Permission::create(['name' => 'edit']),
            'delete' => Permission::create(['name' => 'delete']),
            'create' => Permission::create(['name' => 'create']),
            'view' => Permission::create(['name' => 'view']),
        ];

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($userPermissions);
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo($userPermissions);
        $role = Role::create(['name' => 'yhoiki']);
        $role->givePermissionTo($userPermissions);
    }
}
