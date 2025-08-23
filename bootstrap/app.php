<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

use App\Http\Middleware\ForceJsonRequestHeader;
use App\Exceptions\ApiExceptionHandler;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'force.json' => ForceJsonRequestHeader::class,
            'ability' => CheckForAnyAbility::class
        ]);

        $middleware->api(prepend: [
            'force.json'
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(fn (Throwable $e, $request) => ApiExceptionHandler::handle($e) );
        
    })->create();
