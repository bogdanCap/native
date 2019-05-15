<?php

namespace System\Request;

abstract class RequestBase {

    /** @var  string */
    protected $actionTask;

    /** @var string[] */
    protected $actionParam = [];

    /**
     * @return mixed
     */
    protected function executeControllerContent()
    {
        $action = substr($this->actionTask, strpos($this->actionTask, '@') + 1, strlen($this->actionTask));
        $class = str_replace('@'.$action, "", $this->actionTask);
        $namespace = 'App\\'.str_replace('/', '\\', $class);
        if(count($this->actionParam) == 0) {
            //need to add dynamic argument for action, as in the example below
            $this->setpUpControllerParam($namespace, $action);
        } else {
            //check arguments pass to object action
            $this->setpUpControllerParam($namespace, $action);
        }
    }

    /**
     * @param string $namespace
     * @param string $action
     */
    protected function setpUpControllerParam(string $namespace, string $action)
    {
        //need to add dynamic argument for action, as in the example below
        $reflection = new \ReflectionMethod($namespace, $action);
        $params = $reflection->getParameters();
        $executeParameters = [];
        $iteration = 0;
        foreach ($params as $param) {
            //$param is an instance of ReflectionParameter
            if($param->getClass()) {
                $objectParam = $param->getClass();
                $objNamespace = $objectParam->getName();
                $executeParameters [] = new $objNamespace;
            } else {
                $urlSegmentParam = array_values($this->actionParam);
                $executeParameters [] = $urlSegmentParam[$iteration];
                $iteration++;
            }
        }
        //send param to controller
        $instance = new $namespace();

        $instance->$action(...$executeParameters); //add dynamic param into action
    }
}