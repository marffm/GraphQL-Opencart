<?php

namespace Src\Engine;

class Model
{
    protected $dbInformation = [];

    private $connection;

    private $token;

    private $methodName;


    public function __construct($root = null, $args = null, $context = null, $info = null)
    {
        if($context){
            $this->token = $context->getSecurityKey();
        }        
        // Insert db custom in dbInformation
        if($args['dbCustom']){
            $this->dbInformation['dbCustom'] = $args['dbCustom'];
        }       
    }


    /**
     * Read informations based on query
     * @param array $query
     * @param array $query
     * @return array
     */
    protected function read(array $query = [], array $options = [])
    {
        $this->startConnection();
        return $this->connection->read($query, $options);
    }

    /**
     * Insert data into database
     * @param array $data
     * @return array
     */
    protected function save(array $data)
    {
        $this->startConnection();
        return $this->connection->save($data);
    }

    /**
     * Update data
     * @param array $update
     * @param array $query
     * @return array
     */

    protected function update(array $update, array $query)
    {
        $this->startConnection();
        return $this->connection->update($update, $query);
    }

    /**
     * Delete Data
     * @param array $query
     */
    protected function delete(array $query)
    {
        $this->startConnection();
        return $this->connection->delete($query);
    }

    /**
     * Start Connection with Connection Layer
     */
    private function startConnection()
    {
        $this->connection = new \Src\Engine\Connection($this->dbInformation, $this->token, $this->methodName);
    }

    /**
     * Set methodName
     * @param string $methodName
     */
    protected function setMethodName(string $methodName)
    {
        $this->methodName = $methodName;
    }


}