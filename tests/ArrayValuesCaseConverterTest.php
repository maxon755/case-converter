<?php

use CaseConverter\CaseConverter;
use PHPUnit\Framework\TestCase;

class ArrayValuesCaseConverterTest extends TestCase
{
    public function testArrayConversionWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        CaseConverter::array(42);
    }

    /**
     * @dataProvider kebabCaseDataProvider
     * @param array $subject
     * @param array $expected
     */
    public function testArrayToKebabConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::array($subject)->toKebab());
    }

    public function kebabCaseDataProvider()
    {
        return [
            [
                [], []
            ],
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

    public function testArrayDepthConversionWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        CaseConverter::array([])->depth('forty two');

        $this->expectException(InvalidArgumentException::class);
        CaseConverter::array([])->depth(-42);
    }

    /**
     * @dataProvider recursionKebabCaseDataProvider
     * @param int $depth
     * @param array $subject
     * @param array $expected
     */
    public function testArrayRecursionDepthConversion($depth, $subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::array($subject)->depth($depth)->toKebab());
    }

    public function recursionKebabCaseDataProvider()
    {
        return [
            [
                0,
                [
                    42,
                    'snake_case',
                    [
                        43,
                        'camelCase',
                        [
                            44,
                            'human case',
                            'PascalCase,'
                        ]
                    ]
                ],
                [
                    42,
                    'snake-case',
                    [
                        43,
                        'camelCase',
                        [
                            44,
                            'human case',
                            'PascalCase,'
                        ]
                    ]
                ],
            ],
            [
                1,
                [
                    42,
                    'snake_case',
                    [
                        43,
                        'camelCase',
                        [
                            44,
                            'human case',
                            'PascalCase,'
                        ]
                    ]
                ],
                [
                    42,
                    'snake-case',
                    [
                        43,
                        'camel-case',
                        [
                            44,
                            'human case',
                            'PascalCase,'
                        ]
                    ]
                ],
            ],
            [
                2,
                [
                    42,
                    'snake_case',
                    [
                        43,
                        'camelCase',
                        [
                            44,
                            'human case',
                            'PascalCase,'
                        ]
                    ]
                ],
                [
                    42,
                    'snake-case',
                    [
                        43,
                        'camel-case',
                        [
                            44,
                            'human-case',
                            'pascal-case,'
                        ]
                    ]
                ],
            ]
        ];
    }
}
