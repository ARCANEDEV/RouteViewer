<?php namespace Arcanedev\RouteViewer;

use Arcanedev\Support\PackageServiceProvider;

/**
 * Class     RouteViewerServiceProvider
 *
 * @package  Arcanedev\RouteViewer
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'route-viewer';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

        $this->registerConfig();

        $this->singleton(Contracts\RouteViewer::class, RouteViewer::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

        $this->publishConfig();
        $this->publishViews();
        $this->registerProvider(Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Contracts\RouteViewer::class,
        ];
    }
}
