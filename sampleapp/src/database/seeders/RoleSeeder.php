<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void 
    {
        // Ensure roles exist
        $masyarakatRole = Role::firstOrCreate(['name' => 'Masyarakat', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        
        // Assign roles to specific users based on email
        $masyarakatUser = User::where('email', 'warga@kelurahan.com')->first();
        $adminUser = User::where('email', 'admin@kelurahan.com')->first();

        if ($masyarakatUser) {
            $masyarakatUser->assignRole($masyarakatRole);
        }

        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }
    }
}