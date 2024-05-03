<?php

namespace App\Core\Middleware;

use App\Core\Exceptions\MiddlewareException;

class Middleware
{
    const MAP = [];

    public static function resolve(string $key): void
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? null;

        if (!$middleware) {
            throw MiddlewareException::noMiddlewareFound($key);
        }

        (new $middleware)?->handle();
    }
}
