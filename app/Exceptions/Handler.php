<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @param Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $e
     * @return JsonResponse
     * @throws Exception
     */
    public function render($request, Exception $e): JsonResponse
    {
        if ($e instanceof QueryException) {
            return response()->json([
                'success' => false,
                'message' => 'Database error occurred!',
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'data' => [],
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
