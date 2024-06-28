<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\LoginCheckin;
use App\Http\Middleware\StudentAuthMiddleware;
use App\Http\Middleware\TeacherAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role@admin' => AdminAuthMiddleware::class,
            'role@teacher' => TeacherAuthMiddleware::class,
            'role@student' => StudentAuthMiddleware::class,
            'isAlreadyLogin' => LoginCheckin::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
