<?php

namespace Src\Type\ApiTypes;

use GraphQL\Type\Definition\ObjectType;
use Src\Type\RouterTypes;

class CategoryType extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'Category',
            'description' => 'Category table',
            'fields' => function (){
                return [
                    'category_id' => RouterTypes::int(),
                    'image' => RouterTypes::string(),
                    'parent_id' => [
                        'type' => RouterTypes::returnApiTypes('category'),
                        'description' => 'Parent category from this particular category.',
                        'resolve' => function($config, $args, $context){
                            $categoryModel = new \Src\Model\Catalog\CategoryModel($context);
                            $args['id'] = $config['parent_id'];
                            $response = $categoryModel->getCategories($args);
                            return $response[0];
                        }
                    ],
                    'top' => RouterTypes::int(),
                    'column' => RouterTypes::int(),
                    'status' => RouterTypes::int(),
                    'date_added' => RouterTypes::string(),
                    'date_modified' => RouterTypes::string(),
                    'language_id' => RouterTypes::int(),
                    'name' => RouterTypes::string(),
                    'description' => RouterTypes::string(),
                    'meta_title' => RouterTypes::string(),
                    'meta_description' => RouterTypes::string(),
                    'meta_keyword' => RouterTypes::string(),
                    'store_id' => RouterTypes::int()
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
            'getCategories' => [
                'type' => RouterTypes::listOf(RouterTypes::returnApiTypes('category')),
                'description' => 'Select all Categories.',
                'args' => [
                    'filters' => RouterTypes::nonNull(self::exportInputType('getCategoriesInput'))
                ],
                'resolve' => function($config, $args, $context) {
                    $categoryModel = new \Src\Model\Catalog\CategoryModel($context);
                    return $categoryModel->getCategories($args['filters']);
                }
            ]
        ];
    }


    /**
     * Returns Inputs for Mutation and Query
     * @param string $inputName
     * @return array
     */
    public static function exportInputType(string $inputName)
    {
        $filters = [
            'getCategoriesInput' => new \GraphQL\Type\Definition\InputObjectType([
                'name' =>  'getCategoriesInput',
                'fields' => [
                    'parentId' => [
                        'type' => RouterTypes::int(),
                        'description' => 'Parent Category'
                    ],
                    'storeId' => [
                        'type' => RouterTypes::int(),
                        'description' => 'Store id. Default value 0.',
                        'defaultValue' => 0
                    ],
                    'status' => [
                        'type' => RouterTypes::int(),
                        'description' => 'Categories Status. Default value 1',
                        'defaultValue' => 1
                    ],
                    'id' => [
                        'type' => RouterTypes::int(),
                        'description' => 'Category Id.',
                    ]
                ]
            ])
        ];
        return $filters[$inputName];
    }


}