<?php

namespace App\Services\Api;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseService
{
    private int $code = Response::HTTP_OK;

    private array $headers = [];

    private array $response = [
        'result' => null,
        'status' => 200,
        'success' => true,
    ];

    /**
     * @param  null  $data
     * @return ApiResponseService
     */
    public function success($data = null): static
    {
        $this->response['result'] = $data;

        return $this;
    }

    public function error(?string $messageCode = null, array $errors = []): static
    {
        $this->code = Response::HTTP_BAD_REQUEST;
        $this->response['errors'] = $errors;
        $this->response['success'] = false;
        $this->response['status'] = $this->code;
        $this->response['message'] = '';

        if ($messageCode) {
            $this->response['message'] = [
                'message' => __('validation.' . $messageCode),
            ];
        }

        return $this;
    }

    /**
     * @param  null  $code
     */
    public function respond($code = null, array $headers = []): JsonResponse
    {
        if ($code) {
            $this->code = $code;
            $this->response['status'] = $code;
        }

        if ($headers) {
            $this->headers = $headers;
        }

        return response()->json(
            $this->response,
            $this->code,
            $this->headers
        );
    }
}
