<?php

namespace App\Core;

#[\Attribute]
class Route
{

    public function __construct(public string $path, public string $method = 'GET')
    {
    }
}
