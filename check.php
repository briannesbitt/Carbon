<?php

define('MAXIMUM_MISSING_METHODS_THRESHOLD', 0);
define('VERBOSE', isset($argv[1]) && $argv[1] === 'verbose');

require 'vendor/autoload.php';

$documentation = file_get_contents('docs/index.src.html');

$methodsCount = 0;
$missingMethodsCount = 0;
$missingArguments = 0;

function display($message)
{
    if (substr(PHP_OS, 0, 3) === 'WIN') {
        $message = preg_replace("/\033\\[\d+(;\d+)?m/", '', $message);
    }

    echo $message;
}

$dateTimeMethods = get_class_methods(new \DateTime());
$carbon = new \Carbon\Carbon();

foreach (get_class_methods($carbon) as $method) {
    if (in_array($method, $dateTimeMethods)) {
        continue;
    }

    $methodsCount++;
    $documented = strpos($documentation, $method) !== false;
    if (!$documented) {
        $missingMethodsCount++;
    }
    $color = $documented ? 32 : 31;
    $message = $documented ? 'documented' : 'missing';
    $methodPad = str_pad($method, 25);

    $output = "- $methodPad \033[0;{$color}m{$message}\033[0m\n";

    $reflexion = new \ReflectionMethod($carbon, $method);
    $argumentsCount = count($reflexion->getParameters());
    $argumentsDocumented = true;

    if (
        $argumentsCount === 1 && preg_match('/^(sub|add)[A-Z].*[^s]$/', $method) ||
        $argumentsCount === 3 && preg_match('/^diffIn[A-Z].*Filtered$/', $method) ||
        $argumentsCount === 4 && $method === 'diffFiltered' ||
        $argumentsCount === 2 && preg_match('/^diffIn[A-Z].*s$/', $method) ||
        $method === '__set'
    ) {
        $argumentsCount = 0;
    }

    if ($argumentsCount) {
        preg_match_all('/'.preg_quote($method, '/').'\s*\\(/', $documentation, $matches, PREG_PATTERN_ORDER | PREG_OFFSET_CAPTURE);
        $coveredArgs = 0;
        if (!empty($matches[0])) {
            foreach ($matches[0] as $data) {
                if (preg_match('/^(
                    [^"\'\\(\\)]+ |
                    "(?:\\\\[\\S\\s]|[^"\\\\])*" |
                    \'(?:\\\\[\\S\\s]|[^\'\\\\])*\' |
                    (\\(([^\\(\\)\'"]+|(?1))*\\)) |
                )*\)/x', substr($documentation, $data[1] + strlen($data[0])), $match)) {
                    $argumentsString = substr($match[0], 0, -1);
                    $argumentsString = preg_replace('/(
                            "(?:\\\\[\\S\\s]|[^"\\\\])*" |
                            \'(?:\\\\[\\S\\s]|[^\'\\\\])*\'
                        )*/x', '', $argumentsString);
                    $argumentsString = preg_replace('/(\\(
                            (\\[([^\\[\\]\'"]+|(?1))*\\]) |
                            (\\(([^\\(\\)\'"]+|(?1))*\\)) |
                            (\\{([^\\{\\}\'"]+|(?1))*\\}) |
                            [^\\{\\}\\(\\)\\[\\]\'"]+
                        \\))*/x', '', $argumentsString);
                    $count = count(explode(',', $argumentsString));
                    if ($count > $coveredArgs) {
                        $coveredArgs = $count;
                    }
                }
            }
        }

        if ($documented) {
            $missingArguments += $argumentsCount - $coveredArgs;
        }
        $argumentsDocumented = $argumentsCount === $coveredArgs;
        $color = $argumentsDocumented ? 32 : 31;
        $message = $documented ? 'documented' : 'missing';

        if (VERBOSE || $documented) {
            $output .= "   `- \033[0;{$color}m{$coveredArgs}/{$argumentsCount} documented arguments\033[0m\n";
        }
    }
    if (!$documented || !$argumentsDocumented || VERBOSE) {
        display($output);
    }
}

$errorExit = $missingMethodsCount > MAXIMUM_MISSING_METHODS_THRESHOLD;

display($missingMethodsCount ?
    "\033[".($errorExit ? '0;31' : '1;33')."m$missingMethodsCount missing / $methodsCount (threshold: ".MAXIMUM_MISSING_METHODS_THRESHOLD.")\033[0m\n" :
    "\033[0;32mEvery method documented\033[0m\n"
);

if ($missingArguments) {
    display("\033[1;33mAnd there are $missingArguments more arguments that seems to not be documented.\033[0m\n");
}

exit($errorExit ? 1 : 0);
