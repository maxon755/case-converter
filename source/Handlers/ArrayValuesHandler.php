<?php

namespace CaseConverter\Handlers;

class ArrayValuesHandler extends ArrayBaseHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        return $this->traversArray($subject, function($key, $item) use ($converter) {
            return [
                $key,
                is_string($item) ? $converter->convert($item) : $item
            ];
        });
    }
}
