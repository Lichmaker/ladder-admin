<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class V2RayConfiguration extends Model
{
    protected $table = 'v2ray_configurations';

    public static function createOrUpdateData(string $column, string $value)
    {
        $model = self::query()->where(['option' => $column])->first();
        if (empty($model)) {
            $model = new self();
        }
        $model->option = $column;
        $model->value = $value;
        $model->updateTimestamps();
        return $model->save();
    }

    public static function getV2RayConfigJson()
    {
        $column = 'v2ray_config_json';
        return self::getDataByOption($column);
    }

    public static function getDataByOption($option)
    {
        $query = self::query()->firstWhere('option', $option);
        return empty($query) ? NULL : $query->value;
    }
}
