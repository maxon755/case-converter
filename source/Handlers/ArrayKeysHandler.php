<?php

namespace CaseConverter\Handlers;

class ArrayKeysHandler extends ArrayBaseHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        return $this->traversArray($subject, function($key, $item) use ($converter) {
            return [
                is_string($key) ? $converter->convert($key) : $key,
                $item,
            ];
        });
    }
}
