<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Providers;

use Arcanedev\RouteViewer\Http\Routes\RouteViewerRoutes;
use Arcanedev\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanedev\RouteViewer\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        if ($this->isEnabled()) {
            static::mapRouteClasses([
                RouteViewerRoutes::class,
            ]);
        }
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if routes is enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool) ($this->app['config']['route-viewer.route.enabled'] ?: false);
    }
}
