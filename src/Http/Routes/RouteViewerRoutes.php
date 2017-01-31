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
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map routes.
     */
    public function map()
    {
        $this->get('/', [
            'as'   => 'index', // route-viewer::index
            'uses' => 'RouteViewerController@index',
        ]);
    }
}
