<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use App\Models\Token;
use App\Models\User;
use App\Oauth\JWT;

class Authenticate
{
    /**
     * @var Token
     */
    private $token;

    private $user          = null;
    private $authorization = null;

    public function __construct()
    {
        $this->token = new Token();
        $this->authenticate();
    }

    public function issetAuthorization()
    {
        $headers = apache_request_headers();

        if (!isset($headers['Authorization'])) {
            throw new UnauthorizedException();
        }

        $this->authorization = $headers['Authorization'];
    }

    public function authenticate()
    {
        $this->issetAuthorization();
        $token = $this->getToken();

        if ($objToken = $this->token->findByToken($token)) {
            $this->user = (new User())->getById($objToken['user_id']);
        } else {
            throw new UnauthorizedException();
        }
    }

    public function user()
    {
        return $this->user;
    }

    public function getToken(): string
    {
        $listAuthor = explode(' ', $this->authorization);

        if ($listAuthor[0] !== 'Bearer') {
            throw new UnauthorizedException();
        }
        return $listAuthor[1];
    }

}
