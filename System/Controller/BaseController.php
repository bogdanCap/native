<?php

namespace System\Controller;

use System\Database\Database;

abstract class BaseController {
    
    protected $db;
    
    public function __construct()
    {
        $dbConnection =  Database::getDb();
        $this->db = $dbConnection->getConnection();
    }
}