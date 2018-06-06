<?php

$tags = [
    'property',
    'property-read',
    PHP_EOL,
    'native-method',
    ['call', 'isDayOfWeek'],
    ['call', 'isSameUnit'],
    ['call', 'setUnit'],
    ['call', 'addUnit'],
    ['call', 'addRealUnit'],
];
$nativeMethods = [
    'format' => 'string',
    'modify' => 'static',
    'add' => 'static',
    'sub' => 'static',
    'getTimezone' => '\DateTimeZone',
    'getOffset' => 'int',
    'getTimestamp' => 'int',
    'setTime' => 'static',
    'setISODate' => 'static',
    'setTimestamp' => 'static',
    'diff' => '\DateInterval',
];
$defaultValues = [
    'diff' => [
        'absolute' => true,
    ],
    'setTime' => [
        'second' => 0,
        'microseconds' => 0,
    ],
    'setISODate' => [
        'day' => 1,
    ],
];
$autoDocLines = [];
$carbon = __DIR__.'/src/Carbon/Carbon.php';
$immutable = __DIR__.'/src/Carbon/CarbonImmutable.php';
$interface = __DIR__.'/src/Carbon/CarbonInterface.php';
file_put_contents($interface, preg_replace('/(\/\/ <methods[\s\S]*>)([\s\S]+)(<\/methods>)/mU', "$1\n\n    // $3", file_get_contents($interface), 1));
include_once __DIR__.'/vendor/autoload.php';
$trait = __DIR__.'/src/Carbon/Traits/Date.php';
$code = file_get_contents($trait);

function pluralize($word)
{
    if (preg_match('/(millenni)um$/i', $word)) {
        return preg_replace('/(millenni)um$/i', '$1a', $word);
    }

    return preg_replace('/(centur)y$/i', '$1ie', $word).'s';
}

