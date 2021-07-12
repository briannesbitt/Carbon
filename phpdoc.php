<?php

$tags = [
    'property',
    'property-read',
    PHP_EOL,
    'mode',
    ['call', 'is'],
    ['call', 'isDayOfWeek'],
    ['call', 'isSameUnit'],
    ['call', 'setUnit'],
    ['call', 'addUnit'],
    ['call', 'addRealUnit'],
    ['call', 'roundUnit'],
    ['call', 'diffForHumans'],
];
$nativeMethods = [
    'getOffset' => 'int',
    'getTimestamp' => 'int',
];
$modes = [];
$autoDocLines = [];
$carbon = __DIR__.'/src/Carbon/Carbon.php';
$immutable = __DIR__.'/src/Carbon/CarbonImmutable.php';
$interface = __DIR__.'/src/Carbon/CarbonInterface.php';
$phpLevel = 7.1;
file_put_contents($interface, preg_replace('/(\/\/ <methods[\s\S]*>)([\s\S]+)(<\/methods>)/mU', "$1\n\n    // $3", file_get_contents($interface), 1));
require_once __DIR__.'/vendor/autoload.php';
$trait = __DIR__.'/src/Carbon/Traits/Date.php';
$code = '';
$overrideTyping = [
    $carbon => [
        // 'createFromImmutable' => ['static Carbon', 'DateTimeImmutable $dateTime', 'Create a new Carbon object from an immutable date.'],
        'createFromFormat' => ['static Carbon|false', 'string $format, string $time, string|DateTimeZone $timezone = null', 'Parse a string into a new Carbon object according to the specified format.'],
        '__set_state' => ['static Carbon', 'array $array', 'https://php.net/manual/en/datetime.set-state.php'],
    ],
    $immutable => [
        // 'createFromMutable' => ['static CarbonImmutable', 'DateTime $dateTime', 'Create a new CarbonImmutable object from an immutable date.'],
        'createFromFormat' => ['static CarbonImmutable|false', 'string $format, string $time, string|DateTimeZone $timezone = null', 'Parse a string into a new CarbonImmutable object according to the specified format.'],
        '__set_state' => ['static CarbonImmutable', 'array $array', 'https://php.net/manual/en/datetime.set-state.php'],
    ],
];

foreach (glob(__DIR__.'/src/Carbon/Traits/*.php') as $file) {
    $code .= file_get_contents($file);
}

function unitName($unit)
{
    switch ($unit) {
        case 'milli':
            return 'millisecond';
        case 'micro':
            return 'microsecond';
        default:
            return $unit;
    }
}

function pluralize($word)
{
    if (preg_match('/(millenni)um$/i', $word)) {
        return preg_replace('/(millenni)um$/i', '$1a', $word);
    }

    return preg_replace('/(centur)y$/i', '$1ie', $word).'s';
}

function dumpValue($value)
{
    if ($value === null) {
        return 'null';
    }

    if ($value === \Carbon\CarbonInterface::TRANSLATE_ALL) {
        return 'CarbonInterface::TRANSLATE_ALL';
    }

    $value = preg_replace('/^array\s*\(\s*\)$/', '[]', var_export($value, true));
    $value = preg_replace('/^array\s*\(([\s\S]+)\)$/', '[$1]', $value);

    return $value;
}

function cleanClassName($name)
{
    if (preg_match('/^[A-Z]/', $name)) {
        $name = "\\$name";
    }

    return preg_replace('/^\\\\(Date(?:Time(?:Immutable|Interface|Zone)?|Interval)|[A-Za-z]*Exception|Closure)$/i', '$1', preg_replace('/^\\\\Carbon\\\\/', '', $name));
}

function dumpParameter($method, ReflectionParameter $parameter)
{
    global $defaultValues;

    $name = $parameter->getName();
    $output = '$'.$name;

    if ($parameter->isVariadic()) {
        $output = "...$output";
    }

    if ($parameter->getType()) {
        $name = cleanClassName($parameter->getType()->getName());

        if ($parameter->allowsNull()) {
            $name = "?$name";
        }

        $output = "$name $output";
    }

    if (isset($defaultValues[$method])) {
        if (isset($defaultValues[$method][$name])) {
            $output .= ' = '.dumpValue($defaultValues[$method][$name]);
        }

        return $output;
    }

    try {
        if ($parameter->isDefaultValueAvailable()) {
            $output .= ' = '.dumpValue($parameter->getDefaultValue());
        }
    } catch (ReflectionException $exp) {
    }

    return $output;
}

