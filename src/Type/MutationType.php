<?php

namespace Gpd\Type;

use GraphQL\Type\Definition\ObjectType;
use Gpd\Helpers\Fields;

class MutationType extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'Mutation',
            'description' => 'Here is where changes in data are made',
            'fields' => Fields::getFields('exportMutationType')
        ];
        parent::__construct($config);
    }

}