<?php

namespace CaseConverter\Converters;

use CaseConverter\Interfaces\Converter;

class SnakeCaseConverter implements Converter
{
    /**
     * @inheritDoc
     */
    public function convert($string): string
    {
        return strtolower(preg_replace('/(?<=[a-z])(?=[A-Z])|_+| +|-+/', '_', $string));
    }
}
