<?php

namespace App\Http\Controllers\Dashboard\Servers;


use App\Http\Controllers\Controller;
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
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ssh_login_type' => 'nullable|string',
            'ssh_user' => 'nullable|string|max:255',
            'ssh_port' => 'nullable|string|max:255',
            'ssh_password' => 'nullable|string',
            'ssh_private_key' => 'nullable|string',
        ]);

        /** @var User $user */
        $user = auth()->user();
        $user->company->servers()->create($validated);

        return redirect()->route('servers.index')->with('success', 'Server created successfully.');

    }
}
