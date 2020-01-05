<?php

namespace CaseConverter;

use CaseConverter\Handlers\ArrayValuesHandler;
use CaseConverter\Handlers\StringHandler;
use InvalidArgumentException;

class CaseConverter
{
    private function __construct()
    {
    }

    /**
     * Single string conversion
     *
     * @param string $string
     * @return StringHandler
     */
    public static function string($string)
    {
        if (!is_string($string)) {
            self::throwException($string, 'string');
        }

        return new StringHandler($string);
    }

    /**
     * Array conversion
     *
     * @param $array
     * @return ArrayValuesHandler
     */
    public static function array($array)
    {
        if (!is_array($array)) {
            self::throwException($array, 'array');
        }

        return new ArrayValuesHandler($array);
    }

    private static function throwException($subject, $expectedType)
    {
        $type = gettype($subject);

        throw new InvalidArgumentException(
            'Argument should be ' . $expectedType . ' of string ' . $type . ' given.'
        );
    }
}
