<?php namespace Arcanedev\RouteViewer\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

/**
 * Class     Route
 *
 * @package  Arcanedev\RouteViewer\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Route implements Arrayable, Jsonable, JsonSerializable
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var array */
    public $methods = [];

    /** @var string */
    public $uri;

    /** @var array */
    public $params = [];

    /** @var string */
    public $action;

    /** @var string */
    public $name;

    /** @var array */
    public $middleware;

    /** @var string|null */
    public $domain;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Route constructor.
     *
     * @param  array        $methods
     * @param  string       $uri
     * @param  string|null  $name
     * @param  string|null  $action
     * @param  array        $middleware
     * @param  string|null  $domain
     */
    public function __construct(array $methods, $uri, $action, $name, array $middleware, $domain = null)
    {
        $this->methods    = $methods;
        $this->setUri($uri);
        $this->action     = $action;
        $this->name       = $name;
        $this->middleware = $middleware;
        $this->domain     = $domain;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the route URI.
     *
     * @param  string  $uri
     *
     * @return self
     */
    private function setUri($uri)
    {
        $this->uri = $uri;

        preg_match_all('/({[^}]+})/', $this->uri, $matches);
        $this->params = $matches[0];

        return $this;
    }

    /**
     * Get the action namespace.
     *
     * @return string
     */
    public function getActionNamespace()
    {
        return $this->isClosure() ? '' : explode('@', $this->action)[0];
    }

    /**
     * Get the action method.
     *
     * @return string
     */
    public function getActionMethod()
    {
        return $this->isClosure() ? '' : explode('@', $this->action)[1];
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the route has name.
     *
     * @return bool
     */
    public function hasName()
    {
        return ! is_null($this->name);
    }

    /**
     * Check if the route has domain.
     *
     * @return bool
     */
    public function hasDomain()
    {
        return ! is_null($this->domain);
    }

    /**
     * Check if the route has middleware.
     *
     * @return bool
     */
    public function hasMiddleware()
    {
        return ! empty($this->middleware);
    }

    /**
     * Check if the action is a closure function.
     *
     * @return bool
     */
    public function isClosure()
    {
        return $this->action === 'Closure';
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'methods'    => $this->methods,
            'uri'        => $this->uri,
            'params'     => $this->params,
            'action'     => $this->action,
            'name'       => $this->name,
            'middleware' => $this->middleware,
            'domain'     => $this->domain,
        ];
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}
