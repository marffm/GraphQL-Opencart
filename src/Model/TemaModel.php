<?php

namespace Gpd\Model;

class TemaModel extends \Gpd\Engine\Model
{

    protected $dbInformation = [
        'dbType' => 'mongodb',
        'database' => 'CcSac',
        'collection' => 'Tema',
        'serverConnection' => 'default'
    ];


    public function getTema(array $args)
    {
        $this->setMethodName('getTema');
        $query = [
            '_id' => $args['_id']
        ];
        $result = $this->read($query);
        unset($result['assuntos']);
        return $result;
    }

    /**
     * Returns Temas following parameters rules
     */
    public function getTemas(array $args)
    {
        $options = [
            'limit' => (int)$args['limit'],
            'skip' => (int)$args['offset']
        ];
        $result = $this->read([], $options);
        return $result;
    }

    /**
     * Insert Tema
     * @param array $args
     */
    public function insertTema(array $args)
    {
        if($args['assuntos']){
            $assuntos['assuntos'] = $args['assuntos'];
            $assuntos['dbCustom'] = $args['dbCustom'];
            unset($args['assuntos']);
            unset($args['dbCustom']);
        } else {
            unset($args['dbCustom']);
        }
        $result = $this->save($args);
        if($assuntos){
            $modelAssunto = new \Gpd\Model\AssuntoModel($result, $assuntos);
            $result = $modelAssunto->insertAssuntos($result['_id'], $assuntos);
        }
        return $result;
    }

    /**
     * Delete Tema
     * @param array $args
     */
    public function deleteTema(array $args)
    {
        $query = ['_id' => $args['_id']];
        $response = $this->delete($query);
        return $response;
    }


}