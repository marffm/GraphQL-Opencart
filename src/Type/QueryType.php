<?php

namespace Src\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

use Src\Helpers\Fields;

use Src\Type\RouterTypes;


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