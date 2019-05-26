<?php

return [

    /* -----------------------------------------------------------------
     |  Route settings
     | -----------------------------------------------------------------
     */

    'route'         => [
        'enabled'    => true,

        'attributes' => [
            'prefix'     => 'route-viewer',

            'as'         => 'route-viewer::',

            'namespace'  => 'Arcanedev\\RouteViewer\\Http\\Controllers',

            // 'middleware' => [],
        ],
    ],

    /* -----------------------------------------------------------------
     |  URIs
     | -----------------------------------------------------------------
     */

    'uris'     => [
        'excluded' => [
            'route-viewer',
            '_debugbar',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Methods
     | -----------------------------------------------------------------
     */

    'methods'  => [
        'excluded' => [
            'HEAD',
        ],

        'colors' => [
            'GET'    => 'success',
            'HEAD'   => 'default',
            'POST'   => 'primary',
            'PUT'    => 'warning',
            'PATCH'  => 'info',
            'DELETE' => 'danger',
        ],
    ],
];
