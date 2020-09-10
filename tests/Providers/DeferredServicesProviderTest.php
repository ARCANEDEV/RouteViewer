<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Tests\Providers;

use Arcanedev\RouteViewer\Tests\TestCase;

/**
 * Class     DeferredServicesProviderTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DeferredServicesProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\RouteViewer\Providers\DeferredServicesProvider */
    protected $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(\Arcanedev\RouteViewer\Providers\DeferredServicesProvider::class);
    }

    public function tearDown(): void
    {
        unset($this->provider);

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
            \Illuminate\Support\ServiceProvider::class,
            \Illuminate\Contracts\Support\DeferrableProvider::class,
            \Arcanedev\Support\Providers\ServiceProvider::class,
            \Arcanedev\RouteViewer\Providers\DeferredServicesProvider::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides(): void
    {
        $expected = [
            \Arcanedev\RouteViewer\Contracts\RouteViewer::class,
        ];

        static::assertSame($expected, $this->provider->provides());
    }
}
