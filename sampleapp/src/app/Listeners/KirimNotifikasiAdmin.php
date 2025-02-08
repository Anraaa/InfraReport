<?php

namespace App\Listeners;

use App\Events\PengaduanBaruEvent;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class KirimNotifikasiAdmin
{
    public function handle(PengaduanBaruEvent $event)
    {
        // Cek apakah pengaduan ini baru saja diproses
        $lastNotifiedAt = $event->pengaduan->updated_at;
        $timeDifference = Carbon::now()->diffInMinutes($lastNotifiedAt);

        // Hanya kirim notifikasi jika pengaduan baru dan belum diberi notifikasi dalam 1 menit
        if ($timeDifference <= 1) {
            Log::info("Event PengaduanBaruEvent diterima: Pengaduan ID: {$event->pengaduan->id}");

            $admins = User::where('role', 'Admin')->get();
            Log::info("Total admin ditemukan: " . $admins->count());

            // Ambil admin (misalnya dengan role 'admin')
            $admins = User::where('role', 'Admin')->get();

            foreach ($admins as $admin) {
                // Cek apakah notifikasi sudah ada untuk pengaduan ini
                $existingNotification = $admin->notifications()
                    ->whereJsonContains('data->pengaduan_id', $event->pengaduan->id)
                    ->first();

                Log::info("Mengecek notifikasi untuk admin {$admin->name}, Pengaduan ID: {$event->pengaduan->id}");

                if (!$existingNotification) {
                    // Kirimkan notifikasi
                    Notification::make()
                        ->title('Pengaduan Baru')
                        ->body("Pengaduan baru oleh {$event->pengaduan->user->name}.")
                        ->success()
                        ->sendToDatabase($admin); // Kirim ke database

                    Log::info("Notifikasi berhasil dikirim ke admin {$admin->name} untuk Pengaduan ID: {$event->pengaduan->id}");
                } else {
                    Log::info("Notifikasi sudah ada untuk Pengaduan ID: {$event->pengaduan->id} ke admin {$admin->name}");
                }
            }
        }
    }
}
