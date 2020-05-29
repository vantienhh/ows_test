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

}
