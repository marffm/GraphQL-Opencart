<?php

namespace Src\Model\Catalog;

class CategoryModel extends \Src\Engine\Model
{

    /**
     * Carries information about connection to dataBase
     */
    protected $dbInformation = [
        'dbType' => 'mysql',
        'database' => 'loja',
        'collection' => 'category',
        'serverConnection' => 'default',
        'customId' => 'category_id'
    ];


    /**
     * Get Categories
     * @param array $args
     * @return array
     */
    public function getCategories(array $args = null)
    {
        $query = $this->generateQuery($args);
        return $this->read($query);        
    }


    /**
     * Generates Query
     * @param array $args
     * @return string $query 
     */
    private function generateQuery(array $args = null) : string
    {
        if(!isset($args['status'])) $args['status'] = 1;
        if(!isset($args['storeId'])) $args['storeId'] = 0;

        $query = "SELECT * FROM category";
        $query .= " LEFT JOIN category_description ON (category.category_id = category_description.category_id)";
        $query .= " LEFT JOIN category_to_store ON (category.category_id = category_to_store.category_id)";
        $query .= " WHERE category.status = '" . $args['status'] . "'";
        $query .= " AND category_to_store.store_id = '" . $args['storeId'] ."'";

        if($args['id']) $query .= " AND category.category_id = '" . $args['id'] . "'";
        
        if(isset($args['parentId'])) $query .= " AND category.parent_id = '" . $args['parentId'] . "'";
        
        $query .= " ORDER BY category.sort_order";
        return $query;
    }

}