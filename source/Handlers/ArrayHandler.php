<?php

namespace CaseConverter\Handlers;

use CaseConverter\Interfaces\Handler;

class ArrayHandler implements Handler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        return array_map(function ($item) use ($converter) {
            if (!is_string($item)) {
                return $item;
            }

            return $converter->convert($item);
        }, $subject);
    }
}
