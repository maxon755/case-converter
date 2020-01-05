<?php

namespace CaseConverter\Handlers;

use CaseConverter\Converters\CamelCaseConverter;
use CaseConverter\Converters\HumanCaseConverter;
use CaseConverter\Converters\KebabCaseConverter;
use CaseConverter\Converters\PascalCaseConverter;
use CaseConverter\Converters\SnakeCaseConverter;
use CaseConverter\Interfaces\Converter;

abstract class BaseHandler
{
    /** @var mixed entity than will be converted */
    protected $subject;

    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Handles particular type of subject.
     *
     * @param mixed $subject
     * @param Converter $converter
     *
     * @return mixed
     */
    abstract public function handle($subject, $converter);

    /**
     * @param Converter $converter
     *
     * @return mixed
     */
    private function to($converter)
    {
        return static::handle($this->subject, $converter);
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
