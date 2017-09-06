<?php namespace Arcanedev\RouteViewer\Http\Routes;

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
    public function map()
    {
        $this->get('/', 'RouteViewerController@index')
             ->name('index'); // route-viewer::index
    }
}
