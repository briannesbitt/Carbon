<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\Exceptions\InvalidDateException;
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Exceptions\OutOfRangeException;
use Carbon\Translator;
use Closure;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use ReturnTypeWillChange;

/**
 * Trait Creator.
 *
 * Static creators.
 *
 * Depends on the following methods:
 *
 * @method static Carbon|CarbonImmutable getTestNow()
 */
trait Creator
{
    use ObjectInitialisation;

    /**
     * The errors that can occur.
     *
     * @var array
     */
    protected static $lastErrors;

    /**
     * Create a new Carbon instance.
     *
     * Please see the testing aids section (specifically static::setTestNow())
     * for more on the possibility of this constructor returning a test instance.
     *
     * @param DateTimeInterface|string|null $time
     * @param DateTimeZone|string|null      $tz
     *
     * @throws InvalidFormatException
     */
    public function __construct($time = null, $tz = null)
    {
        if ($time instanceof DateTimeInterface) {
            $time = $this->constructTimezoneFromDateTime($time, $tz)->format('Y-m-d H:i:s.u');
        }

        if (is_numeric($time) && (!\is_string($time) || !preg_match('/^\d{1,14}$/', $time))) {
            $time = static::createFromTimestampUTC($time)->format('Y-m-d\TH:i:s.uP');
        }

        // If the class has a test now set and we are trying to create a now()
        // instance then override as required
        $isNow = empty($time) || $time === 'now';

        if (method_exists(static::class, 'hasTestNow') &&
            method_exists(static::class, 'getTestNow') &&
            static::hasTestNow() &&
            ($isNow || static::hasRelativeKeywords($time))
        ) {
            static::mockConstructorParameters($time, $tz);
        }

        // Work-around for PHP bug https://bugs.php.net/bug.php?id=67127
        if (!str_contains((string) .1, '.')) {
            $locale = setlocale(LC_NUMERIC, '0');
            setlocale(LC_NUMERIC, 'C');
        }

        try {
            parent::__construct($time ?: 'now', static::safeCreateDateTimeZone($tz) ?: null);
        } catch (Exception $exception) {
            throw new InvalidFormatException($exception->getMessage(), 0, $exception);
        }

        $this->constructedObjectId = spl_object_hash($this);

        if (isset($locale)) {
            setlocale(LC_NUMERIC, $locale);
        }

        static::setLastErrors(parent::getLastErrors());
    }

    /**
     * Get timezone from a datetime instance.
     *
     * @param DateTimeInterface        $date
     * @param DateTimeZone|string|null $tz
     *
     * @return DateTimeInterface
     */
    private function constructTimezoneFromDateTime(DateTimeInterface $date, &$tz)
    {
        if ($tz !== null) {
            $safeTz = static::safeCreateDateTimeZone($tz);

            if ($safeTz) {
                return $date->setTimezone($safeTz);
            }

            return $date;
        }

        $tz = $date->getTimezone();

        return $date;
    }

    /**
     * Update constructedObjectId on cloned.
     */
    public function __clone()
    {
        $this->constructedObjectId = spl_object_hash($this);
    }

    /**
     * Create a Carbon instance from a DateTime one.
     *
     * @param DateTimeInterface $date
     *
     * @return static
     */
    public static function instance($date)
    {
        if ($date instanceof static) {
            return clone $date;
        }

        static::expectDateTime($date);

        $instance = new static($date->format('Y-m-d H:i:s.u'), $date->getTimezone());

        if ($date instanceof CarbonInterface || $date instanceof Options) {
            $settings = $date->getSettings();

            if (!$date->hasLocalTranslator()) {
                unset($settings['locale']);
            }

            $instance->settings($settings);
        }

        return $instance;
    }

    /**
     * Create a carbon instance from a string.
     *
     * This is an alias for the constructor that allows better fluent syntax
     * as it allows you to do Carbon::parse('Monday next week')->fn() rather
     * than (new Carbon('Monday next week'))->fn().
     *
     * @param string|DateTimeInterface|null $time
     * @param DateTimeZone|string|null      $tz
     *
     * @throws InvalidFormatException
     *
     * @return static
     */
    public static function rawParse($time = null, $tz = null)
    {
        if ($time instanceof DateTimeInterface) {
            return static::instance($time);
        }

        try {
            return new static($time, $tz);
        } catch (Exception $exception) {
            $date = @static::now($tz)->change($time);

            if (!$date) {
                throw new InvalidFormatException("Could not parse '$time': ".$exception->getMessage(), 0, $exception);
            }

            return $date;
        }
    }

