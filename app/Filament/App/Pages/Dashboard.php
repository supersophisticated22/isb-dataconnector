<?php

namespace App\Filament\App\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    public static function getNavigationLabel(): string
    {
        return __('saas.pages.dashboard.navigation_label');
    }

    public function getTitle(): string
    {
        return __('saas.pages.dashboard.title');
    }
}
