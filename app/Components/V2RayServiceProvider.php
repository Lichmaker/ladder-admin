<?php

namespace App\Components;

use App\Exceptions\V2RayConfigException;
use App\Models\V2RayClientAttribute;
use App\TraitLib\Singleton;
use App\Models\V2RayConfiguration;
use Exception;
use Illuminate\Support\Facades\Storage;

class V2RayServiceProvider
{
    use Singleton;

    /**
     * @return string|null
     * @throws Exception
     */
    public function getUUid()
    {
        return V2RayCommandHandler::getInstance()->generateUUid();
    }

    public function generateVmessConfig($uuid, $email)
    {
        $vmessURL = VmessURLGenerator::getInstance()->generateByUuid($uuid, $email);

        return [
            'vmessURL' => $vmessURL,
            'QRCode' => '',
        ];
    }

    public function updateConfiguration(string $column, string $value)
    {
        switch ($column) {
            case 'v2ray_config_json':
                // 必须为json
                if (!is_array(json_decode($value, true))) {
                    throw new V2RayConfigException('数据不为json');
                }

                V2RayConfiguration::createOrUpdateData($column, $value);
                break;

            default:
                throw new V2RayConfigException('未知的column : '.$column);
        }
    }

    /**
     * 重启 v2ray
     */
    public function restartApp()
    {
        try {
            $result = V2RayCommandHandler::getInstance()->restart();
            logger()->info(__METHOD__.' 重启服务 :'.$result);
        } catch (Exception $exception) {
            logger()->error(__METHOD__.' 重启服务失败 :'.$exception->getMessage());
        }
    }

    /**
     * 获取当前配置文件json
     *
     * @param bool $fromDb
     * @param bool $getArray
     * @param int|null $encodeOptions
     * @return array|false|mixed|string
     * @throws Exception
     */
    public function getCurrentConfig(bool $fromDb = true, bool $getArray = false, int $encodeOptions = NULL)
    {
        if ($fromDb) {
            $json = V2RayConfiguration::getV2RayConfigJson();
        } else {
            $json = V2RayCommandHandler::getInstance()->readConfig();
        }
        logger()->debug(__METHOD__. ' 读取到配置json '.$json);
        $decode = json_decode($json, true);
        if (!is_array($decode) || empty($decode)) {
            throw new Exception('config读取失败 : '.$json);
        }
        $encodeOptions = is_null($encodeOptions) ? JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE : $encodeOptions;

        // 20200817 临时处理 policy 中的 level 和 stats 和 outbounds 中的 settings，强转为对象
        $levelsSetting = json_decode(json_encode($decode['policy']['levels'], JSON_FORCE_OBJECT));
        $decode['policy']['levels'] = $levelsSetting;
        $statsSetting = json_decode(json_encode($decode['stats'], JSON_FORCE_OBJECT));
        $decode['stats'] = $statsSetting;
        foreach ($decode['outbounds'] as &$outboundSetting) {
            $settings = json_decode(json_encode($outboundSetting['settings'], JSON_FORCE_OBJECT));
            $outboundSetting['settings'] = $settings;
        }

        return $getArray ? $decode : json_encode($decode, $encodeOptions);
    }

    /**
     * 获取配置文件路径
     *
     * @return mixed
     * @throws Exception
     */
    private function getConfigFilePath()
    {
        $path = env('V2RAY_CONFIG_PATH');
        if (empty($path)) {
            throw new Exception('undefined V2RAY_CONFIG_PATH');
        }
        return $path;
    }

    /**
     * 把配置写入服务器
     *
     * @throws Exception
     */
    public function writeConfigIntoFile()
    {
        $remoteConfigFilePath = $this->getConfigFilePath();
        logger()->info('读取远程配置文件路径 '.$remoteConfigFilePath);

        // 读取db的内容，覆盖写入到一个本地临时文件，然后scp上传到目标目录
        $configJsonFromDb = $this->getCurrentConfig(true, false, JSON_UNESCAPED_UNICODE);
        $tmpPath = '/tmp/'.uniqid().'.tmp.v2ray.config';
        try {
            logger()->info(__METHOD__ . ' local path '.$tmpPath);
            logger()->info(__METHOD__ . ' remote path '.$remoteConfigFilePath);
            file_put_contents($tmpPath, $configJsonFromDb);

        } catch (Exception $exception) {
            logger()->error("文件写入失败。 本地路径 {$tmpPath} 。 msg {$exception->getMessage()} ; trace {$exception->getTraceAsString()}");

            throw $exception;
        }

        // 上传到目标路径
        RemoteCommandHandler::getInstance()->writeFile($tmpPath, $remoteConfigFilePath);

        // 成功后删除本地文件
        @unlink($tmpPath);
    }

    public function synchronizeConfig()
    {
        logger()->debug(__METHOD__. ' 开始执行配置同步');

        // 从数据库中读取
        $configArray = $this->getCurrentConfig(true, true);
        if (empty($configArray)) {
            // 数据库中无数据，从服务器中获取
            $configArray = $this->getCurrentConfig(false, true);
        }
        if (empty($configArray) || !is_array($configArray)) {
            throw new V2RayConfigException('无法读取当前已有配置，请确认系统配置是否正确');
        }

        // 读取数据库中已有的client
        $clientConfig = $this->getClientConfig();

        // 遍历目前已有的配置，忽略掉已有email的数据，然后覆盖
        $clientSetting = NULL;
        logger()->debug(__METHOD__. ' config : '.json_encode($configArray));
        foreach ($configArray['inbounds'] as $key => $inboundSetting) {
            if ($inboundSetting['protocol'] == 'vmess' && isset($inboundSetting['settings'])) {
                $clientSetting = &$configArray['inbounds'][$key]['settings'];
            }
        }
        if (empty($clientSetting)) {
            throw new V2RayConfigException('无法读取vmess的clients设置，请确认系统配置是否正确');
        }
        $clientSetting['clients'] = $clientConfig;

        // 写入数据库
        V2RayServiceProvider::getInstance()->updateConfiguration('v2ray_config_json', json_encode($configArray, JSON_UNESCAPED_UNICODE));
    }

    public function getClientConfig()
    {
        $query = V2RayClientAttribute::all();

        $data = [];
        foreach ($query as $row) {
            $data[] = [
                'id' => $row->uuid,
                'alterId' => 32,
                'email' => $row->email,
                'level' => 0,
            ];
        }

        return $data;
    }
}
