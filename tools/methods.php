<?php

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
            new \Carbon\CarbonInterval('P1D'),
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

        foreach (get_class_methods($carbonObject) as $method) {
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

            yield [$carbonObject, $className, $method, null];
        }
    }

    $className = \Carbon\Carbon::class;
    $carbonObject = new $className();
    $rc = new \ReflectionClass($className);
    preg_match_all('/@method\s+(\S+)\s+([^(]+)\(([^)]*)\)/', $rc->getDocComment(), $matches, PREG_SET_ORDER);
    foreach ($matches as list($all, $return, $method, $parameters)) {
        $parameters = trim($parameters);

        if (isset($records["$className::$method"])) {
            continue;
        }

        $records["$className::$method"] = true;

        yield [$carbonObject, $className, $method, $parameters === '' ? [] : explode(',', $parameters)];
    }
}
