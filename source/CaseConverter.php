<?php

namespace CaseConverter;

use CaseConverter\Converters\Converter;
use CaseConverter\Converters\KebabConverter;
use CaseConverter\Handlers\Handler;
use CaseConverter\Handlers\StringHandler;
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
        return $this->to(new KebabConverter());
    }
}
