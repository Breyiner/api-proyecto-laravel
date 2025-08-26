<?php

namespace App\Helpers;

class ResponseFormatter
{
    /**
     * Create a new class instance.
     */
    public static function success($message = "Operación exitosa", $status = 200, $data) {

      return response()->json([
        "success"=> true,
        "code" => $status,
        "message"=> $message,
        "data" => $data
      ], $status);

    }

    public static function error($message, $status, $errors = []) {

      return response()->json([
        "success"=> false,
        "code" => $status,
        "message"=> $message,
        "erros" => $errors
      ], $status);

    }
}
