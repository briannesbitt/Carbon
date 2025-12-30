<?php

declare(strict_types=1);

namespace Carbon\Doc\Methods;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\CarbonTimeZone;
use Carbon\FactoryImmutable;
use Carbon\Language;
use Carbon\Translator;
use Cmixin\BusinessTime;
use Cmixin\SeasonMixin;
use DateInterval;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Generator;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionIntersectionType;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionUnionType;
use stdClass;
use Stringable;
use Symfony\Component\Translation\Translator as SymfonyTranslator;

/** @return Generator<string|Closure> */
function getMethodsFromObject($object): Generator
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

        return $class::$globalMacros ?? FactoryImmutable::getDefaultInstance()->getSettings()['macros'];
    }
}

class BusinessTimeCarbon extends Carbon
{
    use MacroExposer;
}

/**
 * @return Generator<array{
 *     CarbonInterface,
 *     DateTimeInterface,
 *     ?class-string,
 *     ?string,
 *     ?CarbonInterface,
 *     ?class-string,
 *  }>
 */
function getClassesData($excludeMixins = true): Generator
{
    if (class_exists(Carbon::class)) {
        yield [
            new Carbon(),
            new DateTime(),
        ];

        if (!$excludeMixins) {
            if (class_exists(BusinessTime::class)) {
                yield [
                    BusinessTime::enable(BusinessTimeCarbon::class),
                    new Carbon(),
                    Carbon::class,
                    'Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>',
                    new BusinessTimeCarbon(),
                ];
            }

            if (trait_exists(SeasonMixin::class)) {
                BusinessTimeCarbon::mixin(SeasonMixin::class);

                yield [
                    new BusinessTimeCarbon(),
                    new Carbon(),
                    Carbon::class,
                    'Requires <a href="https://github.com/kylekatarnls/season">cmixin/season</a>',
                    new class() extends BusinessTimeCarbon {
                        use SeasonMixin;
                    },
                    SeasonMixin::class,
                ];
            }
        }
    }

    if (class_exists(CarbonInterval::class)) {
        yield [
            new CarbonInterval(0, 0, 0, 1),
            new DateInterval('P1D'),
        ];
    }

    if (class_exists(CarbonPeriod::class)) {
        yield [
            new CarbonPeriod(),
            new stdClass(),
        ];
    }

    if (class_exists(CarbonTimeZone::class)) {
        yield [
            new CarbonTimeZone('Europe/Paris'),
            new DateTimeZone('Europe/Paris'),
        ];
    }

    if (class_exists(Translator::class)) {
        yield [
            new Translator('en'),
            new SymfonyTranslator('en'),
        ];
    }

    if (class_exists(Language::class)) {
        yield [
            new Language('en'),
            new stdClass(),
        ];
    }
}

/**
 * @return Generator<array{
 *     CarbonInterface,
 *     DateTimeInterface,
 *     ?class-string,
 *     ?string,
 *     ?CarbonInterface,
 *     ?class-string,
 *  }>
 */
function getClasses($excludeMixins = true): Generator
{
    foreach (getClassesData($excludeMixins) as $data) {
        yield array_pad($data, 6, null);
    }
}

function convertType(Stringable|string $type): string
{
    if ($type instanceof ReflectionUnionType) {
        $type = implode('|', array_map(
            __FUNCTION__,
            $type->getTypes(),
        ));
    } elseif ($type instanceof ReflectionIntersectionType) {
        $type = implode('&', array_map(
            __FUNCTION__,
            $type->getTypes(),
        ));
    } elseif ($type instanceof ReflectionNamedType) {
        $type = $type->getName();
    }

    return strtr($type, [
        'NULL' => 'null',
        'FALSE' => 'false',
        'TRUE' => 'true',
        "array (\n)" => '[]',
    ]);
}

function convertReturnType(Stringable|string $type, string $className): string
{
    $type = convertType($type);

    $type = strtr(ltrim($type, '\\'), [
        'self' => $className,
        'static' => $className,
    ]);

    $type = ltrim($type, '\\');

    return preg_replace('/\\|\\\\/', '|', preg_replace('/Carbon\\\\/', '', $type));
}

/**
 * @return Generator<array{
 *     CarbonInterface,
 *     class-string<CarbonInterface>,
 *     string,
 *     ?array,
 *     ?string,
 *     ?string,
 *     DateTimeInterface,
 *     mixed,
 *   }>
 */
function methods(bool $excludeNatives = false, bool $excludeMixins = true): Generator
{
    $records = [];

    foreach (getClasses($excludeMixins) as [$carbonObject, $dateTimeObject, $className, $info, $invoke, $trait]) {
        $className = $className ?: get_class($carbonObject);
        $dateTimeMethods = get_class_methods($dateTimeObject);

        foreach (getMethodsFromObject($carbonObject) as $method => $content) {
            if (is_int($method)) {
                $method = $content;
                $content = null;
            }

            if (
                ($excludeNatives && in_array($method, $dateTimeMethods, true)) ||
                in_array($method, [
                    '__call',
                    '__callStatic',
                    '__getMacros',
                    'getAvailableMacroLocales',
                    'getAllMethods',
                    'describeIsoFormat',
                ], true)
            ) {
                continue;
            }

            if (isset($records["$className::$method"])) {
                continue;
            }

            $records["$className::$method"] = true;
            try {
                $rc = new ReflectionMethod($carbonObject, $method);
            } catch (ReflectionException $exception) {
                if (!$trait) {
                    throw $exception;
                }

                $rc = new ReflectionMethod($trait, $method);
            }

            if (!$rc->isPublic()) {
                continue;
            }

            if (!$trait && $invoke && ($function = $rc->invoke($carbonObject))) {
                $rc = new ReflectionFunction($function);
            }

            $docComment = (
                $rc->getDocComment() ?: (
                    method_exists(CarbonImmutable::class, $method)
                        ? (new ReflectionMethod(CarbonImmutable::class, $method))->getDocComment()
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
                    ? convertReturnType($rc->getReturnType(), $className)
                    : $docReturn,
                $docComment,
                $dateTimeObject,
                $info,
            ];
        }
    }

    $className = Carbon::class;
    $carbonObject = new $className();
    $dateTimeObject = new DateTime();
    $rc = new ReflectionClass($className);
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
            $info ?? null,
        ];
    }
}
