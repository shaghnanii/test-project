<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function response404($message): JsonResponse
    {
        return response()->json(['message' => $message], 404);
    }

    public function response500($message): JsonResponse
    {
        return response()->json(['message' => $message], 500);
    }

    public function response200($message, $data): JsonResponse
    {
        return response()->json(['message' => $message, 'data' => $data]);
    }

    public function response401($message): JsonResponse
    {
        return response()->json(['message' => $message], 401);
    }
}
