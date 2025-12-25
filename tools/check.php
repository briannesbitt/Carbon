<?php

declare(strict_types=1);

namespace Carbon\Doc\Check;

use Carbon\Translator;

use ReflectionMethod;
use ReflectionParameter;
use function Carbon\Doc\Methods\methods;

const MAXIMUM_MISSING_METHODS_THRESHOLD = 0;
define('VERBOSE', isset($argv[1]) && $argv[1] === 'verbose');

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../tools/methods.php';

$documentation = implode("\n", array_map(
    file_get_contents(...),
    [
        ...glob(__DIR__ . '/../docs/guide/**/*.md'),
        ...glob(__DIR__ . '/../docs/parts/**/*.md'),
    ],
));

$methodsCount = 0;
$missingMethodsCount = 0;
$missingArguments = 0;

function display(string $message): void
{
    if (str_starts_with(PHP_OS, 'WIN')) {
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
        baseDebugInfo |
        original|optimize|absolute |
        createFromISO8601String|getIterator |
        baseMixin|clone|setISODate |
        has(Positive|Negative)Values |
        getTranslationMessage|getTranslationMessageWith|translateWith|getCalendarFormats|getPaddedUnit|translate|getFormatsToIsoReplacements|getTimeFormatByPrecision|hasLocalTranslator |
        (use|is)StrictMode(Enabled)? |
        __(isset|clone|sleep|wakeup|construct|debugInfo|set_state|serialize|unserialize) |
        diffInUTC$upperUnit |
        (floor|ceil|round|sub(tract)?(Real|UTC)?|add(Real|UTC)?|isCurrent|isLast|isNext|isSame)$upperUnit?((No|With(No)?|Without)Overflow)? |
        (set|get)$upperUnit |
        (startOf|endOf)$upperUnit |
        $lowerUnit(In|Of)$upperUnit |
        $lowerUnit
    )$/x", $method);
    $methodFQCN = "$className::$method";
    $exclusion = $exclusion || in_array($methodFQCN, [
            Translator::class.'::getFromCatalogue',
        ], true);
    $documented = $exclusion || preg_match("/(?:[[>`]|::)$pattern(?!\w)| $pattern\(/", $documentation);

    if (!$documented) {
        $missingMethodsCount++;
    }

    $color = $documented ? 32 : 31;
    $message = $documented ? 'documented' : 'missing';
    $methodPad = str_pad($methodFQCN, 45);

    $output = "- $methodPad \033[0;{$color}m{$message}\033[0m\n";

    $parameterList = $parameters === null ? array_filter(
        (new ReflectionMethod($carbonObject, $method))->getParameters(),
        static fn (ReflectionParameter $parameter): bool => !$parameter->isVariadic(),
    ) : $parameters;
    $argumentsDocumented = [];

    foreach ($parameterList as $parameter) {
        $name = $parameter instanceof ReflectionParameter
            ? $parameter->getName()
            : preg_split('/[= ]/', explode('$', $parameter)[1])[0];
        $argumentsDocumented[$name] = false;
    }

    $argumentsCount = count($parameterList);
    $allArgumentsDocumented = true;

    if (
        $exclusion ||
        $argumentsCount === 3 && preg_match('/^diffIn[A-Z].*Filtered$/', $method) ||
        $argumentsCount === 3 && preg_match('/^getTranslated(Day|Month)Name$/', $method) ||
        $argumentsCount === 4 && ($method === 'diffFiltered' || $method === 'diff') ||
        $argumentsCount === 2 && preg_match('/^((diff|floatDiff)(AsDateInterval|In[A-Z].*s)|.*Until)$/', $method) ||
        $argumentsCount > 0 && preg_match('/^(plus|minus|createStrict)$/', $method) ||
        preg_match('/^(isStartOf|isEndOf)/', $method) ||
        $method === '__set'
    ) {
        $argumentsCount = 0;
    } elseif ($method === 'createFromIsoFormat' && $argumentsCount === 5) {
        $argumentsCount = 4;
    } elseif ($method === 'getDateIntervalSpec' && $argumentsCount <= 3) {
        $argumentsCount = 1;
    } elseif ($method === 'diffAsCarbonInterval' && $argumentsCount === 3) {
        $argumentsCount = 2;
    }

    if ($argumentsCount) {
        preg_match_all('/'.preg_quote($method, '/').'\s*\\(/', $documentation, $matches, PREG_PATTERN_ORDER | PREG_OFFSET_CAPTURE);
        $coveredArgs = 0;

        if (!empty($matches[0])) {
            foreach ($matches[0] as [$opening, $position]) {
                if (preg_match('/^(
                    [^"\'()]+ |
                    "(?:\\\\[\\S\\s]|[^"\\\\])*" |
                    \'(?:\\\\[\\S\\s]|[^\'\\\\])*\' |
                    (\\(([^()\'"]+|(?1))*\\)) |
                )*\)/x', substr($documentation, $position + strlen($opening)), $match)) {
                    $argumentsString = substr($match[0], 0, -1);
                    $empty = ($argumentsString === '');
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
                    // TODO replace [''] with [] and document methods with 1 optional argument properly
                    $argumentValues = $empty ? [''] : array_filter(
                        explode(',', $argumentsString),
                        static function ($argumentValue) use (&$argumentsDocumented) {
                            if (preg_match('/^\s*(?<name>[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\s*:[^:]/', $argumentValue, $match)) {
                                if (isset($argumentsDocumented[$match['name']])) {
                                    $argumentsDocumented[$match['name']] = true;
                                }

                                return false;
                            }

                            return true;
                        },
                    );
                    $count = count($argumentValues);

                    if ($count > $coveredArgs) {
                        $coveredArgs = $count;
                    }
                }
            }
        }

        if ($documented) {
            $missingArguments += max(0, $argumentsCount - $coveredArgs);
        }

        $allArgumentsDocumented = $argumentsCount <= $coveredArgs;
        $color = $allArgumentsDocumented ? 32 : 31;

        if (VERBOSE || $documented) {
            $output .= "   `- \033[0;{$color}m{$coveredArgs}/{$argumentsCount} documented arguments\033[0m\n";
            $argumentNames = array_keys($argumentsDocumented);
            $missingNames = array_slice($argumentNames, $coveredArgs, $argumentsCount - $coveredArgs);

            // Methods diffIn all have the same parameters, so we won't describe each one.
            if (array_diff($missingNames, ['absolute', 'utc']) === []) {
                $missingNames = [];
            }

            $allArgumentsDocumented = true;

            foreach ($missingNames as $name) {
                if ($argumentsDocumented[$name]) {
                    $missingArguments--;

                    continue;
                }

                $allArgumentsDocumented = false;
                $output .= "     `- \033[0;{$color}m{$name}\033[0m\n";
            }
        }
    }

    if (!$documented || !$allArgumentsDocumented || VERBOSE) {
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
