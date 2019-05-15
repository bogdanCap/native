<?php

namespace System\Database\Query;

class Model extends ModelBase {

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $parameters)
    {
        $parentClass = get_class($this);
        $model = new $parentClass;
        if(!property_exists($model, 'table')) {
            throw new \Exception('Please define model property "table" with table name value');
        }
        if (!$model->table) {
            throw new \Exception('Table name do not define in the model');
        }
        $parameters[max(array_keys($parameters)) + 1] = $model->table;
        
        return $this->newQuery(...$parameters)->$method(...$parameters);
    }
}