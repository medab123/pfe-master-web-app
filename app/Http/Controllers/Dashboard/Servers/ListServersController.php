<?php

namespace App\Http\Controllers\Dashboard\Servers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Server;
use App\Models\User;
use App\ViewModel\Server\ListServersViewModel;

class ListServersController extends Controller
{

    const INERTIA_PAGE_NAME = 'Servers/ListServers';
    public function __invoke()
    {
        /** @var User $user */
        $user = auth()->user();

        $servers = $user->company->servers;

        return inertia(self::INERTIA_PAGE_NAME, new ListServersViewModel($servers));
    }
}
