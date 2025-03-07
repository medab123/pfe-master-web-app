<?php

namespace App\ViewModel\Server;

use App\Models\Server;
use Illuminate\Database\Eloquent\Collection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\ViewModels\ViewModel;

#[TypeScript]
class ListServersViewModel extends ViewModel
{

    /**
     * ListServersViewModel constructor.
     * @param Collection<Server> $servers
     */
    public function __construct(private readonly ?Collection $servers)
    {
    }

    /**
     * @return \Illuminate\Support\Collection<ServerViewModel>|Collection
     */
    public function servers(): \Illuminate\Support\Collection|Collection
    {
        return $this->servers
            ? $this->servers->mapInto(ServerViewModel::class)
            : collect();
    }
}
