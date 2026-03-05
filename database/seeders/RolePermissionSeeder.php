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
        // Permissions
        $permissions = [
            'view_products',
            'create_products',
            'edit_products',
            'delete_products',
            'view_orders',
            'update_orders',
            'manage_stock',
            'view_roles',
            'create_roles',
            'update_roles',
            'delete_roles',
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'manage_site_info',
            'view_logs'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Rôle admin avec toutes les permissions
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo(Permission::all());

        // Rôle admin (ne peut voi les logs)
        $admin = Role::create(['name' => 'admin']);
        $allPermissions = Permission::where('name', '!=', 'view_logs')->get();
        $admin->givePermissionTo($allPermissions);

        // Rôle moderateur
        $moderator = Role::create(['name' => 'moderator']);
        $moderator->givePermissionTo([
            'view_products',
            'create_products',
            'edit_products',
            'view_orders',
            'update_orders',
            'manage_stock',
        ]);
    }
}