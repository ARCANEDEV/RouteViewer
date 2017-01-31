<?php namespace Arcanedev\RouteViewer\Providers;

use Arcanedev\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Contracts\Routing\Registrar as Router;
use Arcanedev\RouteViewer\Http\Routes;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanedev\RouteViewer\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
    |  Getters & Setters
    | ------------------------------------------------------------------------------------------------
    */
    /**
     * Get route attributes.
     *
     * @return array
     */
    public function routeAttributes()
    {
        return $this->config('attributes', [
            'prefix'     => 'route-viewer',
            'as'         => 'route-viewer::',
            'namespace'  => 'Arcanedev\\RouteViewer\\Http\\Controllers',
        ]);
    }

    /**
     * Check if routes is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->config('enabled', false);
    }

    /**
     * Get config value by key
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    private function config($key, $default = null)
    {
        /** @var  \Illuminate\Config\Repository  $config */
        $config = $this->app['config'];

        return $config->get("route-viewer.route.{$key}", $default);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Router $router)
    {
        if ($this->isEnabled()) {
            $router->group($this->routeAttributes(), function(Router $router) {
                Routes\RouteViewerRoutes::register($router);
            });
        }
    }
}
