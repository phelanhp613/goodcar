<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, LogLevel::*>
     */
    protected $levels = [
        //
    ];
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];
    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e)
        {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $exception
     * @return JsonResponse|\Illuminate\Http\Response|Response|void
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            session()->flash('error', 'This action is unauthorized.');
            if (session()->has('_previous.url')) {

                return redirect()->to(session('_previous.url'));
            }

            return redirect()->route('admin.dashboard');
        }

        return parent::render($request, $exception);
    }
}
