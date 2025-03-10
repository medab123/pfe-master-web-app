<?php

namespace App\Jobs;

use App\Models\Server;
use App\Services\SSH\SSHService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class InstallAgentJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Server $server)
    {
        //
    }

    /**
     * Execute the job.
     * @throws \Exception
     */
    public function handle(): void
    {
        /** @var SSHService $sshService */
        $sshService = resolve(SSHService::class, ['host' => $this->server->host, 'port' => $this->server->ssh_port]);
        if($this->server->ssh_login_type == 'password') {
            if(!$sshService->connectUsingPassword($this->server->ssh_user,$this->server->ssh_password)){
                throw new \Exception('SSH authentication failed using password.');
            };
        }

        if($this->server->ssh_login_type == 'ssh_private_key') {
            if(!$sshService->connectUsingPrivateKey($this->server->ssh_user,$this->server->ssh_private_key)){
                throw new \Exception('SSH authentication failed using ssh_private_key.');
            };
        }

        $sshService->closeConnection();
    }
}
