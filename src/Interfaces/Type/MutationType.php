<?php

namespace Gpd\Interfaces\Type;

interface MutationType
{
    /**
     * Export Types to be used in Mutation Schema
     */
    public static function exportMutationType();

    /**
     * Export Input types to be used in args in mutation ObjectType
     * @param string $inputName
     */
    public static function exportInputType(string $inputName);

}