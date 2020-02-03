<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Tests;

/**
 * Class     RouteViewerTest
 *
 * @package  Arcanedev\RouteViewer\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\RouteViewer\Contracts\RouteViewer */
    protected $routeViewer;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->routeViewer = $this->app->make(\Arcanedev\RouteViewer\Contracts\RouteViewer::class);
    }

    public function tearDown(): void
    {
        unset($this->routeViewer);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $expectations = [
            \Arcanedev\RouteViewer\Contracts\RouteViewer::class,
            \Arcanedev\RouteViewer\RouteViewer::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->routeViewer);
        }
    }

    /** @test */
    public function it_can_get_all_routes(): void
    {
        $routes = $this->routeViewer->all();

        static::assertInstanceOf(\Arcanedev\RouteViewer\Entities\RouteCollection::class, $routes);
        static::assertCount(2, $routes);
    }

    /** @test */
    public function it_can_view_the_route_viewer(): void
    {
        $response = $this->get('route-viewer');

        $response->isOk();

        static::assertStringContainsString(
            '<h1>Routes <small>| 2 routes registered</small></h1>',
            $response->content()
        );
    }
}
