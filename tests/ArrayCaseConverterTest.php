<?php

use CaseConverter\CaseConverter;
use PHPUnit\Framework\TestCase;

class ArrayCaseConverterTest extends TestCase
{
    public function testStringConversionWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        CaseConverter::string(42);
    }

    /**
     * @dataProvider kebabCaseDataProvider
     * @param array $subject
     * @param array $expected
     */
    public function testStringToKebabConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::array($subject)->toKebab());
    }

    public function kebabCaseDataProvider()
    {
        return [
            [
                [
                    '', 'word', 'Cap', 'human case', 'human   case', 'multi  word human   case',
                    'kebab-case', 'multi-word-kebab-case', 'camelCase', 'multiWordCamelCase',
                    'snake_case', 'multi_word___snake__case', 'PascalCase', 'MultiWordPascalCase',
                    'UPPER_CASE', 'MULTI_WORD_UPPER__CASE'
                ],
                [
                    '', 'word', 'cap', 'human-case', 'human-case', 'multi-word-human-case',
                    'kebab-case', 'multi-word-kebab-case', 'camel-case', 'multi-word-camel-case',
                    'snake-case', 'multi-word-snake-case', 'pascal-case', 'multi-word-pascal-case',
                    'upper-case', 'multi-word-upper-case'
                ]
            ],
            [
                [
                    'snake_case',
                    [
                        'camelCase',
                        [
                            'human case',
                            'PascalCase,'
                        ]
                    ]
                ],
                [
                    'snake-case',
                    [
                        'camel-case',
                        [
                            'human-case',
                            'pascal-case,'
                        ]
                    ]
                ],
            ]
        ];
    }
}
