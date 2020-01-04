<?php

namespace CaseConverter\Traits;

use InvalidArgumentException;

trait ThrowException
{
    private static function throwException($subject, $expectedType)
    {
        $type = gettype($subject);

        throw new InvalidArgumentException(
            'Argument should be ' . $expectedType . ' of string ' . $type . ' given.'
        );
    }
}
