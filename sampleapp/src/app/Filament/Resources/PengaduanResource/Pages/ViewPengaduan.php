<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\ButtonAction;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;

class ViewPengaduan extends ViewRecord
{
    protected static string $resource = PengaduanResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Grid::make(3)
                    ->schema([
                        Components\Section::make('Detail Pengaduan')
                            ->columnSpan(2)
                            ->schema([
                                Components\TextEntry::make('judul')->label('Judul'),
                                Components\TextEntry::make('deskripsi')->label('Deskripsi'),
                                Components\TextEntry::make('lokasi')->label('Lokasi'),
                                Components\ImageEntry::make('foto')->label('Foto')->disk('cloudinary')->height(300),
                                Components\TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'menunggu' => 'warning',
                                        'diteruskan' => 'success',
                                        'ditolak' => 'danger',
                                    }),
                            ]),

                        Components\Section::make('Informasi Tambahan')
                            ->columnSpan(1)
                            ->schema([
                                Components\TextEntry::make('user.name')->label('Nama Pelapor'),
                                Components\TextEntry::make('created_at')->label('Dibuat Pada')->dateTime(),
                                Components\TextEntry::make('updated_at')->label('Diperbarui Pada')->dateTime(),
                            ]),
                    ]),

                Components\Section::make('Komentar')
                    ->columnSpanFull()
                    ->schema([
                        ...$this->getKomentarSchema(),
                    ]),
            ]);
    }

    protected function getKomentarSchema(): array
{
    $komentars = Komentar::where('pengaduan_id', $this->record->id)
        ->whereNull('parent_id') // Hanya komentar utama
        ->with(['user', 'replies.user']) // Load user dan balasan
        ->get();

    return $komentars->map(function ($komentar) {
        return Components\Group::make([
            Components\TextEntry::make('user.name')
                ->label('Nama')
                ->default($komentar->user->name),
            Components\TextEntry::make('pesan')
                ->label('Pesan')
                ->default($komentar->pesan),
            Components\TextEntry::make('created_at')
                ->label('Dikirim Pada')
                ->default($komentar->created_at->format('d-m-Y H:i')),

            Components\Actions::make([
                Components\Actions\Action::make('Balas')
                    ->icon('heroicon-o-arrow-uturn-right')
                    ->color('primary')
                    ->modalHeading('Balas Komentar')
                    ->form([
                        Hidden::make('pengaduan_id')->default($this->record->id),
                        Hidden::make('user_id')->default(Auth::id()),
                        Hidden::make('parent_id')->default($komentar->id),
                        Textarea::make('pesan')
                            ->label('Tulis Balasan')
                            ->placeholder('Masukkan balasan Anda...')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        Komentar::create($data);
                        $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                    })
                    ->visible(fn () => Auth::user()->hasRole('admin') || Auth::id() === $komentar->user_id),

                Components\Actions\Action::make('Edit')
                    ->icon('heroicon-o-pencil')
                    ->color('info')
                    ->modalHeading('Edit Komentar')
                    ->form([
                        Textarea::make('pesan')
                            ->label('Edit Komentar')
                            ->default($komentar->pesan)
                            ->required(),
                    ])
                    ->action(function (array $data) use ($komentar) {
                        $komentar->update(['pesan' => $data['pesan']]);
                        $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                    }),

                Components\Actions\Action::make('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function () use ($komentar) {
                        $komentar->delete();
                        $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                    }),
            ]),

            // Menampilkan balasan jika ada
            ...$komentar->replies->map(function ($reply) {
                return Components\Group::make([
                    Components\TextEntry::make('user.name')
                        ->label('Nama (Balasan)')
                        ->default($reply->user->name),
                    Components\TextEntry::make('pesan')
                        ->label('Balasan')
                        ->default($reply->pesan),
                    Components\TextEntry::make('created_at')
                        ->label('Dikirim Pada')
                        ->default($reply->created_at->format('d-m-Y H:i')),
            
                    Components\Actions::make([
                        Components\Actions\Action::make('Edit')
                            ->icon('heroicon-o-pencil')
                            ->color('info')
                            ->modalHeading('Edit Komentar')
                            ->form([
                                Textarea::make('pesan')
                                    ->label('Edit Komentar')
                                    ->default($reply->pesan)
                                    ->required(),
                            ])
                            ->action(function (array $data) use ($reply) {
                                $reply->update(['pesan' => $data['pesan']]);
                                $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                            })
                            ->visible(fn () => Auth::user()->hasRole('admin') || Auth::id() === $reply->user_id),
            
                        Components\Actions\Action::make('Hapus')
                            ->icon('heroicon-o-trash')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->action(function () use ($reply) {
                                $reply->delete();
                                $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                            })
                            ->visible(fn () => Auth::user()->hasRole('admin') || Auth::id() === $reply->user_id),
                    ]),
                ]);
            })->toArray(),            
        ]);
    })->toArray();
}

}
