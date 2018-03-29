<?php

namespace Src\Interfaces\DataBase;

interface Database {

    public function save($data);

    public function read(string $query);

    public function update($data, $query);

    public function delete($query);
    
}