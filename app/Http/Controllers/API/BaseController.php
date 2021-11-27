<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /* ---------------------------- success response ---------------------------- */
    public function sendResponse($result, $message, $code)
    {
        $response = [
            'success' => true,
            'status'  => $code,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }

    /* ----------------------------- error response ----------------------------- */
    public function sendError($error, $errorMessages = [], $code)
    {
        $response = [
            'success' => false,
            'status'  => $code,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
