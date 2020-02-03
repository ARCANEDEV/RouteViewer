<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Tests\Entities;

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
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $methods = $this->getMethods();
        $route   = new Route($methods, '/', 'Closure', 'public::home', ['web']);

        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \Arcanedev\RouteViewer\Entities\Route::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $route);
        }

        static::assertSame($methods, $route->methods);
        static::assertSame('/', $route->uri);
        static::assertSame('Closure', $route->action);
        static::assertSame('public::home', $route->name);
        static::assertSame(['web'], $route->middleware);
        static::assertEmpty($route->getActionNamespace());
        static::assertEmpty($route->getActionMethod());

        static::assertTrue($route->isClosure());
        static::assertTrue($route->hasName());
        static::assertFalse($route->hasDomain());
        static::assertTrue($route->hasMiddleware());
    }

    /** @test */
    public function it_can_get_action_namespace_and_method(): void
    {
        $namespace = 'App\\Http\\Controllers\\PagesController';
        $method    = 'index';
        $route     = new Route($this->getMethods(), '/', "{$namespace}@{$method}", 'public::home', ['web']);

        static::assertSame($namespace, $route->getActionNamespace());
        static::assertSame($method, $route->getActionMethod());
    }

    /** @test */
    public function it_can_get_params_from_uri(): void
    {
        $route = new Route($this->getMethods(), 'blog/posts/{id}', 'Closure', 'blog::post.show', ['web']);

        static::assertCount(1, $route->params);
        static::assertSame(['{id}'], $route->params);

        $route = new Route($this->getMethods(), 'blog/categories/{category}/{sub_category}', 'Closure', 'blog::categories.show', ['web']);

        static::assertCount(2, $route->params);
        static::assertSame(['{category}', '{sub_category}'], $route->params);
    }

    /** @test */
    public function it_can_convert_to_array(): void
    {
        $array = (new Route($this->getMethods(), '/', 'Closure', 'public::home', ['web']))->toArray();

        static::assertIsArray($array);

        foreach (['methods', 'uri', 'params', 'action', 'name', 'middleware', 'domain'] as $key) {
            static::assertArrayHasKey($key, $array);
        }

        static::assertSame('/', $array['uri']);
        static::assertEmpty($array['params']);
        static::assertSame('Closure', $array['action']);
        static::assertSame('public::home', $array['name']);
        static::assertSame(['web'], $array['middleware']);
        static::assertNull($array['domain']);
    }

    /** @test */
    public function it_can_convert_to_json(): void
    {
        $route = new Route($this->getMethods(), '/', 'Closure', 'public::home', ['web']);

        static::assertJson($route->toJson());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get methods.
     *
     * @return array
     */
    private function getMethods(): array
    {
        return [
            [
                'name'  => 'GET',
                'color' => 'success',
            ],
        ];
    }
}
