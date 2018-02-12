<?php

namespace Src\Interfaces\Type;

/**
 * Defines required methods to Scalar Types
 */
interface ScalarType
{
    /**
     * Return CustomScalarType object with serialize and parseValue methods
     */
    public static function create();

    /**
     * Convert value to use in a response.
     * @param mixed $value
     * @return string
     */
    public static function serialize($value);

    /**
     * Convert Value to use as an input
     * @param string $value
     */
    public static function parseValue(string $value);

    /**
     * @param \GraphQL\Language\AST\Node $valueNode
     */
    public static function parseLiteral($valueNode);



}