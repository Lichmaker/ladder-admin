<?php

namespace App\Components;

use App\Exceptions\V2RayClientException;
use App\Models\V2RayClientAttribute;
use Illuminate\Database\Eloquent\Model;

class V2RayClientManager
{
    public static function createClientWithAdminUserId(int $adminUserId, string $email)
    {
        $expire_at = date('Y-m-d', strtotime('next month'));  // 初始默认为下个月

        $uuid = V2RayServiceProvider::getInstance()->getUuid();
        $v2rayConfig = V2RayServiceProvider::getInstance()->generateVmessConfig($uuid, $email);
        $v2ray_qrcode = '#';  // 暂不提供
        $v2ray_vmess = $v2rayConfig['vmessURL'];

        $model = new V2RayClientAttribute();
        $model->admin_user_id = $adminUserId;
//        $model->v2ray_qrcode = $v2ray_qrcode;
        $model->v2ray_vmess = $v2ray_vmess;
        $model->uuid = $uuid;
        $model->expire_at = $expire_at;
        $model->email = $email;
        $model->bandwidth_usage_max = -1;   // 默认无限
        if (!$model->save()) {
            throw new \Exception(__METHOD__.' save failed . '.json_encode($model->getAttributes(), JSON_UNESCAPED_UNICODE));
        }
    }

    public static function getLastStatTimestamp($email)
    {
        $query = \App\Admin\Repositories\V2RayClientAttribute::make()->createEloquent()->newQuery()->where([
            'email' => $email,
        ])->first();
        if (empty($query)) {
            throw new V2RayClientException('email not found');
        }

        return $query->stat_updated_at;
    }

    public static function updateLastStatTimestamp($email)
    {
        $query = \App\Admin\Repositories\V2RayClientAttribute::make()->createEloquent()->newQuery()->where([
            'email' => $email,
        ])->first();
        if (empty($query)) {
            throw new V2RayClientException('email not found');
        }
        $query->stat_updated_at = date('Y-m-d H:i:s');
        if (!$query->save()) {
            throw new \Exception(__METHOD__.' save failed . '.json_encode($query->getAttributes(), JSON_UNESCAPED_UNICODE));
        }
    }

    /**
     * @param $email
     * @return Model|object|null
     */
    public static function getClientByEmail(string $email)
    {
        return \App\Admin\Repositories\V2RayClientAttribute::make()->createEloquent()->newQuery()->where([
            'email' => $email,
        ])->first();
    }

    /**
     * @param V2RayClientAttribute $v2RayClientAttribute
     * @return int|mixed|null
     * @throws \Exception
     */
    public static function getRemainUsage(V2RayClientAttribute $v2RayClientAttribute)
    {
        // 获取当前月数据
        $model = BandwidthStatisticsSummaryHandler::getInstance()->getModel($v2RayClientAttribute->email);
        if (empty($model)) {
            return NULL;
        }

        return $v2RayClientAttribute->bandwidth_usage_max > 0 ? $v2RayClientAttribute->bandwidth_usage_max - $v2RayClientAttribute->usage : -1;
    }
}
