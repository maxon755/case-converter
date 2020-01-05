<?php

namespace CaseConverter\Handlers;

use CaseConverter\Traits\ThrowException;

class ArrayValuesHandler extends BaseHandler
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
                if (is_null($this->depth)) {
                    return $this->handle($item, $converter);
                } else {
                    if ($this->depth > 0) {
                        $this->depth -= 1;

                        return $this->handle($item, $converter);
                    } else {
                        return $item;
                    }
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
