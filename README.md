## CaseConverter

### Package for advanced case conversion

It allows to convert arbitrary strings to specific cases.

Supported cases:
- camelCase
- PascalCase
- kebab-case
- snake_case
- human case

#### Usage:

#### String conversion:

```php
    CaseConverter::string('some String')->toCamel();    //'someString'
    
    CaseConverter::string('some String')->toPascal();   //'SomeString'
    
    CaseConverter::string('some String')->toKebab();    //'some-string'
    
    CaseConverter::string('some String')->toSnake();    //'some_string'
    
    CaseConverter::string('some String')->toHuman();    //'some string'
```

#### Array conversion:
Also arrays can be converted:

```php
    CaseConverter::array([
        'not_converted_key' => 'converted_value'
    ])->toCamel(); 


    // return: [
    //    'not_converted_key' => 'convertedValue'
    // ]
```

By default only array values will be converted. You can specify it explicitly, using `values()` method:

```php
    CaseConverter::array($someArray)->values()->toCamel();
```

Or you can convert only keys of array:

```php
    CaseConverter::array($someArray)->keys()->toCamel();
```

Or both keys and values:

```php
    CaseConverter::array($someArray)->both()->toCamel();
```

#### Nested array conversion:
If given array is nested CaseConverter will recursively convert it's items.

You can limit depth of recursion using `depth(int $depth)` method:

note: recursion level count starts from 0.

```php
    $someArray = [
        'zero level array',
        [
            'first level array'
        ]
    ];
        

    CaseConverter::array($someArray)->values()->depth(0)->toCamel();

    // return:
    // [
    //     'zeroLevelArray', // converted
    //     [
    //         'first level array' // not converted
    //     ]
    // ]
```

#### Custom converters:
If supported functionality is not enough for your need you can define your
own converter and pass it to `withConverter()` method. 

1. Callable

You can pass you converter as callable, that takes string as argument
and return modified string:
  
```php
    CaseConverter::string('1-2-3-4')->withConverter(function ($string) {
        return str_replace('-', '*', $string);
    }); //'1*2*3*4'
```
    
2. Converter class

You can create your own class, that will 
implement `CaseConverter\Interfaces\Converter` interface
and pass instance of this object to `withConverter()` method.

```php
    class AsteriskConverter implements Converter
    {
        public function convert($string)
        {
            return str_replace('-', '*', $string);
        }
    }
    
    CaseConverter::string('1-2-3-4')
        ->withConverter(new AsteriskConverter()); //'1*2*3*4'
```
