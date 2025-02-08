<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PengaduanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Daftar status yang digunakan
        $statuses = ['menunggu', 'diteruskan', 'ditolak'];

        // User ID 2 dan 3
        $userIds = [3, 4, 5, 6, 7, 8];

        // Buat 35 pengaduan
        for ($i = 1; $i <= 100; $i++) {
            $status = '';
            if ($i <= 31) {
                // 7 pengaduan dengan status 'menunggu'
                $status = 'menunggu';
            } elseif ($i <= 43) {
                // 9 pengaduan dengan status 'diteruskan'
                $status = 'diteruskan';
            } else {
                // Sisanya pengaduan dengan status 'ditolak'
                $status = 'ditolak';
            }

            // Pilih user secara acak
            $userId = $userIds[array_rand($userIds)];

            // Buat data pengaduan
            Pengaduan::updateOrCreate([
                'user_id' => $userId,
                'judul' => $faker->sentence(),
                'deskripsi' => $faker->paragraph(),
                'lokasi' => $faker->address(),
                'foto' => 'uploads/' . $faker->imageUrl(640, 480, 'cats', true),
                'status' => $status,
                'created_at' => $faker->dateTimeBetween('2024-01-11', '2025-02-05'),
                'updated_at' => now(),
            ]);
        }
    }
}
