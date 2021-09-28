<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest(route('login'));
        }

        if ($request->is('company_general_manager') || $request->is('company_general_manager/*')) {
            return redirect()->guest(route('company_general_manager.login'));
        }

        if ($request->is('quality_manager') || $request->is('quality_manager/*')) {
            return redirect()->guest(route('login'));
        }

        if ($request->is('clean_mantanance_manager') || $request->is('clean_mantanance_manager/*')) {
            return redirect()->guest(route('login'));
        }

        if ($request->is('supervisor') || $request->is('supervisor/*')) {
            return redirect()->guest(route('login'));
        }

        if ($request->is('employee') || $request->is('employee/*')) {
            return redirect()->guest(route('login'));
        }

        return redirect()->guest(route('login'));
    }
}