<?php

namespace App\Http\Controllers;

use App\Response\ResponseHandler;

class UserController
{
    use ResponseHandler;

    public function profile()
    {
        return 'profile';
    }

    public function update()
    {
        return 'update';
    }
}
