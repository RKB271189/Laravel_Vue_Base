<?php

namespace App\Usables_Extensions;

trait ClientURL
{
    public function RequestURL(string $url = '', bool $requesttype, array $headers = [], $jsonencodefields)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $requesttype);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonencodefields);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}
