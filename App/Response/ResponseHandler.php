<?php

namespace App\Response;

trait ResponseHandler
{
    protected function successResponse($data = [])
    {
        return json_encode([
            'code'   => 200,
            'status' => 'success',
            'data'   => $data
        ]);
    }

    protected function serviceErrorResponse($message = null)
    {
        return json_encode([
            'code'   => 500,
            'status' => 'error',
            'message' => $message or 'Internal Server Error'
        ]);
    }
}
