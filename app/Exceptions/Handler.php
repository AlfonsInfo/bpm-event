<?php

namespace App\Exceptions;

use App\Helper\ResponseBuilder;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Throwable;

class Handler extends ExceptionHandler
{

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


       protected function unauthenticated($request, AuthenticationException $exception)
        {
            return response()->json([
                'status' => 'F',
                'message' => 'Harap login dahulu!'
            ], 401);
        }

        protected function handleAccessDeniedException($request, MissingAbilityException $exception)
        {
            return response()->json([
                'status' => 'F',
                'message' => 'Role tidak diijinkan'
            ], 403);
        }

        protected function handleValidationException($request, ValidationException $exception)
        {
            return response()->json([
                'status' => 'F',
                'message' => 'Role tidak diijinkan'
            ], 403);
        }

  
        protected function handleThrottleRequestsException($request, ThrottleRequestsException $exception)
        {
            return ResponseBuilder::responseFailed('Terlalu banyak request', 429);
        }


        public function render($request, Throwable $exception)
        {
            if($exception instanceof DataNotFoundException){
                return ResponseBuilder::responseFailed($exception->getMessage(), 400);
            }
            
            if ($exception instanceof MissingAbilityException) {
                return $this->handleAccessDeniedException($request, $exception);
            }
            if ($exception instanceof ValidationException) {
                // Menangkap ValidationException dan mengembalikan respons JSON dengan pesan kesalahan validasi
                return ResponseBuilder::responseFailed($exception->errors(), 403);
            }


            if ($exception instanceof CustomAuthException) {
                return ResponseBuilder::responseFailed($exception->getMessage(), 401);
            }

            if ($exception instanceof ThrottleRequestsException) {
                return $this->handleThrottleRequestsException($request, $exception);
            }
    
    
            return parent::render($request, $exception);

        }

}
