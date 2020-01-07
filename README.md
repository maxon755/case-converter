### CaseConverter

##### Package for advanced case conversion

It allows to convert arbitrary strings to specific cases.

Supported cases:
- camelCase
- PascalCase
- kebab-case
- snake_case
- human case

####Usage:

##### String conversion:

    CaseConverter::string('some String')->toCamel();    //'someString'
    
    CaseConverter::string('some String')->toPascal();   //'SomeString'
    
    CaseConverter::string('some String')->toKebab();    //'some-string'
    
    CaseConverter::string('some String')->toSnake();    //'some_string'
    
    CaseConverter::string('some String')->toHuman();    //'some string'


##### Array conversion:
Also arrays can be converted:

    CaseConverter::array([
        'not_converted_key' => 'converted_value'
    ])->toCamel(); 

    will return: [
       'not_converted_key' => 'convertedValue'
    ]

By default only array values will be converted.
You can specify in explicitly, using values() method:

    CaseConverter::array($someArray)->values()->toCamel();
        
Or you can convert only keys of array:

    CaseConverter::array($someArray)->keys()->toCamel();
    
Or both keys and values:

    CaseConverter::array($someArray)->both()->toCamel();
    
##### Multidimensional Array conversion:
If given array is nested CaseConverter will recursively convert it`s items.

You can limit depth of recursion using depth() method:
(recursion levels start count from 0)

    $someArray = [
        'zero level array',
        [
            'first level array'
        ]
    ];
        

    CaseConverter::array($someArray)->values()->depth(0)->toCamel();

    will return:
    [
        'zeroLevelArray', // converted
        [
            'first level array' // not converted
        ]
    ]

##### Custom converters:
If supported case converters is not enough for your need you can define your
own using withConverter() method. 

1. Callable

You can pass you converter as callable, that takes string as argument
and return modified string:
    
    CaseConverter::string('1-2-3-4')->withConverter(function ($string) {
        return str_replace('-', '*', $string);
    }); //'1*2*3*4'
    
2. Converter class

You can create your own class, that will 
implement CaseConverter\Interfaces\Converter interface
and pass instance of this object to withConverter() method.

    class AsteriskConverter implements Converter
    {
        public function convert($string)
        {
            return str_replace('-', '*', $string);
        }
    }
    
    CaseConverter::string('1-2-3-4')
        ->withConverter(new AsteriskConverter()); //'1*2*3*4'
    
