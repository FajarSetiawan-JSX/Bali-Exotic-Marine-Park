<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->statefulApi();
        $middleware->alias([
            'super_admin' => \App\Http\Middleware\superadmin::class,
            'user_level_1' => \App\Http\Middleware\Level1::class,
            'supervisor' => \App\Http\Middleware\Supervisor::class,
            'activity' => \App\Http\Middleware\UpdateActivity::class,
            'cek-token' => \App\Http\Middleware\CekTokenPassword::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function (Response $response, Throwable $exception, Request $request) {
            // Kalau request API, jangan render Inertia
            if ($request->expectsJson()) {
                return $response;
            }

            if (in_array($response->getStatusCode(), [500, 503, 404, 403])) {
                return Inertia::render('Error', [
                    'status' => $response->getStatusCode(),
                    'message' => $exception->getMessage(),
                ])
                    ->toResponse($request)
                    ->setStatusCode($response->getStatusCode());
            }

            return $response;
        });
    })->create();
