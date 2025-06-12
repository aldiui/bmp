<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

abstract class Controller
{
    public function successResponse($data = null, $message = 'Success', $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ], $code)->header('Content-Type', 'application/json');
    }

    public function errorResponse($data = null, $message = null, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => $code,
            'message' => $message ?? 'Error',
            'data' => $data,
        ], $code)->header('Content-Type', 'application/json');
    }
}
