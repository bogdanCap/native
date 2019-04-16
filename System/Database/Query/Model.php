<?php

namespace System\Database\Query;

class Model {
    
    private $selectQuery = 'SELECT ';
    
   // private $whereQuery = '';
    
    public function select($fields) 
    {
        $this->selectQuery .= $fields;
        $this->selectQuery .= ' from users';
        
        return new QueryBuilder($this->selectQuery);
    }
    
    public function update()
    {

    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    /*
    public function __call($method, $parameters)
    {
        if (in_array($method, ['increment', 'decrement'])) {
            return $this->$method(...$parameters);
        }

        return $this->newQuery()->$method(...$parameters);
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    /*
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
    
    /**
     * Get a new query builder that doesn't have any global scopes or eager loading.
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    /*
    public function newQuery()
    {
        $connection = $this->getConnection();
            
        return new QueryBuilder(
            $connection, $connection->getQueryGrammar(), $connection->getPostProcessor()
        );
    }
    */
}