<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;

abstract class Controller
{
    public function successResponse($data, $message = 'success', $code = 200): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    public function errorResponse($errors, $message = 'error', $code = 500): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'data'    => $errors,
        ], $code);
    }
}
