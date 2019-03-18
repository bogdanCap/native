<?php

namespace System\Request;



use App\Controller;

class   BootController {
    
    public $requestParam;

    private $bootInstance;

    public function __construct(RequestImplementation $requestImplementation)
    {
        $this->requestParam = $requestImplementation;
    }



    public function bootController()
    {



        $actionTask = '';
        $actionParam = [];

        if (isset($this->requestParam->getRoutes()[$this->requestParam->getUrlSegments()])) {
            $actionTask = $this->requestParam->getRoutes()[$this->requestParam->getUrlSegments()];
        } else {
            //if do nor find standard route and we need to find route with bind param
            foreach ($this->requestParam->getRoutes() as $route => $classParam) {
                $requestSegments = explode('/', $this->requestParam->getUrlSegments());
                unset($requestSegments[0]);
                if(strpos($route, '@d')) {
                    //dd($route);
                    $registeringUrlSegments = explode('/', $route);
                    unset($registeringUrlSegments[0]);
                    if(count($registeringUrlSegments) == count($requestSegments)) {
                        $actionParam = $requestSegments;
                        $actionTask = $classParam;

                      break;
                    }
                }
            }
        }

        if(!$actionTask){
            throw new \Exception('Bogdan: no route found for this url!');
        }

        $action = substr($actionTask, strpos($actionTask, '@') + 1, strlen($actionTask));
        $class = str_replace('@'.$action,"",$actionTask);
        $namespace = 'App\\'.str_replace('/', '\\', $class);

        if(count($actionParam) == 0) {

            //need to add dynamic argument for action, as in the example below


            $instance = new $namespace();
            echo $instance->$action();
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
                    $urlSegmentParam = array_values($actionParam);
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