<?php namespace Arcanedev\RouteViewer\Tests;

/**
 * Class     RouteViewerServiceProviderTest
 *
 * @package  Arcanedev\RouteViewer\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\RouteViewer\RouteViewerServiceProvider */
    protected $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(\Arcanedev\RouteViewer\RouteViewerServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanedev\Support\PackageServiceProvider::class,
            \Arcanedev\RouteViewer\RouteViewerServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            \Arcanedev\RouteViewer\Contracts\RouteViewer::class,
        ];

        $this->assertSame($expected, $this->provider->provides());
    }
}
