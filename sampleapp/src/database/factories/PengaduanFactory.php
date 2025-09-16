<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PengaduanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' akan kita isi di Seeder, jadi tidak perlu di sini
            'judul' => $this->faker->sentence(4),
            'deskripsi' => $this->faker->paragraph(3),
            'lokasi' => $this->faker->address(),
            'foto' => 'uploads/placeholder.png', // Contoh foto placeholder
            'status' => 'menunggu', // Status default
        ];
    }
}