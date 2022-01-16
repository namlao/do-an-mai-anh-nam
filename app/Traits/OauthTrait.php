<?php
namespace App\Traits;

use OAuth;
use OAuthException;

trait OauthTrait{

    public static function checkPermission($modelApi){
        $apiId = request()->session()->get('apiID');
        //get token
        $api = $modelApi->find($apiId);
        $api_key = $api->api_key;
        $secret_key = $api->secret_key;
        $oauth_token = $api->oauth_token;
        $oauth_token_secret = $api->oauth_token_secret;

        $oauth = new OAuth($api_key, $secret_key,
            OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
        $oauth->setToken($oauth_token, $oauth_token_secret);
        $oauth->disableSSLChecks();
        try {
            $data = $oauth->fetch("https://openapi.etsy.com/v2/oauth/scopes", null, OAUTH_HTTP_METHOD_GET);
            $json = $oauth->getLastResponse();
            $jsonDecode = json_decode($json, true);
            return $jsonDecode['results'];

        } catch (OAuthException $e) {
            error_log($e->getMessage());
            error_log(print_r($oauth->getLastResponse(), true));
            error_log(print_r($oauth->getLastResponseInfo(), true));
            exit;
        }

    }

    public static function callApi($modelApi,$uri,$method){
        $apiId = request()->session()->get('apiID');
        //get token
        $api = $modelApi->find($apiId);
        $api_key = $api->api_key;
        $secret_key = $api->secret_key;
        $oauth_token = $api->oauth_token;
        $oauth_token_secret = $api->oauth_token_secret;

        $oauth = new OAuth($api_key, $secret_key);
        $oauth->disableSSLChecks();

        $oauth->setToken($oauth_token, $oauth_token_secret);
        try {
            $data = $oauth->fetch("https://openapi.etsy.com/v2/".$uri, null, $method);
            $json = $oauth->getLastResponse();
            return json_decode($json, true);


        } catch (OAuthException $e) {
            error_log($e->getMessage());
            error_log(print_r($oauth->getLastResponse(), true));
            error_log(print_r($oauth->getLastResponseInfo(), true));
            exit;
        }
    }
}
