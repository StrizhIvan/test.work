<?php

namespace App\Application\Router;

class Route
{
    private static array $routes;

    protected static function add(string $uri, callable|array $callback, string $method, bool $needcsrfToken)
    {
        self::$routes[] = [
            'uri' => $uri,
            'callback' => $callback,
            'method' => strtoupper($method),
            'needcsrfToken'=> $needcsrfToken
        ];
    }

    public static function get(string $uri, callable|array $callback,  bool $needcsrfToken = true, string $method = 'get') {
        self::add($uri, $callback, $method, $needcsrfToken);
    }
    public static function post(string $uri, callable|array $callback,  bool $needcsrfToken = true, string $method = 'post') {
        self::add($uri, $callback, $method, $needcsrfToken);
    }

    public static function dispatch()
    {
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        $requestURI = $_SERVER['REQUEST_URI'];
        foreach (self::$routes as $route) {
            if ($requestMethod == $route['method'] && $requestURI == $route['uri']) {
                call_user_func($route['callback']);
                return;
            }   
        }
        http_response_code(404);
        return;
    }

    

}