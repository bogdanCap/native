<?php

namespace System\Database\Query;

use System\Database\Database;

class QueryFetch {

    /**
     * @var \mysqli
     */
    private $connection;

    /**
     * @var string
     */
    private $query;

    /**
     * QueryFetch constructor.
     * @param $query
     */
    public function __construct(string $query)
    {
        $this->query = $query;
        $db = Database::getDb();
        $this->connection = $db->getConnection();
    }

    /**
     * @return array
     * @throws \Exception
     */
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