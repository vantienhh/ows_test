<?php

namespace App\Oauth;

class JWT
{
    const HEADER = [
        'alg' => 'HS256',
        'typ' => 'JWT'
    ];

    const ISS = 'tien';

    public static function encode(array $payload)
    {
        $encodePayload   = base64_encode(json_encode(array_merge(
            ['iss' => self::ISS],
            $payload
        )));
        $encodeHeader    = base64_encode(json_encode(self::HEADER));
        $encodeSignature = base64_encode($_ENV['JWT_SIGNATURE']);

        return $encodeHeader . '.' . $encodePayload . '.' . $encodeSignature;
    }

    public static function decode(string $jwt)
    {
//        $encodePayload   = base64_encode(json_encode(array_merge(
//            ['iss' => 'tien'],
//            $payload
//        )));
        $encodeHeader    = base64_encode(json_encode(self::HEADER));
        $decodeSignature = base64_encode(base64_decode($_ENV['JWT_SIGNATURE']));
        die;
    }
}
