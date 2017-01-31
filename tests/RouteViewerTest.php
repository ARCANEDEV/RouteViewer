<?php namespace Arcanedev\RouteViewer\Tests;

/**
 * Class     RouteViewerTest
 *
 * @package  Arcanedev\RouteViewer\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\RouteViewer\Contracts\RouteViewer */
    protected $routeViewer;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->routeViewer = $this->app->make(\Arcanedev\RouteViewer\Contracts\RouteViewer::class);
    }

    public function tearDown()
    {
        unset($this->routeViewer);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\RouteViewer\Contracts\RouteViewer::class,
            \Arcanedev\RouteViewer\RouteViewer::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->routeViewer);
        }
    }

    /** @test */
    public function it_can_get_all_routes()
    {
        $routes = $this->routeViewer->all();

        $this->assertInstanceOf(\Arcanedev\RouteViewer\Entities\RouteCollection::class, $routes);
        $this->assertCount(2, $routes);
    }

    /** @test */
    public function it_can_get_all_routes_via_facade()
    {
        $routes = \Arcanedev\RouteViewer\Facades\RouteViewer::all();

        $this->assertInstanceOf(\Arcanedev\RouteViewer\Entities\RouteCollection::class, $routes);
        $this->assertCount(2, $routes);
    }

    /** @test */
    public function it_can_view_the_route_viewer()
    {
        $response = $this->get('route-viewer');

        $response->isOk();

        $this->assertContains(
            '<h1>Routes <small>| 2 routes registered</small></h1>',
            $response->content()
        );
    }
}
