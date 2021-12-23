<?php
namespace App\Helpers;

use App\Models\Setting;

class getConfigSetting{
    public static function getConfigValue($config_key){
        $setting = Setting::select('config_key','config_value')->where('config_key',$config_key)->first();
        if (!empty($setting)){
            return $setting->config_value;
        }
        return null;
    }
}
