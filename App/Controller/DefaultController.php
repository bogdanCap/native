<?php

namespace App\Controller;

use System\View;

class DefaultController {

    public function indexAction()
    {
        $view = new View('test.php');

        return $view->render(['test']);
    }
}