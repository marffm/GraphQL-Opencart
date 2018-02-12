<?php
namespace Src\Type;


class MainTypes 
{

    //Object types
    private static $query;
    private static $mutation;

    /**
     * @return QueryType
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new \Src\Type\QueryType());
    }


    /**
     * @return MutationType
     */
    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new \Src\Type\MutationType());
    }

}