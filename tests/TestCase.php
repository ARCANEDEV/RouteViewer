<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Tests;

use Arcanedev\RouteViewer\Tests\Stubs\Controllers\ContactController;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\RouteViewer\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            \Arcanedev\RouteViewer\RouteViewerServiceProvider::class,
            \Arcanedev\RouteViewer\Providers\DeferredServicesProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $this->registerRoutes($app['router']);
    }

    /* -----------------------------------------------------------------
     |  Other Functions
     | -----------------------------------------------------------------
     */

    /**
     * Register the routes for tests.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    private function registerRoutes(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->middleware('web')->group(function () use ($router) {
            $router->get('/', function () {
                return 'Homepage';
            })->name('public::home');

            $router->get('contact', [ContactController::class, '@getForm'])
                   ->name('public::contact.get');
        });
    }
}
