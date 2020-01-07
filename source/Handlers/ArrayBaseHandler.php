<?php

namespace CaseConverter\Handlers;

use InvalidArgumentException;

abstract class ArrayBaseHandler extends BaseHandler
{
    /** @var integer | null recursion depth  */
    protected $depth = null;

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
