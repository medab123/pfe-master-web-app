<?php

namespace App\Http\Controllers\Dashboard\Servers;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServerRequest;
use App\Jobs\InstallAgentJob;
use App\Models\User;
use Illuminate\Http\Request;

class StoreServerController extends Controller
{
    /**
     * Handle the incoming request for showing the form and storing the server.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(StoreServerRequest $request)
    {
        $validated = $request->validated();
        /** @var User $user */
        $user = auth()->user();
        $server = $user->company->servers()->create($validated);

        if($request->get('auto_agent_install')){
            InstallAgentJob::dispatch($server);
        }

        return redirect()->route('servers.index')->with('success', 'Server created successfully.');

    }
}
