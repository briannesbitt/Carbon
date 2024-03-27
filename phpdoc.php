<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\Factory;
use Carbon\FactoryImmutable;

$tags = [
    'property',
    'property-read',
    'property-write',
    PHP_EOL,
    'mode',
    ['call', 'is'],
    ['call', 'isDayOfWeek'],
    ['call', 'isSameUnit'],
    ['call', 'setUnit'],
    ['call', 'addUnit'],
    ['call', 'addUTCUnit'],
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
        // 'createFromFormat' => ['static static', 'string $format, string $time, DateTimeZone|string|false|null $timezone = null', 'Parse a string into a new Carbon object according to the specified format.'],
        // '__set_state' => ['static static', 'array $array', 'https://php.net/manual/en/datetime.set-state.php'],
    ],
    $immutable => [
        // 'createFromMutable' => ['static CarbonImmutable', 'DateTime $dateTime', 'Create a new CarbonImmutable object from an immutable date.'],
        // 'createFromFormat' => ['static static', 'string $format, string $time, DateTimeZone|string|false|null $timezone = null', 'Parse a string into a new CarbonImmutable object according to the specified format.'],
        // '__set_state' => ['static static', 'array $array', 'https://php.net/manual/en/datetime.set-state.php'],
    ],
];

foreach (glob(__DIR__.'/src/Carbon/Traits/*.php') as $file) {
    $code .= file_get_contents($file);
}

function unitName($unit)
{
    return match ($unit) {
        'milli' => 'millisecond',
        'micro' => 'microsecond',
        default => $unit,
    };
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

    if ($value === CarbonInterface::TRANSLATE_ALL) {
        return 'CarbonInterface::TRANSLATE_ALL';
    }

    $value = preg_replace('/^array\s*\(\s*\)$/', '[]', var_export($value, true));
    $value = preg_replace('/^array\s*\(([\s\S]+)\)$/', '[$1]', $value);

    return $value;
}

function cleanClassName($name)
{
    if ($name === 'CarbonInterval') {
        throw new \Exception('stop');
    }

    if (preg_match('/^[A-Z]/', $name)) {
        $name = "\\$name";
    }

    if ($name === '\\Symfony\\Contracts\\Translation\\TranslatorInterface') {
        return 'TranslatorInterface';
    }

    return preg_replace('/^\\\\(Date(?:Time(?:Immutable|Interface|Zone)?|Interval)|[a-z]*Exception|Closure)$/i', '$1', preg_replace('/^\\\\Carbon\\\\/', '', $name));
}

function dumpType(ReflectionType $type, bool $deep = true, bool $allowsNull = false): string
{
    if ($type instanceof ReflectionUnionType) {
        return ($deep ? '(' : '').implode('|', array_map(
            dumpType(...),
            $type->getTypes(),
        )).($deep ? ')' : '');
    }

    if ($type instanceof ReflectionIntersectionType) {
        return ($deep ? '(' : '').implode('&', array_map(
            dumpType(...),
            $type->getTypes(),
        )).($deep ? ')' : '');
    }

    $name = cleanClassName($type instanceof ReflectionNamedType ? $type->getName() : (string) $type);
    $nullable = $allowsNull && $name !== 'mixed';

    return (!$deep && $nullable ? '?' : '').
        $name.
        ($deep && $nullable ? '|null' : '');
}

function dumpParameter(string $method, ReflectionParameter $parameter): string
{
    global $defaultValues;

    $name = $parameter->getName();
    $output = '$'.$name;

    if ($parameter->isVariadic()) {
        $output = "...$output";
    }

    if ($parameter->hasType()) {
        $output = dumpType($parameter->getType(), false, $parameter->allowsNull())." $output";
    }

    if (isset($defaultValues[$method])) {
        if (isset($defaultValues[$method][$name])) {
            $output .= ' = '.dumpValue($defaultValues[$method][$name]);
        }

        return $output;
    }

    if ($parameter->isDefaultValueAvailable()) {
        $output .= ' = '.dumpValue($parameter->getDefaultValue());
    }

    return $output;
}

