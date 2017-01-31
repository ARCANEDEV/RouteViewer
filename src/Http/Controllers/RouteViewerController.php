<?php namespace Arcanedev\RouteViewer\Http\Controllers;

/**
 * Class     RouteViewerController
 *
 * @package  Arcanedev\RouteViewer\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $routes = $this->routeViewer->all();

        return view('route-viewer::index', compact('routes'));
    }
}
