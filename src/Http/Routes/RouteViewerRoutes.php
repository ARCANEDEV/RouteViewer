<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Http\Routes;

use Arcanedev\RouteViewer\Http\Controllers\RouteViewerController;
use Arcanedev\Support\Routing\RouteRegistrar;

/**
 * Class     RouteViewerRoutes
 *
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
        $this->group(config('route-viewer.route.attributes'), function () {
            $this->get('/', [RouteViewerController::class, 'index'])
                 ->name('index'); // route-viewer::index
        });
    }
}
