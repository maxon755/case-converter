<?php

namespace CaseConverter\Handlers;

use InvalidArgumentException;

abstract class ArrayBaseHandler extends BaseHandler
{
    /** @var integer | null recursion depth  */
    protected $depth = null;

    /**
     * @param $subject
     * @param callable $action
     *
     * @return array
     */
    protected function traversArray($subject, callable $action): array
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
     * @param int $depth
     * @return $this
     */
    public function depth(int $depth): self
    {
        if ($depth < 0) {
            throw new InvalidArgumentException("Depth parameter should be non negative integer");
        }

        $this->depth = $depth;

        return $this;
    }
}
