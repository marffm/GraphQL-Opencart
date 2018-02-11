<?php

namespace Gpd\Model;

class AssuntoModel extends \Gpd\Engine\Model
{

    protected $dbInformation = [
        'dbType' => 'mongodb',
        'database' => 'CcSac',
        'collection' => 'Tema',
        'serverConnection' => 'default'
    ];


    public function getAssuntos($idTema)
    {
        $query = ['_id' => $idTema];
        $result = $this->read($query);
        return $result['assuntos'];
    }

    public function insertAssuntos($idTema, $data)
    {
        $update['$set']['assuntos'] = [];
        foreach($data['assuntos'] as $assunto){
            $update['$set']['assuntos'][] = [
                'id' => new \MongoDB\BSON\ObjectId(),
                'descricao' => $assunto['descricao']
            ];
        }
        $query = ['_id' => $idTema];
        return $this->update($update, $query);
    }


}