foreach ($tags as $tag) {
    if (\is_array($tag)) {
        [$tag, $pattern] = $tag;
    }

    $pattern = isset($pattern) ? $pattern : '\S+';

    if ($tag === PHP_EOL) {
        $autoDocLines[] = '';

        continue;
    }

    preg_match_all('/\/\/ @'.$tag.'\s+(?<type>'.$pattern.')(?:\s+\$(?<name>\S+)(?:[^\S\n](?<description>.*))?\n|(?:[^\S\n](?<description2>.*))?\n[^\']*\'(?<name2>[^\']+)\')/', $code, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $vars = (object) $match;
        $vars->name = $vars->name ?: $vars->name2;
        $vars->description = $vars->description ?: $vars->description2;

        if ($tag === 'mode') {
            if (!isset($modes[$vars->type])) {
                $modes[$vars->type] = [];
            }

            $modes[$vars->type][] = $vars->name;

            continue;
        }

        if ($tag === 'call') {
            switch ($vars->type) {
                case 'diffForHumans':
                    foreach ($modes[$vars->type] as $mode) {
                        $autoDocLines[] = [
                            '@method',
                            'string',
                            "$mode{$vars->name}DiffForHumans(DateTimeInterface \$other = null, int \$parts = 1)",
                            "Get the difference ($mode format, '{$vars->name}' mode) in a human readable format in the current locale. (\$other and \$parts parameters can be swapped.)",
                        ];
                    }

                    break;

                case 'isDayOfWeek':
                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'is'.ucFirst($vars->name).'()',
                        'Checks if the instance day is '.unitName(strtolower($vars->name)).'.',
                    ];

                    break;

                case 'is':
                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'is'.ucFirst($vars->name).'()',
                        $vars->description,
                    ];

                    break;

                case 'isSameUnit':
                    $unit = $vars->name;
                    $unitName = unitName($unit);
                    $method = 'isSame'.ucFirst($unit);

                    if (!method_exists(\Carbon\Carbon::class, $method)) {
                        $autoDocLines[] = [
                            '@method',
                            'bool',
                            $method.'(Carbon|DateTimeInterface|string|null $date = null)',
                            "Checks if the given date is in the same $unitName as the instance. If null passed, compare to now (with the same timezone).",
                        ];
                    }

                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'isCurrent'.ucFirst($unit).'()',
                        "Checks if the instance is in the same $unitName as the current moment.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'isNext'.ucFirst($unit).'()',
                        "Checks if the instance is in the same $unitName as the current moment next $unitName.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'isLast'.ucFirst($unit).'()',
                        "Checks if the instance is in the same $unitName as the current moment last $unitName.",
                    ];

                    break;

                case 'setUnit':
                    $unit = $vars->name;
                    $unitName = unitName($unit);
                    $plUnit = pluralize($unit);
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        "$plUnit(int \$value)",
                        "Set current instance $unitName to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        "$unit(int \$value)",
                        "Set current instance $unitName to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'set'.ucfirst($plUnit).'(int $value)',
                        "Set current instance $unitName to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'set'.ucfirst($unit).'(int $value)',
                        "Set current instance $unitName to the given value.",
                    ];

                    break;

                case 'addUnit':
                    $unit = $vars->name;
                    $unitName = unitName($unit);
                    $plUnit = pluralize($unit);
                    $plUnitName = pluralize($unitName);
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'add'.ucFirst($plUnit).'(int $value = 1)',
                        "Add $plUnitName (the \$value count passed in) to the instance (using date interval).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'add'.ucFirst($unit).'()',
                        "Add one $unitName to the instance (using date interval).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'sub'.ucFirst($plUnit).'(int $value = 1)',
                        "Sub $plUnitName (the \$value count passed in) to the instance (using date interval).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'sub'.ucFirst($unit).'()',
                        "Sub one $unitName to the instance (using date interval).",
                    ];

                    if (\in_array($unit, [
                        'month',
                        'quarter',
                        'year',
                        'decade',
                        'century',
                        'millennium',
                    ])) {
                        $autoDocLines[] = [
                            '@method',
                            'self',
                            'add'.ucFirst($plUnit).'WithOverflow(int $value = 1)',
                            "Add $plUnitName (the \$value count passed in) to the instance (using date interval) with overflow explicitly allowed.",
                        ];
                        $autoDocLines[] = [
                            '@method',
                            'self',
                            'add'.ucFirst($unit).'WithOverflow()',
                            "Add one $unitName to the instance (using date interval) with overflow explicitly allowed.",
                        ];
                        $autoDocLines[] = [
                            '@method',
                            'self',
                            'sub'.ucFirst($plUnit).'WithOverflow(int $value = 1)',
                            "Sub $plUnitName (the \$value count passed in) to the instance (using date interval) with overflow explicitly allowed.",
                        ];
                        $autoDocLines[] = [
                            '@method',
                            'self',
                            'sub'.ucFirst($unit).'WithOverflow()',
                            "Sub one $unitName to the instance (using date interval) with overflow explicitly allowed.",
                        ];

                        foreach (['WithoutOverflow', 'WithNoOverflow', 'NoOverflow'] as $alias) {
                            $autoDocLines[] = [
                                '@method',
                                'self',
                                'add'.ucFirst($plUnit)."$alias(int \$value = 1)",
                                "Add $plUnitName (the \$value count passed in) to the instance (using date interval) with overflow explicitly forbidden.",
                            ];
                            $autoDocLines[] = [
                                '@method',
                                'self',
                                'add'.ucFirst($unit)."$alias()",
                                "Add one $unitName to the instance (using date interval) with overflow explicitly forbidden.",
                            ];
                            $autoDocLines[] = [
                                '@method',
                                'self',
                                'sub'.ucFirst($plUnit)."$alias(int \$value = 1)",
                                "Sub $plUnitName (the \$value count passed in) to the instance (using date interval) with overflow explicitly forbidden.",
                            ];
                            $autoDocLines[] = [
                                '@method',
                                'self',
                                'sub'.ucFirst($unit)."$alias()",
                                "Sub one $unitName to the instance (using date interval) with overflow explicitly forbidden.",
                            ];
                        }

                        break;
                    }

                    break;

                case 'addRealUnit':
                    $unit = $vars->name;
                    $unitName = unitName($unit);
                    $plUnit = pluralize($unit);
                    $plUnitName = pluralize($unitName);
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'addReal'.ucFirst($plUnit).'(int $value = 1)',
                        "Add $plUnitName (the \$value count passed in) to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'addReal'.ucFirst($unit).'()',
                        "Add one $unitName to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'subReal'.ucFirst($plUnit).'(int $value = 1)',
                        "Sub $plUnitName (the \$value count passed in) to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'subReal'.ucFirst($unit).'()',
                        "Sub one $unitName to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'CarbonPeriod',
                        $plUnit.'Until($endDate = null, int $factor = 1)',
                        "Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each $unitName or every X $plUnitName if a factor is given.",
                    ];

                    break;

                case 'roundUnit':
                    $unit = $vars->name;
                    $unitName = unitName($unit);
                    $plUnit = pluralize($unit);
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'round'.ucFirst($unit).'(float $precision = 1, string $function = "round")',
                        "Round the current instance $unitName with given precision using the given function.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'round'.ucFirst($plUnit).'(float $precision = 1, string $function = "round")',
                        "Round the current instance $unitName with given precision using the given function.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'floor'.ucFirst($unit).'(float $precision = 1)',
                        "Truncate the current instance $unitName with given precision.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'floor'.ucFirst($plUnit).'(float $precision = 1)',
                        "Truncate the current instance $unitName with given precision.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'ceil'.ucFirst($unit).'(float $precision = 1)',
                        "Ceil the current instance $unitName with given precision.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'ceil'.ucFirst($plUnit).'(float $precision = 1)',
                        "Ceil the current instance $unitName with given precision.",
                    ];

                    break;
            }

            continue;
        }

        $description = trim($vars->description);
        $variable = $vars->name;
        if (str_starts_with($description, '$')) {
            [$variable, $description] = explode(' ', $description, 2);
            $variable = ltrim($variable, '$');
            $description = ltrim($description);
        }
        $autoDocLines[] = [
            '@'.$tag,
            $vars->type,
            '$'.$variable,
            $description ?: '',
        ];
    }
}

