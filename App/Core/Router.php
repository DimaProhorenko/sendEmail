<?php

namespace App\Core;

use App\Core\Exceptions\RouteException;
use App\Core\Middleware\Middleware;
use App\Core\Route;

class Router
{
    private array $routes = [];


    // public function add($uri, $controller_path, $method)
    // {
    //     $this->routes[] = [
    //         'uri' => $uri,
    //         'controller' => $controller_path,
    //         'method' => $method,
    //         'middleware' => null,
    //     ];
    //     return $this;
    // }

    public function add(string $uri, string $method, array $action)
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'middleware' => null,
            'action' => $action
        ];
    }

    public function register_routes(array $controllers)
    {
        foreach ($controllers as $controller) {
            $reflectionController = new \ReflectionClass($controller);

            foreach ($reflectionController->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class);

                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();
                    $this->add($route->path, $route->method, [$controller, $method->getName()]);
                }
            }
        }
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                if ($route['middleware']) {
                    Middleware::resolve($route['middleware']);
                }
                // return require base_path("app/Controllers/{$route['controller']}");
                // return (new $route['controller'])->index();
                $className = $route['action'][0];
                $methodName = $route['action'][1];
                return (new $className)->$methodName();
            }
        }

        throw RouteException::notFound($uri, $method);
    }

    // public function only($key)
    // {
    //     $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    //     return $this;
    // }

    // public function get($uri, $controller_path)
    // {
    //     return $this->add($uri, $controller_path, 'GET');
    // }

    // public function post($uri, $controller_path)
    // {
    //     return $this->add($uri, $controller_path, 'POST');
    // }

    // public function delete($uri, $controller_path)
    // {
    //     return $this->add($uri, $controller_path, 'DELETE');
    // }

    // public function push($uri, $controller_path)
    // {
    //     return $this->add($uri, $controller_path, 'PUSH');
    // }

    // public function patch($uri, $controller_path)
    // {
    //     return $this->add($uri, $controller_path, 'PATCH');
    // }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
