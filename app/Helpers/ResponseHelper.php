<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class ResponseHelper 
{
    public static function response($data=null, $status=200)
    {
        return response()->json($data, $status);
    }
    
    public static function notFoundResponse($message)
    {
        $response = [
            'url' => URL::full(),
            'method' => Request::getMethod(),
            'code' => 404,
            'message' => $message
        ];

        return response($response, 404);
    }
}