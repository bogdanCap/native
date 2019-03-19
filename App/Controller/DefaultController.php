<?php

namespace App\Controller;

use App\Service\UserService;
use System\Request\BootController;
use System\View;

class DefaultController {

    public function indexAction()
    {
        $view = new View('test.php');

        return $view->render(['testData' => 'test']);
    }

    public function testAction()
    {

        dd("New Action Controller");
        //$view = new View('test.php');

        //return $view->render(['testData' => 'test']);
    }

    public function paramAction($param, \Config\DatabaseConnection $databaseConnection)
    {

        dd('Controller with PARAM ='.$param.'='.$databaseConnection->getTest());
    }
}