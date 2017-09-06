<?php namespace Arcanedev\RouteViewer;

use Arcanedev\RouteViewer\Contracts\RouteViewer as RouteViewerContract;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Routing\Registrar as Router;

/**
 * Class     RouteViewer
 *
 * @package  Arcanedev\RouteViewer
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewer implements RouteViewerContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The router instance.
     *
     * @var  \Illuminate\Routing\Router
     */
    private $router;

    /**
     * The config repository.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    private $config;

    /**
     * The route collection.
     *
     * @var \Arcanedev\RouteViewer\Entities\RouteCollection
     */
    protected $routes;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * RouteViewer constructor.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     * @param  \Illuminate\Contracts\Config\Repository  $config
     */
    public function __construct(Router $router, Config $config)
    {
        $this->router = $router;
        $this->config = $config;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all routes.
     *
     * @return \Arcanedev\RouteViewer\Entities\RouteCollection
     */
    public function all()
    {
        if (is_null($this->routes)) {
            $this->routes = Entities\RouteCollection::load(
                $this->router->getRoutes()->getRoutes(),
                $this->getExcludedUris(),
                $this->getExcludedMethods(),
                $this->getMethodColors()
            );
        }

        return $this->routes;
    }

    /**
     * Get the excluded URIs.
     *
     * @return array
     */
    public function getExcludedUris()
    {
        return $this->getConfig('uris.excluded', []);
    }

    /**
     * Get the excluded methods.
     *
     * @return array
     */
    public function getExcludedMethods()
    {
        return $this->getConfig('methods.excluded', ['HEAD']);
    }

    /**
     * Get method colors.
     *
     * @return array
     */
    private function getMethodColors()
    {
        return $this->getConfig('methods.colors', [
            'GET'    => 'success',
            'HEAD'   => 'default',
            'POST'   => 'primary',
            'PUT'    => 'warning',
            'PATCH'  => 'info',
            'DELETE' => 'danger',
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a config value.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    private function getConfig($key, $default = null)
    {
        return $this->config->get("route-viewer.{$key}", $default);
    }
}
