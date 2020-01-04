<?php

namespace CaseConverter\Converters;

use CaseConverter\Interfaces\Converter;

class KebabCaseConverter implements Converter
{
    /**
     * @inheritDoc
     */
    public function convert($string)
    {
        return strtolower(preg_replace('/(?<=[a-z])(?=[A-Z])|_+| +|-+/', '-', $string));
    }
}
