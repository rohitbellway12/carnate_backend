<?php

use App\Http\Middleware\{AdminMiddleware,WorkshopMiddleware, Authenticated, RedirectIfAuthenticated, profileCheck, UnifiedGuestMiddleware};
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'workshop' => WorkshopMiddleware::class,
            'auth' => Authenticated::class,
            'guest' => RedirectIfAuthenticated::class,
            'unified.guest' => UnifiedGuestMiddleware::class,
            'auth.guard' => \App\Http\Middleware\EnsureCorrectGuard::class,
            'auth:sanctum' => EnsureFrontendRequestsAreStateful::class,
            'permission' => PermissionMiddleware::class,
            'role' => RoleMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
            'profileCheck' => profileCheck::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'errors' => $e->errors(),
                    ], 422);
                }
    
                if ($e instanceof AuthenticationException) {
                    return response()->json(['success' => false,'message' => 'Unauthenticated.'], 401);
                }
    
                return response()->json([
                    'error' => $e->getMessage()
                ], $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException ? $e->getStatusCode() : 500);
            }
        });
    })->create();
