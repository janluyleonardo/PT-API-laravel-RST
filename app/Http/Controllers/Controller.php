<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * errorResponse
     *
     * @param  mixed $code
     * @param  mixed $message
     * @param  mixed $service
     * @return void
     */
    public function errorResponse($code, $message, $service)
    {
        $response = response()->json([
            'code' => $code,
            'message' => $message,
            'details' => [
                'Servicio' => $service . '',
            ],
        ], $code);
        return $response;
    }

    /**
     * extractDetailError
     *
     * @param  mixed $errorMessage
     * @return void
     */
    public function extractDetailError($errorMessage)
    {
        $detailPattern = '/ERROR: (.+?)\./';
        preg_match($detailPattern, $errorMessage, $matches);
        if (isset($matches[1])) {
            $detail = $matches[1];
            return $detail;
        } else {
            return $errorMessage;
        }
    }
}
