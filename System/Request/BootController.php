<?php

namespace System\Request;

use App\Controller;

class BootController extends RequestBase {

    /**
     * @var RequestImplementation
     */
    public $request;

    /**
     * BootController constructor.
     * @param RequestImplementation $requestImplementation
     */
    public function __construct(RequestImplementation $requestImplementation)
    {
        $this->request = $requestImplementation;
    }

    /**
     * @throws \Exception
     */
    private function getRouteSegment()
    {
        try {
            $routes = $this->request->getRoutes()[strtolower($_SERVER['REQUEST_METHOD'])];
        } catch (\Exception $e) {
            throw new \Exception('Bogdan: no route registering for this http method!');
        }
        if (isset($routes[$this->request->getUrlSegments()])) {
            $this->actionTask = $routes[$this->request->getUrlSegments()];
        } else {
            //if do nor find standard route and we need to find route with bind param
            foreach ($routes as $route => $classParam) {
                $requestSegments = explode('/', $this->request->getUrlSegments());
                unset($requestSegments[0]);
                if(strpos($route, '@d')) {
                    $registeringUrlSegments = explode('/', $route);
                    unset($registeringUrlSegments[0]);
                    if(count($registeringUrlSegments) == count($requestSegments)) {
                        $this->actionParam = $requestSegments;
                        $this->actionTask = $classParam;

                        break;
                    }
                }
            }
        }
    }

    public function bootController()
    {
        //pars request segment
        $this->getRouteSegment();
        if(!$this->actionTask){
            throw new \Exception('Bogdan: no route found for this url!');
        }
        //execute controller content
        $this->executeControllerContent();
    }
}