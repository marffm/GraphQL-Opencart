<?php
namespace Gpd\Type;


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
        return self::$query ?: (self::$query = new \Gpd\Type\QueryType());
    }


    /**
     * @return MutationType
     */
    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new \Gpd\Type\MutationType());
    }

}