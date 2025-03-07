<?php

namespace App\Http\Controllers\Dashboard\Servers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CreateServerPageController extends Controller
{
    /**
     * Show the form for creating a new server.
     *
     * @return \Inertia\Response
     */
    public function __invoke()
    {
        return Inertia::render('Servers/Create');
    }
}
