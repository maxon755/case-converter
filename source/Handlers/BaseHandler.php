<?php

namespace CaseConverter\Handlers;

use CaseConverter\Converters\CamelCaseConverter;
use CaseConverter\Converters\HumanCaseConverter;
use CaseConverter\Converters\KebabCaseConverter;
use CaseConverter\Converters\PascalCaseConverter;
use CaseConverter\Converters\SnakeCaseConverter;
use CaseConverter\Interfaces\Converter;
use InvalidArgumentException;

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
    abstract public function handle($subject, Converter $converter);

    /**
     * @param Converter $converter
     *
     * @return mixed
     */
    private function to(Converter $converter)
    {
        return static::handle($this->subject, $converter);
    }

    /**
     * @return array|string
     */
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

    public function toHuman()
    {
        return $this->to(new HumanCaseConverter());
    }

    /**
     * @param $converter
     *
     * @return mixed
     */
    public function withConverter($converter)
    {
        if (is_callable($converter)) {
            $converter = $this->buildConverter($converter);
        }
        if (!$converter instanceof Converter) {
            throw new InvalidArgumentException(
                '$converter must be instance of ' . Converter::class . ' or callable'
            );
        }

        return $this->to($converter);
    }

    /**
     * @param callable $callable
     * @return Converter
     */
    private function buildConverter(callable $callable): Converter
    {
        return new class($callable) implements Converter {
            private $callable;

            public function __construct(callable  $callable)
            {
                $this->callable = $callable;
            }

            /**
             * @inheritDoc
             */
            public function convert($string): string
            {
                return call_user_func($this->callable, $string);
            }
        };
    }
}
