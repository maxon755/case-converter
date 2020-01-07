<?php

namespace CaseConverter\Handlers;

class ArrayBothHandler extends ArrayBaseHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        return $this->traversArray($subject, function ($key, $item) use ($converter) {
            return [
                is_string($item) ? $converter->convert($item) : $item,
                is_string($key) ? $converter->convert($key) : $key,
            ];
        });
    }
}
