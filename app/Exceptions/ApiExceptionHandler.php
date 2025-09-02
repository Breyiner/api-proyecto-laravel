<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ApiExceptionHandler
{
    public static function handle(Throwable $e)
    {
        if ($e instanceof AuthenticationException || $e instanceof UnauthorizedHttpException) {
            return ResponseFormatter::error('No autenticado', 401);
        }

        if ($e instanceof AuthorizationException) {
            return ResponseFormatter::error('No autorizado', 403);
        }

        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            return ResponseFormatter::error('Recurso no encontrado', 404);
        }

        if ($e instanceof ValidationException) {
            $flattenedErrors = collect($e->errors())
                ->flatten()
                ->values()
                ->all();

            return ResponseFormatter::error('Datos inválidos', 422, $flattenedErrors);
        }

        if ($e instanceof HttpException) {
            return ResponseFormatter::error(
                $e->getMessage() ?: 'Error HTTP',
                $e->getStatusCode()
            );
        }

        // Error desconocido
        return ResponseFormatter::error(
            'Error interno del servidor',
            500,
            config('app.debug') ? [$e->getMessage()] : []
        );
    }
}