foreach ($tags as $tag) {
    if (is_array($tag)) {
        list($tag, $pattern) = $tag;
    }
    $pattern = isset($pattern) ? $pattern : '\S+';
    if ($tag === PHP_EOL) {
        $autoDocLines[] = '';

        continue;
    }
    if ($tag === 'native-method') {
        foreach ($nativeMethods as $method => $return) {
            $function = new ReflectionMethod(\Carbon\Carbon::class, $method);
            $parameters = implode(', ', array_map(function (ReflectionParameter $parameter) use ($defaultValues, $method) {
                $name = $parameter->getName();
                $output = '$'.$name;
                if ($parameter->getType()) {
                    $name = $parameter->getType()->getName();
                    if (preg_match('/^[A-Z]/', $name)) {
                        $name = "\\$name";
                    }
                    $output = "$name $output";
                }
                if (isset($defaultValues[$method])) {
                    if (isset($defaultValues[$method][$name])) {
                        $output .= ' = '.var_export($defaultValues[$method][$name], true);
                    }

                    return $output;
                }
                try {
                    if ($parameter->getDefaultValue()) {
                        $output .= ' = '.$parameter->getDefaultValue();
                    }
                } catch (\ReflectionException $exp) {
                }

                return $output;
            }, $function->getParameters()));
            $link = strtolower($method);
            $autoDocLines[] = [
                '@method',
                $return,
                "$method($parameters)",
                "call \DateTime::$method if mutable or \DateTimeImmutable::$method else.",
            ];
            $autoDocLines[] = ['', '', '', "http://php.net/manual/en/datetime.$link.php"];
        }

        continue;
    }

    preg_match_all('/\/\/ @'.$tag.'\s+(?<type>'.$pattern.')(?:\s+\$(?<name>\S+)(?:[^\S\n](?<description>.*))?\n|(?:[^\S\n](?<description2>.*))?\n[^\']*\'(?<name2>[^\']+)\')/', $code, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $vars = (object) $match;
        $vars->name = $vars->name ?: $vars->name2;
        $vars->description = $vars->description ?: $vars->description2;
        if ($tag === 'call') {
            switch ($vars->type) {
                case 'isDayOfWeek':
                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'is'.ucFirst($vars->name).'()',
                        'Checks if the instance day is '.strtolower($vars->name).'.',
                    ];
                    break;
                case 'isSameUnit':
                    $unit = $vars->name;
                    $method = 'isSame'.ucFirst($unit);
                    if (!method_exists(\Carbon\Carbon::class, $method)) {
                        $autoDocLines[] = [
                            '@method',
                            'bool',
                            $method.'(\DateTimeInterface $date = null)',
                            "Checks if the given date is in the same $unit as the instance. If null passed, compare to now (with the same timezone).",
                        ];
                    }
                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'isCurrent'.ucFirst($unit).'()',
                        "Checks if the instance is in the same $unit as the current moment.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'isNext'.ucFirst($unit).'()',
                        "Checks if the instance is in the same $unit as the current moment next $unit.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        'bool',
                        'isLast'.ucFirst($unit).'()',
                        "Checks if the instance is in the same $unit as the current moment last $unit.",
                    ];
                    break;
                case 'setUnit':
                    $unit = $vars->name;
                    $plUnit = pluralize($unit);
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        "$plUnit(int \$value)",
                        "Set current instance $unit to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        "$unit(int \$value)",
                        "Set current instance $unit to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'set'.ucfirst($plUnit).'(int $value)',
                        "Set current instance $unit to the given value.",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'set'.ucfirst($unit).'(int $value)',
                        "Set current instance $unit to the given value.",
                    ];
                    break;
                case 'addUnit':
                    $unit = $vars->name;
                    $plUnit = pluralize($unit);
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'add'.ucFirst($plUnit).'(int $value = 1)',
                        "Add $plUnit (the \$value count passed in) to the instance (using date interval).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'add'.ucFirst($unit).'()',
                        "Add one $unit to the instance (using date interval).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'sub'.ucFirst($plUnit).'(int $value = 1)',
                        "Sub $plUnit (the \$value count passed in) to the instance (using date interval).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'sub'.ucFirst($unit).'()',
                        "Sub one $unit to the instance (using date interval).",
                    ];
                    if (in_array($unit, [
                        'month',
                        'quarter',
                        'year',
                        'decade',
                        'century',
                        'millennium',
                    ])) {
                        $autoDocLines[] = [
                            '@method',
                            '$this',
                            'add'.ucFirst($plUnit).'WithOverflow(int $value = 1)',
                            "Add $plUnit (the \$value count passed in) to the instance (using date interval) with overflow explicitly allowed.",
                        ];
                        $autoDocLines[] = [
                            '@method',
                            '$this',
                            'add'.ucFirst($unit).'WithOverflow()',
                            "Add one $unit to the instance (using date interval) with overflow explicitly allowed.",
                        ];
                        $autoDocLines[] = [
                            '@method',
                            '$this',
                            'sub'.ucFirst($plUnit).'WithOverflow(int $value = 1)',
                            "Sub $plUnit (the \$value count passed in) to the instance (using date interval) with overflow explicitly allowed.",
                        ];
                        $autoDocLines[] = [
                            '@method',
                            '$this',
                            'sub'.ucFirst($unit).'WithOverflow()',
                            "Sub one $unit to the instance (using date interval) with overflow explicitly allowed.",
                        ];
                        foreach (['WithoutOverflow', 'WithNoOverflow', 'NoOverflow'] as $alias) {
                            $autoDocLines[] = [
                                '@method',
                                '$this',
                                'add'.ucFirst($plUnit)."$alias(int \$value = 1)",
                                "Add $plUnit (the \$value count passed in) to the instance (using date interval) with overflow explicitly forbidden.",
                            ];
                            $autoDocLines[] = [
                                '@method',
                                '$this',
                                'add'.ucFirst($unit)."$alias()",
                                "Add one $unit to the instance (using date interval) with overflow explicitly forbidden.",
                            ];
                            $autoDocLines[] = [
                                '@method',
                                '$this',
                                'sub'.ucFirst($plUnit)."$alias(int \$value = 1)",
                                "Sub $plUnit (the \$value count passed in) to the instance (using date interval) with overflow explicitly forbidden.",
                            ];
                            $autoDocLines[] = [
                                '@method',
                                '$this',
                                'sub'.ucFirst($unit)."$alias()",
                                "Sub one $unit to the instance (using date interval) with overflow explicitly forbidden.",
                            ];
                        }
                        break;
                    }
                    break;
                case 'addRealUnit':
                    $unit = $vars->name;
                    $plUnit = pluralize($unit);
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'addReal'.ucFirst($plUnit).'(int $value = 1)',
                        "Add $plUnit (the \$value count passed in) to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'addReal'.ucFirst($unit).'()',
                        "Add one $unit to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'subReal'.ucFirst($plUnit).'(int $value = 1)',
                        "Sub $plUnit (the \$value count passed in) to the instance (using timestamp).",
                    ];
                    $autoDocLines[] = [
                        '@method',
                        '$this',
                        'subReal'.ucFirst($unit).'()',
                        "Sub one $unit to the instance (using timestamp).",
                    ];
                    break;
            }

            continue;
        }

        $description = trim($vars->description);
        $variable = $vars->name;
        if (substr($description, 0, 1) === '$') {
            list($variable, $description) = explode(' ', $description, 2);
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

$autoDoc = '';
$columnsMaxLengths = [];
foreach ($autoDocLines as $line) {
    if (is_array($line)) {
        foreach ($line as $column => $text) {
            $length = strlen($text);
            $max = $columnsMaxLengths[$column] ?? 0;
            if ($length > $max) {
                $columnsMaxLengths[$column] = $length;
            }
        }
    }
}
foreach ($autoDocLines as $line) {
    $autoDoc .= "\n *";
    if (is_string($line)) {
        if (!empty($line)) {
            $autoDoc .= " $line";
        }

        continue;
    }

    $computedLine = '';
    foreach ($line as $column => $text) {
        $computedLine .= str_pad($text, $columnsMaxLengths[$column] + 1, ' ', STR_PAD_RIGHT);
    }

    $autoDoc .= ' '.trim($computedLine);
}

$files = new stdClass();

foreach ([$trait, $carbon, $immutable, $interface] as $file) {
    $content = file_get_contents($file);
    $files->$file = preg_replace_callback('/(<autodoc[\s\S]*>)([\s\S]+)(<\/autodoc>)/mU', function ($matches) use ($file, $autoDoc) {
        return $matches[1]."\n *$autoDoc\n *\n * ".$matches[3];
    }, $content, 1);
}

$methods = '';
foreach (get_class_methods(\Carbon\Carbon::class) as $method) {
    if (method_exists(\Carbon\CarbonImmutable::class, $method) && !method_exists(DateTimeInterface::class, $method)) {
        $function = new ReflectionMethod(\Carbon\Carbon::class, $method);
        $static = $function->isStatic() ? ' static' : '';
        $parameters = implode(', ', array_map(function (ReflectionParameter $parameter) use ($method) {
            $output = '$'.$parameter->getName();
            if ($parameter->getType()) {
                $name = $parameter->getType()->getName();
                if (preg_match('/^[A-Z]/', $name)) {
                    $name = "\\$name";
                }
                $output = "$name $output";
            }
            try {
                if ($parameter->getDefaultValue()) {
                    $output .= ' = '.$parameter->getDefaultValue();
                }
            } catch (\ReflectionException $exp) {
            }

            return $output;
        }, $function->getParameters()));
        $return = $function->getReturnType() ? ': '.$function->getReturnType()->getName() : '';
        $methods .= "\n\n    public$static function $method($parameters)$return;";
    }
}

$files->$interface = preg_replace_callback('/(\/\/ <methods[\s\S]*>)([\s\S]+)(<\/methods>)/mU', function ($matches) use ($methods) {
    return $matches[1]."$methods\n\n    // ".$matches[3];
}, $files->$interface, 1);

foreach ([$trait, $carbon, $immutable, $interface] as $file) {
    file_put_contents($file, $files->$file);
}
