<?php

namespace App\Filament\Masyarakat\Pages;

use App\Filament\Masyarakat\Widgets\StatsOverview;
use App\Filament\Masyarakat\Widgets\RecentComplaintsWidget;
use App\Models\Pengaduan;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.masyarakat.pages.dashboard';

    protected static ?string $slug = 'masyarakat'; // Ubah slug menjadi /masyarakat/

    public $totalPengaduan;
    public $pengaduanDiteruskan;
    public $pengaduanDitolak;

    public function mount()
    {
        $this->totalPengaduan = Pengaduan::where('user_id', Auth::user()->id)->count();
        $this->pengaduanDiteruskan = Pengaduan::where('user_id', Auth::user()->id)->where('status', 'diteruskan')->count();
        $this->pengaduanDitolak = Pengaduan::where('user_id', Auth::user()->id)->where('status', 'ditolak')->count();
    }

    protected function getHeaderWidgets(): array
{
    return [
        StatsOverview::class, // StatsOverview muncul di atas
    ];
}



    protected function getTableQuery()
    {
        return Pengaduan::where('user_id', Auth::id())->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false; // Sembunyikan dari navigasi jika perlu
    }
}