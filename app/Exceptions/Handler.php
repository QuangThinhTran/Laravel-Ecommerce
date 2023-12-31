<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'status' => $e->getStatusCode(),
                'message' => "Not found"
            ], 404);
        });

        $this->renderable(function (ValidationException $e) {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => $e->errors()
            ], 400);
        });

        $this->renderable(function (ModelNotFoundException $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ], 404);
        });

        return parent::render($request, $e);
    }
}
