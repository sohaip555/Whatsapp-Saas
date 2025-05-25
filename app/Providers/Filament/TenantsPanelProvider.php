<?php

namespace App\Providers\Filament;

use App\Filament\Tenants\Widgets\DashboardChart;
use App\Filament\Tenants\Widgets\DashboardStats;
use App\Filament\Tenants\Widgets\SentMessagesStats;
use App\Filament\Tenants\Widgets\TotalPaidStats;
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

class TenantsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('tenants')
            ->login()
            ->authGuard('tenant')
            ->path('tenants')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Tenants/Resources'), for: 'App\\Filament\\Tenants\\Resources')
            ->discoverPages(in: app_path('Filament/Tenants/Pages'), for: 'App\\Filament\\Tenants\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Tenants/Widgets'), for: 'App\\Filament\\Tenants\\Widgets')
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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
