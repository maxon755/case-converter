<?php

namespace CaseConverter\Handlers;

use CaseConverter\Interfaces\Converter;

class ArrayKeysHandler extends ArrayBaseHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, Converter $converter)
    {
        return $this->traversArray($subject, function($key, $item) use ($converter) {
            return [
                is_string($key) ? $converter->convert($key) : $key,
                $item,
            ];
        });
    }
}
