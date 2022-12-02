<?php

function getMethodsFromObject($object)
{
    foreach (get_class_methods($object) as $method) {
        yield $method;
    }

    foreach (get_class_methods(get_class($object)) as $method) {
        yield $method;
    }

    if (method_exists($object, '__getMacros')) {
        foreach ($object->__getMacros() as $method => $content) {
            yield $method => $content;
        }
    }
}

trait MacroExposer
{
    public function __getMacros()
    {
        $class = get_called_class();

        return $class::$globalMacros;
    }
}

class BusinessTimeCarbon extends \Carbon\Carbon
{
    use MacroExposer;
}

function getClassesData($excludeMixins = true)
{
    if (class_exists(\Carbon\Carbon::class)) {
        yield [
            new \Carbon\Carbon(),
            new \DateTime(),
        ];

        if (!$excludeMixins && class_exists(\Cmixin\BusinessTime::class)) {
            yield [
                \Cmixin\BusinessTime::enable(BusinessTimeCarbon::class),
                new \Carbon\Carbon(),
                \Carbon\Carbon::class,
                'Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>',
                new BusinessTimeCarbon(),
            ];
        }
    }

    if (class_exists(\Carbon\CarbonInterval::class)) {
        yield [
            new \Carbon\CarbonInterval(0, 0, 0, 1),
            new \DateInterval('P1D'),
        ];
    }

    if (class_exists(\Carbon\CarbonPeriod::class)) {
        yield [
            new \Carbon\CarbonPeriod(),
            new \stdClass(),
        ];
    }

    if (class_exists(\Carbon\CarbonTimeZone::class)) {
        yield [
            new \Carbon\CarbonTimeZone(),
            new \DateTimeZone('Europe/Paris'),
        ];
    }

    if (class_exists(\Carbon\Translator::class)) {
        yield [
            new \Carbon\Translator('en'),
            new \Symfony\Component\Translation\Translator('en'),
        ];
    }

    if (class_exists(\Carbon\Language::class)) {
        yield [
            new \Carbon\Language('en'),
            new \stdClass(),
        ];
    }
}

function getClasses($excludeMixins = true)
{
    foreach (getClassesData($excludeMixins) as $data) {
        yield array_pad($data, 5, null);
    }
}

function convertType($type)
{
    return strtr($type, [
        'NULL' => 'null',
        'FALSE' => 'false',
        'TRUE' => 'true',
        "array (\n)" => '[]',
    ]);
}

function convertReturnType($type, $className)
{
    $type = convertType($type);

    $type = strtr(ltrim($type, '\\'), [
        'self' => $className,
        'static' => $className,
    ]);

    $type = ltrim($type, '\\');

    return preg_replace('/\\|\\\\/', '|', preg_replace('/Carbon\\\\/', '', $type));
}

function methods($excludeNatives = false, $excludeMixins = true)
{
    $records = [];

    foreach (getClasses($excludeMixins) as [$carbonObject, $dateTimeObject, $className, $info, $invoke]) {
        $className = $className ?: get_class($carbonObject);
        $dateTimeMethods = get_class_methods($dateTimeObject);

        foreach (getMethodsFromObject($carbonObject) as $method => $content) {
            if (is_int($method)) {
                $method = $content;
                $content = null;
            }

            if (
                ($excludeNatives && in_array($method, $dateTimeMethods)) ||
                $method === '__call' ||
                $method === '__callStatic' ||
                $method === '__getMacros'
            ) {
                continue;
            }

            if (isset($records["$className::$method"])) {
                continue;
            }

            $records["$className::$method"] = true;
            $rc = new \ReflectionMethod($carbonObject, $method);

            if ($invoke && ($function = $rc->invoke($carbonObject))) {
                $rc = new \ReflectionFunction($function);
            }

            $docComment = (
                $rc->getDocComment()
                ?: (
                    method_exists(\Carbon\CarbonImmutable::class, $method)
                        ? (new \ReflectionMethod(\Carbon\CarbonImmutable::class, $method))->getDocComment()
                        : null
                )
            ) ?: null;

            $docReturn = preg_match('/@return (\S+)/', $docComment ?? '', $returnMatch)
                ? convertReturnType($returnMatch[1], $className)
                : null;

            if ($docComment) {
                preg_match_all('/@example[\t ]+([^\n]+)\n/', "$docComment\n", $matches, PREG_PATTERN_ORDER);
                $matches[2] = [];
                $docComment = preg_replace_callback('/(?:@example\n)?[[\t ]*\*[\t ]*```(?:php)?((\n[\t ]*\*[^\n]*)*)\n[\t ]*\*[\t ]*```/U', function ($match) use (&$matches) {
                    $matches[2][] = substr(preg_replace('/^[\t ]*\*[\t ]?/m', '', $match[1]), 1);

                    return '';
                }, $docComment);
                $docComment = preg_replace('/^\s*\/\*+\s*\n([\s\S]+)\n\s*\*\/\s*$/', '$1', $docComment);
                $docComment = trim(explode("\n@", preg_replace('/^\s*\*[\t ]*/m', '', $docComment))[0]);
                preg_match_all('/^(\s*)\S.*$/m', $docComment, $subMatches, PREG_PATTERN_ORDER);

                if (count($matches[1]) || count($matches[2])) {
                    $docComment .= '<p><strong>Examples:</strong></p>';

                    foreach ($matches[2] as $example) {
                        $length = 300;
                        $example = explode("\n", $example);

                        foreach ($example as $line) {
                            $trim = ltrim($line);

                            if ($trim === '') {
                                continue;
                            }

                            $l = strlen($line) - strlen($trim);

                            if ($l < $length) {
                                $length = $l;
                            }
                        }

                        foreach ($example as &$line) {
                            $line = substr($line, $length);
                        }

                        $example = implode("\n", $example);
                        $docComment .= '<pre class="live-editor"><code class="php">'.$example.'</code></pre>';
                    }

                    foreach ($matches[1] as $example) {
                        $docComment .= '<p><code>'.str_replace(' ', '&nbsp;', $example).'</code></p>';
                    }
                }
            }

            yield [
                $carbonObject,
                $className,
                $method,
                null,
                $rc->hasReturnType()
                    ? convertReturnType($rc->getReturnType()->getName(), $className)
                    : $docReturn,
                $docComment,
                $dateTimeObject,
                $info,
            ];
        }
    }

    $className = \Carbon\Carbon::class;
    $carbonObject = new $className();
    $dateTimeObject = new \DateTime();
    $rc = new \ReflectionClass($className);
    preg_match_all('/@method\s+(\S+)\s+([^(\s]+)\(([^)]*)\)\s+(.+)\n/', $rc->getDocComment(), $matches, PREG_SET_ORDER);

    foreach ($matches as [$all, $return, $method, $parameters, $description]) {
        $parameters = convertType(trim($parameters));

        if (preg_match('/^(static|Carbon\w*)\s/', $method)) {
            continue;
        }

        if (isset($records["$className::$method"])) {
            continue;
        }

        $records["$className::$method"] = true;

        yield [
            $carbonObject,
            $className,
            $method,
            $parameters === '' ? [] : explode(',', $parameters),
            $return,
            $description,
            $dateTimeObject,
            $info,
        ];
    }
}
