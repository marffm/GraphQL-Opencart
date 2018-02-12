<?php

namespace Src\Interfaces\Type;

interface QueryType
{
    /**
     * Uses to export ObjectType to be used in Query Schema
     */
    public static function exportQueryType();
}