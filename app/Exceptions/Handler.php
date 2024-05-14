<?php

namespace App\Exceptions;

use App\Facades\Api\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected $dontReport = [
        //
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e) {
            if ($e instanceof ValidationException) {
                $errors = $e->validator->getMessageBag()->getMessages();

                return ApiResponse::error(errors: $errors)->respond(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            }

            if ($e instanceof NotFoundHttpException) {
                return ApiResponse::error()->respond(ResponseAlias::HTTP_NOT_FOUND);
            }

            $statusCode = $e->getCode() >= 100 && $e->getCode() < 600 ? $e->getCode() : 500;

            return ApiResponse::error($e->getMessage())->respond($statusCode);
        });
    }
}
