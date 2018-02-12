<?php

namespace Src\Interfaces\DataBase;

interface Database {

    public function save(array $dados);

    public function read(array $query, array $options);

    public function update(array $dados, array $query);

    public function delete(array $query);
    
}