$deprecated = [];

foreach ($tags as $tag) {
    if (\is_array($tag)) {
        [$tag, $pattern] = $tag;
    }

    $pattern ??= '\S+';

    if ($tag === PHP_EOL) {
        $autoDocLines[] = '';

        continue;
    }

    $unitOfUnit = [];
    preg_match_all('/\/\/ @'.$tag.'\s+(?<type>'.$pattern.')(?:\s+\$(?<name>\S+)(?:[^\S\n](?<description>.*))?\n|(?:[^\S\n](?<description2>.*))?\n(?<comments>(?:[ \t]+\/\/[^\n]*\n)*)[^\']*\'(?<name2>[^\']+)\')/', $code, $oneLine, PREG_SET_ORDER);
    preg_match_all('/\/\* *@'.$tag.'\s+(?<type>'.$pattern.') *\*\/[^\']*\'(?<name2>[^\']+)\'/', $code, $multiLine, PREG_SET_ORDER);

    foreach ([...$oneLine, ...$multiLine] as $match) {
        $vars = (object) $match;
        $deprecation = null;

        if (isset($vars->comments) && preg_match(
            '`^[ \t]+(//|/*|#)[ \t]*@deprecated(?:\s(?<deprecation>[\s\S]*))?$`',
            $vars->comments,
            $comments
        )) {
            ['deprecation' => $deprecation] = $comments;
            $deprecation = preg_replace('/^\s*(\/\/|#|\*) {0,3}/m', '', trim($deprecation));

            if (preg_match('/^(?:[a-z]+:[^\n]+\n)+$/', "$deprecation\n")) {
                $data = [];

                foreach (explode("\n", $deprecation) as $line) {
                    [$name, $value] = array_map('trim', explode(':', $line, 2));

                    $data[$name] = $value;
                }

                $deprecation = $data;
            } else {
                $deprecation = ['reason' => $deprecation];
            }
        }

        $vars->name = ($vars->name ?? null) ?: ($vars->name2 ?? '');
        $vars->description = ($vars->description ?? null) ?: ($vars->description2 ?? '');

        if ($tag === 'mode') {
            $modes[$vars->type] ??= [];
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

                    if (!method_exists(Carbon::class, $method)) {
                        $autoDocLines[] = [
                            '@method',
                            'bool',
                            $method.'(DateTimeInterface|string $date)',
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
                    $enums = $unitName === 'month' ? 'Month|' : '';
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        "$plUnit({$enums}int \$value)",
                        "Set current instance $unitName to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        "$unit({$enums}int \$value)",
                        "Set current instance $unitName to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'set'.ucfirst($plUnit)."({$enums}int \$value)",
                        "Set current instance $unitName to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'set'.ucfirst($unit)."({$enums}int \$value)",
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
                        'add'.ucFirst($plUnit).'(int|float $value = 1)',
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
                        'sub'.ucFirst($plUnit).'(int|float $value = 1)',
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
                            'add'.ucFirst($plUnit).'WithOverflow(int|float $value = 1)',
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
                            'sub'.ucFirst($plUnit).'WithOverflow(int|float $value = 1)',
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
                                'add'.ucFirst($plUnit)."$alias(int|float \$value = 1)",
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
                                'sub'.ucFirst($plUnit)."$alias(int|float \$value = 1)",
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

                case 'addUTCUnit':
                    $unit = $vars->name;
                    $unitName = unitName($unit);
                    $plUnit = pluralize($unit);
                    $plUnitName = pluralize($unitName);
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'addUTC'.ucFirst($plUnit).'(int|float $value = 1)',
                        "Add $plUnitName (the \$value count passed in) to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'addUTC'.ucFirst($unit).'()',
                        "Add one $unitName to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'subUTC'.ucFirst($plUnit).'(int|float $value = 1)',
                        "Sub $plUnitName (the \$value count passed in) to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'self',
                        'subUTC'.ucFirst($unit).'()',
                        "Sub one $unitName to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'CarbonPeriod',
                        $plUnit.'Until($endDate = null, int|float $factor = 1)',
                        "Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each $unitName or every X $plUnitName if a factor is given.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'float',
                        'diffInUTC'.ucFirst($plUnit).'(DateTimeInterface|string|null $date, bool $absolute = false)',
                        "Convert current and given date in UTC timezone and return a floating number of $plUnitName.",
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

        if ($deprecation !== null) {
            $deprecated[$tag] = $deprecated[$tag] ?? [];
            $deprecated[$tag][] = [
                'deprecation' => $deprecation,
                'type' => $vars->type,
                'variable' => $variable,
                'description' => $description ?: '',
            ];

            continue;
        }

        if (
            \in_array($tag, ['property', 'property-read'], true) &&
            preg_match('/^[a-z]{2,}(?<operator>In|Of)[A-Z][a-z]+$/', $vars->name, $match)
        ) {
            $unitOfUnit[$vars->name] = [
                '@'.($match['operator'] === 'Of' ? 'property' : 'property-read'),
                $vars->type,
                '$'.$variable,
                $description ?: '',
            ];

            continue;
        }

        $autoDocLines[] = [
            '@'.$tag,
            $vars->type,
            '$'.$variable,
            $description ?: '',
        ];
    }

    if ($tag === 'property') {
        $units = ['microseconds', 'milliseconds', 'seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'quarters', 'years', 'decades', 'centuries', 'millennia'];

        foreach ($units as $small) {
            array_shift($units);

            foreach ($units as $big) {
                $singularSmall = Carbon::singularUnit($small);
                $singularBig = Carbon::singularUnit($big);
                $name = $singularSmall.'Of'.ucfirst($singularBig);
                $unitOfUnit[$name] ??= [
                    '@property',
                    'int',
                    '$'.$name,
                    'The value of the '.$singularSmall.' starting from the beginning of the current '.$singularBig,
                ];
            }
        }

        ksort($unitOfUnit);

        array_push($autoDocLines, ...array_values($unitOfUnit));
    }

    if ($tag === 'property-read') {
        $units = ['microseconds', 'milliseconds', 'seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'quarters', 'years', 'decades', 'centuries', 'millennia'];

        foreach ($units as $small) {
            array_shift($units);

            foreach ($units as $big) {
                $singularSmall = Carbon::singularUnit($small);
                $singularBig = Carbon::singularUnit($big);
                $name = $small.'In'.ucfirst($singularBig);
                $unitOfUnit[$name] ??= [
                    '@property-read',
                    'int',
                    '$'.$name,
                    'The number of '.$small.' contained in the current '.$singularBig,
                ];
            }
        }

        ksort($unitOfUnit);

        array_push($autoDocLines, ...array_values($unitOfUnit));
    }
}

$units = ['microseconds', 'milliseconds', 'seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'quarters', 'years', 'decades', 'centuries', 'millennia'];
$unitOfUnit = [
    'dayOfYear' => false,
    'weeksInYear' => false,
];

foreach ($units as $small) {
    array_shift($units);

    foreach ($units as $big) {
        $singularSmall = Carbon::singularUnit($small);
        $singularBig = Carbon::singularUnit($big);
        $name = $singularSmall.'Of'.ucfirst($singularBig);
        $unitOfUnit[$name] ??= [
            '@method',
            'int|static',
            $name.'(?int $'.$singularSmall.' = null)',
            'Return the value of the '.$singularSmall.' starting from the beginning of the current '.$singularBig.' when called with no parameters, change the current '.$singularSmall.' when called with an integer value',
        ];
        $name = $small.'In'.ucfirst($singularBig);
        $unitOfUnit[$name] ??= [
            '@method',
            'int',
            $name.'()',
            'Return the number of '.$small.' contained in the current '.$singularBig,
        ];
    }
}

ksort($unitOfUnit);

array_push($autoDocLines, ...array_values(array_filter($unitOfUnit)));

$propertyTemplate = '
    /**
     * %description%
     *
     * @var %type%
     *
     * @deprecated %line1%
     *             %line2%
     */
    public $%variable%;
';

$lineGlue = preg_replace('/^[\s\S]*%line1%([\s\S]*)%line2%[\s\S]*$/', '$1', $propertyTemplate);
$propertyTemplate = preg_replace('/(%line1%[\s\S]*%line2%)/', '%deprecation%', $propertyTemplate);

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
$carbonMethods = get_class_methods(Carbon::class);
sort($carbonMethods);

function getMethodReturnType(ReflectionMethod $method): string
{
    $type = $method->getReturnType();
    $type = $type ? dumpType($type, false, $type->allowsNull()) : null;

    return $type ? ': '.$type : '';
}

foreach ($carbonMethods as $method) {
    if (!method_exists(CarbonImmutable::class, $method) ||
        method_exists(DateTimeInterface::class, $method) ||
        \in_array($method, ['diff', 'createFromInterface'], true)
    ) {
        continue;
    }

    $function = new ReflectionMethod(Carbon::class, $method);
    $static = $function->isStatic() ? ' static' : '';
    $parameters = implode(', ', array_map(function (ReflectionParameter $parameter) use ($method) {
        return dumpParameter($method, $parameter);
    }, $function->getParameters()));
    $methodDocBlock = $function->getDocComment() ?: '';

    if (!str_starts_with($method, '__') && $function->isStatic()) {
        $doc = preg_replace('/^\/\*+\n([\s\S]+)\s*\*\//', '$1', $methodDocBlock);
        $doc = preg_replace('/^\s*\*\s?/m', '', $doc);
        $doc = explode("\n@", $doc, 2);
        $doc = preg_split('/(\r\n|\r|\n)/', trim($doc[0]));
        $returnType = $function->getReturnType();

        if ($returnType instanceof ReflectionType) {
            $returnType = dumpType($returnType, false, $returnType->allowsNull());
        }

        if (!$returnType && preg_match('/\*\s*@returns?\s+(\S+)/', $methodDocBlock, $match)) {
            $returnType = $match[1];
        }

        $returnType = str_replace('static|CarbonInterface', 'static', $returnType ?: 'static');
        if (!method_exists(Factory::class, $method)) {
            $staticMethods[] = [
                '@method',
                str_replace(['self', 'static'], 'Carbon', $returnType),
                "$method($parameters)",
                $doc[0],
            ];

            for ($i = 1; $i < \count($doc); $i++) {
                $staticMethods[] = ['', '', '', $doc[$i]];
            }
        }

        if (!method_exists(FactoryImmutable::class, $method)) {
            $staticImmutableMethods[] = [
                '@method',
                str_replace(['self', 'static'], 'CarbonImmutable', $returnType),
                "$method($parameters)",
                $doc[0],
            ];

            for ($i = 1; $i < \count($doc); $i++) {
                $staticImmutableMethods[] = ['', '', '', $doc[$i]];
            }
        }
    }

    $return = getMethodReturnType($function);

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

$files->$interface = strtr(preg_replace_callback(
    '/(\/\/ <methods[\s\S]*>)([\s\S]+)(<\/methods>)/mU',
    static fn ($matches) => "{$matches[1]}$methods\n\n    // {$matches[3]}",
    $files->$interface,
    1,
), [
    '|CarbonInterface' => '|self',
    'CarbonInterface::TRANSLATE_ALL' => 'self::TRANSLATE_ALL',
]);

$factories = [
    __DIR__.'/src/Carbon/Factory.php' => $staticMethods,
    __DIR__.'/src/Carbon/FactoryImmutable.php' => $staticImmutableMethods,
];

foreach ($factories as $file => $methods) {
    $autoDoc = compileDoc($methods, $file);
    $content = file_get_contents($file);
    $files->$file = preg_replace_callback(
        '/(<autodoc[\s\S]*>)([\s\S]+)(<\/autodoc>)/mU',
        static fn ($matches) => "{$matches[1]}\n *$autoDoc\n *\n * {$matches[3]}",
        $content,
        1,
    );
}

foreach ($files as $file => $contents) {
    file_put_contents($file, $contents);
}
