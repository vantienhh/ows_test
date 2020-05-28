<?php

namespace App\Http\Controllers;

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
            $data['password'] = hash('sha256', $data['email'] . $data['password']);

            if ($user = $this->user->getAccount($data['email'], $data['password'])) {
                return $this->successResponse($user);
            }
            return $this->errorResponse([
                'errors' => [
                    'authen' => ['Thông tin đăng nhập không chính xác.']
                ]
            ]);
        } catch (\Exception $e) {
            echo $this->serviceErrorResponse();
        }
    }

    public function logout()
    {
        return 'logout';
    }

}
