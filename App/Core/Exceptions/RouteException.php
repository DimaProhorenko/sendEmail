<?php

namespace App\Core\Exceptions;

class RouteException extends \Exception
{

    public static function notFound($path, $method)
    {
        return new static("Route {$path} with method {$method} was not found");
    }
}
