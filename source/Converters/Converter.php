<?php

namespace CaseConverter\Converters;

interface Converter
{
    /**
     * Convert string to another case.
     *
     * @param string $string
     *
     * @return string
     */
    public function convert($string);
}
