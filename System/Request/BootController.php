<?php

namespace System\Request;

use App\Controller;

class  BootController {
    
    public $request;

    /** @var  string */
    private $actionTask;

    /** @var string[] */
    private $actionParam = [];

    public function __construct(RequestImplementation $requestImplementation)
    {
        $this->request = $requestImplementation;
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

    /**
     * @return mixed
     */
    private function executeControllerContent()
    {
        $action = substr($this->actionTask, strpos($this->actionTask, '@') + 1, strlen($this->actionTask));
        $class = str_replace('@'.$action, "", $this->actionTask);
        $namespace = 'App\\'.str_replace('/', '\\', $class);

        if(count($this->actionParam) == 0) {
            //need to add dynamic argument for action, as in the example below
            $reflaction = new \ReflectionMethod($namespace, $action);
            $params = $reflaction->getParameters();
            $executeParameters = [];
            $ii = 0;

            foreach ($params as $param) {
                //$param is an instance of ReflectionParameter

                if($param->getClass()) {
                    $objectParam = $param->getClass();
                    $objNamespace = $objectParam->getName();
                    $executeParameters [] = new $objNamespace;
                } else {
                    $urlSegmentParam = array_values($this->actionParam);
                    $executeParameters [] = $urlSegmentParam[$ii];
                    $ii++;
                }
            }
            //send param to controller
            $instance = new $namespace();

            echo $instance->$action(...$executeParameters); //add dynamic param into action
        } else {
            //check arguments pass to object action
            $reflaction = new \ReflectionMethod($namespace, $action);
            $params = $reflaction->getParameters();
            $executeParameters = [];
            $ii = 0;
            foreach ($params as $param) {
                //$param is an instance of ReflectionParameter
                if($param->getClass()) {
                    $objectParam = $param->getClass();
                    $objNamespace = $objectParam->getName();
                    $executeParameters [] = new $objNamespace;
                } else {
                    $urlSegmentParam = array_values($this->actionParam);
                    $executeParameters [] = $urlSegmentParam[$ii];
                    $ii++;
                }
            }
            //send param to controller
            $instance = new $namespace();

            echo $instance->$action(...$executeParameters); //add dynamic param into action
        }
    }
}