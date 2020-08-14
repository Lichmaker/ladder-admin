<?php

namespace App\Components;

use App\TraitLib\Singleton;
use Exception;

class V2RayCommandHandler
{
    use Singleton;

    private $daemonPath;

    private $cliPath;

    private $configPath;

    private function __construct()
    {
        $this->daemonPath = config('v2ray.daemon_path');
        $this->cliPath = config('v2ray.cli_path');
        $this->configPath = config('v2ray.config_path');
    }

    /**
     * 生成一个uuid
     *
     * @return string|null
     * @throws Exception
     */
    public function generateUUid()
    {
        $command = $this->cliPath.' uuid';

        return $this->run($command);
    }

    /**
     * 重启 v2ray 服务
     *
     * @return string|null
     * @throws Exception
     */
    public function restart()
    {
        // 从config中读取重启的命令
        $command = config('v2ray.restart_command');

        return $this->run($command);
    }

    public function readConfig()
    {
        $command = "cat {$this->configPath}";

        return $this->run($command);
    }

    /**
     * 执行命令
     *
     * @param $command
     * @return string|null
     * @throws Exception
     */
    private function run($command)
    {
        try {
            logger()->info(__METHOD__. ' command : '.$command);
            $output = RemoteCommandHandler::getInstance()->run($command);
            logger()->info(__METHOD__. ' remote command output: '.$output);
            return $output;
        } catch (Exception $exception) {
            logger()->error(__METHOD__ . ' 执行失败 ： '.$exception->getMessage());
            throw new $exception;
        }
    }


}
