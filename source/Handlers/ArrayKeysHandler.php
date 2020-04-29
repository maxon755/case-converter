<?php

namespace CaseConverter\Handlers;

use CaseConverter\Interfaces\Converter;

class ArrayKeysHandler extends ArrayBaseHandler
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
                is_string($key) ? $converter->convert($key) : $key,
                $item,
            ];
        });
    }
}
