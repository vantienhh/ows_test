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

    public function getDataOfMethodPost(): array
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