    /**
     * Create a carbon instance from a string.
     *
     * This is an alias for the constructor that allows better fluent syntax
     * as it allows you to do Carbon::parse('Monday next week')->fn() rather
     * than (new Carbon('Monday next week'))->fn().
     *
     * @param string|DateTimeInterface|null $time
     * @param DateTimeZone|string|null      $tz
     *
     * @throws InvalidFormatException
     *
     * @return static
     */
    public static function parse($time = null, $tz = null)
    {
        $function = static::$parseFunction;

        if (!$function) {
            return static::rawParse($time, $tz);
        }

        if (\is_string($function) && method_exists(static::class, $function)) {
            $function = [static::class, $function];
        }

        return $function(...\func_get_args());
    }

    /**
     * Create a carbon instance from a localized string (in French, Japanese, Arabic, etc.).
     *
     * @param string                   $time   date/time string in the given language (may also contain English).
     * @param string|null              $locale if locale is null or not specified, current global locale will be
     *                                         used instead.
     * @param DateTimeZone|string|null $tz     optional timezone for the new instance.
     *
     * @throws InvalidFormatException
     *
     * @return static
     */
    public static function parseFromLocale($time, $locale = null, $tz = null)
    {
        return static::rawParse(static::translateTimeString($time, $locale, 'en'), $tz);
    }

    /**
     * Get a Carbon instance for the current date and time.
     *
     * @param DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function now($tz = null)
    {
        return new static(null, $tz);
    }

    /**
     * Create a Carbon instance for today.
     *
     * @param DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function today($tz = null)
    {
        return static::rawParse('today', $tz);
    }

    /**
     * Create a Carbon instance for tomorrow.
     *
     * @param DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function tomorrow($tz = null)
    {
        return static::rawParse('tomorrow', $tz);
    }

    /**
     * Create a Carbon instance for yesterday.
     *
     * @param DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function yesterday($tz = null)
    {
        return static::rawParse('yesterday', $tz);
    }

    /**
     * Create a Carbon instance for the greatest supported date.
     *
     * @return static
     */
    public static function maxValue()
    {
        if (self::$PHPIntSize === 4) {
            // 32 bit
            return static::createFromTimestamp(PHP_INT_MAX); // @codeCoverageIgnore
        }

        // 64 bit
        return static::create(9999, 12, 31, 23, 59, 59);
    }

    /**
     * Create a Carbon instance for the lowest supported date.
     *
     * @return static
     */
    public static function minValue()
    {
        if (self::$PHPIntSize === 4) {
            // 32 bit
            return static::createFromTimestamp(~PHP_INT_MAX); // @codeCoverageIgnore
        }

        // 64 bit
        return static::create(1, 1, 1, 0, 0, 0);
    }

    private static function assertBetween($unit, $value, $min, $max)
    {
        if (static::isStrictModeEnabled() && ($value < $min || $value > $max)) {
            throw new OutOfRangeException($unit, $min, $max, $value);
        }
    }

    private static function createNowInstance($tz)
    {
        if (!static::hasTestNow()) {
            return static::now($tz);
        }

        $now = static::getTestNow();

        if ($now instanceof Closure) {
            return $now(static::now($tz));
        }

        return $now;
    }

