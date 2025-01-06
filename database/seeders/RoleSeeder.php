<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage-branch',
            'view-transactions',
            'manage-stock',
            'process-transactions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $rolesPermissions = [
            'owner' => $permissions,
            'manager' => ['manage-branch', 'view-transactions', 'manage-stock'],
            'supervisor' => ['view-transactions', 'manage-stock'],
            'kasir' => ['process-transactions'],
            'gudang' => ['manage-stock'],
        ];

        foreach ($rolesPermissions as $role => $rolePermissions) {
            $roleInstance = Role::firstOrCreate(['name' => $role]);
            $roleInstance->syncPermissions($rolePermissions); 
        }
    }
}
