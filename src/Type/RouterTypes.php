<?php

namespace Gpd\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;

/**
 * Acts as registry and factory to api types.
 */
class RouterTypes
{

    /**
     * Receives all types declared
     * @var array
     */
    private static $types = [];

    /**
     * Return object of Api Type passed as argument
     * @param string $type
     * @return object $classType
     */
    public static function returnApiTypes(string $type)
    {
        $name = ucfirst($type) . 'Type';
        $fullName = '\Gpd\Type\ApiTypes\\' . $name;
        if(self::$types[$name]){
            return self::$types[$name];
        }
        
        $classType = new $fullName;
        if(!$classType instanceof $fullName){
            throw \GraphQL\Error\Error::createLocatedError(1101);
        }
        self::$types[$name] = $classType;
        return $classType;
    }

    /**
     * Returns object of ScalarType passed as argument
     * @param string
     * @return object $classScalarType
     */
    public static function returnScalarType(string $type)
    {
        $name = ucfirst($type) . 'Type';
        if(self::$types[$name]){
            return self::$types[$name];
        }
        $fullName = '\Gpd\Type\Scalar\\' . $name;
        if(!is_callable([$fullName, 'create'])){
            throw \GraphQL\Error\Error::createLocatedError(1102);
        }
        $fullName .= '::create';
        return (self::$types[$name] = $fullName());
    }

    /**
     * @return \GraphQL\Type\Definition\IntType
     */
    public static function int()
    {
        return Type::int();
    }

    /**
     * @return \GraphQL\Type\Definition\StringType
     */
    public static function string()
    {
        return Type::string();
    }


    /**
     * @param Type $type
     * @return NonNull
     */
    public static function nonNull($type)
    {
        return new NonNull($type);
    }

    /**
     * @param Type $type
     * @return ListOfType
     */
    public static function listOf($type)
    {
        return new ListOfType($type);
    }

}