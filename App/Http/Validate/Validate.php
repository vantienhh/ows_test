<?php

namespace App\Http\Validate;

use App\Exceptions\ValidationsException;
use App\Http\Request\Request;

class Validate
{
    public static function validateLogin(Request $request)
    {
        $data = $request->getDataRequest();

        if (!array_key_exists('email', $data) || !array_key_exists('password', $data)) {
            throw new ValidationsException('Dữ liệu không chính xác');
        }
    }

    public static function validateUpdateProfile(Request $request)
    {
        $data = $request->getDataRequest();

        if (!array_key_exists('address', $data) || !array_key_exists('name', $data)) {
            throw new ValidationsException('Dữ liệu không chính xác');
        }
    }
}
