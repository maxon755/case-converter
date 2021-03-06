<?php

namespace CaseConverter;

use CaseConverter\Handlers\ArrayBothHandler;
use CaseConverter\Handlers\ArrayKeysHandler;
use CaseConverter\Handlers\ArrayValuesHandler;

/**
 * @method depth(int $depth)
 * @method toKebab()
 * @method toCamel()
 * @method toSnake()
 * @method toPascal()
 * @method toHuman()
 *
 * @method withConverter($converter)
 */
class ArrayProxy
{
    private $subject;

    public function __construct(array $subject)
    {
        $this->subject = $subject;
    }

    public function values(): ArrayValuesHandler
    {
        return new ArrayValuesHandler($this->subject);
    }

    public function keys(): ArrayKeysHandler
    {
        return new ArrayKeysHandler($this->subject);
    }

    public function both(): ArrayBothHandler
    {
        return new ArrayBothHandler($this->subject);
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->values(), $method], $arguments);
    }
}
