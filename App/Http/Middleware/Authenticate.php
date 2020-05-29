<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use App\Models\Token;
use App\Models\User;

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

    public function checkAuthorization()
    {
        $headers = apache_request_headers();

        if (!isset($headers['Authorization'])) {
            throw new UnauthorizedException();
        }

        $this->authorization = $headers['Authorization'];
    }

    public function authenticate()
    {
        $this->checkAuthorization();
        $token = $this->getToken();

        if ($token = $this->token->findByToken($token)) {
            $this->user = (new User())->getById($token['user_id']);
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
