<?php

use CaseConverter\CaseConverter;
use PHPUnit\Framework\TestCase;

class StringCaseConverterTest extends TestCase
{

    public function testStringConversionWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        CaseConverter::string(42);
    }

    /**
     * @dataProvider kebabCaseDataProvider
     * @param string $subject
     * @param string $expected
     */
    public function testStringToKebabConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::string($subject)->toKebab());
    }

    public function kebabCaseDataProvider()
    {
        return [
            ['', ''],
            ['word', 'word'],
            ['Cap', 'cap'],
            ['two words', 'two-words'],
            ['two    words', 'two-words'],
            ['few words in   single  line', 'few-words-in-single-line'],
            ['kebab-case', 'kebab-case'],
            ['multi-word-kebab-case', 'multi-word-kebab-case'],
            ['camelCase', 'camel-case'],
            ['multiWordCamelCase', 'multi-word-camel-case'],
            ['snake_case', 'snake-case'],
            ['multi_word___snake__case', 'multi-word-snake-case'],
            ['PascalCase', 'pascal-case'],
            ['MultiWordPascalCase', 'multi-word-pascal-case'],
            ['UPPER_CASE', 'upper-case'],
            ['MULTI_WORD_UPPER__CASE', 'multi-word-upper-case'],
        ];
    }

    /**
     * @dataProvider camelCaseDataProvider
     * @param string $subject
     * @param string $expected
     */
    public function testStringToCamelConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::string($subject)->toCamel());
    }

    public function camelCaseDataProvider()
    {
        return [
            ['', ''],
            ['word', 'word'],
            ['Cap', 'cap'],
            ['two words', 'twoWords'],
            ['two    words', 'twoWords'],
            ['few words in   single  line', 'fewWordsInSingleLine'],
            ['kebab-case', 'kebabCase'],
            ['multi-word-kebab-case', 'multiWordKebabCase'],
            ['camelCase', 'camelCase'],
            ['multiWordCamelCase', 'multiWordCamelCase'],
            ['snake_case', 'snakeCase'],
            ['multi_word___snake__case', 'multiWordSnakeCase'],
            ['PascalCase', 'pascalCase'],
            ['MultiWordPascalCase', 'multiWordPascalCase'],
            ['UPPER_CASE', 'upperCase'],
            ['MULTI_WORD_UPPER__CASE', 'multiWordUpperCase'],
        ];
    }
}
