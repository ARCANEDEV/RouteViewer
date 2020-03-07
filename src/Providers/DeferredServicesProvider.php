<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Providers;

use Arcanedev\RouteViewer\Contracts\RouteViewer as RouteViewerContract;
use Arcanedev\RouteViewer\RouteViewer;
use Arcanedev\Support\Providers\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class     DeferredServicesProvider
 *
 * @package  Arcanedev\RouteViewer\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DeferredServicesProvider extends ServiceProvider implements DeferrableProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        $this->singleton(RouteViewerContract::class, RouteViewer::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            RouteViewerContract::class,
        ];
    }
}
