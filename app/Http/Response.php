<?php

namespace App\Http;

use App\Enums\ResponseStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class Response
{

    /**
     * Create a success response
     *
     * @param array|JsonResource $data = []
     * @param string $message = ""
     * @param int $statusCode = 200 The HTTP status code
     *
     * @return JsonResponse
     */
    public function success(array|JsonResource $data = [], string $message = "", int $statusCode = 200): JsonResponse
    {
        return $this->json(
            $this->prepareData(
                data: $data,
                status: ResponseStatus::SUCCESS,
                message: ($message) ? $message : __('success_response'),
            ),
            $statusCode
        );
    }

    /**
     * Create a failed response
     *
     * @param int $statusCode The HTTP status code
     * @param string $message = "" The reason for the failed operation
     * @param array|JsonResource $data = []
     *
     * @return JsonResponse
     */
    public function failed(int $statusCode, string $message = "", array|JsonResource $data = []): JsonResponse
    {
        return $this->json(
            $this->prepareData(
                data: $data,
                status: ResponseStatus::FAILED,
                message: ($message) ? $message : __('failed_response'),
            ),
            $statusCode
        );
    }

    /**
     * Create a json response
     *
     * @param array $data
     * @param int $statusCode The HTTP status code
     *
     * @return JsonResponse
     */
    public function json(array $data, int $statusCode): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    /**
     * Prepare the response data
     *
     * @param array|JsonResource $data The response data
     * @param string $status
     * @param string $message = ""
     *
     */
    private function prepareData(array|JsonResource $data, string $status, string $message = ""): array
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }

}
