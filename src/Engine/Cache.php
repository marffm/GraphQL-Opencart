<?php

namespace Gpd\Engine;

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
        $dataToCache = $this->formatDataToCache($data, $dbInformation);
        if($this->cache[$index]){
            $this->cache[$index] += $dataToCache;
        } else {
            $this->cache[$index] = $dataToCache;
        }
    }

    /**
     * Get informations stored in cache
     * @param array $query
     * @param array $dbInformation
     * @return array|false
     */
    public function getCache(array $query, array $dbInformation)
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
        $id = $this->setId($data);
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
        if($data['_id']){
            $cache = [
                (string)$data['_id'] => $data
            ];
            return $cache;
        }
        foreach($data as $value){
            $cache[(string)$value['_id']] = $value;
        }
        return $cache;
    }

    /**
     * Set Index of cache
     * @param array $dbInformation
     * @return string
     */
    protected function setIndex(array $dbInformation)
    {
        if($dbInformation['dbCustom']){
            $dbInformation['database'] = $dbInformation['database'] . $dbInformation['dbCustom'];
        }
        return $dbInformation['dbType'] . '.' . $dbInformation['database'] . '.' . $dbInformation['collection'];
    }

    /**
     * Set id
     * @param array $data
     * @return string $id
     */
    protected function setId(array $data){
        if($data['_id']){
            $id = (string)$data['_id'];
        } else if($data['id']){
            $id = (string)$data['id'];
        } else {
            return false;
        }
        return $id;
    }

}