<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer;

use Arcanedev\RouteViewer\Providers\RouteServiceProvider;
use Arcanedev\Support\Providers\PackageServiceProvider;

/**
 * Class     RouteViewerServiceProvider
 *
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

        $this->registerProvider(RouteServiceProvider::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->loadTranslations();
        $this->loadViews();

        if ($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->publishTranslations();
            $this->publishViews();
        }
    }
}
