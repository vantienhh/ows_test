<?php

namespace App\Http\Request;

class Request
{
    public $method = null;

    public function getMethod()
    {
        if ($this->method !== null) {
            return $this->method;
        }
        $this->method = $_SERVER['REQUEST_METHOD'];
        return $this->method;
    }

    public function isMethodPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    public function isMethodPUT(): bool
    {
        return $this->getMethod() === 'PUT';
    }

    public function getDataRequest(): array
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
