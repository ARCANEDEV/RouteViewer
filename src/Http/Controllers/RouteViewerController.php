<?php namespace Arcanedev\RouteViewer\Http\Controllers;

use Arcanedev\RouteViewer\Contracts\RouteViewer;
use Illuminate\Routing\Controller;

/**
 * Class     RouteViewerController
 *
 * @package  Arcanedev\RouteViewer\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerController extends Controller
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The route viewer instance
     *
     * @var \Arcanedev\RouteViewer\Contracts\RouteViewer
     */
    protected $routeViewer;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Controller constructor.
     *
     * @param  \Arcanedev\RouteViewer\Contracts\RouteViewer  $routeViewer
     */
    public function __construct(RouteViewer $routeViewer)
    {
        $this->routeViewer = $routeViewer;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the routes.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $theme = config('route-viewer.theme', 'bootstrap-3');

        return view("route-viewer::{$theme}.index", [
            'routes' => $this->routeViewer->all(),
        ]);
    }
}
