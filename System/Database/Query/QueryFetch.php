<?php

namespace System\Database\Query;

use System\Database\Database;

class QueryFetch {
    
    private $connection;
    
    private $query;
    
    public function __construct($query)
    {
        $this->query = $query;
        $db = Database::getDb();
        $this->connection = $db->getConnection();
    }

    public function get()
    {
        $data = [];
        try {
            if ($result = $this->connection->query($this->query)) {
                while ($obj = $result->fetch_object()) {
                    $data[] = (array)$obj;
                }
            }
            
            return $data;
        } catch (\Exception $e) {
            throw new \Exception("Database query error: ".$this->query);
        }
    }
}