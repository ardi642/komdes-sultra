<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $mitraMedia = Role::firstOrCreate(['name' => 'Mitra Media']);

        // Check if there is an existing User ID 1, else create one
        $user = User::find(1);
        
        if (!$user) {
            $user = User::create([
                'id' => 1,
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'posisi' => 'Pemilik Sistem',
            ]);
        }

        // Assign Super Admin role to user ID 1
        $user->assignRole('Super Admin');
    }
}
