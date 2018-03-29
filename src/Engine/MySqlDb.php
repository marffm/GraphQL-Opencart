<?php

namespace Src\Engine;

class MySqlDb implements \Src\Interfaces\Database\Database
{

    /**
     * Instance of PDO Connection
     * @var
     */
    private $connection;

    public function __construct($dbInformation, $dbSettings)
    {
        $this->connection = $this->connectToDatabase($dbSettings, $dbInformation);
    }

    /**
     * Insert data in database
     * @param array $dados
     */
    public function save($data)
    {

    }

    /**
     * Read data in database
     * @param array $query
     * @param array $options
     */
    public function read(string $query)
    {
        $query = $this->connection->prepare($query);
        $query->execute();
        $response = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    /**
     * Update data in database
     * @param array $dados
     * @param array $query
     */
    public function update($data, $query)
    {

    }

    /**
     * Delete data in database
     * @param array $query
     */
    public function delete($query)
    {

    }

    /**
     * Make connection with dataBase
     * @param array $dbSettings
     * @return object
     */
    private function connectToDatabase(array $dbSettings, $dbInformation)
    {
        $host = $dbSettings[$dbInformation['serverConnection']]['hostname'];
        $dbName = $dbSettings[$dbInformation['serverConnection']]['database'];
        $port = $dbSettings[$dbInformation['serverConnection']]['port'];
        $username = $dbSettings[$dbInformation['serverConnection']]['username'];
        $password = $dbSettings[$dbInformation['serverConnection']]['password'];
        try {
            return new \PDO("mysql:host=$host;port=$port;dbname=$dbName", $username, $password, array(\PDO::ATTR_PERSISTENT => true));            
        } catch (\PDOException $error) {
            throw \GraphQL\Error\Error::createLocatedError($error->getMessage());
        }
        
    }


}