function compileDoc($autoDocLines, $file)
{
    $class = 'CarbonInterface';

    if (preg_match('`[\\\\/](Carbon\w*)\.php$`', $file, $match)) {
        $class = $match[1];
    }

    $autoDoc = '';
    $columnsMaxLengths = [];
    foreach ($autoDocLines as &$editableLine) {
        if (\is_array($editableLine)) {
            if (($editableLine[1] ?? '') === 'self') {
                $editableLine[1] = $class === 'Carbon' ? '$this' : $class;
            }

            foreach ($editableLine as $column => $text) {
                $length = \strlen($text);
                $max = $columnsMaxLengths[$column] ?? 0;

                if ($length > $max) {
                    $columnsMaxLengths[$column] = $length;
                }
            }
        }
    }

    foreach ($autoDocLines as $line) {
        $autoDoc .= "\n *";
        if (\is_string($line)) {
            if (!empty($line)) {
                $autoDoc .= " $line";
            }

            continue;
        }

        $computedLine = ' ';
        foreach ($line as $column => $text) {
            $computedLine .= str_pad($text, $columnsMaxLengths[$column] + 1, ' ', STR_PAD_RIGHT);
        }

        $autoDoc .= rtrim($computedLine);
    }

    return $autoDoc;
}

$files = new stdClass();

