<?php

namespace CaseConverter\Handlers;

class ArrayBothHandler extends ArrayValuesHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        $result = [];

        foreach ($subject as $key => $item) {
            $item = is_string($item) ? $converter->convert($item) : $item;
            $key = is_string($key) ? $converter->convert($key) : $key;

            if (is_array($item)) {
                if (is_null($this->depth) || $this->depth-- > 0) {
                    $result[$key] = $this->handle($item, $converter);
                } else {
                    $result[$key] = $item;
                }
            } else {
                $result[$key] = $item;
            }
        }

        return $result;
    }
}
