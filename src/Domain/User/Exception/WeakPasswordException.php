<?php
namespace App\Domain\User\Exception;

use Exception;

final class WeakPasswordException extends Exception
{
    public function __construct($message = "Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}