<?php

namespace App\Services\SSH;

use App\Models\Server;
use phpseclib3\Net\SSH2;
use phpseclib3\Crypt\PublicKeyLoader;
use Exception;

class SSHService
{
    protected $ssh;

    public function __construct(string $host, int $port)
    {
        $this->ssh = new SSH2($host, $port);
    }

    public static function createFromServer(Server $server): static
    {
        $static = new static($server->host, $server->ssh_port);
        $check = $server->ssh_login_type == 'password'
            ? $static->connectUsingPassword($server->ssh_user, $server->ssh_password)
            : $static->connectUsingPrivateKey($server->ssh_user, $server->ssh_private_key);

        if (!$check) {
            throw new Exception('Attempt to connect to SSH server failed.');
        }
        return $check ? $static : false;
    }

    /**
     * Connects to the server using SSH
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function connectUsingPassword(string $username, string $password): bool
    {
        if (!$this->ssh->login($username, $password)) {
            return false;
        }
        return true;
    }

    /**
     * Connects to the server using a private key
     *
     * @param string $username
     * @param string $privateKey
     * @return bool
     */
    public function connectUsingPrivateKey(string $username, string $privateKey): bool
    {
        $privateKey = PublicKeyLoader::load($privateKey);

        if (!$this->ssh->login($username, $privateKey)) {
            return false;
        }
        return true;
    }

    /**
     * Executes a command on the server
     *
     * @param string $command
     * @return string
     */
    public function executeCommand(string $command): string
    {
        return $this->ssh->exec($command);
    }

    /**
     * Closes the SSH connection
     */
    public function closeConnection()
    {
        $this->ssh->disconnect();
    }
}
