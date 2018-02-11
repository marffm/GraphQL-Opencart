<?php

namespace Gpd\Engine;

class MongoDb implements \Gpd\Interfaces\Database\Database
{
    /**
     * Stores connections with MongoDb
     * @var array
     */
    private $mongoConnection;


    /**
     * Start connection with Mongo
     * @param array $dbInformation
     * @return array $this->mongoConnection
     */
    public function __construct($dbInformation)
    {
        // Set db Custom to database name
        if($dbInformation['dbCustom']){
            $dbInformation['database'] = $dbInformation['database'] . $dbInformation['dbCustom'];
        }
        try{
            $classMongo = new \Gpd\Core\Database\Mongodb();
            $db = $classMongo->getDb($dbInformation['serverConnection'] ?: 'default');
            $dbSelected = $db->{$dbInformation['database']};
            $this->mongoConnection = $dbSelected->{$dbInformation['collection']};
        } catch(\Exception $error) {
            throw \GraphQL\Error\Error::createLocatedError($error->getMessage());
        }
    }

    /**
     * Save data into database
     * @param array $data
     * @return
     */
    public function save(array $data)
    {
        $insert = $this->mongoConnection->insertOne($data);
        return $insert->getInsertedId() ?: null;
    }

    /**
     * Get informations in database based on informations passed
     * @param array $query
     * @param array $options
     * @return array $result
     */
    public function read(array $query, array $options = [])
    {
        if($options['aggregate']){
            return $this->aggregateRead($query);
        }
        try{
            $response = $this->mongoConnection->find($query, $options);
            if($response instanceof \MongoDB\Driver\Cursor){
                foreach($response as $result){
                    $results[] = $result;
                }
            }
            if(count($results) == 1){
                return $results[0];
            }
            
            return $results;
        } catch(\Exception $error){
            throw \GraphQL\Error\Error::createLocatedError($error->getMessage());
        }
    }

    /**
     * Update data stored in database
     * @param array $update
     * @param array $query
     * @return array
     */
    public function update(array $update, array $query)
    {
        return  $this->mongoConnection->findOneAndUpdate($query, $update, ['returnDocument' => \MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER]);
    }

    /**
     * Remove data stored in database
     * @param array $query
     */
    public function delete(array $query)
    {
        $response = $this->mongoConnection->deleteOne($query);
        return $response->getDeletedCount();
    }

    /**
     * Uses Aggregation method to return data
     * @param array $query
     * @return array
     */
    private function aggregateRead($query)
    {
        try {
            $response = $this->mongoConnection->aggregate($query);
            if($response instanceof \MongoDB\Driver\Cursor){
                foreach($response as $result){
                    $results[] = $result;
                }
            }
            return $results;
        } catch (\Exception $error) {
            throw \GraphQL\Error\Error::createLocatedError($error->getMessage());
        }
        
    }

}