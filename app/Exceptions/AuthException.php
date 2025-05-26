<?php
namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthException extends HttpException
{
    protected $code = 401;
    protected $message = 'Authentication failed';

    public function __construct($message = null, $code = null, Exception $previous = null)
    {
        if ($message) {
            $this->message = $message;
        }
        if ($code) {
            $this->code = $code;
        }
        parent::__construct( $this->code, $this->message, $previous);
    }
}