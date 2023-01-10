<?php

namespace App\Components;

use App\Exceptions\V2RayException;
use App\TraitLib\Singleton;

class VmessURLGenerator
{
    use Singleton;

    protected $host;

    protected $path;

    protected function __construct()
    {
        // 读取 host 配置
        $this->host = config('v2ray.config_host');
        $this->path = config('v2ray.config_url_path');
    }

    /**
     * @param string $uuid
     * @param string $email
     * @param int $alterId
     * @return string
     */
    public function generateByUuid(string $uuid, string $email,int $alterId = 32)
    {
        $data = $this->build($uuid, $alterId, $email);

        return $this->render($data);
    }

    protected function build($uuid, $alterId, $email)
    {
        $data = $this->getTemplate();
        $data['ps'] = $email;
        $data['host'] = $data['add'] = $this->host;
        $data['path'] = $this->path;
        $data['id'] = $uuid;
        $data['aid'] = $alterId;
        return $data;
    }

    protected function render($data)
    {
        return 'vmess://'.base64_encode(json_encode($data));
    }


    public function getTemplate()
    {
        return [
//            'port' => '443',
            'port' => '3006',
            'ps' => NULL,
            'tls' => 'tls',
            'id' => NULL,
            'aid' => NULL,
            'v' => '2',
            'host' => NULL,
            'type' => 'none',
            'path' => NULL,
            'net' => 'ws',
            'add' => NULL,
        ];
    }
}
