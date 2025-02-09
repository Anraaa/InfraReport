<?php

namespace App\Filament\Masyarakat\Resources\PengaduanResource\Pages;

use App\Filament\Masyarakat\Resources\PengaduanResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action as ActionsAction; // Untuk action di header
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;

class ViewPengaduan extends ViewRecord
{
    protected static string $resource = PengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionsAction::make('Tambah Komentar')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->form([
                    Hidden::make('pengaduan_id')->default($this->record->id),
                    Hidden::make('user_id')->default(Auth::id()),
                    Textarea::make('pesan')
                        ->label('Tulis Komentar')
                        ->placeholder('Masukkan komentar Anda...')
                        ->required(),
                ])
                ->action(function (array $data) {
                    Komentar::create($data);
                    $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                })
                ->modalHeading('Tambah Komentar')
                ->modalButton('Kirim')
                ->color('primary'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Grid::make(3)
                    ->schema([
                        // Kolom kiri (Detail Pengaduan)
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

                        // Kolom kanan (Informasi Tambahan)
                        Components\Section::make('Informasi Tambahan')
                            ->columnSpan(1)
                            ->schema([
                                Components\TextEntry::make('user.name')->label('Nama Pelapor'),
                                Components\TextEntry::make('created_at')->label('Dibuat Pada')->dateTime(),
                                Components\TextEntry::make('updated_at')->label('Diperbarui Pada')->dateTime(),
                            ]),
                    ]),

                // Section untuk Komentar
                Components\Section::make('Komentar')
                    ->columnSpanFull()
                    ->schema([
                        // Loop melalui semua komentar
                        ...$this->getKomentarSchema(),
                    ]),
            ]);
    }

    /**
     * Mengembalikan schema untuk menampilkan komentar.
     */
    protected function getKomentarSchema(): array
{
    $komentars = Komentar::where('pengaduan_id', $this->record->id)
        ->whereNull('parent_id') // Ambil hanya komentar utama
        ->with(['user', 'replies.user']) // Load user & balasan
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
                    ->icon('heroicon-o-reply')
                    ->color('primary')
                    ->modalHeading('Balas Komentar')
                    ->form([
                        Hidden::make('parent_id')->default($komentar->id),
                        Hidden::make('pengaduan_id')->default($komentar->pengaduan_id),
                        Hidden::make('user_id')->default(Auth::id()),
                        Textarea::make('pesan')
                            ->label('Balasan')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        Komentar::create($data);
                        $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                    })
                    ->visible(fn () => Auth::user()->hasRole('admin')), // Hanya admin yang bisa membalas

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
                    })
                    ->visible(fn () => $komentar->user_id === Auth::id()),

                Components\Actions\Action::make('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function () use ($komentar) {
                        $komentar->delete();
                        $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                    })
                    ->visible(fn () => $komentar->user_id === Auth::id()),
            ]),

            // **Menampilkan balasan komentar**
            ...$komentar->replies->map(function ($reply) {
                return Components\Group::make([
                    Components\TextEntry::make('user.name')
                        ->label('Nama (Balasan)')
                        ->default($reply->user->hasRole('admin') ? 'Admin' : $reply->user->name), // Jika admin, labelnya "Admin"

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
                            ->modalHeading('Edit Balasan')
                            ->form([
                                Textarea::make('pesan')
                                    ->label('Edit Balasan')
                                    ->default($reply->pesan)
                                    ->required(),
                            ])
                            ->action(function (array $data) use ($reply) {
                                $reply->update(['pesan' => $data['pesan']]);
                                $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                            })
                            ->visible(fn () => Auth::user()->hasRole('admin')),

                        Components\Actions\Action::make('Hapus')
                            ->icon('heroicon-o-trash')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->action(function () use ($reply) {
                                $reply->delete();
                                $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                            })
                            ->visible(fn () => Auth::user()->hasRole('admin')),
                    ]),
                ]);
            })->toArray(),
        ]);
    })->toArray();
}

}