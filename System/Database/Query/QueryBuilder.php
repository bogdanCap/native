<?php

namespace System\Database\Query;

class QueryBuilder extends ModelBase {

    /**
     * @var string
     */
    private $selectQuery = 'SELECT ';

    /**
     * @var string
     */
    private $where = ' where ';

    /**
     * @var string
     */
    private $select = '';

    /**
     * @var string
     */
    private $query = '';

    /**
     * QueryBuilder constructor.
     * @param string $select
     */
    public function  __construct($select = '')
    {

        $this->select = $select;
    }

    /**
     * @param string $fields
     * @param string $table
     * @return $this
     */
    public function select(string $fields = '', string $table = '')
    {
        $this->selectQuery .= $fields;
        $this->selectQuery .= " from $table"; //need to find way to change table name from config
        $this->query = $this->selectQuery; // if using select() with where
        $this->newQuery($this->selectQuery);

        return $this;
    }

    /**
     * @param $where
     * @return $this
     */
    public function where(string $where)
    {
        $this->where .= $where;
        $this->selectQuery = $this->query .$this->where;

        return $this;
    }

    /**
     * Fetch database result
     * @return array
     * @throws \Exception
     */
    public function get()
    {
        $query = $this->queryFetch($this->selectQuery);

        return $query->get();
    }
}