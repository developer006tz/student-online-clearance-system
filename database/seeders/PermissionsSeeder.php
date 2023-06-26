<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'update users']);

        Permission::create(['name' => 'view students']);

        Permission::create(['name' => 'list clears']);
        Permission::create(['name' => 'view clears']);
        Permission::create(['name' => 'create clears']);
        Permission::create(['name' => 'update clears']);

        Permission::create(['name' => 'list clearances']);
        Permission::create(['name' => 'view clearances']);
        Permission::create(['name' => 'create clearances']);
        Permission::create(['name' => 'update clearances']);

        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'update students']);
        
        Permission::create(['name' => 'list students']);

        Permission::create(['name' => 'list messages']);
        Permission::create(['name' => 'view messages']);
        Permission::create(['name' => 'create messages']);


        $currentPermissions = Permission::all();
        $roles = ['user','student', 'hall-wadern','librarian-udsm','librarian-cse','coordinator','principal','smart-card'];
        foreach ($roles as $role) {
            $new_role = Role::create(['name' => $role]);
            $new_role->givePermissionTo($currentPermissions);
        }


        Permission::create(['name' => 'delete clearances']);
        Permission::create(['name' => 'delete students']);
        Permission::create(['name' => 'update messages']);
        Permission::create(['name' => 'delete messages']);
        Permission::create(['name' => 'delete clears']);
        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list users']);
        
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'delete users']);
        $adminPermission = Permission::all();
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($adminPermission);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);
        
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        // Create admin user and assign admin role


        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
