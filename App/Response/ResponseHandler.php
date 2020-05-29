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

    protected function unauthorizedResponse()
    {
        return json_encode([
            'code'    => 401,
            'status'  => 'error',
            'message' => 'Unauthorized'
        ]);
    }

    protected function methodNotAllowResponse()
    {
        return json_encode([
            'code'    => 405,
            'status'  => 'error',
            'message' => 'Method Not Allowed'
        ]);
    }

    protected function errorResponse($data)
    {
        return json_encode([
            'code'    => 422,
            'status'  => 'error',
            'data'    => $data,
            'message' => 'Unprocessable Entity'
        ]);
    }

    protected function serviceErrorResponse($message = null)
    {
        return json_encode([
            'code'    => 500,
            'status'  => 'error',
            'message' => $message ?? 'Internal Server Error'
        ]);
    }
}