    /**
     * Create a new Carbon instance from a specific date and time.
     *
     * If any of $year, $month or $day are set to null their now() values will
     * be used.
     *
     * If $hour is null it will be set to its now() value and the default
     * values for $minute and $second will be their now() values.
     *
     * If $hour is not null then the default values for $minute and $second
     * will be 0.
     *
     * @param int|null                 $year
     * @param int|null                 $month
     * @param int|null                 $day
     * @param int|null                 $hour
     * @param int|null                 $minute
     * @param int|null                 $second
     * @param DateTimeZone|string|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static|false
     */
    public static function create($year = 0, $month = 1, $day = 1, $hour = 0, $minute = 0, $second = 0, $tz = null)
    {
        if (\is_string($year) && !is_numeric($year) || $year instanceof DateTimeInterface) {
            return static::parse($year, $tz ?: (\is_string($month) || $month instanceof DateTimeZone ? $month : null));
        }

        $defaults = null;
        $getDefault = function ($unit) use ($tz, &$defaults) {
            if ($defaults === null) {
                $now = self::createNowInstance($tz);

                $defaults = array_combine([
                    'year',
                    'month',
                    'day',
                    'hour',
                    'minute',
                    'second',
                ], explode('-', $now->rawFormat('Y-n-j-G-i-s.u')));
            }

            return $defaults[$unit];
        };

        $year = $year ?? $getDefault('year');
        $month = $month ?? $getDefault('month');
        $day = $day ?? $getDefault('day');
        $hour = $hour ?? $getDefault('hour');
        $minute = $minute ?? $getDefault('minute');
        $second = (float) ($second ?? $getDefault('second'));

        self::assertBetween('month', $month, 0, 99);
        self::assertBetween('day', $day, 0, 99);
        self::assertBetween('hour', $hour, 0, 99);
        self::assertBetween('minute', $minute, 0, 99);
        self::assertBetween('second', $second, 0, 99);

        $fixYear = null;

        if ($year < 0) {
            $fixYear = $year;
            $year = 0;
        } elseif ($year > 9999) {
            $fixYear = $year - 9999;
            $year = 9999;
        }

        $second = ($second < 10 ? '0' : '').number_format($second, 6);
        $instance = static::rawCreateFromFormat('!Y-n-j G:i:s.u', sprintf('%s-%s-%s %s:%02s:%02s', $year, $month, $day, $hour, $minute, $second), $tz);

        if ($fixYear !== null) {
            $instance = $instance->addYears($fixYear);
        }

        return $instance;
    }

    /**
     * Create a new safe Carbon instance from a specific date and time.
     *
     * If any of $year, $month or $day are set to null their now() values will
     * be used.
     *
     * If $hour is null it will be set to its now() value and the default
     * values for $minute and $second will be their now() values.
     *
     * If $hour is not null then the default values for $minute and $second
     * will be 0.
     *
     * If one of the set values is not valid, an InvalidDateException
     * will be thrown.
     *
     * @param int|null                 $year
     * @param int|null                 $month
     * @param int|null                 $day
     * @param int|null                 $hour
     * @param int|null                 $minute
     * @param int|null                 $second
     * @param DateTimeZone|string|null $tz
     *
     * @throws InvalidDateException
     *
     * @return static|false
     */
    public static function createSafe($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null)
    {
        $fields = static::getRangesByUnit();

        foreach ($fields as $field => $range) {
            if ($$field !== null && (!\is_int($$field) || $$field < $range[0] || $$field > $range[1])) {
                if (static::isStrictModeEnabled()) {
                    throw new InvalidDateException($field, $$field);
                }

                return false;
            }
        }

        $instance = static::create($year, $month, $day, $hour, $minute, $second, $tz);

        foreach (array_reverse($fields) as $field => $range) {
            if ($$field !== null && (!\is_int($$field) || $$field !== $instance->$field)) {
                if (static::isStrictModeEnabled()) {
                    throw new InvalidDateException($field, $$field);
                }

                return false;
            }
        }

        return $instance;
    }

    /**
     * Create a new Carbon instance from a specific date and time using strict validation.
     *
     * @see create()
     *
     * @param int|null                 $year
     * @param int|null                 $month
     * @param int|null                 $day
     * @param int|null                 $hour
     * @param int|null                 $minute
     * @param int|null                 $second
     * @param DateTimeZone|string|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static
     */
    public static function createStrict(?int $year = 0, ?int $month = 1, ?int $day = 1, ?int $hour = 0, ?int $minute = 0, ?int $second = 0, $tz = null): self
    {
        $initialStrictMode = static::isStrictModeEnabled();
        static::useStrictMode(true);

        try {
            $date = static::create($year, $month, $day, $hour, $minute, $second, $tz);
        } finally {
            static::useStrictMode($initialStrictMode);
        }

        return $date;
    }

    /**
     * Create a Carbon instance from just a date. The time portion is set to now.
     *
     * @param int|null                 $year
     * @param int|null                 $month
     * @param int|null                 $day
     * @param DateTimeZone|string|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static
     */
    public static function createFromDate($year = null, $month = null, $day = null, $tz = null)
    {
        return static::create($year, $month, $day, null, null, null, $tz);
    }

