<?php

use CaseConverter\CaseConverter;
use PHPUnit\Framework\TestCase;

class StringCaseConverterTest extends TestCase
{

    /**
     * @dataProvider kebabCaseDataProvider
     * @param string $subject
     * @param string $expected
     */
    public function testStringToKebabConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::string($subject)->toKebab());
    }

    public function testStringToKebabConversionWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        CaseConverter::string(42);
    }

    public function kebabCaseDataProvider()
    {
        return [
            ['', ''],
            ['word', 'word'],
            ['Cap', 'cap'],
            ['two words', 'two-words'],
            ['camelCase', 'camel-case'],
            ['snake-case', 'snake-case'],
            ['PascalCase', 'pascal-case'],
            ['UPPER_CASE', 'upper-case'],
        ];
    }
}
