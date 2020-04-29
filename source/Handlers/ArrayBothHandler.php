<?php

namespace CaseConverter\Handlers;

use CaseConverter\Interfaces\Converter;

class ArrayBothHandler extends ArrayBaseHandler
{
    /**
     * @inheritDoc
     *
     * @return array
     */
    public function handle($subject, Converter $converter): array
    {
        return $this->traversArray($subject, function ($key, $item) use ($converter) {
            return [
                is_string($item) ? $converter->convert($item) : $item,
                is_string($key) ? $converter->convert($key) : $key,
            ];
        });
    }
}
