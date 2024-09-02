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
            'password' => Hash::make('password'), // Change 'password' to a more secure one
            'profile' => 'user.jpg',
        ]);

        // Create the 'admin' role
        $admin_role = Role::create(['name' => 'admin']);
        $manager_role = Role::create(['name' => 'manager']);
        
        // Assign the 'admin' role to the user
        $admin->assignRole($admin_role);

        // Give all permissions to the 'admin' role
        $admin_role->givePermissionTo(Permission::all());
    }
}
