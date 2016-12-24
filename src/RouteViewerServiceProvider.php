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
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'route-viewer';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();

        $this->registerRouteViewer();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

        $this->publishConfig();
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

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the Route Viewer.
     */
    private function registerRouteViewer()
    {
        $this->singleton(Contracts\RouteViewer::class, RouteViewer::class);
    }
}
