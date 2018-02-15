<?php

namespace Src\Engine;

class External implements \Src\Interfaces\Database\Database
{
    /**
     * Settings from external Connection
     */
    private $dbSettings;


    /**
     * Information from model
     */
    private $dbInformation;

    public function __construct(array $dbInformation, array $dbSettings)
    {
        // Set Settings
        $this->dbSettings = $this->setDbSettings($dbInformation, $dbSettings);
        $this->dbInformation = $dbInformation;
    }

    /**
     * Set Db Settings, external configurations
     * @param array $dbInformation
     * @param array $dbSettings
     */
    private function setDbSettings(array $dbInformation, array $dbSettings) : array
    {
        $serverConnection = $dbInformation['serverConnection']? : 'default';
        return $dbSettings[$serverConnection];
    }

    /**
     * 
     */
    public function save(array $dados)
    {
        // create save function
        // this function must return id of new insertion
    }

    /**
     * Get data from opencart Rest Api
     * @param array $query
     * @param array $options
     * @return array $response
     */
    public function read(array $query, array $options)
    {
        $response = [];
        $data = [
            'query' => $query,
            'dbSettings' => $this->dbSettings,
            'dbInformation' => $this->dbInformation,
            'method' => 'GET'
        ];
        $call = \Src\Helpers\CurlsGenerator::generateOpencartCurl($data);
        $response =  \Src\Helpers\CurlsGenerator::executeCurl($call);
        $response = json_decode($response, true);
        $response = $this->formatResponse($response, $data);
        return $response;
    }

    public function update(array $dados, array $query)
    {
        // Create update function
        // This function must return an updated array record, even it is a single one
    }

    public function delete(array $query)
    {
        // Create delete function
    }


    /**
     * Returns formated response
     * @param array $response
     * @param array $data
     * @return array $response_formated
     */
    private function formatResponse(array $response, array $data)
    {
        $index = $data['dbSettings']['dbPrefix'] . $data['dbInformation']['collection'];
        if($response[$index]){
            $columns = $response[$index]['columns'];
            $records = $response[$index]['records'];
            foreach($records as $record){
                foreach($record as $key=>$value){
                    $result[$columns[$key]] = $value;
                }
                $response_formated[] = $result;
            }
        } else {
            $response_formated[] = $response;
        }
        return $response_formated;
    }


}