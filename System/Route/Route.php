<?php

namespace System\Route;

class Route {

    /**
     * @var array
     */
    private static $routes;

    /**
     * @var array
     */
    private static $allowMethod = [
        'get',
        'post',
        'put',
        'delete'
    ];

    /**
     * @param string $method
     * @param string[] $args
     * @throws \Exception
     */
    static public function __callStatic(string $method, array $args)
    {
        if (in_array($method, self::$allowMethod)) {
            self::$routes[$method][$args[0]] = $args[1];
        } else {
            throw new \Exception("Http \"$method\" method not allow for routes file");
        }
    }

    /**
     * @return array
     */
    static public function getRegisteringRoutes()
    {
        return self::$routes;
    }
}