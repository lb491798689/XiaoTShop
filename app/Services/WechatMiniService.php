<?php

namespace App\Services;

use EasyWeChat\Factory; // https://github.com/overtrue/laravel-wechat
use Exception;

class WechatMiniService extends BaseService
{
    /**
     * Analyze the code and get user openid information
     *
     * @param $code
     * @return array
     */
    public function easyWechatGetSession($code, string $config = 'default')
    {
        $config = config('wechat.mini_program.' . $config);
        $app = Factory::miniProgram($config);
        return $app->auth->session($code);
    }

    /**
     * 解密小程序用户信息
     *
     * @param $session
     * @param $iv
     * @param $encryptData
     * @return void
     */
    public function encryptedData($session, $iv, $encryptData, string $config = 'default')
    {
        $config = config('wechat.mini_program.' . $config);

        $app = Factory::miniProgram($config);
        $decryptedData = $app->encryptor->decryptData($session, $iv, $encryptData);

        return $decryptedData;
    }
}
