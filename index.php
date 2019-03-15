<?php

require_once ('bootstrap.php');
require_once ('App/routes.php');
require_once ('App/helpers.php');
//bootstrap application
try {
    $controller = new \System\Request\BootController(new \System\Request\ControllerBootParam($appRoutes));
    $controller->bootController();
} catch (Exception $e) {
    dd($e->getMessage());
}


