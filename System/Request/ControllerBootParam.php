<?php

namespace System\Request;

use System\Route\Route;

class ControllerBootParam implements RequestImplementation{

    /**
     * @var string
     */
    private $urlSegments;

    /**
     * @var array
     */
    private $routes;
    
    public function __construct()
    {
        $this->urlSegments = $_SERVER['REQUEST_URI'];
        $this->routes = Route::getRegisteringRoutes();
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return mixed
     */
    public function getUrlSegments()
    {
        return $this->urlSegments;
    }
}