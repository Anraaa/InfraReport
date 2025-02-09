<?php

namespace App\Filament\Masyarakat\Resources;

use App\Filament\Masyarakat\Resources\PengaduanResource\Pages;
use App\Models\Pengaduan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\DeleteAction;



class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list'; // Ganti icon sesuai kebutuhan
    protected static ?string $navigationGroup = 'Lapor Pengaduan';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('user_id', Auth::id())->count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_user')
                    ->label('Nama Anda')
                    ->default(\Illuminate\Support\Facades\Auth::user()->name) // Ambil nama user yang sedang login
                    ->disabled(),
                // Menyimpan user_id secara otomatis
                Forms\Components\Hidden::make('user_id')
                    ->default(\Illuminate\Support\Facades\Auth::user()->id),
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto')
                    ->disk('cloudinary')
                    ->directory(fn () => 'pengaduan/' . Auth::user()->name . "/")
                    ->preserveFilenames()
                    ->maxSize(10240) 
                    ->image() 
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'diteruskan' => 'Diteruskan',
                        'ditolak' => 'Ditolak',
                    ])
                    ->required()
                    ->reactive()
                    // Ensure it can only be edited by admin
                    ->disabled(fn (Forms\Components\Select $component) => $component->getModel() === 'diteruskan') // Disable if 'Diteruskan'
                    ->hidden(fn () => !\Illuminate\Support\Facades\Auth::user()->hasRole('admin')), // Hide unless admin
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->where('user_id', auth()->id())) // Filter berdasarkan user yang login
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pengguna')
                    ->searchable(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($record) => match ($record->status) {
                        'menunggu' => 'warning',
                        'diteruskan' => 'success',
                        'ditolak' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('filter')
                    ->options([
                        '7_hari_terakhir' => '7 Hari Terakhir',
                        '2_minggu_terakhir' => '2 Minggu Terakhir',
                        '1_bulan_terakhir' => '1 Bulan Terakhir',
                        //'per_minggu' => 'Per Minggu',
                    ])
                    ->query(function ($query, array $data) {
                        $latestDate = \App\Models\Pengaduan::max('created_at'); // Ambil tanggal terbaru

                        if (!$latestDate) {
                            return $query; // Jika tidak ada data, kembalikan query tanpa filter
                        }

                        $latestDate = \Carbon\Carbon::parse($latestDate); // Konversi ke Carbon

                        return match ($data['value'] ?? null) {
                            '7_hari_terakhir' => $query->whereBetween('created_at', [$latestDate->copy()->subDays(6), $latestDate]),
                            '2_minggu_terakhir' => $query->whereBetween('created_at', [$latestDate->copy()->subWeeks(2), $latestDate]),
                            '1_bulan_terakhir' => $query->whereBetween('created_at', [$latestDate->copy()->subMonth(), $latestDate]),
                            default => $query,
                        };
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                DeleteAction::make()
                ->label('Hapus Pengaduan')
                ->visible(fn ($record) => $record->status === 'menunggu') // Menampilkan aksi hanya untuk admin dan jika status 'menunggu'
                ->after(function ($action, $record) {
                    // Aksi setelah penghapusan
                    // Anda bisa menambahkan logika jika diperlukan setelah penghapusan
                }),
                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => $record->status !== 'diteruskan') // Jika "diteruskan", tombol edit disembunyikan
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaduans::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'view' => Pages\ViewPengaduan::route('/{record}'),
            //'edit' => Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }
}