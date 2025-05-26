<?php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class DataNotFoundException extends HttpException
{
    protected $code = 400;
    protected $message = 'Data Not Found';

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