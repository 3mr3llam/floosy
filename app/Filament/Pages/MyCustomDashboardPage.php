<?php

namespace App\Filament\Pages;

use Awcodes\Overlook\Widgets\OverlookWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets;
use Filament\Pages\Page;

class MyCustomDashboardPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.my-custom-dashboard-page';

    public static function getNavigationLabel(): string
    {
        return __('pages.home');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OverlookWidget::class,
            // Widgets\PageViewsWidget::class,
            // Widgets\VisitorsWidget::class,
            // Widgets\ActiveUsersOneDayWidget::class,
            // Widgets\ActiveUsersSevenDayWidget::class,
            // Widgets\ActiveUsersTwentyEightDayWidget::class,
            // Widgets\SessionsWidget::class,
            // Widgets\SessionsDurationWidget::class,
            // Widgets\SessionsByCountryWidget::class,
            // Widgets\SessionsByDeviceWidget::class,
            // Widgets\MostVisitedPagesWidget::class,
            // Widgets\TopReferrersListWidget::class,
        ];
    }
}
