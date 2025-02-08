<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pengaduan;

class MasyarakatStats extends BaseWidget
{
    protected function getCards(): array
    {
        $totalPengaduan = Pengaduan::count();
        $pengaduanDitolak = Pengaduan::where('status', 'ditolak')->count();
        $pengaduanDiteruskan = Pengaduan::where('status', 'diteruskan')->count();

        return [
            Card::make('Total Masyarakat Terdaftar', User::where('role', 'masyarakat')->count())
                ->description('Jumlah total masyarakat yang terdaftar')
                ->descriptionIcon('heroicon-s-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),
            Stat::make('Total Pengaduan', $totalPengaduan)
                ->description('Jumlah pengaduan yang diajukan')
                ->chart([4, 2, 13, 5, 19, 6, 15])
                ->color('warning'),
            Stat::make('Pengaduan Ditolak', $pengaduanDitolak)
                ->description('Pengaduan yang ditolak')
                ->chart([3, 5, 2, 10, 3, 5, 7])
                ->color('danger'),
            Stat::make('Pengaduan Diteruskan', $pengaduanDiteruskan)
                ->description('Pengaduan yang diteruskan')
                ->chart([5, 3, 7, 2, 10, 3, 5])
                ->color('success'),
            
        ];
    }
}
