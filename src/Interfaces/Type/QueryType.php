<?php

namespace Src\Interfaces\Type;

interface QueryType
{
    /**
     * Uses to export ObjectType to be used in Query Schema
     */
    public static function exportQueryType();

    /**
     * Export Input types to be used in args in query ObjectType
     * @param string $inputName
     */
    public static function exportInputType(string $inputName);
}