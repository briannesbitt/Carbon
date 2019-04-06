<?php

function getMethodsFromObject($object)
{
    foreach (get_class_methods($object) as $method) {
        yield $method;
    }
    foreach (get_class_methods(get_class($object)) as $method) {
        yield $method;
    }
}

function methods($excludeNatives = false)
{
    $records = [];
    $carbonObjects = [];
    if (class_exists(\Carbon\Carbon::class)) {
        $carbonObjects[] = [
            new \Carbon\Carbon(),
            new \DateTime(),
        ];
    }
    if (class_exists(\Carbon\CarbonInterval::class)) {
        $carbonObjects[] = [
            new \Carbon\CarbonInterval(0, 0, 0, 1),
            new \DateInterval('P1D'),
        ];
    }
    if (class_exists(\Carbon\CarbonPeriod::class)) {
        $carbonObjects[] = [
            new \Carbon\CarbonPeriod(),
            new \stdClass(),
        ];
    }
    if (class_exists(\Carbon\CarbonTimeZone::class)) {
        $carbonObjects[] = [
            new \Carbon\CarbonTimeZone(),
            new \DateTimeZone('Europe/Paris'),
        ];
    }
    if (class_exists(\Carbon\Translator::class)) {
        $carbonObjects[] = [
            new \Carbon\Translator('en'),
            new \Symfony\Component\Translation\Translator('en'),
        ];
    }
    if (class_exists(\Carbon\Language::class)) {
        $carbonObjects[] = [
            new \Carbon\Language('en'),
            new \stdClass(),
        ];
    }

    foreach ($carbonObjects as $tuple) {
        list($carbonObject, $dateTimeObject) = $tuple;
        $className = get_class($carbonObject);
        $dateTimeMethods = get_class_methods($dateTimeObject);

        foreach (getMethodsFromObject($carbonObject) as $method) {
            if (
                ($excludeNatives && in_array($method, $dateTimeMethods)) ||
                $method === '__call' ||
                $method === '__callStatic'
            ) {
                continue;
            }

            if (isset($records["$className::$method"])) {
                continue;
            }

            $records["$className::$method"] = true;
            $rc = new \ReflectionMethod($carbonObject, $method);
            $docComment = ($rc->getDocComment()
                ?: (method_exists(\Carbon\CarbonImmutable::class, $method)
                    ? (new \ReflectionMethod(\Carbon\CarbonImmutable::class, $method))->getDocComment()
                    : null
                )
            ) ?: null;
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
                if (strpos($docComment, 'isDayOff') !== false) {
                    var_dump($length, $docComment);
                    exit;
                }
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

            yield [$carbonObject, $className, $method, null, $docComment, $dateTimeObject];
        }
    }

    $className = \Carbon\Carbon::class;
    $carbonObject = new $className();
    $dateTimeObject = new \DateTime();
    $rc = new \ReflectionClass($className);
    preg_match_all('/@method\s+(\S+)\s+([^(]+)\(([^)]*)\)\s+(.+)\n/', $rc->getDocComment(), $matches, PREG_SET_ORDER);
    foreach ($matches as list($all, $return, $method, $parameters, $description)) {
        $parameters = trim($parameters);

        if (isset($records["$className::$method"])) {
            continue;
        }

        $records["$className::$method"] = true;

        yield [$carbonObject, $className, $method, $parameters === '' ? [] : explode(',', $parameters), $description, $dateTimeObject];
    }
}
