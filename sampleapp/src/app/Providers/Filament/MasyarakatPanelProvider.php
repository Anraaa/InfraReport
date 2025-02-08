<?php

namespace App\Providers\Filament;

use App\Filament\Masyarakat\Pages\Auth\LoginCustom as AuthLoginCustom;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources\PengaduanResource;
use Filament\Pages\Dashboard;
use Filament\Navigation\NavigationItem;
use Orion\FilamentGreeter\GreeterPlugin;
use Filament\Actions\Action;
use Filament\Navigation\MenuItem;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;


class MasyarakatPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        return $panel
            ->id('masyarakat')
            ->path('masyarakat')
            ->registration()
            ->login()
            ->emailVerification()
            ->passwordReset()
            ->brandName('InfraReport')
            ->breadcrumbs(false)
            ->userMenuItems([
                MenuItem::make()
                    ->label('Admin')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('/admin')
                    ->visible(fn (): bool => \Illuminate\Support\Facades\Auth::user()->is_admin)
            ])
            ->topNavigation()
            ->colors([
                'primary' => '#6366F1',
            ])
            ->discoverResources(in: app_path('Filament/Masyarakat/Resources'), for: 'App\\Filament\\Masyarakat\\Resources')
            ->discoverPages(in: app_path('Filament/Masyarakat/Pages'), for: 'App\\Filament\\Masyarakat\\Pages')
            ->pages([
                Dashboard::class,
                \App\Filament\Masyarakat\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Masyarakat/Widgets'), for: 'App\\Filament\\Masyarakat\\Widgets')
            ->widgets([
                //Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->plugins([
                //FilamentNordThemePlugin::make(),
                // ...
                FilamentEditProfilePlugin::make()
                ->setTitle('My Profile')
                ->setNavigationLabel('My Profile')
                ->setIcon('heroicon-o-user')
                ->setSort(10)
                ->shouldShowAvatarForm(
                    value: true,
                    directory: 'avatars', // image will be stored in 'storage/app/public/avatars
                    rules: 'mimes:jpeg,png|max:10240' //only accept jpeg and png files with a maximum size of 1MB
                ),
                GreeterPlugin::make()
                    ->message('Selamat Datang,')
                    ->name(\Filament\Facades\Filament::auth()->user()?->is_admin ? 'Admin' : 'Masyarakat')
                    ->title('Silahkan buat pengaduan anda')
                    ->avatar(size: 'w-16 h-16')
                    ->action(
                        Action::make('action')
                            ->label('Pengaduan Baru')
                            ->icon('heroicon-o-clipboard-document-list')
                            ->url('/masyarakat/pengaduans/create')
                            ->color('info')
                    )
                    ->sort(1)
                    ->columnSpan('full'),
                // ...
                ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }


    public function navigation(): array
{
    return [
        NavigationItem::make('Dashboard')
            ->url(route('filament.masyarakat.pages.dashboard'))
            ->icon('heroicon-o-home'),
        NavigationItem::make('Pengaduan')
            ->label('Pengaduan Saya')
            ->url(route('filament.masyarakat.resources.pengaduans.index'))
            ->icon('heroicon-o-document-text'),
    ];
}
}
