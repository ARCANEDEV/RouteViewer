<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Http\Routes;

use Arcanedev\Support\Routing\RouteRegistrar;

/**
 * Class     RouteViewerRoutes
 *
 * @package  Arcanedev\RouteViewer\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map routes.
     */
    public function map(): void
    {
        $this->group($this->getRouteAttributes(), function () {
            $this->get('/', 'RouteViewerController@index')
                 ->name('index'); // route-viewer::index
        });
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the route attributes.
     *
     * @return array
     */
    private function getRouteAttributes(): array
    {
        return config('route-viewer.route.attributes', [
            'prefix'     => 'route-viewer',
            'as'         => 'route-viewer::',
            'namespace'  => 'Arcanedev\\RouteViewer\\Http\\Controllers',
        ]);
    }
}
