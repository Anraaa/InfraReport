<?php

namespace App\Filament\Masyarakat\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $totalPengaduan = Pengaduan::where('user_id', Auth::user()->id)->count();
        $pengaduanMenunggu = Pengaduan::where('user_id', Auth::user()->id)->where('status', 'menunggu')->count();
        $pengaduanDiteruskan = Pengaduan::where('user_id', Auth::user()->id)->where('status', 'diteruskan')->count();
        $pengaduanDitolak = Pengaduan::where('user_id', Auth::user()->id)->where('status', 'ditolak')->count();

        return [
            Stat::make('Total Pengaduan', $totalPengaduan)
                ->description('Jumlah pengaduan yang diajukan')
                ->chart([10, 4, 6, 6, 10, 4, 17])
                ->color('primary'),
            Stat::make('Pengaduan Diteruskan', $pengaduanDiteruskan)
                ->description('Pengaduan yang sedang diproses')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Pengaduan Ditolak', $pengaduanDitolak)
                ->description('Pengaduan yang ditolak')
                ->chart([3, 5, 14, 5, 12, 8, 17])
                ->color('danger'),
        ];
    }

    // Set the widget sorting order
    public static function sort(): int
    {
        return 2; // This places it second
    }
}