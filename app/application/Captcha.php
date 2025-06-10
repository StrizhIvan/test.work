<?php

namespace App\Application;

class Captcha
{
    private string $serverKey;
    //private string $clientKey;
    public function __construct()
    {
        //$this->serverKey = 'ysc2_IW6ysGiWpYnpcnrGCNs48ewd9NeW2JMCiq7cCkbo8755f299';
        //$this->clientKey = 'ysc1_IW6ysGiWpYnpcnrGCNs4qR4ZPV7D1F1gMfkr96Z327b70b18';
    }

    public function checkCaptcha($token)
    {
        $ch = curl_init("https://smartcaptcha.yandexcloud.net/validate");
        $args = [
            "secret" => $this->serverKey,
            "token" => $token,
            "ip" => $_SERVER['SERVER_ADDR'],
        ];

        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($httpcode !== 200) {
            return $httpcode;
        }
        
        $res = json_decode($server_output);
        return $res->status === 'ok';
    }

}