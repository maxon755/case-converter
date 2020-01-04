<?php

namespace CaseConverter\Interfaces;

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
