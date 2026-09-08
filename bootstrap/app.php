<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Expose / reverse proxy tunnel-ийн ард ажиллахад HTTPS зөв танихад
        $middleware->trustProxies(at: '*');

        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        // 404 / 403 -г React layout-той гоё хуудсаар үзүүлэх
        $exceptions->respond(function (\Symfony\Component\HttpFoundation\Response $response, \Throwable $e, Request $request) {
            if ($request->expectsJson() || $request->is('admin', 'admin/*', 'livewire/*')) {
                return $response;
            }
            if (in_array($response->getStatusCode(), [403, 404, 419, 429, 503])) {
                // Route олдоогүй үед middleware ажиллаагүй тул shared prop-уудыг гараар нэмнэ
                \Inertia\Inertia::share(
                    app(\App\Http\Middleware\HandleInertiaRequests::class)->share($request)
                );

                return \Inertia\Inertia::render('Error', ['status' => $response->getStatusCode()])
                    ->toResponse($request)
                    ->setStatusCode($response->getStatusCode());
            }
            return $response;
        });
    })->create();
