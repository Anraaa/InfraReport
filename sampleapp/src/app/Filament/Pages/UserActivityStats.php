<?php

namespace App\Filament\Pages;

use App\Models\ActivityLog;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserActivityStats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.user-activity-stats';
    protected static ?string $navigationLabel = 'Stats Aktivitas Pengguna';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?int $navigationSort = 2;

    /* public function getHeaderWidgets(): array
    {
        return [
            StatsOverviewWidget::class => [
                Stat::make('Total Users', User::count()),
                Stat::make('Total Activities', ActivityLog::count()),
                Stat::make('Latest Activity', ActivityLog::latest()->first()?->activity ?? 'No activity yet'),
            ],
        ];
    } */

    protected function getViewData(): array
{
    $activities = ActivityLog::with('user')
    ->where('activity_type', 'login') // Hanya tampilkan aktivitas login
    ->latest()
    ->take(10)
    ->get();

return [
    'activities' => $activities,
];
}


}
