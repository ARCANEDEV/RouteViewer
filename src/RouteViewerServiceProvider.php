<?php namespace Arcanedev\RouteViewer;

use Arcanedev\Support\Providers\PackageServiceProvider;

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
    public function register(): void
    {
        parent::register();

        $this->registerConfig();

        $this->registerProvider(Providers\RouteServiceProvider::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->publishConfig();
        $this->publishViews();
    }
}
