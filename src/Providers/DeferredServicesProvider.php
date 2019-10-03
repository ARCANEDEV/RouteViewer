<?php namespace Arcanedev\RouteViewer\Providers;

use Arcanedev\RouteViewer\{Contracts, RouteViewer};
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

        $this->singleton(Contracts\RouteViewer::class, RouteViewer::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            Contracts\RouteViewer::class,
        ];
    }
}
