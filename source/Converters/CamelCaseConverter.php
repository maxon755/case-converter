<?php

namespace CaseConverter\Converters;

use CaseConverter\Interfaces\Converter;

class CamelCaseConverter implements Converter
{
    /**
     * @inheritDoc
     */
    public function convert($string)
    {
        $string = preg_replace(
            '/(?<=[a-z])(?=[A-Z])|_+| +|-+/',
            '_',
            $string
        );

        $string = ucwords(strtolower($string), '_');
        $string = str_replace('_', '', $string);

        return lcfirst($string);
    }
}
