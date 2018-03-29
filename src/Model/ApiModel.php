<?php

namespace Src\Model;

class ApiModel extends \Src\Engine\Model
{

    /**
     * Carries information about connection to dataBase
     */
    protected $dbInformation = [
        'dbType' => 'mysql',
        'database' => 'loja',
        'collection' => 'api',
        'serverConnection' => 'default',
        'customId' => 'api_id'
    ];


    /**
     * Get data from Api Table
     * @param array $args
     * @return array $response
     */
    public function getApis(array $args = null) : array
    {
        $query = "SELECT * FROM api";
        return $this->read($query);
        


        // To Read values inside cache
        // $cache = \Src\Engine\Cache::cacheInit();
        // $query['id'] = 1;
        // echo "<pre>" . print_r($cache->getCache($query, $this->dbInformation),true) . "</pre>";die;
    }

}