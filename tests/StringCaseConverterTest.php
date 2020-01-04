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

    /**
     * @dataProvider snakeCaseDataProvider
     * @param string $subject
     * @param string $expected
     */
    public function testStringToSnakeConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::string($subject)->toSnake());
    }

    public function snakeCaseDataProvider()
    {
        return [
            ['', ''],
            ['word', 'word'],
            ['Cap', 'cap'],
            ['two words', 'two_words'],
            ['two    words', 'two_words'],
            ['few words in   single  line', 'few_words_in_single_line'],
            ['kebab-case', 'kebab_case'],
            ['multi-word-kebab-case', 'multi_word_kebab_case'],
            ['camelCase', 'camel_case'],
            ['multiWordCamelCase', 'multi_word_camel_case'],
            ['snake_case', 'snake_case'],
            ['multi_word___snake__case', 'multi_word_snake_case'],
            ['PascalCase', 'pascal_case'],
            ['MultiWordPascalCase', 'multi_word_pascal_case'],
            ['UPPER_CASE', 'upper_case'],
            ['MULTI_WORD_UPPER__CASE', 'multi_word_upper_case'],
        ];
    }

    /**
     * @dataProvider pascalCaseDataProvider
     * @param string $subject
     * @param string $expected
     */
    public function testStringToPascalConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::string($subject)->toPascal());
    }

    public function pascalCaseDataProvider()
    {
        return [
            ['', ''],
            ['word', 'Word'],
            ['Cap', 'Cap'],
            ['two words', 'TwoWords'],
            ['two    words', 'TwoWords'],
            ['few words in   single  line', 'FewWordsInSingleLine'],
            ['kebab-case', 'KebabCase'],
            ['multi-word-kebab-case', 'MultiWordKebabCase'],
            ['camelCase', 'CamelCase'],
            ['multiWordCamelCase', 'MultiWordCamelCase'],
            ['snake_case', 'SnakeCase'],
            ['multi_word___snake__case', 'MultiWordSnakeCase'],
            ['PascalCase', 'PascalCase'],
            ['MultiWordPascalCase', 'MultiWordPascalCase'],
            ['UPPER_CASE', 'UpperCase'],
            ['MULTI_WORD_UPPER__CASE', 'MultiWordUpperCase'],
        ];
    }

    /**
     * @dataProvider humanCaseDataProvider
     * @param string $subject
     * @param string $expected
     */
    public function testStringToHumanConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::string($subject)->toHuman());
    }

    public function humanCaseDataProvider()
    {
        return [
            ['', ''],
            ['word', 'word'],
            ['Cap', 'cap'],
            ['two words', 'two words'],
            ['two    words', 'two words'],
            ['few words in   single  line', 'few words in single line'],
            ['kebab-case', 'kebab case'],
            ['multi-word-kebab-case', 'multi word kebab case'],
            ['camelCase', 'camel case'],
            ['multiWordCamelCase', 'multi word camel case'],
            ['snake_case', 'snake case'],
            ['multi_word___snake__case', 'multi word snake case'],
            ['PascalCase', 'pascal case'],
            ['MultiWordPascalCase', 'multi word pascal case'],
            ['UPPER_CASE', 'upper case'],
            ['MULTI_WORD_UPPER__CASE', 'multi word upper case'],
        ];
    }
}
