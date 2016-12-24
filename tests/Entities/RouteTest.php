<?php namespace Arcanedev\RouteViewer\Tests\Entities;

use Arcanedev\RouteViewer\Entities\Route;
use Arcanedev\RouteViewer\Tests\TestCase;

/**
 * Class     RouteTest
 *
 * @package  Arcanedev\RouteViewer\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $methods = $this->getMethods();
        $route   = new Route($methods, '/', 'Closure', 'public::home', ['web']);

        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \Arcanedev\RouteViewer\Entities\Route::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $route);
        }

        $this->assertSame($methods, $route->methods);
        $this->assertSame('/', $route->uri);
        $this->assertSame('Closure', $route->action);
        $this->assertSame('public::home', $route->name);
        $this->assertSame(['web'], $route->middleware);
        $this->assertEmpty($route->getActionNamespace());
        $this->assertEmpty($route->getActionMethod());

        $this->assertTrue($route->isClosure());
        $this->assertTrue($route->hasName());
        $this->assertFalse($route->hasDomain());
        $this->assertTrue($route->hasMiddleware());
    }

    /** @test */
    public function it_can_get_action_namespace_and_method()
    {
        $namespace = 'App\\Http\\Controllers\\PagesController';
        $method    = 'index';
        $route     = new Route($this->getMethods(), '/', "{$namespace}@{$method}", 'public::home', ['web']);

        $this->assertSame($namespace, $route->getActionNamespace());
        $this->assertSame($method, $route->getActionMethod());
    }

    /** @test */
    public function it_can_get_params_from_uri()
    {
        $route = new Route($this->getMethods(), 'blog/posts/{id}', 'Closure', 'blog::post.show', ['web']);

        $this->assertCount(1, $route->params);
        $this->assertSame(['{id}'], $route->params);

        $route = new Route($this->getMethods(), 'blog/categories/{category}/{sub_category}', 'Closure', 'blog::categories.show', ['web']);

        $this->assertCount(2, $route->params);
        $this->assertSame(['{category}', '{sub_category}'], $route->params);
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $array = (new Route($this->getMethods(), '/', 'Closure', 'public::home', ['web']))->toArray();

        $this->assertInternalType('array', $array);

        foreach (['methods', 'uri', 'params', 'action', 'name', 'middleware', 'domain'] as $key) {
            $this->assertArrayHasKey($key, $array);
        }

        $this->assertSame('/', $array['uri']);
        $this->assertEmpty($array['params']);
        $this->assertSame('Closure', $array['action']);
        $this->assertSame('public::home', $array['name']);
        $this->assertSame(['web'], $array['middleware']);
        $this->assertNull($array['domain']);
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $route = new Route($this->getMethods(), '/', 'Closure', 'public::home', ['web']);

        $this->assertJson($route->toJson());
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get methods.
     *
     * @return array
     */
    private function getMethods()
    {
        return [
            [
                'name'  => 'GET',
                'color' => 'success',
            ]
        ];
    }
}
