<?php

namespace App\Util\Trait;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait ApiResponse {

    /**
     * Retorna sucesso
     *
     * @author Dereck Silva
     * @since 30/04/2023
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success(string $message, array $data, int $statusCode): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], $statusCode);
    }

    /**
     * Retorna um erro
     *
     * @author Dereck Silva
     * @since 30/04/2023
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error(string $message, array $data, int $statusCode): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data
        ], $statusCode);
    }

    /**
     * Retorno de exception com base na requisição
     *
     * @author Dereck Silva
     * @since 30/04/2023
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return HttpResponseException
     */
    public function httpException(string $message, array $data, int $statusCode): HttpResponseException {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data
        ], $statusCode));
    }

}