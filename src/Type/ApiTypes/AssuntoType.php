<?php

namespace Gpd\Type\ApiTypes;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

use Gpd\Type\RouterTypes;

class AssuntoType extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'Assunto',
            'description' => 'Assuntos Referente ao Tema',
            'fields' => function() {
                return [
                    'id' => RouterTypes::returnScalarType('Id'),
                    'descricao' => RouterTypes::string()
                ];
            }
        ];
        parent::__construct($config);
    }


    public static function exportQueryType()
    {
        return [
            'assunto' => [
                'type' => RouterTypes::returnApiTypes('assunto'),
                'description' => 'Assuntos',
                'args' => [
                    'filters' => [
                        'type' => RouterTypes::nonNull(self::exportInputType('getAssunto'))
                    ]
                ],
                'resolve' => function ($root, $args, $context, ResolveInfo $info ) {
                    return ['descricao' => $args['filters']['descricao']];
                }
            ]
        ];
    }


    // /**
    //  * 
    //  */
    public static function exportMutationType()
    {
        return [
            'createAssunto' => [
                'type' => RouterTypes::returnApiTypes('assunto'),
                'description' => 'Insere Assuntos',
                'args' => [
                    'filters' => [
                        'type' => RouterTypes::nonNull(self::exportInputType('createAssunto'))
                    ]
                ],
                'resolve' => function($root, $args, $context, ResolveInfo $info) {
                    $temaModel = new \Gpd\Model\AssuntoModel($val, $args['filters'], $context, $info);
                    return $temaModel->insertAssunto($args['filters']);
                }
            ]
        ];
    }


    /**
     * Returns Inputs for Mutation
     * @param string $inputName
     * @return array
     */
    public static function exportInputType(string $inputName)
    {
        $filters = [
            'getAssunto' => new \GraphQL\Type\Definition\InputObjectType([
                'name' => 'getAssunto',
                'description' => 'Test of assunto',
                'fields' => [
                    'descricao' => [
                        'type' => RouterTypes::string()
                    ]
                ]
            ]),
            'insertAssunto' => new \GraphQL\Type\Definition\InputObjectType([
                'name' => 'insertAssunto',
                'description' => 'Insere Assunto',
                'fields' => [
                    'descricao' => [
                        'type' => RouterTypes::string()
                    ]
                ]
            ]),
            'createAssunto' => new \GraphQL\Type\Definition\InputObjectType([
                'name' => 'InsereAssunto',
                'fields' => [
                    'descricao' => [
                        'type' => RouterTypes::string()
                    ]
                ]
            ])
        ];
        return $filters[$inputName];
    }

}