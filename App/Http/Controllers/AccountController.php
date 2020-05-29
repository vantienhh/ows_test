<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Exceptions\ValidationsException;
use App\Http\Middleware\Authenticate;
use App\Http\Validate\Validate;
use App\Models\Token;
use App\Models\User;
use App\Oauth\JWT;
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

    /**
     * @var Token
     */
    public $token;

    public function __construct()
    {
        $this->user    = new User();
        $this->token   = new Token();
        $this->request = new Request;
    }

    public function login()
    {
        try {
            if ($this->request->isMethodPost()) {
                // check validate
                Validate::validateLogin($this->request);

                $data     = $this->request->getDataOfMethodPost();
                $password = hash('sha256', $data['email'] . $data['password']);

                if ($user = $this->user->getAccount($data['email'], $password)) {
                    $accessToken = JWT::encode($data);

                    $this->token->findAndNew([
                        'user_id' => $user['id'],
                        'token'   => $accessToken
                    ]);
                    return $this->successResponse([
                        'token_type'   => 'Bearer',
                        'access_token' => $accessToken
                    ]);
                }
                return $this->errorResponse([
                    'errors' => [
                        'authen' => ['Thông tin đăng nhập không chính xác.']
                    ]
                ]);
            }
            return $this->methodNotAllowResponse();
        } catch (ValidationsException $e) {
            return $this->errorResponse([
                'errors' => ['authen' => $e->getMessage()]
            ]);
        } catch (\Exception $e) {
            return $this->serviceErrorResponse();
        }
    }

    public function logout()
    {
        try {
            $authenicate = new Authenticate();
            $authenicate->authenticate();

            $this->token->delete($authenicate->getToken(), $authenicate->user()['id']);
            return $this->successResponse([]);
        } catch (UnauthorizedException $e) {
            return $this->unauthorizedResponse();
        } catch (\Exception $e) {
            return $this->serviceErrorResponse();
        }
    }

}
