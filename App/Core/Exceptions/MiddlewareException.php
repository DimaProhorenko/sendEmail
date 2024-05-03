<?php

namespace App\Core\Exceptions;

class MiddlewareException extends \Exception
{

    public static function noMiddlewareFound($key)
    {
        return new static("No middleware is assosiated with key {$key}");
    }
}
