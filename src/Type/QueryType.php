<?php

namespace Gpd\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

use Gpd\Helpers\Fields;

use Gpd\Type\RouterTypes;


class QueryType extends ObjectType
{
    
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'description' => 'Here is where get queries are made',
            'fields' => Fields::getFields('exportQueryType')
        ];
        parent::__construct($config);
    }

}