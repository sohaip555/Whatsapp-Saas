<?php

namespace App\Providers\Filament;

use App\Filament\Companies\Widgets\DashboardChart;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use App\Filament\Companies\Widgets\DashboardStats;
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

class CompanyPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('company')
            ->login()
//            ->authGuard('company')
            ->path('company')
            ->colors([
                'primary' => Color::Amber,
                'gold' => '#FFD700',
                'silver' => '#C0C0C0',
                'platinum' => '#E5E4E2',
                'bronze' => '#B87333',
//                'bronze' => '#CD7F32',
            ])
            ->discoverResources(in: app_path('Filament/Companies/Resources'), for: 'App\\Filament\\Companies\\Resources')
            ->discoverPages(in: app_path('Filament/Companies/Pages'), for: 'App\\Filament\\Companies\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Companies/Widgets'), for: 'App\\Filament\\Companies\\Widgets')
            ->widgets([
//                SentMessagesStats::class,
//                TotalPaidStats::class,
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
            ->plugins([
                FilamentShieldPlugin::make()
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
