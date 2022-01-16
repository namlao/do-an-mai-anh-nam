<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class checkApi{
    public static function checkApiEtsy($api_key){
        $response = Http::get('https://openapi.etsy.com/v2/listings/active?api_key=' . $api_key)->successful();
        if ($response) {
            return true;
        }
        return false;
    }
}
