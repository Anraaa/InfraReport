<?php

namespace App\Filament\Masyarakat\Resources\PengaduanResource\Pages;

use App\Filament\Masyarakat\Resources\PengaduanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class ListPengaduans extends ListRecords
{
    protected static string $resource = PengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $userId = Auth::id();
        
        return [
            'all' => Tab::make('Semua Pengaduan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', $userId))
                ->badge(Pengaduan::where('user_id', $userId)->count()),

            'menunggu' => Tab::make('Menunggu')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', $userId)->where('status', 'menunggu'))
                ->badge(Pengaduan::where('user_id', $userId)->where('status', 'menunggu')->count()),

            'diteruskan' => Tab::make('Diteruskan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', $userId)->where('status', 'diteruskan'))
                ->badge(Pengaduan::where('user_id', $userId)->where('status', 'diteruskan')->count()),

            'ditolak' => Tab::make('Ditolak')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', $userId)->where('status', 'ditolak'))
                ->badge(Pengaduan::where('user_id', $userId)->where('status', 'ditolak')->count()),
        ];
    }
}