<?php

namespace Gpd\Engine;

class Connection implements \Gpd\Interfaces\Database\Database
{
    /**
     * @var $settings File
     */
    private $dbInformation;

    /**
     * Instance of Connection with database
     * @var object $connection
     */
    private $connection;

    /**
     * Instace of Cache
     * @var object $cache
     */
    private $cache;


    /**
     * Create Connection with database
     * @param array $dbInformation - Informations about the database connection
     * @return object $this->dbConnection
     */
    public function __construct(array $dbInformation, $key = null, $methodName = null)
    {
        // Connection to Security Layer
        $security = new \Gpd\Engine\Security($key, $methodName);
        if(!$security->checkSecurity()){
            throw \GraphQL\Error\Error::createLocatedError(1005);
        }

        // Initiate connection with Cache
        $this->cache =  \Gpd\Engine\Cache::cacheInit();

        // Create connection with database based on dbInformation
        $this->connection = $this->connectDataBase($dbInformation);

        $this->dbInformation = $dbInformation;
        return $this;
    }

    /**
     * Select Correct database type and create its connection
     * @param array $dbInformation
     * @return object $connection
     */
    private function connectDataBase(array $dbInformation)
    {
        switch ($dbInformation['dbType']){
            case 'mongodb':
                $connection = new \Gpd\Engine\MongoDb($dbInformation);
                break;
            case 'postgres':
                // Make connection with database
                break;
            case 'external':
                // CREATE CURL CLASS TO MAKE EXTERNAL REQUESTS
                break;
        }
        return $connection;
    }

    /**
     * Access read function in database Connection
     * @param array $query
     * @param array $options
     */
    public function read(array $query = [], array $options = [])
    {
        // search in cache before search in database
        $cached = $this->cache->getCache($query, $this->dbInformation);
        if($cached) {
            return $cached;
        }
        // if there's no cache, search in database connection
        $data = $this->connection->read($query, $options);
        if($data){
            $this->cache->setCache($data, $this->dbInformation);
        }        
        return $data;
    }

    /**
     * Access create function in database Connection
     * @param array $dados
     */
    public function save(array $data)
    {
        $result = $this->connection->save($data);
        if(!$result){
            throw \GraphQL\Error\Error::createLocatedError(1203);
        }
        $query['_id'] = $result;
        $response = $this->read($query);
        return $response;
    }

    /**
     * Access update function in database
     * @param array $dados
     * @param array $query
     */
    public function update(array $update, array $query)
    {
        $result = $this->connection->update($update, $query);
        if(!$result){
            return false;
        }
        $this->cache->updateCache($result, $this->dbInformation);
        return $result;
    }

    /**
     * Access delete function in database
     * @param array $query
     */
    public function delete(array $query)
    {
        $data = $this->read($query);
        if(!$data){
            throw \GraphQL\Error\Error::createLocatedError(1205);
        }
        $response = $this->connection->delete($query);
        if(!$response){
            throw \GraphQL\Error\Error::createLocatedError(1205);
        }
        return $data;
    }

    
}