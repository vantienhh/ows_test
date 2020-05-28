<?php

namespace App\Http\Controllers;

use App\Exceptions\ConnectDatabaseException;
use App\Models\User;
use App\Response\ResponseHandler;
use App\Http\Request\Request;

class AccountController
{
    use ResponseHandler;

    /**
     * @var User
     */
    private $user;

    /**|
     * @var Request
     */
    public $request;

    public function __construct()
    {
        $this->user    = new User();
        $this->request = new Request;
    }

    public function login()
    {
        try {
            $data = $this->request->getDataOfMethodPost();
            // check validate

            echo $this->successResponse($this->user->getAccount($data['email'], $data['password']));
        } catch (\Exception $e) {
            echo $this->serviceErrorResponse();
        }
    }

    public function logout()
    {
        echo 'logout';
    }

    public function profile()
    {
        echo 'profile';
    }

    public function update()
    {
        echo 'update';
    }

    public function register()
    {
        echo 'register';
    }

}
