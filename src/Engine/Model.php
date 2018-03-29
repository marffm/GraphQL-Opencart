<?php

namespace Src\Engine;

class Model
{
    protected $dbInformation = [];

    private $connection;

    private $token;

    private $publicMethodName;

    protected $context;


    public function __construct($context)
    {
        $this->context = $context;
        $this->token = $context->getSecurityKey();
    }


    /**
     * Read informations based on query
     * @param array $query
     * @param array $query
     * @return array
     */
    protected function read(string $query)
    {
        $this->startConnection();
        return $this->connection->read($query);
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
     * Its used to access methods that will not be necessary app key to work
     * @param string $publicMethodName
     */
    protected function setPublicMethodName(string $publicMethodName)
    {
        $this->publicMethodName = $publicMethodName;
    }


}