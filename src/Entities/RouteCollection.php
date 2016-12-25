<?php namespace Arcanedev\RouteViewer\Entities;

use Illuminate\Routing\Route as IlluminateRoute;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class     RouteCollection
 *
 * @package  Arcanedev\RouteViewer\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteCollection extends Collection
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Load the routes.
     *
     * @param  array  $routes
     * @param  array  $excludedUris
     * @param  array  $excludedMethods
     * @param  array  $methodColors
     *
     * @return self
     */
    public static function load(
        array $routes, array $excludedUris = [], array $excludedMethods = [], array $methodColors = []
    ) {
        return static::make($routes)
            ->filter(function (IlluminateRoute $route) use ($excludedUris) {
                return ! Str::startsWith($route->uri(), $excludedUris);
            })
            ->transform(function (IlluminateRoute $route) use ($excludedMethods, $methodColors) {
                return new Route(
                    static::prepareMethods($route, $excludedMethods, $methodColors),
                    $route->uri(),
                    $route->getActionName(),
                    $route->getName(),
                    static::prepareMiddleware($route),
                    $route->domain()
                );
            });
    }

    /**
     * Prepare route methods.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @param  array                      $excluded
     * @param  array                      $colors
     *
     * @return array
     */
    private static function prepareMethods(IlluminateRoute $route, array $excluded, array $colors)
    {
        return array_map(function ($method) use ($colors) {
            return [
                'name'  => $method,
                'color' => Arr::get($colors, $method),
            ];
        }, array_diff($route->getMethods(), $excluded));
    }

    /**
     * Prepare route middleware.
     *
     * @param  \Illuminate\Routing\Route  $route
     *
     * @return array
     */
    private static function prepareMiddleware(IlluminateRoute $route)
    {
        return array_map(function ($value) {
            return $value instanceof \Closure ? 'Closure' : $value;
        }, self::gatherMiddleware($route));
    }

    /**
     * Gather all the route middleware.
     *
     * @param  \Illuminate\Routing\Route  $route
     *
     * @return array
     */
    private static function gatherMiddleware(IlluminateRoute $route)
    {
        /** @var  array  $middleware */
        $middleware = $route->middleware();

        return is_callable([$route, 'controllerMiddleware'])
            ? array_unique(array_merge($middleware, $route->controllerMiddleware()), SORT_REGULAR)
            : $middleware;
    }
}