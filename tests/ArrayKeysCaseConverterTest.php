<?php

use CaseConverter\CaseConverter;
use PHPUnit\Framework\TestCase;

class ArrayKeysCaseConverterTest extends TestCase
{
    /**
     * @dataProvider kebabCaseDataProvider
     * @param array $subject
     * @param array $expected
     */
    public function testArrayKeysToKebabConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::array($subject)->keys()->toKebab());
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
                    '', 'word', 'Cap', 'human case', 'human   case', 'multi  word human   case',
                    'kebab-case', 'multi-word-kebab-case', 'camelCase', 'multiWordCamelCase',
                    'snake_case', 'multi_word___snake__case', 'PascalCase', 'MultiWordPascalCase',
                    'UPPER_CASE', 'MULTI_WORD_UPPER__CASE'
                ],
            ],
            [
                [
                    'keyOne' => 'snake_case',
                    'keyTwo' => [
                        'camelCase',
                        'key_in_snake_case' => [
                            'nestedKeyOne' => 'human case',
                            'nestedKeyTwo' => 'PascalCase,'
                        ]
                    ]
                ],
                [
                    'key-one' => 'snake_case',
                    'key-two' => [
                        'camelCase',
                        'key-in-snake-case' => [
                            'nested-key-one' => 'human case',
                            'nested-key-two' => 'PascalCase,'
                        ]
                    ]
                ],
            ]
        ];
    }

    /**
     * @dataProvider recursionKebabCaseDataProvider
     * @param int $depth
     * @param array $subject
     * @param array $expected
     */
    public function testArrayKeysRecursionDepthConversion($depth, $subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::array($subject)->keys()->depth($depth)->toKebab());
    }

    public function recursionKebabCaseDataProvider()
    {
        return [
            [
                0,
                [
                    42,
                    'keyOne' => 'snake_case',
                    'keyTwo' => [
                        43,
                        'camelCase',
                        'key_in_snake_case' => [
                            44,
                            'nestedKeyOne' => 'human case',
                            'nestedKeyTwo' => 'PascalCase,'
                        ]
                    ]
                ],
                [
                    42,
                    'key-one' => 'snake_case',
                    'key-two' => [
                        43,
                        'camelCase',
                        'key_in_snake_case' => [
                            44,
                            'nestedKeyOne' => 'human case',
                            'nestedKeyTwo' => 'PascalCase,'
                        ]
                    ]
                ],
            ],
            [
                1,
                [
                    42,
                    'keyOne' => 'snake_case',
                    'keyTwo' => [
                        43,
                        'camelCase',
                        'key_in_snake_case' => [
                            44,
                            'nestedKeyOne' => 'human case',
                            'nestedKeyTwo' => 'PascalCase,'
                        ]
                    ]
                ],
                [
                    42,
                    'key-one' => 'snake_case',
                    'key-two' => [
                        43,
                        'camelCase',
                        'key-in-snake-case' => [
                            44,
                            'nestedKeyOne' => 'human case',
                            'nestedKeyTwo' => 'PascalCase,'
                        ]
                    ]
                ],
            ],

            [
                2,
                [
                    42,
                    'keyOne' => 'snake_case',
                    'keyTwo' => [
                        43,
                        'camelCase',
                        'key_in_snake_case' => [
                            44,
                            'nestedKeyOne' => 'human case',
                            'nestedKeyTwo' => 'PascalCase,'
                        ]
                    ]
                ],
                [
                    42,
                    'key-one' => 'snake_case',
                    'key-two' => [
                        43,
                        'camelCase',
                        'key-in-snake-case' => [
                            44,
                            'nested-key-one' => 'human case',
                            'nested-key-two' => 'PascalCase,'
                        ]
                    ]
                ],
            ],

            [
                4,
                [
                    42,
                    'keyOne' => 'snake_case',
                    'keyTwo' => [
                        43,
                        'camelCase',
                        'key_in_snake_case' => [
                            44,
                            'nestedKeyOne' => 'human case',
                            'nestedKeyTwo' => 'PascalCase,'
                        ]
                    ]
                ],
                [
                    42,
                    'key-one' => 'snake_case',
                    'key-two' => [
                        43,
                        'camelCase',
                        'key-in-snake-case' => [
                            44,
                            'nested-key-one' => 'human case',
                            'nested-key-two' => 'PascalCase,'
                        ]
                    ]
                ],
            ]
        ];
    }
}
