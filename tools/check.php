<?php

use Carbon\Translator;

define('MAXIMUM_MISSING_METHODS_THRESHOLD', 0);
define('VERBOSE', isset($argv[1]) && $argv[1] === 'verbose');

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../tools/methods.php';

$documentation = file_get_contents(__DIR__.'/../docs/index.src.html');

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

foreach (methods(true) as [$carbonObject, $className, $method, $parameters]) {
    $methodsCount++;
    $pattern = preg_quote($method, '/');
    $upperUnit = '(Unit|Micro(second)?s?|Milli(second)?s?|Seconds?|Minutes?|Hours?|Days?|Weeks?|Months?|Quarters?|Years?|Decades?|Centur(y|ies)|Millenni(um|a))';
    $lowerUnit = '(micro(second)?s?|milli(second)?s?|seconds?|minutes?|hours?|days?|weeks?|months?|quarters?|years?|decades?|centur(y|ies)|millenni(um|a))';
    $exclusion = (bool) preg_match("/^(
        getFactorWithDefault |
        isUnfilteredAndEndLess |
        getType |
        baseMixin|clone|setISODate |
        has(Positive|Negative)Values |
        getTranslationMessage|getTranslationMessageWith|translateWith|getCalendarFormats|getPaddedUnit|translate|getFormatsToIsoReplacements|getTimeFormatByPrecision|hasLocalTranslator |
        (use|is)StrictMode(Enabled)? |
        __(clone|sleep|wakeup|construct|debugInfo|set_state|serialize|unserialize) |
        (floor|ceil|round|sub(tract)?(Real)?|add(Real)?|isCurrent|isLast|isNext|isSame)$upperUnit?((No|With(No)?|Without)Overflow)? |
        (set|get)$upperUnit |
        (startOf|endOf)$upperUnit |
        $lowerUnit
    )$/x", $method);
    $methodFQCN = "$className::$method";
    $exclusion = $exclusion || in_array($methodFQCN, [
            Translator::class . '::getFromCatalogue',
        ], true);
    $documented = $exclusion || preg_match("/[>:]$pattern(?!\w)| $pattern\(/", $documentation);
    if (!$documented) {
        $missingMethodsCount++;
    }
    $color = $documented ? 32 : 31;
    $message = $documented ? 'documented' : 'missing';
    $methodPad = str_pad($methodFQCN, 45);

    $output = "- $methodPad \033[0;{$color}m{$message}\033[0m\n";

    $argumentsCount = count($parameters === null ? array_filter((new \ReflectionMethod($carbonObject, $method))->getParameters(), function (ReflectionParameter $parameter) {
        return !$parameter->isVariadic();
    }) : $parameters);
    $argumentsDocumented = true;

    if (
        $exclusion ||
        $argumentsCount === 3 && preg_match('/^diffIn[A-Z].*Filtered$/', $method) ||
        $argumentsCount === 3 && preg_match('/^getTranslated(Day|Month)Name$/', $method) ||
        $argumentsCount === 4 && $method === 'diffFiltered' ||
        $argumentsCount === 2 && preg_match('/^((diff|floatDiff)In[A-Z].*s|.*Until)$/', $method) ||
        $argumentsCount > 0 && preg_match('/^(plus|minus|createStrict)$/', $method) ||
        $method === '__set'
    ) {
        $argumentsCount = 0;
    } elseif ($method === 'createFromIsoFormat' && $argumentsCount === 5) {
        $argumentsCount = 4;
    } elseif ($method === 'getDateIntervalSpec' && $argumentsCount === 2) {
        $argumentsCount = 1;
    }

    if ($argumentsCount) {
        preg_match_all('/'.preg_quote($method, '/').'\s*\\(/', $documentation, $matches, PREG_PATTERN_ORDER | PREG_OFFSET_CAPTURE);
        $coveredArgs = 0;
        if (!empty($matches[0])) {
            foreach ($matches[0] as $data) {
                if (preg_match('/^(
                [^"\'()]+ |
                "(?:\\\\[\\S\\s]|[^"\\\\])*" |
                \'(?:\\\\[\\S\\s]|[^\'\\\\])*\' |
                (\\(([^()\'"]+|(?1))*\\)) |
            )*\)/x', substr($documentation, $data[1] + strlen($data[0])), $match)) {
                    $argumentsString = substr($match[0], 0, -1);
                    $argumentsString = preg_replace('/(
                        "(?:\\\\[\\S\\s]|[^"\\\\])*" |
                        \'(?:\\\\[\\S\\s]|[^\'\\\\])*\'
                    )*/x', '', $argumentsString);
                    $argumentsString = preg_replace('/(\\(
                        (\\[([^\\[\\]\'"]+|(?1))*]) |
                        (\\(([^()\'"]+|(?1))*\\)) |
                        ({([^{}\'"]+|(?1))*}) |
                        [^{}()\\[\\]\'"]+
                    \\))*/x', '', $argumentsString);
                    $count = count(explode(',', $argumentsString));
                    if ($count > $coveredArgs) {
                        $coveredArgs = $count;
                    }
                }
            }
        }

        if ($documented) {
            $missingArguments += max(0, $argumentsCount - $coveredArgs);
        }
        $argumentsDocumented = $argumentsCount <= $coveredArgs;
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

display(
    $missingMethodsCount
        ? "\033[".($errorExit ? '0;31' : '1;33')."m$missingMethodsCount missing / $methodsCount (threshold: ".MAXIMUM_MISSING_METHODS_THRESHOLD.")\033[0m\n"
        : "\033[0;32mEvery method documented\033[0m\n"
);

if ($missingArguments) {
    display("\033[1;33mAnd there are $missingArguments more arguments that seems to not be documented.\033[0m\n");
}

exit($errorExit ? 1 : 0);
