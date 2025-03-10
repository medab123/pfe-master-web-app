<?php

namespace App\Http\Controllers\Dashboard\Servers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\TestServerConnectivityRequest;
use App\Models\Server;
use App\Models\User;
use App\Services\SSH\SSHService;
use Inertia\Inertia;

class TestServerSSHConnectivityController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Show the form for creating a new server.
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function __invoke(TestServerConnectivityRequest $request)
    {

        /** @var SSHService $sshService */
        $server = (new Server)->fill($request->validated());
        $check = rescue(fn() => SSHService::createFromServer($server),false);

        if (!$check) {
            return to_route('servers.index')->with('error', 'SSH connection failed');
        }

        $check->closeConnection();
        return to_route('servers.index')->with('success', 'SSH connection success');
    }
}
