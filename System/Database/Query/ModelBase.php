<?php

namespace System\Database\Query;

class ModelBase {

    /**
     * @param string $query
     * @return QueryBuilder
     */
    protected function newQuery($query = '')
    {
        return new QueryBuilder($query);
    }

    /**
     * return database result
     * @param $query
     * @return QueryFetch
     */
    protected function queryFetch($query)
    {
        return new QueryFetch($query);
    }
}