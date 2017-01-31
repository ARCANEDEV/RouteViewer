<?php namespace Arcanedev\RouteViewer\Http\Controllers;

use Arcanedev\RouteViewer\Contracts\RouteViewer;
use Illuminate\Routing\Controller as IlluminateController;

/**
 * Class     Controller
 *
 * @package  Arcanedev\RouteViewer\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller extends IlluminateController
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The route viewer instance
     *
     * @var \Arcanedev\RouteViewer\Contracts\RouteViewer
     */
    protected $routeViewer;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
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
}
