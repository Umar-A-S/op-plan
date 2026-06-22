<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view-fleet', 'create-fleet', 'edit-fleet', 'delete-fleet',
            'view-driver', 'create-driver', 'edit-driver', 'delete-driver',
            'view-delivery-order', 'create-delivery-order', 'edit-delivery-order', 'delete-delivery-order',
            'assign-driver', 'update-delivery-status', 'view-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Admin Logistik']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $driverRole = Role::firstOrCreate(['name' => 'Driver']);

        $adminRole->syncPermissions($permissions);

        $managerRole->syncPermissions([
            'view-fleet', 'view-driver', 'view-delivery-order', 'create-delivery-order',
            'assign-driver', 'update-delivery-status', 'view-reports',
        ]);

        $driverRole->syncPermissions([
            'view-delivery-order', 'update-delivery-status',
        ]);
    }
}
