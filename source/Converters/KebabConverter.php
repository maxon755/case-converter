<?php

namespace CaseConverter\Converters;

class KebabConverter implements Converter
{
    /**
     * @inheritDoc
     */
    public function convert($string)
    {
        return strtolower(preg_replace('/(?<=[a-z])(?=[A-Z])|_| |-/', '-', $string));
    }
}
