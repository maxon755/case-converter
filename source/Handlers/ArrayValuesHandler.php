<?php

namespace CaseConverter\Handlers;

use InvalidArgumentException;

class ArrayValuesHandler extends BaseHandler
{
    /** @var integer | null recursion depth  */
    protected $depth = null;

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

    public function values()
    {
        return $this;
    }

    public function keys()
    {
        return new ArrayKeysHandler($this->subject);
    }

    /**
     * @param integer $depth
     * @return $this
     */
    public function depth($depth)
    {
        if (!is_integer($depth) || $depth < 0) {
            throw new InvalidArgumentException("Depth parameter should be non negative integer");
        }

        $this->depth = $depth;

        return $this;
    }
}
