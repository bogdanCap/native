<?php

namespace System\Route;

class Route {

    private static $routes;

    private static $allowMethod = [
        'get',
        'post',
        'put',
        'delete'
    ];

    static public function __callStatic(string $method, array $args)
    {
        if (in_array($method, self::$allowMethod)) {
          //  var_dump([$method, $args]);
           // die();
            self::$routes[$method][$args[0]] = $args[1];
        } else {
            throw new \Exception("Http \"$method\" method not allow for routes file");
        }
    }

    static public function getRegisteringRoutes()
    {
        return self::$routes;
    }
}