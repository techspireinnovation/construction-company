<?php

namespace App\Traits;

trait Response {

    public function successResponse($message)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }
    
    public function errorResponse($message)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ]);
    }

}



