<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'leave_balance' => 2,
            'password' => Hash::make('password'), // Change 'password' to a more secure one
            'profile' => 'images/user.jpg',
        ]);
        $manager = User::create([
            'name' => 'Koemsran',
            'email' => 'manager@gmail.com',
            'leave_balance' => 2,
            'password' => Hash::make('password'), // Change 'password' to a more secure one
            'profile' => 'images/user.jpg',
        ]);
        
        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        // Create the 'admin' role
        $admin_role = Role::create(['name' => 'Admin']);
        $manager_role = Role::create(['name' => 'Manager']);
        
        // Assign the 'admin' role to the user
        $admin->assignRole($admin_role);
        $manager->assignRole($manager_role);
        
        // Give all permissions to the 'admin' role
        $admin_role->givePermissionTo(Permission::all());
    }
}
