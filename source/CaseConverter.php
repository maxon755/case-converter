<?php

namespace CaseConverter;

use CaseConverter\Converters\CamelCaseConverter;
use CaseConverter\Converters\KebabCaseConverter;
use CaseConverter\Handlers\StringHandler;
use CaseConverter\Interfaces\Converter;
use CaseConverter\Interfaces\Handler;
use InvalidArgumentException;

class CaseConverter
{
    /** @var mixed entity than will be converted */
    private $subject;

    /** @var Handler */
    private $handler;

    /**
     * CaseConverter constructor.
     *
     * @param mixed $subject
     * @param string $handler
     */
    private function __construct($subject, $handler)
    {
        $this->subject = $subject;
        $this->handler = $handler;
    }

    /**
     * Named constructor for single string conversion
     *
     * @param string $string
     * @return CaseConverter
     */
    public static function string($string)
    {
        if (!is_string($string)) {
            $type = gettype($string);

            throw new InvalidArgumentException(
                'Argument should be type of string ' . $type . ' given.'
            );
        }

        return new self($string, new StringHandler());
    }

    /**
     * @param Converter $converter
     *
     * @return mixed
     */
    private function to($converter)
    {
        return $this->handler->handle($this->subject, $converter);
    }

    public function toKebab()
    {
        return $this->to(new KebabCaseConverter());
    }

    public function toCamel()
    {
        return $this->to(new CamelCaseConverter());
    }
}
