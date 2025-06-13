<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use \Spatie\Permission\Middleware\PermissionMiddleware;
use \Spatie\Permission\Middleware\RoleMiddleware;
use \Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role'               => RoleMiddleware::class,
            'permission'         => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, $request) {
            $code    = 500;
            $message = 'Internal Server Error';
            $errors  = $e->getMessage();

            if ($e instanceof AuthenticationException) {
                $code    = 401;
                $message = 'Unauthorized';
            }

            if ($e instanceof UnauthorizedException) {
                $code    = 403;
                $message = 'Forbidden';
            }

            if ($e instanceof ValidationException) {
                $code    = 422;
                $message = 'Validation Failed';
                $errors  = $e->validator->errors()->toArray();
            }

            if ($e instanceof NotFoundHttpException) {
                $code    = 404;
                $message = 'Data Not Found';
                $errors  = null;
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => $message,
                    'data'    => $errors,
                ], $code);
            }
        });
    })->create();
