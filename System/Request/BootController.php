<?php

namespace System\Request;



use App\Controller;

class BootController {
    
    public $requestParam;

    private $bootInstance;

    public function __construct(RequestImplementation $requestImplementation)
    {
        $this->requestParam = $requestImplementation;
    }



    public function bootController()
    {

      //  dd($this->requestParam->getUrlSegments());

        $urlSegments = explode('/', $this->requestParam->getUrlSegments());

        if (isset($urlSegments[1])) {
            if (empty($urlSegments[1])) {
               // dd($this->requestParam->getRoutes()[$this->requestParam->getUrlSegments()]);
                $class = $this->requestParam->getRoutes()[$this->requestParam->getUrlSegments()]; //   \

              //  $r = 'App\\'.str_replace('/', '\\', $class);
             //   $t = new Controller\DefaultController();
              //  dd($r);
              //  $instance = new $r();
              //  dd($instance);
                $namespace = 'App\\'.str_replace('/', '\\', $class);
              //  dd($r);

                $instance = new $namespace();
                echo $instance->indexAction();
                die();
              //  dd($instance->indexAction());
              //  dd(new Controller\DefaultController());
            } else {
                Throw new \Exception('Bogdan error, page not found');
            }
        } else {
            Throw new \Exception('Bogdan error, page not found');
        }
      





        dd($this->requestParam->getRoutes()[$this->requestParam->getUrlSegments()]);
        
        





        echo '<pre>';
        print_r($this->requestParam->getRoutes()['/']);
        echo '</pre>';die();
      //  return $this->requestParam->getRoutes();
        if (in_array($this->requestParam->getUrlSegments(), $this->requestParam->getRoutes())) {
            var_dump('---');
            die();
        }

        var_dump([$this->requestParam->getRoutes(), $this->requestParam->getUrlSegments()]);
        die();
    }



}