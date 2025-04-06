<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use InfyOm\Generator\Utils\ResponseUtil;
use Illuminate\Support\Facades\Response;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message): \Illuminate\Http\JsonResponse
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404): \Illuminate\Http\JsonResponse
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message): \Illuminate\Http\JsonResponse
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
