<?php

namespace App\Exceptions;
use Throwable;
use Exception;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use App\Traits\ApiResponser;
use App\Exceptions\CustomException;

class Handler extends ExceptionHandler
{

    use ApiResponser;
    
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Exception $exception, $request) {

            $response = $this->handleException($request, $exception);
            return $response;
            
        });
    }

    public function handleException($request, Exception $exception){

        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception, $request);
        }
        if($exception instanceof ModelNotFoundException){
            $modelName = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("Does not exist any indicator {modelName} with the espicified indicator", 404);
        }
        if($exception instanceof AuthenticationException){
            return $this->errorResponse('Unauthenticated', 401);
        }
        if($exception instanceof AuthorizationException){
            return $this->errorResponse($exception->getMessage(), 403);
        }
        if($exception instanceof MethodNotAllowedHttpException){
            return $this->errorResponse('The especified method can not be found', 405);
        }
        if($exception instanceof NotFoundHttpException){
            return $this->errorResponse('The especified URL can not be found', 404);
        }
        if($exception instanceof HttpException){
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }
        if($exception instanceof QueryException){
            $errorCode = $exception->errorInfo[1];
            
            if($errorCode == 1451){
                return $this->errorResponse('Cannot remove this resource permanently. It is related with any other resource', 409);
            }
        }
        return parent::render($request, $exception);
    
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->errorResponse($errors, 422);
    }
}
