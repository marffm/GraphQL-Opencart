<?php

namespace Src\Engine;

final class Cache
{

    /**
     * Set informations to keep in cache.
     * Pattern to write must be $cache[origin][table/collection Name]
     * @var array
     */
    private $cache = [];

    /**
     * Instance of cache class
     * @var object
     */
    private static $instance;
    

    /**
     * Initiate cache class
     * @return object
     */
    public static function cacheInit()
    {
        if (!isset(self::$instance)){
            self::$instance = new Cache();
        }
        return self::$instance;
    }

    /**
     * Insert data into cache array
     * @param array $data
     * @param array $dbInformation
     */
    public function setCache(array $data, array $dbInformation)
    {
        $index = $this->setIndex($dbInformation);
        foreach($data as $single_value){
            if($single_value[$dbInformation['customId']]){
                $dataToCache = $this->formatDataToCache($single_value, $dbInformation);
            }
            if($this->cache[$index]){
                $this->cache[$index] += $dataToCache;
            } else {
                $this->cache[$index] = $dataToCache;
            }
        }
    }

    /**
     * Get informations stored in cache
     * @param array $query
     * @param array $dbInformation
     * @return array|false
     */
    public function getCache(string $query, array $dbInformation)
    {
        if(!$this->cache){
            return false;
        }
        $index = $this->setIndex($dbInformation);
        $id = $this->setId($query);
        return $this->cache[$index][$id]?: false;
    }

    /**
     * Updates cache Data
     * @param array $dataToCache
     * @param array $dbInformation
     */
    public function updateCache(array $data, array $dbInformation)
    {
        if(!$this->cache){
            return false;
        }
        $this->invalidateCache($data, $dbInformation);
        $this->setCache($data, $dbInformation);
    }

    /**
     * Removes cache Data
     * @param array $dataToCache
     * @param array $dbInformation
     */
    public function invalidateCache(array $data, array $dbInformation)
    {
        if(!$this->cache){
            return false;
        }
        $index = $this->setIndex($dbInformation);
        $id = $this->setId($data[0][$dbInformation['customId']]);
        unset($this->cache[$index][$id]);
    }

    /**
     * Format data to insert in cache
     * @param array $data
     * @param array $dbInformation
     * @return array $cache
     */
    protected function formatDataToCache(array $data, array $dbInformation)
    {
        $cache = [
            (string)$data[$dbInformation['customId']] => $data
        ];
        return $cache;
    }

    /**
     * Set Index of cache
     * @param array $dbInformation
     * @return string
     */
    protected function setIndex(array $dbInformation)
    {
        return $dbInformation['dbType'] . '.' . $dbInformation['database'] . '.' . $dbInformation['collection'];
    }

    /**
     * Set id
     * @param array $data
     * @return string $id
     */
    protected function setId(string $query)
    {

        echo '<pre>' .json_encode('inside setId Cache'). '</pre>';die;
        // if($query['id']){
        //     $id = $query['id'];
        // }
        // return $id;
    }

}