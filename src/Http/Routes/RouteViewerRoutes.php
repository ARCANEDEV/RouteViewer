<?php namespace Arcanedev\RouteViewer\Http\Routes;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     RouteViewerRoutes
 *
 * @package  Arcanedev\RouteViewer\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerRoutes extends RouteRegister
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Registrar $router)
    {
        $this->get('/', [
            'as'   => 'index', // route-viewer::index
            'uses' => 'RouteViewerController@index',
        ]);
    }
}
