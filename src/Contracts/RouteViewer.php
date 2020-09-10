<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Contracts;

/**
 * Interface  RouteViewer
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface RouteViewer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all routes.
     *
     * @return \Arcanedev\RouteViewer\Entities\RouteCollection
     */
    public function all();
}
