<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class ApiExceptionHandler
{
    public static function handle(Throwable $e)
    {
        if ($e instanceof AuthenticationException || $e instanceof UnauthorizedHttpException) {
            return response()->json([
                'status'  => 401,
                'message' => 'No autenticado',
            ], 401);
        }

        if ($e instanceof AuthorizationException) {
            return response()->json([
                'status'  => 403,
                'message' => 'No autorizado',
            ], 403);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status'  => 404,
                'message' => 'Recurso no encontrado',
            ], 404);
        }

        if ($e instanceof ValidationException) {
            return response()->json([
                'status'  => 422,
                'message' => 'Datos inválidos',
                'errors'  => $e->errors(),
            ], 422);
        }

        if ($e instanceof HttpException) {
            return response()->json([
                'status'  => $e->getStatusCode(),
                'message' => $e->getMessage() ?: 'Error HTTP',
            ], $e->getStatusCode());
        }

        // Mensaje para errores desconocidos
        return response()->json([
            'status'  => 500,
            'message' => 'Error interno del servidor',
            'error'   => config('app.debug') ? $e->getMessage() : null,
        ], 500);
    }
}
