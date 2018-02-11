<?php

namespace Gpd\Model\AppCore;

class AplicacoesModel extends \Gpd\Engine\Model
{

    protected $dbInformation = [
        'dbType' => 'mongodb',
        'database' => 'AppCore',
        'collection' => 'Aplicacoes',
        'serverConnection' => 'default'
    ];


    public function getAplicacoes(array $args)
    {
        $this->setMethodName('getAplicacoes');
        $query = [];
        if(!empty($args['_id'])){
            $query += ['_id' => $args['_id']];
        }
        if(!empty($args['app_key'])){
            $query += [
                'app_key' => $args['app_key']
            ];
        }
        $aplicacoes = $this->read($query);
        return $aplicacoes;
    }
    

}