<?php

namespace App\Helpers;
class ResponseApi
{
    public function coreResponse($message, $data = null, int $statusCode = 200, $isSuccess = true)
    {
        if (!$message){
            return response()->json(['message' => 'Message is required'], 500);
        }

        // Send the response
        if ($isSuccess){
            return response()->json([
                'message'   => $message,
                'error'     => false,
                'code'      => $statusCode,
                'results'   => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message'   => $message,
                'error'     => true,
                'code'      => $statusCode,
            ], $statusCode);
        }

    }

    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, (int) $statusCode);
    }

    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, null, (int) $statusCode, false);
    }
}
