<?php namespace Arcanedev\RouteViewer\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\RouteViewer\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Arcanedev\RouteViewer\RouteViewerServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'RouteViewer' => \Arcanedev\RouteViewer\Facades\RouteViewer::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $this->registerRoutes($app['router']);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    private function registerRoutes(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group([
            'middleware' => 'web',
            'namespace'  => 'Arcanedev\\RouteViewer\\Tests\\Stubs\\Controllers'
        ], function (\Illuminate\Contracts\Routing\Registrar $router) {
            $router->get('/', function () {
                return 'Homepage';
            });

            $router->get('contact', [
                'as'   => 'public::contact.get',
                'uses' => 'ContactController@getForm',
            ]);
        });
    }
}
