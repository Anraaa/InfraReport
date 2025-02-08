<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Components\Tab;

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
            ->modifyQueryUsing(fn (Builder $query) => $query)
            ->badge(Pengaduan::count()),

        'menunggu' => Tab::make('Menunggu')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'menunggu'))
            ->badge(Pengaduan::where('status', 'menunggu')->count()),

        'diteruskan' => Tab::make('Diteruskan')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'diteruskan'))
            ->badge(Pengaduan::where('status', 'diteruskan')->count()),

        'ditolak' => Tab::make('Ditolak')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'ditolak'))
            ->badge(Pengaduan::where('status', 'ditolak')->count()),
    ];
}
}
