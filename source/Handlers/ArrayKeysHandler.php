<?php

namespace CaseConverter\Handlers;

class ArrayKeysHandler extends ArrayValuesHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        $result = [];

        foreach ($subject as $key => $item) {
            if (is_array($item)) {
                if (is_null($this->depth) || $this->depth-- > 0) {
                    $result[$converter->convert($key)] = $this->handle($item, $converter);
                } else {
                    $result[$converter->convert($key)] = $item;

                }
            } else if (!is_string($key)) {
                $result[$key] = $item;
            } else {
                $result[$converter->convert($key)] = $item;
            }
        }

        return $result;
    }
}
