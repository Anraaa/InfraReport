<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;       // <-- Pastikan di-import
use App\Models\Pengaduan;  // <-- Pastikan di-import

class PengaduanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil semua ID dari user yang sudah ada di database.
        $userIds = User::pluck('id')->toArray();

        // Pengecekan keamanan: jika tidak ada user, jangan jalankan seeder ini.
        if (empty($userIds)) {
            $this->command->info('Tidak ada user, seeder pengaduan dilewati.');
            return;
        }

        // 2. Gunakan factory untuk membuat 20 data pengaduan palsu.
        Pengaduan::factory(20)->make()->each(function ($pengaduan) use ($userIds) {
            
            // 3. Untuk setiap pengaduan, pilih user_id acak DARI DAFTAR ID YANG VALID.
            $pengaduan->user_id = $userIds[array_rand($userIds)];
            $pengaduan->save();
        });
    }
}