    /**
     * Create a Carbon instance from just a date. The time portion is set to midnight.
     *
     * @param int|null                 $year
     * @param int|null                 $month
     * @param int|null                 $day
     * @param DateTimeZone|string|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static
     */
    public static function createMidnightDate($year = null, $month = null, $day = null, $tz = null)
    {
        return static::create($year, $month, $day, 0, 0, 0, $tz);
    }

    /**
     * Create a Carbon instance from just a time. The date portion is set to today.
     *
     * @param int|null                 $hour
     * @param int|null                 $minute
     * @param int|null                 $second
     * @param DateTimeZone|string|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static
     */
    public static function createFromTime($hour = 0, $minute = 0, $second = 0, $tz = null)
    {
        return static::create(null, null, null, $hour, $minute, $second, $tz);
    }

    /**
     * Create a Carbon instance from a time string. The date portion is set to today.
     *
     * @param string                   $time
     * @param DateTimeZone|string|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static
     */
    public static function createFromTimeString($time, $tz = null)
    {
        return static::today($tz)->setTimeFromTimeString($time);
    }

    /**
     * @param string                         $format     Datetime format
     * @param string                         $time
     * @param DateTimeZone|string|false|null $originalTz
     *
     * @return DateTimeInterface|false
     */
    private static function createFromFormatAndTimezone($format, $time, $originalTz)
    {
        // Work-around for https://bugs.php.net/bug.php?id=75577
        // @codeCoverageIgnoreStart
        if (version_compare(PHP_VERSION, '7.3.0-dev', '<')) {
            $format = str_replace('.v', '.u', $format);
        }
        // @codeCoverageIgnoreEnd

        if ($originalTz === null) {
            return parent::createFromFormat($format, (string) $time);
        }

        $tz = \is_int($originalTz)
            ? @timezone_name_from_abbr('', (int) ($originalTz * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE), 1)
            : $originalTz;

        $tz = static::safeCreateDateTimeZone($tz, $originalTz);

        if ($tz === false) {
            return false;
        }

        return parent::createFromFormat($format, (string) $time, $tz);
    }

    /**
     * Create a Carbon instance from a specific format.
     *
     * @param string                         $format Datetime format
     * @param string                         $time
     * @param DateTimeZone|string|false|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static|false
     */
    public static function rawCreateFromFormat($format, $time, $tz = null)
    {
        // Work-around for https://bugs.php.net/bug.php?id=80141
        $format = preg_replace('/(?<!\\\\)((?:\\\\{2})*)c/', '$1Y-m-d\TH:i:sP', $format);

        if (preg_match('/(?<!\\\\)(?:\\\\{2})*(a|A)/', $format, $aMatches, PREG_OFFSET_CAPTURE) &&
            preg_match('/(?<!\\\\)(?:\\\\{2})*(h|g|H|G)/', $format, $hMatches, PREG_OFFSET_CAPTURE) &&
            $aMatches[1][1] < $hMatches[1][1] &&
            preg_match('/(am|pm|AM|PM)/', $time)
        ) {
            $format = preg_replace('/^(.*)(?<!\\\\)((?:\\\\{2})*)(a|A)(.*)$/U', '$1$2$4 $3', $format);
            $time = preg_replace('/^(.*)(am|pm|AM|PM)(.*)$/U', '$1$3 $2', $time);
        }

        // First attempt to create an instance, so that error messages are based on the unmodified format.
        $date = self::createFromFormatAndTimezone($format, $time, $tz);
        $lastErrors = parent::getLastErrors();
        /** @var \Carbon\CarbonImmutable|\Carbon\Carbon|null $mock */
        $mock = static::getMockedTestNow($tz);

        if ($mock && $date instanceof DateTimeInterface) {
            // Set timezone from mock if custom timezone was neither given directly nor as a part of format.
            // First let's skip the part that will be ignored by the parser.
            $nonEscaped = '(?<!\\\\)(\\\\{2})*';

            $nonIgnored = preg_replace("/^.*{$nonEscaped}!/s", '', $format);

            if ($tz === null && !preg_match("/{$nonEscaped}[eOPT]/", $nonIgnored)) {
                $tz = clone $mock->getTimezone();
            }

            // Set microseconds to zero to match behavior of DateTime::createFromFormat()
            // See https://bugs.php.net/bug.php?id=74332
            $mock = $mock->copy()->microsecond(0);

            // Prepend mock datetime only if the format does not contain non escaped unix epoch reset flag.
            if (!preg_match("/{$nonEscaped}[!|]/", $format)) {
                $format = static::MOCK_DATETIME_FORMAT.' '.$format;
                $time = ($mock instanceof self ? $mock->rawFormat(static::MOCK_DATETIME_FORMAT) : $mock->format(static::MOCK_DATETIME_FORMAT)).' '.$time;
            }

            // Regenerate date from the modified format to base result on the mocked instance instead of now.
            $date = self::createFromFormatAndTimezone($format, $time, $tz);
        }

        if ($date instanceof DateTimeInterface) {
            $instance = static::instance($date);
            $instance::setLastErrors($lastErrors);

            return $instance;
        }

        if (static::isStrictModeEnabled()) {
            throw new InvalidFormatException(implode(PHP_EOL, $lastErrors['errors']));
        }

        return false;
    }

