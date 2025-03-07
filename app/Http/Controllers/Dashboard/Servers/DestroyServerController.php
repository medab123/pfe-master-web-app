<?php

namespace App\Http\Controllers\Dashboard\Servers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DestroyServerController extends Controller
{
    public function __invoke(int $serverId)
    {
        /** @var User $user */
        $user = auth()->user();
        $server = $user->company->servers()->findOrFail($serverId);
        if(!$server){
            return redirect()->route('servers.index')->with('error', 'Server not found.');
        }

        $server->delete();

        return redirect()->route('servers.index')->with('success', 'Server Deleted successfully.');

    }
}
