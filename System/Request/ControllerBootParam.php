<?php

namespace System\Request;

class ControllerBootParam implements RequestImplementation{
    
    private $urlSegments;
    
    private $routes;
    
    public function __construct(array $routes)
    {
        $this->urlSegments = $_SERVER['REQUEST_URI'];
        $this->routes = $routes;
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