    /**
     * Create a Carbon instance from a specific format.
     *
     * @param string                         $format Datetime format
     * @param string                         $time
     * @param DateTimeZone|string|false|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static|false
     */
    #[ReturnTypeWillChange]
    public static function createFromFormat($format, $time, $tz = null)
    {
        $function = static::$createFromFormatFunction;

        if (!$function) {
            return static::rawCreateFromFormat($format, $time, $tz);
        }

        if (\is_string($function) && method_exists(static::class, $function)) {
            $function = [static::class, $function];
        }

        return $function(...\func_get_args());
    }

    /**
     * Create a Carbon instance from a specific ISO format (same replacements as ->isoFormat()).
     *
     * @param string                                             $format     Datetime format
     * @param string                                             $time
     * @param DateTimeZone|string|false|null                     $tz         optional timezone
     * @param string|null                                        $locale     locale to be used for LTS, LT, LL, LLL, etc. macro-formats (en by fault, unneeded if no such macro-format in use)
     * @param \Symfony\Component\Translation\TranslatorInterface $translator optional custom translator to use for macro-formats
     *
     * @throws InvalidFormatException
     *
     * @return static|false
     */
    public static function createFromIsoFormat($format, $time, $tz = null, $locale = 'en', $translator = null)
    {
        $format = preg_replace_callback('/(?<!\\\\)(\\\\{2})*(LTS|LT|[Ll]{1,4})/', function ($match) use ($locale, $translator) {
            [$code] = $match;

            static $formats = null;

            if ($formats === null) {
                $translator = $translator ?: Translator::get($locale);

                $formats = [
                    'LT' => static::getTranslationMessageWith($translator, 'formats.LT', $locale, 'h:mm A'),
                    'LTS' => static::getTranslationMessageWith($translator, 'formats.LTS', $locale, 'h:mm:ss A'),
                    'L' => static::getTranslationMessageWith($translator, 'formats.L', $locale, 'MM/DD/YYYY'),
                    'LL' => static::getTranslationMessageWith($translator, 'formats.LL', $locale, 'MMMM D, YYYY'),
                    'LLL' => static::getTranslationMessageWith($translator, 'formats.LLL', $locale, 'MMMM D, YYYY h:mm A'),
                    'LLLL' => static::getTranslationMessageWith($translator, 'formats.LLLL', $locale, 'dddd, MMMM D, YYYY h:mm A'),
                ];
            }

            return $formats[$code] ?? preg_replace_callback(
                '/MMMM|MM|DD|dddd/',
                function ($code) {
                    return mb_substr($code[0], 1);
                },
                $formats[strtoupper($code)] ?? ''
            );
        }, $format);

        $format = preg_replace_callback('/(?<!\\\\)(\\\\{2})*('.CarbonInterface::ISO_FORMAT_REGEXP.'|[A-Za-z])/', function ($match) {
            [$code] = $match;

            static $replacements = null;

            if ($replacements === null) {
                $replacements = [
                    'OD' => 'd',
                    'OM' => 'M',
                    'OY' => 'Y',
                    'OH' => 'G',
                    'Oh' => 'g',
                    'Om' => 'i',
                    'Os' => 's',
                    'D' => 'd',
                    'DD' => 'd',
                    'Do' => 'd',
                    'd' => '!',
                    'dd' => '!',
                    'ddd' => 'D',
                    'dddd' => 'D',
                    'DDD' => 'z',
                    'DDDD' => 'z',
                    'DDDo' => 'z',
                    'e' => '!',
                    'E' => '!',
                    'H' => 'G',
                    'HH' => 'H',
                    'h' => 'g',
                    'hh' => 'h',
                    'k' => 'G',
                    'kk' => 'G',
                    'hmm' => 'gi',
                    'hmmss' => 'gis',
                    'Hmm' => 'Gi',
                    'Hmmss' => 'Gis',
                    'm' => 'i',
                    'mm' => 'i',
                    'a' => 'a',
                    'A' => 'a',
                    's' => 's',
                    'ss' => 's',
                    'S' => '*',
                    'SS' => '*',
                    'SSS' => '*',
                    'SSSS' => '*',
                    'SSSSS' => '*',
                    'SSSSSS' => 'u',
                    'SSSSSSS' => 'u*',
                    'SSSSSSSS' => 'u*',
                    'SSSSSSSSS' => 'u*',
                    'M' => 'm',
                    'MM' => 'm',
                    'MMM' => 'M',
                    'MMMM' => 'M',
                    'Mo' => 'm',
                    'Q' => '!',
                    'Qo' => '!',
                    'G' => '!',
                    'GG' => '!',
                    'GGG' => '!',
                    'GGGG' => '!',
                    'GGGGG' => '!',
                    'g' => '!',
                    'gg' => '!',
                    'ggg' => '!',
                    'gggg' => '!',
                    'ggggg' => '!',
                    'W' => '!',
                    'WW' => '!',
                    'Wo' => '!',
                    'w' => '!',
                    'ww' => '!',
                    'wo' => '!',
                    'x' => 'U???',
                    'X' => 'U',
                    'Y' => 'Y',
                    'YY' => 'y',
                    'YYYY' => 'Y',
                    'YYYYY' => 'Y',
                    'YYYYYY' => 'Y',
                    'z' => 'e',
                    'zz' => 'e',
                    'Z' => 'e',
                    'ZZ' => 'e',
                ];
            }

            $format = $replacements[$code] ?? '?';

            if ($format === '!') {
                throw new InvalidFormatException("Format $code not supported for creation.");
            }

            return $format;
        }, $format);

        return static::rawCreateFromFormat($format, $time, $tz);
    }

