<?php

namespace Src\Type\ApiTypes;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

use Src\Type\RouterTypes;

class TemaType extends ObjectType implements \Src\Interfaces\Type\QueryType, \Src\Interfaces\Type\MutationType
{

    public function __construct()
    {
        $config = [
            'name' => 'Tema',
            'description' => 'Tipos do Tema',
            'fields' => function() {
                return [
                    '_id' => RouterTypes::string(),
                    'descricao' => RouterTypes::string(),
                    'icone' => RouterTypes::string(),
                    'assuntos' => [
                        'name' => 'assuntos',
                        'type' => RouterTypes::listOf( RouterTypes::returnApiTypes('assunto')),
                        'description' => 'assuntos',
                        'args' => [
                            'dbCustom' => [
                                'type' => RouterTypes::nonNull(RouterTypes::string())
                            ]
                        ],
                        'resolve' => function($config, $args, $context, ResolveInfo $info){
                            $assuntoModel = new \Gpd\Model\AssuntoModel($config, $args, $context, $info);
                            return $assuntoModel->getAssuntos($config['_id']);
                        }
                    ]
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
            'tema' => [
                'type' => RouterTypes::returnApiTypes('tema'),
                'description' => 'Return only Theme with passed id',
                'args' => [
                    'filters' => [
                        'type' => RouterTypes::nonNull(self::exportInputType('getTemaInput'))
                    ]
                ],
                'resolve' => function ( $val, $args, $context, ResolveInfo $info ) {
                    $temaModel = new \Gpd\Model\TemaModel($val, $args['filters'], $context, $info);
                    return $temaModel->getTema($args['filters']);
                }
            ],
            'temas' => [
                'type' => RouterTypes::listOf(RouterTypes::returnApiTypes('tema')),
                'description' => 'Temas',
                'args' => [
                    'filters' => [
                        'type' => RouterTypes::nonNull(self::exportInputType('getTemasInput'))
                    ]
                ],
                'resolve' => function ( $val, $args, $context, ResolveInfo $info ) {
                    $temaModel = new \Gpd\Model\TemaModel($val, $args['filters'], $context, $info);
                    return $temaModel->getTemas($args['filters']);
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
        return [
            'createTema' => [
                'type' => RouterTypes::returnApiTypes('Tema'),
                'description' => 'Insere Novo Tema',
                'args' => [
                    'filters' => [
                        'type' => RouterTypes::nonNull(self::exportInputType('createTemaInput')),
                    ]
                ],
                'resolve' => function($root, $args, $context, ResolveInfo $info) {                    
                    $temaModel = new \Gpd\Model\TemaModel($val, $args['filters'], $context, $info);
                    return $temaModel->insertTema($args['filters']);
                }
            ],
            'deleteTema' => [
                'type' => RouterTypes::returnApiTypes('Tema'),
                'description' => 'Remove Tema',
                'args' => [
                    'filters' => [
                        'type' => RouterTypes::nonNull(self::exportInputType('deleteTemaInput'))
                    ]
                ],
                'resolve' => function($root, $args, $context, ResolveInfo $info){
                    $temaModel = new \Gpd\Model\TemaModel($val, $args['filters'], $context, $info);
                    return $temaModel->deleteTema($args['filters']);
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
            'getTemaInput' => new \GraphQL\Type\Definition\InputObjectType([
                'name' => 'getTema',
                'description' => 'Retorna tema de acordo com id.',
                'fields' => [
                    '_id' => [
                        'type' => RouterTypes::returnScalarType('Id'),
                        'description' => 'Id do tema'
                    ],
                    'dbCustom' => [
                        'type' => RouterTypes::nonNull(RouterTypes::string()),
                        'description' => 'City where the search will be made.'
                    ]
                ]
            ]),
            'getTemasInput' => new \GraphQL\Type\Definition\InputObjectType([
                'name' => 'getTemas',
                'description' => 'Realiza busca na Collection de Temas',
                'fields' => [
                    '_id' => [
                        'type' => RouterTypes::returnScalarType('Id'), 
                        'description' => 'Id do Tema.'
                    ],
                    'id_assunto' => [
                        'type' => RouterTypes::returnScalarType('Id'),
                        'description' => 'Id do assunto.'
                    ],
                    'descricao' => [
                        'type' => RouterTypes::string(),
                        'description' => 'Descrição do tema. Modo Regex.'
                    ],
                    'assunto_descr' => [
                        'type' => RouterTypes::string(),
                        'description' => 'Descrição do assunto. Modo Regex.'
                    ],
                    'limit' => [
                        'type' => RouterTypes::int(),
                        'description' => 'Limite de retornos.',
                        'defaultValue' => 15
                    ],
                    'offset' => [
                        'type' => RouterTypes::int(),
                        'description' => 'Valor do incio da busca.',
                        'defaultValue' => 0
                    ],
                    'dbCustom' => [
                        'type' => RouterTypes::nonNull(RouterTypes::string()),
                        'description' => 'Cidade dos temas'
                    ]
                ]
            ]),
            'createTemaInput' => new \GraphQL\Type\Definition\InputObjectType([
                'name' => 'CreateTemaInputs',
                'fields' => [
                    'descricao' => [
                        'type' => RouterTypes::string(),
                        'description' => 'Descrição do Tema'
                    ],
                    'icone' => [
                        'type' => RouterTypes::string(),
                        'description' => 'Icone do Tema é uma string'
                    ],
                    'assuntos' => [
                        'type' => RouterTypes::listOf(\Src\Type\ApiTypes\AssuntoType::exportInputType('insertAssunto')),
                        'description' => 'Descricao dos Assuntos'
                    ],
                    'dbCustom' => [
                        'type' => RouterTypes::nonNull(RouterTypes::string()),
                        'description' => 'Banco do tema a ser inserido.'
                    ]
                ]
            ]),
            'deleteTemaInput' => new \GraphQL\Type\Definition\InputObjectType([
                'name' => 'deleteTemaInput',
                'fields' => [
                    '_id' => [
                        'type' => RouterTypes::nonNull(RouterTypes::returnScalarType('Id')), 
                        'description' => 'Id do Tema.'
                    ],
                    'dbCustom' => [
                        'type' => RouterTypes::nonNull(RouterTypes::string()),
                        'description' => 'Banco do tema a ser inserido.'
                    ]
                ]
            ])
        ];
        return $filters[$inputName];
    }

}