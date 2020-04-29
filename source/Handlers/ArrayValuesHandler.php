<?php

namespace CaseConverter\Handlers;

use CaseConverter\Interfaces\Converter;

class ArrayValuesHandler extends ArrayBaseHandler
{
    /**
     * @inheritDoc
     *
     * @return array
     */
    public function handle($subject, Converter $converter): array
    {
        return $this->traversArray($subject, function($key, $item) use ($converter) {
            return [
                $key,
                is_string($item) ? $converter->convert($item) : $item
            ];
        });
    }
}
