<?php

namespace App\Exceptions;

use BadMethodCallException;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\App;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->cookie('setloc') == 'ua' || $request->cookie('setloc') == 'en'){
            App::setLocale($request->cookie('setloc'));
        }

        if ($exception instanceof TokenMismatchException) {
            return redirect()
                ->route('login');
        }

        if ($exception instanceof ModelNotFoundException) {

            return response(view('404'), '404');

        }

        if ($exception instanceof BadMethodCallException) {

            return response(view('404'), '404');

        }


        if ($exception instanceof AuthorizationException) {
            return response(view('404'), '404');
        }

        if ($this->isHttpException($exception)) {

            switch ($exception->getStatusCode()) {

                case 403:

                    return response(view('404'), '404');

                    break;

                case 404:

                    return response(view('404'), '404');

                    break;

                case 500:

                    return response(view('404'), '404');

                    break;

                default:
                    return $this->renderHttpException($exception);
                    break;

            }
        }
        return parent::render($request, $exception);
    }
}
