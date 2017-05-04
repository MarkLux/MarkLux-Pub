<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        if ($e instanceof BaseException) {

            header('Access-Control-Allow-Headers:Origin, Content-Type, Cookie, Accept,token,Accept,X-Requested-With');
            header('Access-Control-Allow-Origin:*');
            header('Access-Control-Allow-Methods:GET, POST, PATCH, PUT, OPTIONS');
            header('Access-Control-Allow-Credentials:true');

            return response()
//                ->header()
//                ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept,token,Accept,X-Requested-With')
//                ->header()
//                ->header()
                ->json([
                    'code' => $e->getCode(),
                    'data' => $e->getData()
                ]);
        }

        return parent::render($request, $e);
    }
}
