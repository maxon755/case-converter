<?php

use CaseConverter\CaseConverter;
use PHPUnit\Framework\TestCase;

class ArrayBothCaseConverter extends TestCase
{
    /**
     * @dataProvider kebabCaseDataProvider
     * @param array $subject
     * @param array $expected
     */
    public function testArrayKeysToKebabConversion($subject, $expected)
    {
        $this->assertEquals($expected, CaseConverter::array($subject)->both()->toKebab());
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
                    'key-one' => 'snake-case',
                    'key-two' => [
                        'camel-case',
                        'key-in-snake-case' => [
                            'nested-key-one' => 'human-case',
                            'nested-key-two' => 'pascal-case,'
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
        $this->assertEquals($expected, CaseConverter::array($subject)->both()->depth($depth)->toKebab());
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
                    'key-one' => 'snake-case',
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
                    'key-one' => 'snake-case',
                    'key-two' => [
                        43,
                        'camel-case',
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
                    'key-one' => 'snake-case',
                    'key-two' => [
                        43,
                        'camel-case',
                        'key-in-snake-case' => [
                            44,
                            'nested-key-one' => 'human-case',
                            'nested-key-two' => 'pascal-case,'
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
                    'key-one' => 'snake-case',
                    'key-two' => [
                        43,
                        'camel-case',
                        'key-in-snake-case' => [
                            44,
                            'nested-key-one' => 'human-case',
                            'nested-key-two' => 'pascal-case,'
                        ]
                    ]
                ],
            ]
        ];
    }
}
