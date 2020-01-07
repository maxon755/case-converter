<?php

namespace CaseConverter\Handlers;

use CaseConverter\Interfaces\Converter;

class ArrayValuesHandler extends ArrayBaseHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, Converter $converter)
    {
        return $this->traversArray($subject, function($key, $item) use ($converter) {
            return [
                $key,
                is_string($item) ? $converter->convert($item) : $item
            ];
        });
    }
}
