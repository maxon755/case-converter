<?php

use CaseConverter\CaseConverter;
use CaseConverter\Interfaces\Converter;
use PHPUnit\Framework\TestCase;

class CustomConverterTest extends TestCase
{
    public function testInvalidCustomConverterArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        CaseConverter::string('valid string')->withConverter('invalid argument');
    }

    public function testCallableCustomConverterForStringConversion()
    {
        $result = CaseConverter::string('1-2-3-4')->withConverter(function ($string) {
            return str_replace('-', '*', $string);
        });

        $this->assertEquals('1*2*3*4', $result);
    }

    public function testCallableCustomConverterForArrayConversion()
    {
        $result = CaseConverter::array([
            '1-2',
            [
                '2-3-4',
                [
                    '5-6-7'
                ]
            ]
        ])->withConverter(function ($string) {
            return str_replace('-', '*', $string);
        });

        $this->assertEquals([
            '1*2',
            [
                '2*3*4',
                [
                    '5*6*7'
                ]
            ]
        ], $result);
    }

    public function testClassCustomConverterForStringConversion()
    {
        $result = CaseConverter::string('1-2-3-4')
            ->withConverter($this->getCustomClassConverter());

        $this->assertEquals('1*2*3*4', $result);
    }

    private function getCustomClassConverter()
    {
        return new class implements Converter {
            public function convert($string): string
            {
                return str_replace('-', '*', $string);
            }
        };
    }

    public function testClassCustomConverterForArrayConversion()
    {
        $result = CaseConverter::array([
            '1-2',
            [
                '2-3-4',
                [
                    '5-6-7'
                ]
            ]
        ])->withConverter($this->getCustomClassConverter());

        $this->assertEquals([
            '1*2',
            [
                '2*3*4',
                [
                    '5*6*7'
                ]
            ]
        ], $result);
    }
}
