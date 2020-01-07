<?php

namespace CaseConverter\Handlers;

class ArrayValuesHandler extends ArrayBaseHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        return array_map(function ($item) use ($converter) {
            if (is_array($item)) {
                if (is_null($this->depth) || $this->depth-- > 0) {
                    return $this->handle($item, $converter);
                } else {
                    return $item;
                }

            } else if (!is_string($item)) {
                return $item;
            }

            return $converter->convert($item);
        }, $subject);
    }
}
