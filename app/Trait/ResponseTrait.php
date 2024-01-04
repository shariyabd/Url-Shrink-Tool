<?php

namespace App\Trait;
trait ResponseTrait
{
    public function successResponse($message, $data = null, $statusCode = 200)
    {
        return response()->json([
            'success' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function errorResponse($message, $statusCode = 400)
    {
        return response()->json([
            'error' => $message,
        ], $statusCode);
    }
}


?>