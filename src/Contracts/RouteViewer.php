<?php namespace Arcanedev\RouteViewer\Contracts;

/**
 * Interface  RouteViewer
 *
 * @package   Arcanedev\RouteViewer\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface RouteViewer
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get all routes.
     *
     * @return \Arcanedev\RouteViewer\Entities\RouteCollection
     */
    public function all();
}
