<?php

namespace App\Application\Router;

use App\Application\Middleware;

class Route
{
    private static array $routes;
    private static $middleware;

    public function __construct(Middleware $middleware) {
        self::$middleware = $middleware;
    }

    protected static function add(string $uri, callable|array $callback, string $method, bool $middleware)
    {
        self::$routes[] = [
            'uri' => $uri,
            'callback' => $callback,
            'method' => strtoupper($method),
            'middleware' => $middleware,
        ];
    }

    public static function get(string $uri, callable|array $callback, bool $middleware = false, string $method = 'get') {
        self::add($uri, $callback, $method, $middleware);
    }
    public static function post(string $uri, callable|array $callback, bool $middleware = false, string $method = 'post') {
        self::add($uri, $callback, $method, $middleware);
    }

    public static function dispatch()
    {
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        $requestURI = $_SERVER['REQUEST_URI'];
        foreach (self::$routes as $route) {
            if ($requestMethod == $route['method'] && $requestURI == $route['uri']) {
                if ($route['middleware']) {
                    self::$middleware->authMiddleware() ? call_user_func($route['callback']) : header('Location: /'); 
                    return;
                }
                call_user_func($route['callback']);
                return;
            }   
        }
        http_response_code(404);
        return;
    }

    

}