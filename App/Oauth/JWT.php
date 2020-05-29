<?php

namespace App\Oauth;

class JWT
{
    const SYMBOL_SIGNATURE = '&&';    // Ký hiệu phân tách signature
    const SYMBOL_JWT       = '.';           // Ký hiệu phân tách các phần jwt

    const ISS    = 'tien';
    const HEADER = [
        'alg' => 'HS256',
        'typ' => 'JWT'
    ];

    public static function encode(array $payload)
    {
        $encodeHeader  = base64_encode(json_encode(self::HEADER));
        $encodePayload = base64_encode(json_encode(array_merge(
            ['iss' => self::ISS],
            $payload
        )));

        $timeStamp = strtotime('now');

        $encodeSignature = hash('sha256', implode(self::SYMBOL_SIGNATURE, array(
            $encodeHeader,
            $encodePayload,
            $timeStamp
        )));

        return $encodeHeader . self::SYMBOL_JWT . $encodePayload . self::SYMBOL_JWT . $encodeSignature;
    }

}
