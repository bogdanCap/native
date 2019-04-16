<?php

namespace App\Controller;

use App\Model\User;
use App\Service\UserService;
use System\Controller\BaseController;
use System\Database\Database;
use System\Request\BootController;
use System\View;

class DefaultController extends BaseController{

    public function indexAction()
    {
       // $db = Database::getDb();
      //  $mysqli = $db->getConnection();


        //NEED TO CREATE NATIVE QUERY BUILDER

        $user = new User();
        $result = $user->select('*')->where('id = 1')->get();
        dd($result);



        $sqlQuery = "SELECT *, (SELECT count(*) FROM users) as count FROM users";

        $data = [];
        if ($result = $this->db->query($sqlQuery)) {
            while ($obj = $result->fetch_object()) {
                $data[] = (array)$obj;
            }
        }
        dd($data);
        $view = new View('test.php');

        return $view->render(['testData' => 'test']);
    }

    public function testAction()
    {

        dd("New Action Controller");
        //$view = new View('test.php');

        //return $view->render(['testData' => 'test']);
    }

    public function paramAction($param)
    {

        dd('Controller with PARAM ='.$param.'=');
    }
}