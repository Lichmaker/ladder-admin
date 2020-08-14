<?php

namespace App\Components;

use App\Exceptions\RemoteCommandException;
use App\TraitLib\Singleton;
use Spatie\Ssh\Ssh;

class RemoteCommandHandler
{
    use Singleton;

    private $serverIP, $serverUser, $serverSshPort;

    private $sshConnectSession;

    protected function __construct()
    {
        $this->serverIP = config('v2ray.server_ip');
        $this->serverUser = config('v2ray.server_user');
        $this->serverSshPort = config('v2ray.server_ssh_port');

        $this->sshConnectSession = ssh2_connect($this->serverIP, $this->serverSshPort, ['hostkey'=>'ssh-rsa']);
        if (!$this->sshConnectSession) {
            logger()->error(__METHOD__. ' '.__LINE__. ' ssh2 连接失败');
            throw new RemoteCommandException('服务器连接失败');
        }
        if (!ssh2_auth_pubkey_file($this->sshConnectSession, 'root', config('v2ray.server_rsa_public_key'), config('v2ray.server_rsa_private_key'))) {
            logger()->error(__METHOD__. ' '.__LINE__. ' ssh2 rsa key 验证失败');
            throw new RemoteCommandException('服务器验证失败');
        }
        logger()->info('ssh2 连接成功');
    }

    public function run($command)
    {
        $execStream = ssh2_exec($this->sshConnectSession, $command);
        $stream = ssh2_fetch_stream($execStream, SSH2_STREAM_STDIO);
        stream_set_blocking($stream, true);
        return stream_get_contents($stream);
    }

    public function writeFile($localPath, $remotePath)
    {
        return ssh2_scp_send($this->sshConnectSession, $localPath, $remotePath, 0644);
    }
}
