<?php

declare(strict_types=1);

namespace Arcanedev\RouteViewer\Tests\Stubs\Controllers;

use Illuminate\Routing\Controller;

/**
 * Class     ContactController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ContactController extends Controller
{
    public function getForm()
    {
        return 'contact form';
    }
}