foreach ([$trait, $carbon, $immutable, $interface] as $file) {
    $content = file_get_contents($file);
    $files->$file = preg_replace_callback('/(<autodoc[\s\S]*>)([\s\S]+)(<\/autodoc>)/mU', function ($matches) use ($file, $autoDocLines, $overrideTyping) {
        foreach (($overrideTyping[$file] ?? []) as $method => $line) {
            $line[1] = $method.'('.$line[1].')';
            array_unshift($line, '@method');
            $autoDocLines[] = $line;
        }

        $autoDoc = compileDoc($autoDocLines, $file);

        return $matches[1]."\n *$autoDoc\n *\n * ".$matches[3];
    }, $content, 1);
}

$staticMethods = [];
$staticImmutableMethods = [];
$methods = '';
$carbonMethods = get_class_methods(\Carbon\Carbon::class);
sort($carbonMethods);
foreach ($carbonMethods as $method) {
    if (!method_exists(\Carbon\CarbonImmutable::class, $method) ||
        method_exists(DateTimeInterface::class, $method) ||
        $method === 'createFromInterface'
    ) {
        continue;
    }

    $function = new ReflectionMethod(\Carbon\Carbon::class, $method);
    $static = $function->isStatic() ? ' static' : '';
    $parameters = implode(', ', array_map(function (ReflectionParameter $parameter) use ($method) {
        return dumpParameter($method, $parameter);
    }, $function->getParameters()));
    $methodDocBlock = $function->getDocComment() ?: '';

    if (str_starts_with($method, '__') && $function->isStatic()) {
        $doc = preg_replace('/^\/\*+\n([\s\S]+)\s*\*\//', '$1', $methodDocBlock);
        $doc = preg_replace('/^\s*\*\s?/m', '', $doc);
        $doc = explode("\n@", $doc, 2);
        $doc = preg_split('/(\r\n|\r|\n)/', trim($doc[0]));
        $returnType = $function->getReturnType();

        if ($returnType instanceof ReflectionNamedType) {
            $returnType = $returnType->getName();
        }

        if (!$returnType && preg_match('/\*\s*@returns?\s+(\S+)/', $methodDocBlock, $match)) {
            $returnType = $match[1];
        }

        $returnType = str_replace('static|CarbonInterface', 'static', $returnType ?: 'static');
        $staticMethods[] = [
            '@method',
            str_replace('static', 'Carbon', $returnType),
            "$method($parameters)",
            $doc[0],
        ];
        $staticImmutableMethods[] = [
            '@method',
            str_replace('static', 'CarbonImmutable', $returnType),
            "$method($parameters)",
            $doc[0],
        ];

        for ($i = 1; $i < \count($doc); $i++) {
            $staticMethods[] = ['', '', '', $doc[$i]];
            $staticImmutableMethods[] = ['', '', '', $doc[$i]];
        }
    }

    $return = $function->getReturnType() ? ': '.$function->getReturnType()->getName() : '';

    if (!empty($methodDocBlock)) {
        $methodDocBlock = "\n    $methodDocBlock";
    } elseif (isset($nativeMethods[$method])) {
        $link = strtolower($method);
        $methodDocBlock = "\n    /**\n".
            "     * Calls DateTime::$method if mutable or DateTimeImmutable::$method else.\n".
            "     *\n".
            "     * @see https://php.net/manual/en/datetime.$link.php\n".
            '     */';
    }

    if (str_contains($return, 'self') && $phpLevel < 7.4) {
        $return = '';
    }

    if ($method === '__toString' && $phpLevel < 8) {
        $return = '';
    }

    if (method_exists($function, 'getAttributes') && ($attributes = $function->getAttributes())) {
        foreach ($attributes as $attribute) {
            $methodDocBlock .= "\n    #[".$attribute->getName().']';
        }
    }

    $methods .= "\n$methodDocBlock\n    public$static function $method($parameters)$return;";
}

$files->$interface = strtr(preg_replace_callback('/(\/\/ <methods[\s\S]*>)([\s\S]+)(<\/methods>)/mU', function ($matches) use ($methods) {
    return $matches[1]."$methods\n\n    // ".$matches[3];
}, $files->$interface, 1), [
    'CarbonInterface::TRANSLATE_ALL' => 'self::TRANSLATE_ALL',
]);

$factories = [
    __DIR__.'/src/Carbon/Factory.php' => $staticMethods,
    __DIR__.'/src/Carbon/FactoryImmutable.php' => $staticImmutableMethods,
];

foreach ($factories as $file => $methods) {
    $autoDoc = compileDoc($methods, $file);
    $content = file_get_contents($file);
    $files->$file = preg_replace_callback('/(<autodoc[\s\S]*>)([\s\S]+)(<\/autodoc>)/mU', function ($matches) use ($file, $autoDoc) {
        return $matches[1]."\n *$autoDoc\n *\n * ".$matches[3];
    }, $content, 1);
}

foreach ($files as $file => $contents) {
    file_put_contents($file, $contents);
}
