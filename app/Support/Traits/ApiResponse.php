<?php

namespace App\Support\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Send success response
     * @param string $message
     * @param $data
     * @param int $code
     * @param bool $error
     * @return JsonResponse
     */
    public function success(string $message = "",$data = [],int $code = Response::HTTP_OK): JsonResponse
    {
        return $this->response($message, $code, false, $data);
    }

    /**
     * Send error response
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function error(string $message = "",int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return $this->response($message, $code,true);
    }

    /**
     * Send response
     * @param string $message
     * @param int $code
     * @param bool $error
     * @return JsonResponse
     * @param $data
     */
    public function response(string $message = "",int $code = Response::HTTP_OK,$error = false,$data = []): JsonResponse
    {
        return response()->json([
            'data'      => $data,
            'message'   => $message,
            'status'    => $code,
            'error'     => $error
        ], $code);
    }

}