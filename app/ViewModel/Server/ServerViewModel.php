<?php

namespace App\ViewModel\Server;

use App\Models\Server;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\ViewModels\ViewModel;

#[TypeScript]
class ServerViewModel extends ViewModel
{

    public function __construct(private readonly Server $server)
    {
    }

    public function name(): string
    {
        return $this->server->name;
    }
   public function host(): string
    {
        return $this->server->host;
    }

    public function description(): string
    {
        return $this->server->description ?? '';
    }
}
