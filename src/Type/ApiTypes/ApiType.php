<?php

namespace Src\Type\ApiTypes;

use GraphQL\Type\Definition\ObjectType;
use Src\Type\RouterTypes;

class ApiType extends ObjectType implements \Src\Interfaces\Type\QueryType, \Src\Interfaces\Type\MutationType
{


    public function __construct()
    {
        $config = [
            'name' => 'Api',
            'fields' => function(){
                return [
                    'api_id' => RouterTypes::int(),
                    'username' => RouterTypes::string(),
                    'key' => RouterTypes::string(),
                    'status' => RouterTypes::int(),
                    'date_added' => RouterTypes::string(),
                    'date_modified' => RouterTypes::string()
                ];
            }
        ];
        parent::__construct($config);
    }


    /**
     * Returns Query Types
     * @return array
     */
    public static function exportQueryType()
    {
        return [
            'getApis' => [
                'type' => RouterTypes::returnApiTypes('Api'),
                'description' => 'Api Register from opencart.',
                'args' => [
                    'fields' => [
                        'type' => self::exportInputType('getApiInput')
                    ]
                ],
                'resolve' => function ($config, $args, $context) {
                    $apiModel = new \Src\Model\ApiModel($config, $args, $context);
                    $response = $apiModel->getApis($args['fields']);
                }
            ]
        ];
    }

    /**
     * Returns Mutation Types
     * @return array
     */
    public static function exportMutationType()
    {

    }

    /**
     * Returns Inputs for Mutation and Query
     * @param string $inputName
     * @return array
     */
    public static function exportInputType(string $inputName)
    {
        $filters = [
            'getApiInput' => new \GraphQL\Type\Definition\InputObjectType([
                'name' =>  'getApiInput',
                'fields' => [
                    'id' => [
                        'type' => RouterTypes::int(),
                        'description' => 'Id da Api'
                    ]
                ]
            ])
        ];
        return $filters[$inputName];
    }


}