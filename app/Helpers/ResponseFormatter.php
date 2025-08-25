<?php

namespace App\Helpers;

class ResponseFormatter
{
    /**
     * Create a new class instance.
     */
    public static function success($data, $message = "Operación exitosa", $status = 200) {

      return response()->json([
        "success"=> true,
        "code" => $status,
        "message"=> $message,
        "data" => $data
      ]);

    }
}
