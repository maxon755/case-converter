<?php

namespace CaseConverter\Handlers;

use InvalidArgumentException;

abstract class ArrayBaseHandler extends BaseHandler
{
    /** @var integer | null recursion depth  */
    protected $depth = null;

    protected function traversArray($subject, callable $action)
    {
        $result = [];

        foreach ($subject as $key => $item) {
            [$key, $item] = $action($key, $item);

            if (is_array($item)) {
                if (is_null($this->depth) || $this->depth-- > 0) {
                    $result[$key] = $this->traversArray($item, $action);
                } else {
                    $result[$key] = $item;
                }
            } else {
                $result[$key] = $item;
            }
        }

        return $result;
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
