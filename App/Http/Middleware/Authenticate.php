<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use App\Models\Token;

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
        $this->checkAuthorization();
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
        $token = $this->getToken();

        if ($user = $this->token->findByToken($token)) {
            $this->user = $user;
        } else {
            throw new UnauthorizedException();
        }
    }

    public function user()
    {
        if (!$this->user) {
            $this->authenticate();
        }
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