    /**
     * Create a Carbon instance from a specific format and a string in a given language.
     *
     * @param string                         $format Datetime format
     * @param string                         $locale
     * @param string                         $time
     * @param DateTimeZone|string|false|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static|false
     */
    public static function createFromLocaleFormat($format, $locale, $time, $tz = null)
    {
        return static::rawCreateFromFormat($format, static::translateTimeString($time, $locale, 'en'), $tz);
    }

    /**
     * Create a Carbon instance from a specific ISO format and a string in a given language.
     *
     * @param string                         $format Datetime ISO format
     * @param string                         $locale
     * @param string                         $time
     * @param DateTimeZone|string|false|null $tz
     *
     * @throws InvalidFormatException
     *
     * @return static|false
     */
    public static function createFromLocaleIsoFormat($format, $locale, $time, $tz = null)
    {
        $time = static::translateTimeString($time, $locale, 'en', CarbonInterface::TRANSLATE_MONTHS | CarbonInterface::TRANSLATE_DAYS | CarbonInterface::TRANSLATE_MERIDIEM);

        return static::createFromIsoFormat($format, $time, $tz, $locale);
    }

    /**
     * Make a Carbon instance from given variable if possible.
     *
     * Always return a new instance. Parse only strings and only these likely to be dates (skip intervals
     * and recurrences). Throw an exception for invalid format, but otherwise return null.
     *
     * @param mixed $var
     *
     * @throws InvalidFormatException
     *
     * @return static|null
     */
    public static function make($var)
    {
        if ($var instanceof DateTimeInterface) {
            return static::instance($var);
        }

        $date = null;

        if (\is_string($var)) {
            $var = trim($var);

            if (!preg_match('/^P[0-9T]/', $var) &&
                !preg_match('/^R[0-9]/', $var) &&
                preg_match('/[a-z0-9]/i', $var)
            ) {
                $date = static::parse($var);
            }
        }

        return $date;
    }

    /**
     * Set last errors.
     *
     * @param array $lastErrors
     *
     * @return void
     */
    private static function setLastErrors(array $lastErrors)
    {
        static::$lastErrors = $lastErrors;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    #[ReturnTypeWillChange]
    public static function getLastErrors()
    {
        return static::$lastErrors;
    }
}
