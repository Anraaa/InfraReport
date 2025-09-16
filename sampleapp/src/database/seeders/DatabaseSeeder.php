<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        
        // User::factory(10)->create();
        $this->seedUsers();
        $this->call([RoleSeeder::class]);
        $this->call(PengaduanSeeder::class);
    }

    private function seedUsers(): void
    {
        // Fungsi ini hanya membuat user, tanpa memberikan role
        $adminEmail = 'admin@admin.com';
        if (! User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'is_admin' => true,
                'password' => bcrypt('password'),
            ]);
        }
        
        // Buat juga user masyarakat di sini agar bisa ditemukan oleh RoleSeeder
        $masyarakatEmail = 'warga@kelurahan.com';
        if (! User::where('email', $masyarakatEmail)->exists()) {
            User::create([
                'name' => 'Warga Kelurahan',
                'email' => $masyarakatEmail,
                'password' => bcrypt('password'),
            ]);
        }
    }
}