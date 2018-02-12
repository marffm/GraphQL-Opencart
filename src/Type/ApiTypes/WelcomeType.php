<?php

namespace Src\Type\ApiTypes;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

use Src\Type\RouterTypes;

class WelcomeType extends \GraphQL\Type\Definition\ObjectType implements \Src\Interfaces\Type\QueryType
{

    public function __construct()
    {
        $config = [
            'name' => 'Welcome',
            'description' => 'Default End Point',
            'fields' => function() {
                return [
                    'welcome' => RouterTypes::string()
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
            'welcome' => [
                'type' => RouterTypes::returnApiTypes('welcome'),
                'description' => 'Default End Point',
                'resolve' => function ( $val, $args, $context, ResolveInfo $info ) {
                    return ['welcome' => 'Welcome, you can start your queries.'];
                }
            ]
        ];
    }


}