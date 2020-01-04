<?php

namespace CaseConverter\Handlers;

use CaseConverter\Traits\ThrowException;

class ArrayHandler extends BaseHandler
{
    use ThrowException;

    protected $handler = null;

    protected $depth = null;

    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        return array_map(function ($item) use ($converter) {
            if (is_array($item)) {
                return $this->handle($item, $converter);
            } else if (!is_string($item)) {
                return $item;
            }

            return $converter->convert($item);
        }, $subject);
    }

    public function values()
    {
        return $this;
    }

    public function keys()
    {
        return new ArrayKeysHandler($this->subject);
    }

    /**
     * @param int $depth
     * @return $this
     */
    public function depth($depth)
    {
        if (!is_integer($depth)) {
            $this->throwException($depth, 'integer');
        }

        $this->depth = $depth;

        return $this;
    }
}
