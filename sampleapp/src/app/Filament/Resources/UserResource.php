<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Daftar Pengguna';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field Nama
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                // Field Email
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),

                // Field Role
                Select::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'masyarakat' => 'Masyarakat',
                    ])
                    ->required(),

                // Field is_admin (Toggle untuk menentukan apakah admin)
                Toggle::make('is_admin')
                    ->label('Admin')
                    ->required(),

                // Field Avatar
                FileUpload::make('avatar_url')
                    ->label('Avatar')
                    ->disk('public') // Menyimpan avatar di disk public
                    ->directory('avatars') // Lokasi penyimpanan avatar
                    ->image() // Hanya menerima file gambar
                    ->maxSize(10240), // Ukuran maksimal file 10MB
                    //->default(fn ($record) => $record->getFilamentAvatarUrl()), // Menampilkan avatar lama jika ada

                // Field Password
                TextInput::make('password')
                    ->label('Password')
                    ->required(fn ($get) => !$get('record')) // Password wajib diisi hanya pada saat create (bukan edit)
                    ->minLength(8) // Panjang minimal password
                    ->password() // This makes the input a password field
                    ->same('password_confirmation') // Verifikasi password dengan konfirmasi password
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)) // Enkripsi password sebelum disimpan
                    ->reactive(), // Agar field konfirmasi password hanya muncul jika password diisi

                // Konfirmasi Password
                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->required(fn ($get) => !$get('record')) // Password confirmation wajib diisi saat create
                    ->minLength(8)
                    ->password() // This makes the input a password field
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->getStateUsing(fn ($record) => $record->getFilamentAvatarUrl())
                    ->circular()
                    ->width(40)
                    ->height(40),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Custom filters can be added here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            // Relations can be added here if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            //'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
