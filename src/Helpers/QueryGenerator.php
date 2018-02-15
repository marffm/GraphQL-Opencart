<?php

namespace Src\Helpers;

class QueryGenerator {

    /**
     * Generates query based on args
     * @param array $args
     * @return array $query
     */
    public static function generateQuery(array $args = null) : array
    {
        $query = [];

        if($args['id']){
            $query = ['id' => $args['id']];
        }
        return $query;
    }


}