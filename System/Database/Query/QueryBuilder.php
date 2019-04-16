<?php

namespace System\Database\Query;

class QueryBuilder {
    
    private $select = '';
    
    private $where = ' where ';
    
    public function  __construct($select)
    {
        $this->select = $select;
    }

    public function where($where)
    {
        $this->where .= $where;
        $query = $this->select .$this->where;
        
        return new QueryFetch($query);
    }
}