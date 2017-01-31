<?php namespace Arcanedev\RouteViewer\Facades;

use Arcanedev\RouteViewer\Contracts\RouteViewer as RouteViewerContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class     RouteViewer
 *
 * @package  Arcanedev\RouteViewer\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return RouteViewerContract::class; }
}
