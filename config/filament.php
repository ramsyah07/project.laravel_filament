<?php

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

return [

    /*
    |--------------------------------------------------------------------------
    | Filament Path
    |--------------------------------------------------------------------------
    |
    | The path for the Filament admin panel.
    |
    | Note: this is a path relative to the website's domain.
    |
    */

    'path' => env('FILAMENT_PATH', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Filament Domain
    |--------------------------------------------------------------------------
    |
    | The domain for the Filament admin panel.
    |
    | Note: this is an optional setting for multi-tenant applications.
    |
    */

    'domain' => env('FILAMENT_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Filament Name
    |--------------------------------------------------------------------------
    |
    | The name of the Filament admin panel.
    |
    */

    'name' => env('APP_NAME'),

    /*
    |--------------------------------------------------------------------------
    | Filament Unauthenticated Routes
    |--------------------------------------------------------------------------
    |
    | The URL paths to the unauthenticated pages of the Filament admin panel.
    |
    | You can add your own unauthenticated routes here.
    |
    */

    'unauthenticated_routes' => [
        'login',
    ],

    /*
    |--------------------------------------------------------------------------
    | Filament Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware are applied to every request of the Filament admin panel.
    |
    */

    'middleware' => [
        'base' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            // Baris ini dihapus karena tidak ditemukan di instalasi Anda
            DispatchServingFilamentEvent::class,
        ],
        'auth' => [
            Authenticate::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Filament Assets
    |--------------------------------------------------------------------------
    |
    | All of the assets of the Filament admin panel.
    |
    */

    'assets' => [
        'style' => [
            'theme' => env('FILAMENT_THEME', null), // Nilai `FilamentAsset::load` diubah menjadi `null`
            'custom' => [],
        ],
        'script' => [],
    ],

    'fonts' => [
        'inter' => 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap',
    ],

];

