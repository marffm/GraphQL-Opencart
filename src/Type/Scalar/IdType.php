<?php
namespace Gpd\Type\Scalar;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\CustomScalarType;
use GraphQL\Error\Error;


class IdType implements \Gpd\Interfaces\Type\ScalarType
{

    public static function create()
    {
        return new CustomScalarType([
            'name' => 'Id',
            'description' => 'MongoDb Id',
            'serialize' => [__CLASS__, 'serialize'],
            'parseValue' => [__CLASS__, 'parseValue'],
            'parseLiteral' => [__CLASS__, 'parseLiteral']
        ]);
    }


    /**
     * Convert value to use in a response.
     * @param ObjectId $value
     * @return string
     */
    public static function serialize($value)
    {
        // Convert ObjectId to string
        return (string)$value;
    }


    /**
     * Convert id to use as an input
     * @param string $value
     * @return ObjectId $id 
     */
    public static function parseValue(string $value)
    {
        // return \Gpd\Core\Database\Mongodb::objectId($value);
        return 'test';
    }

    /**
     * Convert query String into objectId
     * @param \GraphQL\Language\AST\Node $valueNode
     */
    public static function parseLiteral($valueNode)
    {
        try {
            return \Gpd\Core\Database\Mongodb::objectId($valueNode->value);
        } catch(\Exception $error){
            throw \GraphQL\Error\Error::createLocatedError($error->getMessage());
        }
        
    }

}