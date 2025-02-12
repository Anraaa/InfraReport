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
//use App\Events\KomentarBaru;


class ViewPengaduan extends ViewRecord
{
    protected static string $resource = PengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
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
                         // Tombol Tambah Komentar
                    Components\Actions::make([
                        Components\Actions\Action::make('Tambah Komentar')
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
                    ])
                    ->alignment('left'), // Menyusun tombol di kiri atas

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

    return $komentars->flatMap(function ($komentar) {
        return [
            // Komentar utama (Masyarakat) di kiri
            Components\Grid::make(2)
                ->schema([
                    Components\Group::make([
                        Components\TextEntry::make('user.name')
                            ->label('')
                            ->default($komentar->user->name),
                            //->color('gray'),
                        
                        Components\TextEntry::make('pesan')
                            ->label('')
                            ->default($komentar->pesan)
                            //->color('gray')
                            ->extraAttributes([
                                'class' => 'bg-gray-100 dark:bg-gray-800 dark:text-white-100 rounded-lg p-2' , // Styling untuk chat bubble masyarakat
                            ]),

                        Components\TextEntry::make('created_at')
                            ->label('')
                            ->default($komentar->created_at->format('d-m-Y H:i'))
                            //->color('gray')
                            ->size('sm'),

                        Components\Actions::make([
                            Components\Actions\Action::make('Balas')
                                ->icon('heroicon-o-arrow-uturn-right')
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
                                ->visible(fn () => Auth::user()->is_admin == true), // Hanya admin yang bisa membalas

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
                                ->visible(fn () => Auth::id() === $komentar->user_id), // Hanya pemilik komentar yang bisa edit

                            Components\Actions\Action::make('Hapus')
                                ->icon('heroicon-o-trash')
                                ->color('danger')
                                ->requiresConfirmation()
                                ->action(function () use ($komentar) {
                                    $replies = $komentar->replies;
                                    
                                    if($replies->isNotEmpty()){
                                        $komentarLain = Komentar::whereNull('parent_id')
                                        ->where('pengaduan_id', $komentar->pengaduan_id)
                                        ->where('id', '!=', $komentar->id)
                                        ->first();

                                        if($komentarLain){
                                            foreach($replies as $reply){
                                                $reply->update(['parent_id' => $komentarLain->id]);
                                            }
                                        } else{
                                            $komentar->replies()->delete();
                                        }
                                    }

                                    $komentar->delete();

                                    $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                                })
                                ->visible(fn () => Auth::id() === $komentar->user_id || Auth::user()->is_admin), // Admin atau pemilik bisa hapus
                        ])
                    ])->columnSpan(1), // Taruh komentar masyarakat di kolom kiri
                    
                    Components\Group::make([])->columnSpan(1), // Kosongkan kolom kanan untuk admin
                ])
                ->columnSpanFull(),

            // Menampilkan balasan admin di sebelah kanan
            ...$komentar->replies->map(function ($reply) {
                return Components\Grid::make(2)
                    ->schema([
                        Components\Group::make([])->columnSpan(1), // Kosongkan kolom kiri untuk masyarakat

                        Components\Group::make([
                            Components\TextEntry::make('')
                                ->label('')
                                ->default('Admin') // Nama Admin fixed jadi "Admin"
                                ->color('blue'),

                                Components\TextEntry::make('pesan')
                                ->label('')
                                ->default($reply->pesan)
                                ->color('blue')
                                ->extraAttributes([
                                    'class' => 'bg-gray-100 dark:bg-gray-800 dark:text-white-100 rounded-lg p-2' , // Styling untuk chat bubble admin
                                ]),

                            Components\TextEntry::make('created_at')
                                ->label('')
                                ->default($reply->created_at->format('d-m-Y H:i'))
                                ->color('blue')
                                ->size('sm'),

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
                                    ->visible(fn () => Auth::user()->is_admin == true), 

                                Components\Actions\Action::make('Hapus')
                                    ->icon('heroicon-o-trash')
                                    ->color('danger')
                                    ->requiresConfirmation()
                                    ->action(function () use ($reply) {
                                        $reply->delete();
                                        $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]));
                                    })
                                    ->visible(fn () => Auth::user()->is_admin == true), 
                            ])
                        ])->columnSpan(1), // Taruh balasan admin di kolom kanan
                    ])
                    ->columnSpanFull();
            })->toArray(),
        ];
    })->toArray();
}



}