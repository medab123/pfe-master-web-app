<?php

namespace App\Http\Controllers\Dashboard\Servers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DestroyServerController extends Controller
{
    public function __invoke(int $serverId)
    {
        /** @var User $user */
        $user = auth()->user();
        $server = $user->company->servers()->findOrFail($serverId);
        if(!$server){
            return Inertia::location(route('servers.index'));
        }

        $server->delete();

        return Inertia::location(route('servers.index'));

    }
}
