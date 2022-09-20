<?php

namespace App\Http\Traits;

trait HttpResponse
{
    public function success(
        $data,
        int $code = 200,
        string $message = 'Request was successful',
    ) {
        return response()->json([
            'satatus' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function error(
        $data,
        int $code = 401,
        string $message = 'Error has occurred',
    ) {
        return response()->json([
            'satatus' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
