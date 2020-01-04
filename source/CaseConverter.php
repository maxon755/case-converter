<?php

namespace CaseConverter;

use CaseConverter\Converters\CamelCaseConverter;
use CaseConverter\Converters\HumanCaseConverter;
use CaseConverter\Converters\KebabCaseConverter;
use CaseConverter\Converters\PascalCaseConverter;
use CaseConverter\Converters\SnakeCaseConverter;
use CaseConverter\Handlers\ArrayHandler;
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
            self::throwException($string, 'string');
        }

        return new self($string, new StringHandler());
    }

    public static function array($array)
    {
        if (!is_array($array)) {
            self::throwException($array, 'array');
        }

        return new self($array, new ArrayHandler());
    }

    private static function throwException($subject, $expectedType)
    {
        $type = gettype($subject);

        throw new InvalidArgumentException(
            'Argument should be ' . $expectedType . ' of string ' . $type . ' given.'
        );
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

    public function toSnake()
    {
        return $this->to(new SnakeCaseConverter());
    }

    public function toPascal()
    {
        return $this->to(new PascalCaseConverter());
    }

    public function  toHuman()
    {
        return $this->to(new HumanCaseConverter());
    }
}
