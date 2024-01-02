<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e): Response|JsonResponse|RedirectResponse
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return redirect()->route('not.found');
        });

//        $this->renderable(function (ValidationException $e) {
//            return back()->with('errors', '12');
//        });

        $this->renderable(function (ModelNotFoundException $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ], 404);
        });

        return parent::render($request, $e);
    }
}
