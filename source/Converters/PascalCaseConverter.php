<?php

namespace CaseConverter\Converters;

use CaseConverter\Interfaces\Converter;

class PascalCaseConverter implements Converter
{
    /**
     * @inheritDoc
     */
    public function convert($string): string
    {
        $string = preg_replace(
            '/(?<=[a-z])(?=[A-Z])|_+| +|-+/',
            '_',
            $string
        );

        $string = ucwords(strtolower($string), '_');

        return str_replace('_', '', $string);
    }
}
