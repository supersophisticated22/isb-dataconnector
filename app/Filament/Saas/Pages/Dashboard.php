<?php

namespace App\Filament\Saas\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function getNavigationLabel(): string
    {
        return __('saas.pages.dashboard.navigation_label');
    }

    public function getTitle(): string
    {
        return __('saas.pages.dashboard.title');
    }
}
