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

function methods()
{
    $records = [];
    $carbonObjects = [];
    if (class_exists(\Carbon\Carbon::class)) {
        $carbonObjects[] = [
            new \Carbon\Carbon(),
            new \DateTime()
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

    foreach ($carbonObjects as $tuple) {
        list($carbonObject, $dateTimeObject) = $tuple;
        $className = get_class($carbonObject);
        $dateTimeMethods = get_class_methods($dateTimeObject);

        foreach (getMethodsFromObject($carbonObject) as $method) {
            if (
                in_array($method, $dateTimeMethods) ||
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
                $docComment = preg_replace('/^\s*\/\*+\s*\n([\s\S]+)\n\s*\*\/\s*$/', '$1', $docComment);
                $docComment = explode("\n\n", preg_replace('/^\s*\*[\t ]*/m', '', $docComment))[0];
            }

            yield [$carbonObject, $className, $method, null, $docComment];
        }
    }

    $className = \Carbon\Carbon::class;
    $carbonObject = new $className();
    $rc = new \ReflectionClass($className);
    preg_match_all('/@method\s+(\S+)\s+([^(]+)\(([^)]*)\)\s+(.+)\n/', $rc->getDocComment(), $matches, PREG_SET_ORDER);
    foreach ($matches as list($all, $return, $method, $parameters, $description)) {
        $parameters = trim($parameters);

        if (isset($records["$className::$method"])) {
            continue;
        }

        $records["$className::$method"] = true;

        yield [$carbonObject, $className, $method, $parameters === '' ? [] : explode(',', $parameters), $description];
    }
}
