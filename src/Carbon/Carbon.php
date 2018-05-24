<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

use Carbon\Exceptions\InvalidDateException;
use Closure;
use DatePeriod;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use InvalidArgumentException;
use JsonSerializable;
use ReflectionException;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * A simple API extension for DateTime.
 *
 * @property      int $year
 * @property      int $yearIso
 * @property      int $month
 * @property      int $day
 * @property      int $hour
 * @property      int $minute
 * @property      int $second
 * @property      int $micro
 * @property      int $timestamp seconds since the Unix Epoch
 * @property      int $age does a diffInYears() with default parameters
 * @property      int $offsetHours the timezone offset in hours from UTC
 * @property      \DateTimeZone $timezone the current timezone
 * @property      \DateTimeZone $tz alias of $timezone
 * @property-read int $dayOfWeek 0 (for Sunday) through 6 (for Saturday)
 * @property-read int $dayOfWeekIso 1 (for Monday) through 7 (for Sunday)
 * @property-read int $dayOfYear 0 through 365
 * @property-read int $weekOfYear ISO-8601 week number of year, weeks starting on Monday
 * @property-read int $daysInMonth number of days in the given month
 * @property-read int $weekOfMonth 1 through 5
 * @property-read int $weekNumberInMonth 1 through 5
 * @property-read int $quarter the quarter of this instance, 1 - 4
 * @property-read int $decade the decade of this instance
 * @property-read int $century the century of this instance
 * @property-read int $millennium the millennium of this instance
 * @property-read int $offset the timezone offset in seconds from UTC
 * @property-read bool $dst daylight savings time indicator, true if DST, false otherwise
 * @property-read bool $local checks if the timezone is local, true if local, false otherwise
 * @property-read bool $utc checks if the timezone is UTC, true if UTC, false otherwise
 * @property-read \DateTimeZone $timezoneName the current timezone name
 * @property-read \DateTimeZone $tzName alias of $timezoneName
 *
 * @method bool isCurrentMonth() Checks if the instance is in the same month as the current moment.
 * @method bool isCurrentQuarter() Checks if the instance is in the same quarter as the current moment.
 * @method bool isSameDecade(\DateTimeInterface $date = null) Checks if the given date is in the same decade as the instance. If null passed, compare to now (with the same timezone).
 * @method bool isCurrentDecade() Checks if the instance is in the same decade as the current moment.
 * @method bool isSameCentury(\DateTimeInterface $date = null) Checks if the given date is in the same century as the instance. If null passed, compare to now (with the same timezone).
 * @method bool isCurrentCentury() Checks if the instance is in the same century as the current moment.
 * @method bool isSameMillennium(\DateTimeInterface $date = null) Checks if the given date is in the same millennium as the instance. If null passed, compare to now (with the same timezone).
 * @method bool isCurrentMillennium() Checks if the instance is in the same millennium as the current moment.
 * @method bool isSameYear(\DateTimeInterface $date = null) Checks if the given date is in the same year as the instance. If null passed, compare to now (with the same timezone).
 * @method bool isCurrentYear() Checks if the instance is in the same year as the current moment.
 * @method bool isSameDay(\DateTimeInterface $date = null) Checks if the given date is in the same day as the instance. If null passed, compare to now (with the same timezone).
 * @method bool isCurrentDay() Checks if the instance is in the same day as the current moment.
 * @method bool isSameHour(\DateTimeInterface $date = null) Checks if the given date is in the same hour as the instance. If null passed, compare to now (with the same timezone).
 * @method bool isCurrentHour() Checks if the instance is in the same hour as the current moment.
 * @method bool isSameMinute(\DateTimeInterface $date = null) Checks if the given date is in the same minute as the instance. If null passed, compare to now (with the same timezone).
 * @method bool isCurrentMinute() Checks if the instance is in the same minute as the current moment.
 * @method bool isSameSecond(\DateTimeInterface $date = null) Checks if the given date is in the same second as the instance. If null passed, compare to now (with the same timezone).
 * @method bool isCurrentSecond() Checks if the instance is in the same second as the current moment.
 * @method $this years(int $value) Set current instance year to the given value.
 * @method $this year(int $value) Set current instance year to the given value.
 * @method $this setYears(int $value) Set current instance year to the given value.
 * @method $this setYear(int $value) Set current instance year to the given value.
 * @method $this months(int $value) Set current instance month to the given value.
 * @method $this month(int $value) Set current instance month to the given value.
 * @method $this setMonths(int $value) Set current instance month to the given value.
 * @method $this setMonth(int $value) Set current instance month to the given value.
 * @method $this days(int $value) Set current instance day to the given value.
 * @method $this day(int $value) Set current instance day to the given value.
 * @method $this setDays(int $value) Set current instance day to the given value.
 * @method $this setDay(int $value) Set current instance day to the given value.
 * @method $this hours(int $value) Set current instance hour to the given value.
 * @method $this hour(int $value) Set current instance hour to the given value.
 * @method $this setHours(int $value) Set current instance hour to the given value.
 * @method $this setHour(int $value) Set current instance hour to the given value.
 * @method $this minutes(int $value) Set current instance minute to the given value.
 * @method $this minute(int $value) Set current instance minute to the given value.
 * @method $this setMinutes(int $value) Set current instance minute to the given value.
 * @method $this setMinute(int $value) Set current instance minute to the given value.
 * @method $this seconds(int $value) Set current instance second to the given value.
 * @method $this second(int $value) Set current instance second to the given value.
 * @method $this setSeconds(int $value) Set current instance second to the given value.
 * @method $this setSecond(int $value) Set current instance second to the given value.
 * @method $this addYears(int $value = 1) Add years (the $value count passed in) to the instance (using date interval).
 * @method $this addYear() Add one year to the instance (using date interval).
 * @method $this subYears(int $value = 1) Sub years (the $value count passed in) to the instance (using date interval).
 * @method $this subYear() Sub one year to the instance (using date interval).
 * @method $this addYearsWithOverflow(int $value = 1) Add years (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addYearWithOverflow() Add one year to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subYearsWithOverflow(int $value = 1) Sub years (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subYearWithOverflow() Sub one year to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addYearsWithoutOverflow(int $value = 1) Add years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addYearWithoutOverflow() Add one year to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subYearsWithoutOverflow(int $value = 1) Sub years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subYearWithoutOverflow() Sub one year to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addYearsWithNoOverflow(int $value = 1) Add years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addYearWithNoOverflow() Add one year to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subYearsWithNoOverflow(int $value = 1) Sub years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subYearWithNoOverflow() Sub one year to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addYearsNoOverflow(int $value = 1) Add years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addYearNoOverflow() Add one year to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subYearsNoOverflow(int $value = 1) Sub years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subYearNoOverflow() Sub one year to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMonths(int $value = 1) Add months (the $value count passed in) to the instance (using date interval).
 * @method $this addMonth() Add one month to the instance (using date interval).
 * @method $this subMonths(int $value = 1) Sub months (the $value count passed in) to the instance (using date interval).
 * @method $this subMonth() Sub one month to the instance (using date interval).
 * @method $this addMonthsWithOverflow(int $value = 1) Add months (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addMonthWithOverflow() Add one month to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subMonthsWithOverflow(int $value = 1) Sub months (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subMonthWithOverflow() Sub one month to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addMonthsWithoutOverflow(int $value = 1) Add months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMonthWithoutOverflow() Add one month to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMonthsWithoutOverflow(int $value = 1) Sub months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMonthWithoutOverflow() Sub one month to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMonthsWithNoOverflow(int $value = 1) Add months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMonthWithNoOverflow() Add one month to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMonthsWithNoOverflow(int $value = 1) Sub months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMonthWithNoOverflow() Sub one month to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMonthsNoOverflow(int $value = 1) Add months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMonthNoOverflow() Add one month to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMonthsNoOverflow(int $value = 1) Sub months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMonthNoOverflow() Sub one month to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addDays(int $value = 1) Add days (the $value count passed in) to the instance (using date interval).
 * @method $this addDay() Add one day to the instance (using date interval).
 * @method $this subDays(int $value = 1) Sub days (the $value count passed in) to the instance (using date interval).
 * @method $this subDay() Sub one day to the instance (using date interval).
 * @method $this addHours(int $value = 1) Add hours (the $value count passed in) to the instance (using date interval).
 * @method $this addHour() Add one hour to the instance (using date interval).
 * @method $this subHours(int $value = 1) Sub hours (the $value count passed in) to the instance (using date interval).
 * @method $this subHour() Sub one hour to the instance (using date interval).
 * @method $this addMinutes(int $value = 1) Add minutes (the $value count passed in) to the instance (using date interval).
 * @method $this addMinute() Add one minute to the instance (using date interval).
 * @method $this subMinutes(int $value = 1) Sub minutes (the $value count passed in) to the instance (using date interval).
 * @method $this subMinute() Sub one minute to the instance (using date interval).
 * @method $this addSeconds(int $value = 1) Add seconds (the $value count passed in) to the instance (using date interval).
 * @method $this addSecond() Add one second to the instance (using date interval).
 * @method $this subSeconds(int $value = 1) Sub seconds (the $value count passed in) to the instance (using date interval).
 * @method $this subSecond() Sub one second to the instance (using date interval).
 * @method $this addMillennia(int $value = 1) Add millennia (the $value count passed in) to the instance (using date interval).
 * @method $this addMillennium() Add one millennium to the instance (using date interval).
 * @method $this subMillennia(int $value = 1) Sub millennia (the $value count passed in) to the instance (using date interval).
 * @method $this subMillennium() Sub one millennium to the instance (using date interval).
 * @method $this addMillenniaWithOverflow(int $value = 1) Add millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addMillenniumWithOverflow() Add one millennium to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subMillenniaWithOverflow(int $value = 1) Sub millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subMillenniumWithOverflow() Sub one millennium to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addMillenniaWithoutOverflow(int $value = 1) Add millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMillenniumWithoutOverflow() Add one millennium to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMillenniaWithoutOverflow(int $value = 1) Sub millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMillenniumWithoutOverflow() Sub one millennium to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMillenniaWithNoOverflow(int $value = 1) Add millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMillenniumWithNoOverflow() Add one millennium to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMillenniaWithNoOverflow(int $value = 1) Sub millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMillenniumWithNoOverflow() Sub one millennium to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMillenniaNoOverflow(int $value = 1) Add millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addMillenniumNoOverflow() Add one millennium to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMillenniaNoOverflow(int $value = 1) Sub millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subMillenniumNoOverflow() Sub one millennium to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addCenturies(int $value = 1) Add centuries (the $value count passed in) to the instance (using date interval).
 * @method $this addCentury() Add one century to the instance (using date interval).
 * @method $this subCenturies(int $value = 1) Sub centuries (the $value count passed in) to the instance (using date interval).
 * @method $this subCentury() Sub one century to the instance (using date interval).
 * @method $this addCenturiesWithOverflow(int $value = 1) Add centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addCenturyWithOverflow() Add one century to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subCenturiesWithOverflow(int $value = 1) Sub centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subCenturyWithOverflow() Sub one century to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addCenturiesWithoutOverflow(int $value = 1) Add centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addCenturyWithoutOverflow() Add one century to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subCenturiesWithoutOverflow(int $value = 1) Sub centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subCenturyWithoutOverflow() Sub one century to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addCenturiesWithNoOverflow(int $value = 1) Add centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addCenturyWithNoOverflow() Add one century to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subCenturiesWithNoOverflow(int $value = 1) Sub centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subCenturyWithNoOverflow() Sub one century to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addCenturiesNoOverflow(int $value = 1) Add centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addCenturyNoOverflow() Add one century to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subCenturiesNoOverflow(int $value = 1) Sub centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subCenturyNoOverflow() Sub one century to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addDecades(int $value = 1) Add decades (the $value count passed in) to the instance (using date interval).
 * @method $this addDecade() Add one decade to the instance (using date interval).
 * @method $this subDecades(int $value = 1) Sub decades (the $value count passed in) to the instance (using date interval).
 * @method $this subDecade() Sub one decade to the instance (using date interval).
 * @method $this addDecadesWithOverflow(int $value = 1) Add decades (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addDecadeWithOverflow() Add one decade to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subDecadesWithOverflow(int $value = 1) Sub decades (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subDecadeWithOverflow() Sub one decade to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addDecadesWithoutOverflow(int $value = 1) Add decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addDecadeWithoutOverflow() Add one decade to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subDecadesWithoutOverflow(int $value = 1) Sub decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subDecadeWithoutOverflow() Sub one decade to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addDecadesWithNoOverflow(int $value = 1) Add decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addDecadeWithNoOverflow() Add one decade to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subDecadesWithNoOverflow(int $value = 1) Sub decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subDecadeWithNoOverflow() Sub one decade to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addDecadesNoOverflow(int $value = 1) Add decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addDecadeNoOverflow() Add one decade to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subDecadesNoOverflow(int $value = 1) Sub decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subDecadeNoOverflow() Sub one decade to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addQuarters(int $value = 1) Add quarters (the $value count passed in) to the instance (using date interval).
 * @method $this addQuarter() Add one quarter to the instance (using date interval).
 * @method $this subQuarters(int $value = 1) Sub quarters (the $value count passed in) to the instance (using date interval).
 * @method $this subQuarter() Sub one quarter to the instance (using date interval).
 * @method $this addQuartersWithOverflow(int $value = 1) Add quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addQuarterWithOverflow() Add one quarter to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subQuartersWithOverflow(int $value = 1) Sub quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.
 * @method $this subQuarterWithOverflow() Sub one quarter to the instance (using date interval) with overflow explicitly allowed.
 * @method $this addQuartersWithoutOverflow(int $value = 1) Add quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addQuarterWithoutOverflow() Add one quarter to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subQuartersWithoutOverflow(int $value = 1) Sub quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subQuarterWithoutOverflow() Sub one quarter to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addQuartersWithNoOverflow(int $value = 1) Add quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addQuarterWithNoOverflow() Add one quarter to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subQuartersWithNoOverflow(int $value = 1) Sub quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subQuarterWithNoOverflow() Sub one quarter to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addQuartersNoOverflow(int $value = 1) Add quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addQuarterNoOverflow() Add one quarter to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subQuartersNoOverflow(int $value = 1) Sub quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this subQuarterNoOverflow() Sub one quarter to the instance (using date interval) with overflow explicitly forbidden.
 * @method $this addWeeks(int $value = 1) Add weeks (the $value count passed in) to the instance (using date interval).
 * @method $this addWeek() Add one week to the instance (using date interval).
 * @method $this subWeeks(int $value = 1) Sub weeks (the $value count passed in) to the instance (using date interval).
 * @method $this subWeek() Sub one week to the instance (using date interval).
 * @method $this addWeekdays(int $value = 1) Add weekdays (the $value count passed in) to the instance (using date interval).
 * @method $this addWeekday() Add one weekday to the instance (using date interval).
 * @method $this subWeekdays(int $value = 1) Sub weekdays (the $value count passed in) to the instance (using date interval).
 * @method $this subWeekday() Sub one weekday to the instance (using date interval).
 * @method $this addRealSeconds(int $value = 1) Add seconds (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealSecond() Add one second to the instance (using timestamp).
 * @method $this subRealSeconds(int $value = 1) Sub seconds (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealSecond() Sub one second to the instance (using timestamp).
 * @method $this addRealMinutes(int $value = 1) Add minutes (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealMinute() Add one minute to the instance (using timestamp).
 * @method $this subRealMinutes(int $value = 1) Sub minutes (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealMinute() Sub one minute to the instance (using timestamp).
 * @method $this addRealHours(int $value = 1) Add hours (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealHour() Add one hour to the instance (using timestamp).
 * @method $this subRealHours(int $value = 1) Sub hours (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealHour() Sub one hour to the instance (using timestamp).
 * @method $this addRealDays(int $value = 1) Add days (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealDay() Add one day to the instance (using timestamp).
 * @method $this subRealDays(int $value = 1) Sub days (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealDay() Sub one day to the instance (using timestamp).
 * @method $this addRealWeeks(int $value = 1) Add weeks (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealWeek() Add one week to the instance (using timestamp).
 * @method $this subRealWeeks(int $value = 1) Sub weeks (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealWeek() Sub one week to the instance (using timestamp).
 * @method $this addRealMonths(int $value = 1) Add months (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealMonth() Add one month to the instance (using timestamp).
 * @method $this subRealMonths(int $value = 1) Sub months (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealMonth() Sub one month to the instance (using timestamp).
 * @method $this addRealQuarters(int $value = 1) Add quarters (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealQuarter() Add one quarter to the instance (using timestamp).
 * @method $this subRealQuarters(int $value = 1) Sub quarters (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealQuarter() Sub one quarter to the instance (using timestamp).
 * @method $this addRealYears(int $value = 1) Add years (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealYear() Add one year to the instance (using timestamp).
 * @method $this subRealYears(int $value = 1) Sub years (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealYear() Sub one year to the instance (using timestamp).
 * @method $this addRealDecades(int $value = 1) Add decades (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealDecade() Add one decade to the instance (using timestamp).
 * @method $this subRealDecades(int $value = 1) Sub decades (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealDecade() Sub one decade to the instance (using timestamp).
 * @method $this addRealCenturies(int $value = 1) Add centuries (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealCentury() Add one century to the instance (using timestamp).
 * @method $this subRealCenturies(int $value = 1) Sub centuries (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealCentury() Sub one century to the instance (using timestamp).
 * @method $this addRealMillennia(int $value = 1) Add millennia (the $value count passed in) to the instance (using timestamp).
 * @method $this addRealMillennium() Add one millennium to the instance (using timestamp).
 * @method $this subRealMillennia(int $value = 1) Sub millennia (the $value count passed in) to the instance (using timestamp).
 * @method $this subRealMillennium() Sub one millennium to the instance (using timestamp).
 */
class Carbon extends DateTime implements JsonSerializable
{
    const NO_ZERO_DIFF = 01;
    const JUST_NOW = 02;
    const ONE_DAY_WORDS = 04;
    const TWO_DAY_WORDS = 010;

    /**
     * The day constants.
     */
    const SUNDAY = 0;
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;

    /**
     * Names of days of the week.
     *
     * @var array
     */
    protected static $days = [
        self::SUNDAY => 'Sunday',
        self::MONDAY => 'Monday',
        self::TUESDAY => 'Tuesday',
        self::WEDNESDAY => 'Wednesday',
        self::THURSDAY => 'Thursday',
        self::FRIDAY => 'Friday',
        self::SATURDAY => 'Saturday',
    ];

    /**
     * Number of X in Y.
     */
    const YEARS_PER_MILLENNIUM = 1000;
    const YEARS_PER_CENTURY = 100;
    const YEARS_PER_DECADE = 10;
    const MONTHS_PER_YEAR = 12;
    const MONTHS_PER_QUARTER = 3;
    const WEEKS_PER_YEAR = 52;
    const WEEKS_PER_MONTH = 4;
    const DAYS_PER_WEEK = 7;
    const HOURS_PER_DAY = 24;
    const MINUTES_PER_HOUR = 60;
    const SECONDS_PER_MINUTE = 60;

    /**
     * RFC7231 DateTime format.
     *
     * @var string
     */
    const RFC7231_FORMAT = 'D, d M Y H:i:s \G\M\T';

    /**
     * Default format to use for __toString method when type juggling occurs.
     *
     * @var string
     */
    const DEFAULT_TO_STRING_FORMAT = 'Y-m-d H:i:s';

    /**
     * Format for converting mocked time, includes microseconds.
     *
     * @var string
     */
    const MOCK_DATETIME_FORMAT = 'Y-m-d H:i:s.u';

    /**
     * Customizable PHP_INT_SIZE override.
     *
     * @var int
     */
    public static $PHPIntSize = PHP_INT_SIZE;

    /**
     * Format to use for __toString method when type juggling occurs.
     *
     * @var string
     */
    protected static $toStringFormat = self::DEFAULT_TO_STRING_FORMAT;

    /**
     * First day of week.
     *
     * @var int
     */
    protected static $weekStartsAt = self::MONDAY;

    /**
     * Last day of week.
     *
     * @var int
     */
    protected static $weekEndsAt = self::SUNDAY;

    /**
     * Days of weekend.
     *
     * @var array
     */
    protected static $weekendDays = [
        self::SATURDAY,
        self::SUNDAY,
    ];

    /**
     * Midday/noon hour.
     *
     * @var int
     */
    protected static $midDayAt = 12;

    /**
     * Format regex patterns.
     *
     * @var array
     */
    protected static $regexFormats = [
        'd' => '(3[01]|[12][0-9]|0[1-9])',
        'D' => '([a-zA-Z]{3})',
        'j' => '([123][0-9]|[1-9])',
        'l' => '([a-zA-Z]{2,})',
        'N' => '([1-7])',
        'S' => '([a-zA-Z]{2})',
        'w' => '([0-6])',
        'z' => '(36[0-5]|3[0-5][0-9]|[12][0-9]{2}|[1-9]?[0-9])',
        'W' => '(5[012]|[1-4][0-9]|[1-9])',
        'F' => '([a-zA-Z]{2,})',
        'm' => '(1[012]|0[1-9])',
        'M' => '([a-zA-Z]{3})',
        'n' => '(1[012]|[1-9])',
        't' => '(2[89]|3[01])',
        'L' => '(0|1)',
        'o' => '([1-9][0-9]{0,4})',
        'Y' => '([1-9][0-9]{0,4})',
        'y' => '([0-9]{2})',
        'a' => '(am|pm)',
        'A' => '(AM|PM)',
        'B' => '([0-9]{3})',
        'g' => '(1[012]|[1-9])',
        'G' => '(2[0-3]|1?[0-9])',
        'h' => '(1[012]|0[1-9])',
        'H' => '(2[0-3]|[01][0-9])',
        'i' => '([0-5][0-9])',
        's' => '([0-5][0-9])',
        'u' => '([0-9]{1,6})',
        'v' => '([0-9]{1,3})',
        'e' => '([a-zA-Z]{1,5})|([a-zA-Z]*\/[a-zA-Z]*)',
        'I' => '(0|1)',
        'O' => '([\+\-](1[012]|0[0-9])[0134][05])',
        'P' => '([\+\-](1[012]|0[0-9]):[0134][05])',
        'T' => '([a-zA-Z]{1,5})',
        'Z' => '(-?[1-5]?[0-9]{1,4})',
        'U' => '([0-9]*)',

        // The formats below are combinations of the above formats.
        'c' => '(([1-9][0-9]{0,4})\-(1[012]|0[1-9])\-(3[01]|[12][0-9]|0[1-9])T(2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])[\+\-](1[012]|0[0-9]):([0134][05]))', // Y-m-dTH:i:sP
        'r' => '(([a-zA-Z]{3}), ([123][0-9]|[1-9]) ([a-zA-Z]{3}) ([1-9][0-9]{0,4}) (2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9]) [\+\-](1[012]|0[0-9])([0134][05]))', // D, j M Y H:i:s O
    ];

    /**
     * A test Carbon instance to be returned when now instances are created.
     *
     * @var \Carbon\Carbon
     */
    protected static $testNow;

    /**
     * A translator to ... er ... translate stuff.
     *
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected static $translator;

    /**
     * The errors that can occur.
     *
     * @var array
     */
    protected static $lastErrors;

    /**
     * The custom Carbon JSON serializer.
     *
     * @var callable|null
     */
    protected static $serializer;

    /**
     * The registered string macros.
     *
     * @var array
     */
    protected static $localMacros = [];

    /**
     * Will UTF8 encoding be used to print localized date/time ?
     *
     * @var bool
     */
    protected static $utf8 = false;

    /**
     * Add microseconds to now on PHP < 7.1 and 7.1.3. true by default.
     *
     * @var bool
     */
    protected static $microsecondsFallback = true;

    /**
     * Indicates if months should be calculated with overflow.
     *
     * @var bool
     */
    protected static $monthsOverflow = true;

    /**
     * Indicates if years should be calculated with overflow.
     *
     * @var bool
     */
    protected static $yearsOverflow = true;

    /**
     * Options for diffForHumans().
     *
     * @var int
     */
    protected static $humanDiffOptions = self::NO_ZERO_DIFF;

    /**
     * @param int $humanDiffOptions
     */
    public static function setHumanDiffOptions($humanDiffOptions)
    {
        static::$humanDiffOptions = $humanDiffOptions;
    }

    /**
     * @param int $humanDiffOption
     */
    public static function enableHumanDiffOption($humanDiffOption)
    {
        static::$humanDiffOptions = static::getHumanDiffOptions() | $humanDiffOption;
    }

    /**
     * @param int $humanDiffOption
     */
    public static function disableHumanDiffOption($humanDiffOption)
    {
        static::$humanDiffOptions = static::getHumanDiffOptions() & ~$humanDiffOption;
    }

    /**
     * @return int
     */
    public static function getHumanDiffOptions()
    {
        return static::$humanDiffOptions;
    }

    /**
     * Add microseconds to now on PHP < 7.1 and 7.1.3 if set to true,
     * let microseconds to 0 on those PHP versions if false.
     *
     * @param bool $microsecondsFallback
     */
    public static function useMicrosecondsFallback($microsecondsFallback = true)
    {
        static::$microsecondsFallback = $microsecondsFallback;
    }

    /**
     * Return true if microseconds fallback on PHP < 7.1 and 7.1.3 is
     * enabled. false if disabled.
     *
     * @return bool
     */
    public static function isMicrosecondsFallbackEnabled()
    {
        return static::$microsecondsFallback;
    }

    /**
     * Indicates if months should be calculated with overflow.
     *
     * @param bool $monthsOverflow
     *
     * @return void
     */
    public static function useMonthsOverflow($monthsOverflow = true)
    {
        static::$monthsOverflow = $monthsOverflow;
    }

    /**
     * Reset the month overflow behavior.
     *
     * @return void
     */
    public static function resetMonthsOverflow()
    {
        static::$monthsOverflow = true;
    }

    /**
     * Get the month overflow behavior.
     *
     * @return bool
     */
    public static function shouldOverflowMonths()
    {
        return static::$monthsOverflow;
    }

    /**
     * Indicates if years should be calculated with overflow.
     *
     * @param bool $yearsOverflow
     *
     * @return void
     */
    public static function useYearsOverflow($yearsOverflow = true)
    {
        static::$yearsOverflow = $yearsOverflow;
    }

    /**
     * Reset the month overflow behavior.
     *
     * @return void
     */
    public static function resetYearsOverflow()
    {
        static::$yearsOverflow = true;
    }

    /**
     * Get the month overflow behavior.
     *
     * @return bool
     */
    public static function shouldOverflowYears()
    {
        return static::$yearsOverflow;
    }

    /**
     * Creates a DateTimeZone from a string, DateTimeZone or integer offset.
     *
     * @param \DateTimeZone|string|int|null $object
     *
     * @throws \InvalidArgumentException
     *
     * @return \DateTimeZone
     */
    protected static function safeCreateDateTimeZone($object)
    {
        if ($object === null) {
            // Don't return null... avoid Bug #52063 in PHP <5.3.6
            return new DateTimeZone(date_default_timezone_get());
        }

        if ($object instanceof DateTimeZone) {
            return $object;
        }

        if (is_numeric($object)) {
            $tzName = timezone_name_from_abbr(null, $object * 3600, true);

            if ($tzName === false) {
                throw new InvalidArgumentException('Unknown or bad timezone ('.$object.')');
            }

            $object = $tzName;
        }

        $tz = @timezone_open($object = (string) $object);

        if ($tz !== false) {
            return $tz;
        }

        throw new InvalidArgumentException('Unknown or bad timezone ('.$object.')');
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////////// CONSTRUCTORS /////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Create a new Carbon instance.
     *
     * Please see the testing aids section (specifically static::setTestNow())
     * for more on the possibility of this constructor returning a test instance.
     *
     * @param string|null               $time
     * @param \DateTimeZone|string|null $tz
     */
    public function __construct($time = null, $tz = null)
    {
        // If the class has a test now set and we are trying to create a now()
        // instance then override as required
        $isNow = empty($time) || $time === 'now';
        if (static::hasTestNow() && ($isNow || static::hasRelativeKeywords($time))) {
            $testInstance = clone static::getTestNow();

            //shift the time according to the given time zone
            if ($tz !== null && $tz !== static::getTestNow()->getTimezone()) {
                $testInstance->setTimezone($tz);
            } else {
                $tz = $testInstance->getTimezone();
            }

            if (static::hasRelativeKeywords($time)) {
                $testInstance->modify($time);
            }

            $time = $testInstance->format(static::MOCK_DATETIME_FORMAT);
        }

        $timezone = static::safeCreateDateTimeZone($tz);

        // Work-around for PHP bug https://bugs.php.net/bug.php?id=67127
        if (strpos((string) .1, '.') === false) {
            $locale = setlocale(LC_NUMERIC, '0');
            setlocale(LC_NUMERIC, 'C');
        }
        parent::__construct($time, $timezone);
        if (isset($locale)) {
            setlocale(LC_NUMERIC, $locale);
        }
        static::setLastErrors(parent::getLastErrors());
    }

    /**
     * Create a Carbon instance from a DateTime one.
     *
     * @param \DateTimeInterface $date
     *
     * @return static
     */
    public static function instance($date)
    {
        if ($date instanceof static) {
            return clone $date;
        }

        static::expectDateTime($date);

        return new static($date->format('Y-m-d H:i:s.u'), $date->getTimezone());
    }

    /**
     * Create a carbon instance from a string.
     *
     * This is an alias for the constructor that allows better fluent syntax
     * as it allows you to do Carbon::parse('Monday next week')->fn() rather
     * than (new Carbon('Monday next week'))->fn().
     *
     * @param string|null               $time
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function parse($time = null, $tz = null)
    {
        return new static($time, $tz);
    }

    /**
     * Get a Carbon instance for the current date and time.
     *
     * @param \DateTimeZone|string|null $tz
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
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function today($tz = null)
    {
        return static::parse('today', $tz);
    }

    /**
     * Create a Carbon instance for tomorrow.
     *
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function tomorrow($tz = null)
    {
        return static::parse('tomorrow', $tz);
    }

    /**
     * Create a Carbon instance for yesterday.
     *
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function yesterday($tz = null)
    {
        return static::parse('yesterday', $tz);
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
     * @param int|null                  $year
     * @param int|null                  $month
     * @param int|null                  $day
     * @param int|null                  $hour
     * @param int|null                  $minute
     * @param int|null                  $second
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \InvalidArgumentException
     *
     * @return static
     */
    public static function create($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null)
    {
        $now = static::hasTestNow() ? static::getTestNow() : static::now($tz);

        $defaults = array_combine([
            'year',
            'month',
            'day',
            'hour',
            'minute',
            'second',
        ], explode('-', $now->format('Y-n-j-G-i-s')));

        $year = $year === null ? $defaults['year'] : $year;
        $month = $month === null ? $defaults['month'] : $month;
        $day = $day === null ? $defaults['day'] : $day;

        if ($hour === null) {
            $hour = $defaults['hour'];
            $minute = $minute === null ? $defaults['minute'] : $minute;
            $second = $second === null ? $defaults['second'] : $second;
        } else {
            $minute = $minute === null ? 0 : $minute;
            $second = $second === null ? 0 : $second;
        }

        $fixYear = null;

        if ($year < 0) {
            $fixYear = $year;
            $year = 0;
        } elseif ($year > 9999) {
            $fixYear = $year - 9999;
            $year = 9999;
        }

        $instance = static::createFromFormat('!Y-n-j G:i:s', sprintf('%s-%s-%s %s:%02s:%02s', $year, $month, $day, $hour, $minute, $second), $tz);

        if ($fixYear !== null) {
            $instance->addYears($fixYear);
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
     * If one of the set values is not valid, an \InvalidArgumentException
     * will be thrown.
     *
     * @param int|null                  $year
     * @param int|null                  $month
     * @param int|null                  $day
     * @param int|null                  $hour
     * @param int|null                  $minute
     * @param int|null                  $second
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \Carbon\Exceptions\InvalidDateException|\InvalidArgumentException
     *
     * @return static
     */
    public static function createSafe($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null)
    {
        $fields = [
            'year' => [0, 9999],
            'month' => [0, 12],
            'day' => [0, 31],
            'hour' => [0, 24],
            'minute' => [0, 59],
            'second' => [0, 59],
        ];

        foreach ($fields as $field => $range) {
            if ($$field !== null && (!is_int($$field) || $$field < $range[0] || $$field > $range[1])) {
                throw new InvalidDateException($field, $$field);
            }
        }

        $instance = static::create($year, $month, $day, $hour, $minute, $second, $tz);

        foreach (array_reverse($fields) as $field => $range) {
            if ($$field !== null && (!is_int($$field) || $$field !== $instance->$field)) {
                throw new InvalidDateException($field, $$field);
            }
        }

        return $instance;
    }

    /**
     * Create a Carbon instance from just a date. The time portion is set to now.
     *
     * @param int|null                  $year
     * @param int|null                  $month
     * @param int|null                  $day
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \InvalidArgumentException
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
     * @param int|null                  $year
     * @param int|null                  $month
     * @param int|null                  $day
     * @param \DateTimeZone|string|null $tz
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
     * @param int|null                  $hour
     * @param int|null                  $minute
     * @param int|null                  $second
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \InvalidArgumentException
     *
     * @return static
     */
    public static function createFromTime($hour = null, $minute = null, $second = null, $tz = null)
    {
        return static::create(null, null, null, $hour, $minute, $second, $tz);
    }

    /**
     * Create a Carbon instance from a time string. The date portion is set to today.
     *
     * @param string                    $time
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \InvalidArgumentException
     *
     * @return static
     */
    public static function createFromTimeString($time, $tz = null)
    {
        return static::today($tz)->setTimeFromTimeString($time);
    }

    private static function createFromFormatAndTimezone($format, $time, $tz)
    {
        return $tz !== null
            ? parent::createFromFormat($format, $time, static::safeCreateDateTimeZone($tz))
            : parent::createFromFormat($format, $time);
    }

    /**
     * Create a Carbon instance from a specific format.
     *
     * @param string                    $format Datetime format
     * @param string                    $time
     * @param \DateTimeZone|string|null $tz
     *
     * @throws InvalidArgumentException
     *
     * @return static
     */
    public static function createFromFormat($format, $time, $tz = null)
    {
        // First attempt to create an instance, so that error messages are based on the unmodified format.
        $date = self::createFromFormatAndTimezone($format, $time, $tz);
        $lastErrors = parent::getLastErrors();

        if (($mock = static::getTestNow()) && ($date instanceof DateTime || $date instanceof DateTimeInterface)) {
            // Set timezone from mock if custom timezone was neither given directly nor as a part of format.
            // First let's skip the part that will be ignored by the parser.
            $nonEscaped = '(?<!\\\\)(\\\\{2})*';

            $nonIgnored = preg_replace("/^.*{$nonEscaped}!/s", '', $format);

            if ($tz === null && !preg_match("/{$nonEscaped}[eOPT]/", $nonIgnored)) {
                $tz = $mock->getTimezone();
            }

            // Prepend mock datetime only if the format does not contain non escaped unix epoch reset flag.
            if (!preg_match("/{$nonEscaped}[!|]/", $format)) {
                $format = static::MOCK_DATETIME_FORMAT.' '.$format;
                $time = $mock->format(static::MOCK_DATETIME_FORMAT).' '.$time;
            }

            // Regenerate date from the modified format to base result on the mocked instance instead of now.
            $date = self::createFromFormatAndTimezone($format, $time, $tz);
        }

        if ($date instanceof DateTime || $date instanceof DateTimeInterface) {
            $instance = static::instance($date);
            $instance::setLastErrors($lastErrors);

            return $instance;
        }

        throw new InvalidArgumentException(implode(PHP_EOL, $lastErrors['errors']));
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
     */
    public static function getLastErrors()
    {
        return static::$lastErrors;
    }

    /**
     * Create a Carbon instance from a timestamp.
     *
     * @param int                       $timestamp
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromTimestamp($timestamp, $tz = null)
    {
        return static::today($tz)->setTimestamp($timestamp);
    }

    /**
     * Create a Carbon instance from a timestamp in milliseconds.
     *
     * @param int                       $timestamp
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromTimestampMs($timestamp, $tz = null)
    {
        return static::createFromFormat('U.u', sprintf('%F', $timestamp / 1000))
            ->setTimezone($tz);
    }

    /**
     * Create a Carbon instance from an UTC timestamp.
     *
     * @param int $timestamp
     *
     * @return static
     */
    public static function createFromTimestampUTC($timestamp)
    {
        return new static('@'.$timestamp);
    }

    /**
     * Make a Carbon instance from given variable if possible.
     *
     * Always return a new instance. Parse only strings and only these likely to be dates (skip intervals
     * and recurrences). Throw an exception for invalid format, but otherwise return null.
     *
     * @param mixed $var
     *
     * @return static|null
     */
    public static function make($var)
    {
        if ($var instanceof DateTime || $var instanceof DateTimeInterface) {
            return static::instance($var);
        }

        if (is_string($var)) {
            $var = trim($var);
            $first = substr($var, 0, 1);

            if (is_string($var) && $first !== 'P' && $first !== 'R' && preg_match('/[a-z0-9]/i', $var)) {
                return static::parse($var);
            }
        }
    }

    /**
     * Get a copy of the instance.
     *
     * @return static
     */
    public function copy()
    {
        return clone $this;
    }

    /**
     * Returns a present instance in the same timezone.
     *
     * @return static
     */
    public function nowWithSameTz()
    {
        return static::now($this->getTimezone());
    }

    /**
     * Throws an exception if the given object is not a DateTime and does not implement DateTimeInterface.
     *
     * @param mixed $date
     *
     * @throws \InvalidArgumentException
     */
    protected static function expectDateTime($date)
    {
        if (!$date instanceof DateTimeInterface) {
            throw new InvalidArgumentException(
                'Expected null, string, DateTime or DateTimeInterface, '.
                (is_object($date) ? get_class($date) : gettype($date)).' given'
            );
        }
    }

    /**
     * Return the Carbon instance passed through, a now instance in the same timezone
     * if null given or parse the input if string given.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     *
     * @return static
     */
    protected function resolveCarbon($date = null)
    {
        if (!$date) {
            return $this->nowWithSameTz();
        }

        if (is_string($date)) {
            return static::parse($date, $this->getTimezone());
        }

        static::expectDateTime($date);

        return $date instanceof self ? $date : static::instance($date);
    }

    ///////////////////////////////////////////////////////////////////
    ///////////////////////// GETTERS AND SETTERS /////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Get a part of the Carbon object
     *
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return string|int|\DateTimeZone
     */
    public function __get($name)
    {
        static $formats = [
            // @property int
            'year' => 'Y',
            // @property int
            'yearIso' => 'o',
            // @property int
            // @call isSameUnit
            'month' => 'n',
            // @property int
            'day' => 'j',
            // @property int
            'hour' => 'G',
            // @property int
            'minute' => 'i',
            // @property int
            'second' => 's',
            // @property int
            'micro' => 'u',
            // @property-read int 0 (for Sunday) through 6 (for Saturday)
            'dayOfWeek' => 'w',
            // @property-read int 1 (for Monday) through 7 (for Sunday)
            'dayOfWeekIso' => 'N',
            // @property-read int 0 through 365
            'dayOfYear' => 'z',
            // @property-read int ISO-8601 week number of year, weeks starting on Monday
            'weekOfYear' => 'W',
            // @property-read int number of days in the given month
            'daysInMonth' => 't',
            // @property int seconds since the Unix Epoch
            'timestamp' => 'U',
        ];

        switch (true) {
            case isset($formats[$name]):
                return (int) $this->format($formats[$name]);

            // @property-read int 1 through 5
            case $name === 'weekOfMonth':
                return (int) ceil($this->day / static::DAYS_PER_WEEK);

            // @property-read int 1 through 5
            case $name === 'weekNumberInMonth':
                return (int) ceil(($this->day + $this->copy()->startOfMonth()->dayOfWeek - 1) / static::DAYS_PER_WEEK);

            // @property int does a diffInYears() with default parameters
            case $name === 'age':
                return $this->diffInYears();

            // @property-read int the quarter of this instance, 1 - 4
            // @call isSameUnit
            case $name === 'quarter':
                return (int) ceil($this->month / static::MONTHS_PER_QUARTER);

            // @property-read int the decade of this instance
            // @call isSameUnit
            case $name === 'decade':
                return (int) ceil($this->year / static::YEARS_PER_DECADE);

            // @property-read int the century of this instance
            // @call isSameUnit
            case $name === 'century':
                $factor = 0;
                $year = $this->year;
                if ($year < 0) {
                    $year = -$year;
                    $factor = -1;
                }

                return (int) $factor * ceil($year / static::YEARS_PER_CENTURY);

            // @property-read int the millennium of this instance
            // @call isSameUnit
            case $name === 'millennium':
                $factor = 0;
                $year = $this->year;
                if ($year < 0) {
                    $year = -$year;
                    $factor = -1;
                }

                return (int) $factor * ceil($year / static::YEARS_PER_MILLENNIUM);

            // @property-read int the timezone offset in seconds from UTC
            case $name === 'offset':
                return $this->getOffset();

            // @property int the timezone offset in hours from UTC
            case $name === 'offsetHours':
                return $this->getOffset() / static::SECONDS_PER_MINUTE / static::MINUTES_PER_HOUR;

            // @property-read bool daylight savings time indicator, true if DST, false otherwise
            case $name === 'dst':
                return $this->format('I') === '1';

            // @property-read bool checks if the timezone is local, true if local, false otherwise
            case $name === 'local':
                return $this->getOffset() === $this->copy()->setTimezone(date_default_timezone_get())->getOffset();

            // @property-read bool checks if the timezone is UTC, true if UTC, false otherwise
            case $name === 'utc':
                return $this->getOffset() === 0;

            // @property \DateTimeZone $timezone the current timezone
            // @property \DateTimeZone $tz alias of $timezone
            case $name === 'timezone' || $name === 'tz':
                return $this->getTimezone();

            // @property-read \DateTimeZone $timezoneName the current timezone name
            // @property-read \DateTimeZone $tzName alias of $timezoneName
            case $name === 'timezoneName' || $name === 'tzName':
                return $this->getTimezone()->getName();

            default:
                throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
        }
    }

    /**
     * Check if an attribute exists on the object
     *
     * @param string $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        try {
            $this->__get($name);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return true;
    }

    /**
     * Set a part of the Carbon object
     *
     * @param string                   $name
     * @param string|int|\DateTimeZone $value
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function __set($name, $value)
    {
        switch ($name) {
            case 'year':
            case 'month':
            case 'day':
            case 'hour':
            case 'minute':
            case 'second':
                list($year, $month, $day, $hour, $minute, $second) = explode('-', $this->format('Y-n-j-G-i-s'));
                $$name = $value;
                $this->setDateTime($year, $month, $day, $hour, $minute, $second);
                break;

            case 'timestamp':
                parent::setTimestamp($value);
                break;

            case 'timezone':
            case 'tz':
                $this->setTimezone($value);
                break;

            default:
                throw new InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
        }
    }

    /**
     * Sets the current date of the DateTime object to a different date.
     * Calls modify as a workaround for a php bug
     *
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return static
     *
     * @see https://github.com/briannesbitt/Carbon/issues/539
     * @see https://bugs.php.net/bug.php?id=63863
     */
    public function setDate($year, $month, $day)
    {
        $this->modify('+0 day');

        return parent::setDate($year, $month, $day);
    }

    /**
     * Set the date and time all together
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     *
     * @return static
     */
    public function setDateTime($year, $month, $day, $hour, $minute, $second = 0)
    {
        return $this->setDate($year, $month, $day)->setTime($hour, $minute, $second);
    }

    /**
     * Set the time by time string
     *
     * @param string $time
     *
     * @return static
     */
    public function setTimeFromTimeString($time)
    {
        if (strpos($time, ':') === false) {
            $time .= ':0';
        }

        return $this->modify($time);
    }

    /**
     * Set the instance's timestamp
     *
     * @param int $value
     *
     * @return static
     */
    public function timestamp($value)
    {
        return $this->setTimestamp($value);
    }

    /**
     * Alias for setTimezone()
     *
     * @param \DateTimeZone|string $value
     *
     * @return static
     */
    public function timezone($value)
    {
        return $this->setTimezone($value);
    }

    /**
     * Alias for setTimezone()
     *
     * @param \DateTimeZone|string $value
     *
     * @return static
     */
    public function tz($value)
    {
        return $this->setTimezone($value);
    }

    /**
     * Set the instance's timezone from a string or object
     *
     * @param \DateTimeZone|string $value
     *
     * @return static
     */
    public function setTimezone($value)
    {
        parent::setTimezone(static::safeCreateDateTimeZone($value));
        // https://bugs.php.net/bug.php?id=72338
        // just workaround on this bug
        $this->getTimestamp();

        return $this;
    }

    /**
     * Set the year, month, and date for this instance to that of the passed instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface $date
     *
     * @return static
     */
    public function setDateFrom($date)
    {
        $date = static::instance($date);

        $this->setDate($date->year, $date->month, $date->day);

        return $this;
    }

    /**
     * Set the hour, day, and time for this instance to that of the passed instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface $date
     *
     * @return static
     */
    public function setTimeFrom($date)
    {
        $date = static::instance($date);

        $this->setTime($date->hour, $date->minute, $date->second);

        return $this;
    }

    /**
     * Get the days of the week
     *
     * @return array
     */
    public static function getDays()
    {
        return static::$days;
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////// WEEK SPECIAL DAYS /////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Get the first day of week
     *
     * @return int
     */
    public static function getWeekStartsAt()
    {
        return static::$weekStartsAt;
    }

    /**
     * Set the first day of week
     *
     * @param int $day week start day
     *
     * @return void
     */
    public static function setWeekStartsAt($day)
    {
        static::$weekStartsAt = $day;
    }

    /**
     * Get the last day of week
     *
     * @return int
     */
    public static function getWeekEndsAt()
    {
        return static::$weekEndsAt;
    }

    /**
     * Set the last day of week
     *
     * @param int $day
     *
     * @return void
     */
    public static function setWeekEndsAt($day)
    {
        static::$weekEndsAt = $day;
    }

    /**
     * Get weekend days
     *
     * @return array
     */
    public static function getWeekendDays()
    {
        return static::$weekendDays;
    }

    /**
     * Set weekend days
     *
     * @param array $days
     *
     * @return void
     */
    public static function setWeekendDays($days)
    {
        static::$weekendDays = $days;
    }

    /**
     * get midday/noon hour
     *
     * @return int
     */
    public static function getMidDayAt()
    {
        return static::$midDayAt;
    }

    /**
     * Set midday/noon hour
     *
     * @param int $hour midday hour
     *
     * @return void
     */
    public static function setMidDayAt($hour)
    {
        static::$midDayAt = $hour;
    }

    ///////////////////////////////////////////////////////////////////
    ///////////////////////// TESTING AIDS ////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Set a Carbon instance (real or mock) to be returned when a "now"
     * instance is created.  The provided instance will be returned
     * specifically under the following conditions:
     *   - A call to the static now() method, ex. Carbon::now()
     *   - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
     *   - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
     *   - When a string containing the desired time is passed to Carbon::parse().
     *
     * Note the timezone parameter was left out of the examples above and
     * has no affect as the mock value will be returned regardless of its value.
     *
     * To clear the test instance call this method using the default
     * parameter of null.
     *
     * @param \Carbon\Carbon|null        $testNow real or mock Carbon instance
     * @param \Carbon\Carbon|string|null $testNow
     */
    public static function setTestNow($testNow = null)
    {
        static::$testNow = is_string($testNow) ? static::parse($testNow) : $testNow;
    }

    /**
     * Get the Carbon instance (real or mock) to be returned when a "now"
     * instance is created.
     *
     * @return static the current instance used for testing
     */
    public static function getTestNow()
    {
        return static::$testNow;
    }

    /**
     * Determine if there is a valid test instance set. A valid test instance
     * is anything that is not null.
     *
     * @return bool true if there is a test instance, otherwise false
     */
    public static function hasTestNow()
    {
        return static::getTestNow() !== null;
    }

    /**
     * Determine if a time string will produce a relative date.
     *
     * @param string $time
     *
     * @return bool true if time match a relative date, false if absolute or invalid time string
     */
    public static function hasRelativeKeywords($time)
    {
        if (strtotime($time) === false) {
            return false;
        }

        $date1 = new DateTime('2000-01-01T00:00:00Z');
        $date1->modify($time);
        $date2 = new DateTime('2001-12-25T00:00:00Z');
        $date2->modify($time);

        return $date1 != $date2;
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////// LOCALIZATION //////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Initialize the translator instance if necessary.
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    protected static function translator()
    {
        if (static::$translator === null) {
            static::$translator = Translator::get();
        }

        return static::$translator;
    }

    /**
     * Get the translator instance in use
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    public static function getTranslator()
    {
        return static::translator();
    }

    /**
     * Set the translator instance to use
     *
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     *
     * @return void
     */
    public static function setTranslator(TranslatorInterface $translator)
    {
        static::$translator = $translator;
    }

    /**
     * Get the current translator locale
     *
     * @return string
     */
    public static function getLocale()
    {
        return static::translator()->getLocale();
    }

    /**
     * Set the current translator locale and indicate if the source locale file exists
     *
     * @param string $locale locale ex. en
     *
     * @return bool
     */
    public static function setLocale($locale)
    {
        return static::translator()->setLocale($locale) !== false;
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////// STRING FORMATTING /////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Set if UTF8 will be used for localized date/time
     *
     * @param bool $utf8
     */
    public static function setUtf8($utf8)
    {
        static::$utf8 = $utf8;
    }

    /**
     * Format the instance with the current locale.  You can set the current
     * locale using setlocale() http://php.net/setlocale.
     *
     * @param string $format
     *
     * @return string
     */
    public function formatLocalized($format)
    {
        // Check for Windows to find and replace the %e modifier correctly.
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $format = preg_replace('#(?<!%)((?:%%)*)%e#', '\1%#d', $format); // @codeCoverageIgnore
        }

        $formatted = strftime($format, strtotime($this->toDateTimeString()));

        return static::$utf8 ? utf8_encode($formatted) : $formatted;
    }

    /**
     * Reset the format used to the default when type juggling a Carbon instance to a string
     *
     * @return void
     */
    public static function resetToStringFormat()
    {
        static::setToStringFormat(static::DEFAULT_TO_STRING_FORMAT);
    }

    /**
     * Set the default format used when type juggling a Carbon instance to a string
     *
     * @param string $format
     *
     * @return void
     */
    public static function setToStringFormat($format)
    {
        static::$toStringFormat = $format;
    }

    /**
     * Format the instance as a string using the set format
     *
     * @return string
     */
    public function __toString()
    {
        return $this->format(static::$toStringFormat);
    }

    /**
     * Format the instance as date
     *
     * @return string
     */
    public function toDateString()
    {
        return $this->format('Y-m-d');
    }

    /**
     * Format the instance as a readable date
     *
     * @return string
     */
    public function toFormattedDateString()
    {
        return $this->format('M j, Y');
    }

    /**
     * Format the instance as time
     *
     * @return string
     */
    public function toTimeString()
    {
        return $this->format('H:i:s');
    }

    /**
     * Format the instance as date and time
     *
     * @return string
     */
    public function toDateTimeString()
    {
        return $this->format('Y-m-d H:i:s');
    }

    /**
     * Format the instance with day, date and time
     *
     * @return string
     */
    public function toDayDateTimeString()
    {
        return $this->format('D, M j, Y g:i A');
    }

    /**
     * Format the instance as ATOM
     *
     * @return string
     */
    public function toAtomString()
    {
        return $this->format(static::ATOM);
    }

    /**
     * Format the instance as COOKIE
     *
     * @return string
     */
    public function toCookieString()
    {
        return $this->format(static::COOKIE);
    }

    /**
     * Format the instance as ISO8601
     *
     * @return string
     */
    public function toIso8601String()
    {
        return $this->toAtomString();
    }

    /**
     * Format the instance as RFC822
     *
     * @return string
     */
    public function toRfc822String()
    {
        return $this->format(static::RFC822);
    }

    /**
     * Convert the instance to UTC and return as Zulu ISO8601
     *
     * @return string
     */
    public function toIso8601ZuluString()
    {
        return $this->copy()->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
    }

    /**
     * Format the instance as RFC850
     *
     * @return string
     */
    public function toRfc850String()
    {
        return $this->format(static::RFC850);
    }

    /**
     * Format the instance as RFC1036
     *
     * @return string
     */
    public function toRfc1036String()
    {
        return $this->format(static::RFC1036);
    }

    /**
     * Format the instance as RFC1123
     *
     * @return string
     */
    public function toRfc1123String()
    {
        return $this->format(static::RFC1123);
    }

    /**
     * Format the instance as RFC2822
     *
     * @return string
     */
    public function toRfc2822String()
    {
        return $this->format(static::RFC2822);
    }

    /**
     * Format the instance as RFC3339
     *
     * @return string
     */
    public function toRfc3339String()
    {
        return $this->format(static::RFC3339);
    }

    /**
     * Format the instance as RSS
     *
     * @return string
     */
    public function toRssString()
    {
        return $this->format(static::RSS);
    }

    /**
     * Format the instance as W3C
     *
     * @return string
     */
    public function toW3cString()
    {
        return $this->format(static::W3C);
    }

    /**
     * Format the instance as RFC7231
     *
     * @return string
     */
    public function toRfc7231String()
    {
        return $this->copy()
            ->setTimezone('GMT')
            ->format(static::RFC7231_FORMAT);
    }

    /**
     * Get default array representation
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'year' => $this->year,
            'month' => $this->month,
            'day' => $this->day,
            'dayOfWeek' => $this->dayOfWeek,
            'dayOfYear' => $this->dayOfYear,
            'hour' => $this->hour,
            'minute' => $this->minute,
            'second' => $this->second,
            'micro' => $this->micro,
            'timestamp' => $this->timestamp,
            'formatted' => $this->format(self::DEFAULT_TO_STRING_FORMAT),
            'timezone' => $this->timezone,
        ];
    }

    ///////////////////////////////////////////////////////////////////
    ////////////////////////// COMPARISONS ////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Determines if the instance is equal to another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function eq($date)
    {
        return $this == $date;
    }

    /**
     * Determines if the instance is equal to another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see eq()
     *
     * @return bool
     */
    public function equalTo($date)
    {
        return $this->eq($date);
    }

    /**
     * Determines if the instance is not equal to another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function ne($date)
    {
        return !$this->eq($date);
    }

    /**
     * Determines if the instance is not equal to another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see ne()
     *
     * @return bool
     */
    public function notEqualTo($date)
    {
        return $this->ne($date);
    }

    /**
     * Determines if the instance is greater (after) than another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function gt($date)
    {
        return $this > $date;
    }

    /**
     * Determines if the instance is greater (after) than another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see gt()
     *
     * @return bool
     */
    public function greaterThan($date)
    {
        return $this->gt($date);
    }

    /**
     * Determines if the instance is greater (after) than or equal to another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function gte($date)
    {
        return $this >= $date;
    }

    /**
     * Determines if the instance is greater (after) than or equal to another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see gte()
     *
     * @return bool
     */
    public function greaterThanOrEqualTo($date)
    {
        return $this->gte($date);
    }

    /**
     * Determines if the instance is less (before) than another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function lt($date)
    {
        return $this < $date;
    }

    /**
     * Determines if the instance is less (before) than another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see lt()
     *
     * @return bool
     */
    public function lessThan($date)
    {
        return $this->lt($date);
    }

    /**
     * Determines if the instance is less (before) or equal to another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function lte($date)
    {
        return $this <= $date;
    }

    /**
     * Determines if the instance is less (before) or equal to another
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see lte()
     *
     * @return bool
     */
    public function lessThanOrEqualTo($date)
    {
        return $this->lte($date);
    }

    /**
     * Determines if the instance is between two others
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date1
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date2
     * @param bool                                    $equal Indicates if an equal to comparison should be done
     *
     * @return bool
     */
    public function between($date1, $date2, $equal = true)
    {
        if ($date1->gt($date2)) {
            $temp = $date1;
            $date1 = $date2;
            $date2 = $temp;
        }

        if ($equal) {
            return $this->gte($date1) && $this->lte($date2);
        }

        return $this->gt($date1) && $this->lt($date2);
    }

    /**
     * Get the closest date from the instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date1
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date2
     *
     * @return static
     */
    public function closest($date1, $date2)
    {
        return $this->diffInSeconds($date1) < $this->diffInSeconds($date2) ? $date1 : $date2;
    }

    /**
     * Get the farthest date from the instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date1
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date2
     *
     * @return static
     */
    public function farthest($date1, $date2)
    {
        return $this->diffInSeconds($date1) > $this->diffInSeconds($date2) ? $date1 : $date2;
    }

    /**
     * Get the minimum instance between a given instance (default now) and the current instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return static
     */
    public function min($date = null)
    {
        $date = $this->resolveCarbon($date);

        return $this->lt($date) ? $this : $date;
    }

    /**
     * Get the minimum instance between a given instance (default now) and the current instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see min()
     *
     * @return static
     */
    public function minimum($date = null)
    {
        return $this->min($date);
    }

    /**
     * Get the maximum instance between a given instance (default now) and the current instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return static
     */
    public function max($date = null)
    {
        $date = $this->resolveCarbon($date);

        return $this->gt($date) ? $this : $date;
    }

    /**
     * Get the maximum instance between a given instance (default now) and the current instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see max()
     *
     * @return static
     */
    public function maximum($date = null)
    {
        return $this->max($date);
    }

    /**
     * Determines if the instance is a weekday.
     *
     * @return bool
     */
    public function isWeekday()
    {
        return !$this->isWeekend();
    }

    /**
     * Determines if the instance is a weekend day.
     *
     * @return bool
     */
    public function isWeekend()
    {
        return in_array($this->dayOfWeek, static::$weekendDays);
    }

    /**
     * Determines if the instance is yesterday.
     *
     * @return bool
     */
    public function isYesterday()
    {
        return $this->toDateString() === static::yesterday($this->getTimezone())->toDateString();
    }

    /**
     * Determines if the instance is today.
     *
     * @return bool
     */
    public function isToday()
    {
        return $this->toDateString() === $this->nowWithSameTz()->toDateString();
    }

    /**
     * Determines if the instance is tomorrow.
     *
     * @return bool
     */
    public function isTomorrow()
    {
        return $this->toDateString() === static::tomorrow($this->getTimezone())->toDateString();
    }

    /**
     * Determines if the instance is within the next week.
     *
     * @return bool
     */
    public function isNextWeek()
    {
        return $this->weekOfYear === $this->nowWithSameTz()->addWeek()->weekOfYear;
    }

    /**
     * Determines if the instance is within the last week.
     *
     * @return bool
     */
    public function isLastWeek()
    {
        return $this->weekOfYear === $this->nowWithSameTz()->subWeek()->weekOfYear;
    }

    /**
     * Determines if the instance is within the next quarter.
     *
     * @return bool
     */
    public function isNextQuarter()
    {
        return $this->quarter === $this->nowWithSameTz()->addQuarter()->quarter;
    }

    /**
     * Determines if the instance is within the last quarter.
     *
     * @return bool
     */
    public function isLastQuarter()
    {
        return $this->quarter === $this->nowWithSameTz()->subQuarter()->quarter;
    }

    /**
     * Determines if the instance is within the next month.
     *
     * @return bool
     */
    public function isNextMonth()
    {
        return $this->month === $this->nowWithSameTz()->addMonthNoOverflow()->month;
    }

    /**
     * Determines if the instance is within the last month.
     *
     * @return bool
     */
    public function isLastMonth()
    {
        return $this->month === $this->nowWithSameTz()->subMonthNoOverflow()->month;
    }

    /**
     * Determines if the instance is within next year.
     *
     * @return bool
     */
    public function isNextYear()
    {
        return $this->year === $this->nowWithSameTz()->addYear()->year;
    }

    /**
     * Determines if the instance is within the previous year.
     *
     * @return bool
     */
    public function isLastYear()
    {
        return $this->year === $this->nowWithSameTz()->subYear()->year;
    }

    /**
     * Determines if the instance is in the future, ie. greater (after) than now.
     *
     * @return bool
     */
    public function isFuture()
    {
        return $this->gt($this->nowWithSameTz());
    }

    /**
     * Determines if the instance is in the past, ie. less (before) than now.
     *
     * @return bool
     */
    public function isPast()
    {
        return $this->lt($this->nowWithSameTz());
    }

    /**
     * Determines if the instance is a leap year.
     *
     * @return bool
     */
    public function isLeapYear()
    {
        return $this->format('L') === '1';
    }

    /**
     * Determines if the instance is a long year
     *
     * @see https://en.wikipedia.org/wiki/ISO_8601#Week_dates
     *
     * @return bool
     */
    public function isLongYear()
    {
        return static::create($this->year, 12, 28, 0, 0, 0, $this->tz)->weekOfYear === 53;
    }

    /**
     * Compares the formatted values of the two dates.
     *
     * @param string                                 $format date formats to compare.
     * @param \Carbon\Carbon|\DateTimeInterface|null $date   instance to compare with or null to use current day.
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    public function isSameAs($format, $date = null)
    {
        $date = $date ?: static::now($this->tz);

        static::expectDateTime($date);

        return $this->format($format) === $date->format($format);
    }

    /**
     * Determines if the instance is in the current unit given.
     *
     * @param string                                 $unit singular unit string
     * @param \Carbon\Carbon|\DateTimeInterface|null $date instance to compare with or null to use current day.
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    public function isSameUnit($unit, $date = null)
    {
        $units = [
            // @call isSameUnit
            'year' => 'Y',
            // @call isSameUnit
            'day' => 'Y-m-d',
            // @call isSameUnit
            'hour' => 'Y-m-d H',
            // @call isSameUnit
            'minute' => 'Y-m-d H:i',
            // @call isSameUnit
            'second' => 'Y-m-d H:i:s',
        ];

        if (!isset($units[$unit])) {
            if (isset($this->$unit)) {
                $date = $date ? static::instance($date) : static::now($this->tz);

                static::expectDateTime($date);

                return $this->$unit === $date->$unit;
            }

            throw new InvalidArgumentException("Bad comparison unit: '$unit'");
        }

        return $this->isSameAs($units[$unit], $date);
    }

    /**
     * Determines if the instance is in the current unit given.
     *
     * @param string $unit The unit to test.
     *
     * @throws \ReflectionException
     *
     * @return bool
     */
    public function isCurrentUnit($unit)
    {
        return $this->{'isSame'.ucfirst($unit)}();
    }

    /**
     * Checks if the passed in date is in the same quarter as the instance quarter (and year if needed).
     *
     * @param \Carbon\Carbon|\DateTimeInterface|null $date       The instance to compare with or null to use current day.
     * @param bool                                   $ofSameYear Check if it is the same month in the same year.
     *
     * @return bool
     */
    public function isSameQuarter($date = null, $ofSameYear = true)
    {
        $date = $date ? static::instance($date) : static::now($this->tz);

        static::expectDateTime($date);

        return $this->quarter === $date->quarter && (!$ofSameYear || $this->isSameYear($date));
    }

    /**
     * Checks if the passed in date is in the same month as the instance´s month.
     *
     * Note that this defaults to only comparing the month while ignoring the year.
     * To test if it is the same exact month of the same year, pass in true as the second parameter.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|null $date       The instance to compare with or null to use the current date.
     * @param bool                                   $ofSameYear Check if it is the same month in the same year.
     *
     * @return bool
     */
    public function isSameMonth($date = null, $ofSameYear = true)
    {
        return $this->isSameAs($ofSameYear ? 'Y-m' : 'm', $date);
    }

    /**
     * Checks if this day is a specific day of the week.
     *
     * @param int $dayOfWeek
     *
     * @return bool
     */
    public function isDayOfWeek($dayOfWeek)
    {
        if (is_string($dayOfWeek) && defined($constant = static::class.'::'.strtoupper($dayOfWeek))) {
            $dayOfWeek = constant($constant);
        }

        return $this->dayOfWeek === $dayOfWeek;
    }

    /**
     * Checks if this day is a Sunday.
     *
     * @return bool
     */
    public function isSunday()
    {
        return $this->dayOfWeek === static::SUNDAY;
    }

    /**
     * Checks if this day is a Monday.
     *
     * @return bool
     */
    public function isMonday()
    {
        return $this->dayOfWeek === static::MONDAY;
    }

    /**
     * Checks if this day is a Tuesday.
     *
     * @return bool
     */
    public function isTuesday()
    {
        return $this->dayOfWeek === static::TUESDAY;
    }

    /**
     * Checks if this day is a Wednesday.
     *
     * @return bool
     */
    public function isWednesday()
    {
        return $this->dayOfWeek === static::WEDNESDAY;
    }

    /**
     * Checks if this day is a Thursday.
     *
     * @return bool
     */
    public function isThursday()
    {
        return $this->dayOfWeek === static::THURSDAY;
    }

    /**
     * Checks if this day is a Friday.
     *
     * @return bool
     */
    public function isFriday()
    {
        return $this->dayOfWeek === static::FRIDAY;
    }

    /**
     * Checks if this day is a Saturday.
     *
     * @return bool
     */
    public function isSaturday()
    {
        return $this->dayOfWeek === static::SATURDAY;
    }

    /**
     * Check if its the birthday. Compares the date/month values of the two dates.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|null $date The instance to compare with or null to use current day.
     *
     * @return bool
     */
    public function isBirthday($date = null)
    {
        return $this->isSameAs('md', $date);
    }

    /**
     * Check if today is the last day of the Month
     *
     * @return bool
     */
    public function isLastOfMonth()
    {
        return $this->day === $this->daysInMonth;
    }

    /**
     * Check if the instance is start of day / midnight.
     *
     * @param bool $checkMicroseconds check time at microseconds precision
     *                                /!\ Warning, this is not reliable with PHP < 7.1.4
     *
     * @return bool
     */
    public function isStartOfDay($checkMicroseconds = false)
    {
        return $checkMicroseconds
            ? $this->format('H:i:s.u') === '00:00:00.000000'
            : $this->format('H:i:s') === '00:00:00';
    }

    /**
     * Check if the instance is end of day.
     *
     * @param bool $checkMicroseconds check time at microseconds precision
     *                                /!\ Warning, this is not reliable with PHP < 7.1.4
     *
     * @return bool
     */
    public function isEndOfDay($checkMicroseconds = false)
    {
        return $checkMicroseconds
            ? $this->format('H:i:s.u') === '23:59:59.999999'
            : $this->format('H:i:s') === '23:59:59';
    }

    /**
     * Check if the instance is start of day / midnight.
     *
     * @return bool
     */
    public function isMidnight()
    {
        return $this->isStartOfDay();
    }

    /**
     * Check if the instance is midday.
     *
     * @return bool
     */
    public function isMidday()
    {
        return $this->format('G:i:s') === static::$midDayAt.':00:00';
    }

    /**
     * Checks if the (date)time string is in a given format.
     *
     * @param string $date
     * @param string $format
     *
     * @return bool
     */
    public static function hasFormat($date, $format)
    {
        try {
            // Try to create a DateTime object. Throws an InvalidArgumentException if the provided time string
            // doesn't match the format in any way.
            static::createFromFormat($format, $date);

            // createFromFormat() is known to handle edge cases silently.
            // E.g. "1975-5-1" (Y-n-j) will still be parsed correctly when "Y-m-d" is supplied as the format.
            // To ensure we're really testing against our desired format, perform an additional regex validation.
            $regex = strtr(
                preg_quote($format, '/'),
                static::$regexFormats
            );

            return (bool) preg_match('/^'.$regex.'$/', $date);
        } catch (InvalidArgumentException $e) {
        }

        return false;
    }

    /**
     * Add seconds to the instance using timestamp. Positive $value travels
     * forward while negative $value travels into the past.
     *
     * @param int $value
     *
     * @return static
     */
    public function addRealUnit($unit, $value = 1)
    {
        switch ($unit) {
            // @call addRealUnit
            case 'second':
                break;
            // @call addRealUnit
            case 'minute':
                $value *= static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'hour':
                $value *= static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'day':
                $value *= static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'week':
                $value *= static::DAYS_PER_WEEK * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'month':
                $value *= 30 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'quarter':
                $value *= static::MONTHS_PER_QUARTER * 30 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'year':
                $value *= 365 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'decade':
                $value *= static::YEARS_PER_DECADE * 365 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'century':
                $value *= static::YEARS_PER_CENTURY * 365 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            // @call addRealUnit
            case 'millennium':
                $value *= static::YEARS_PER_MILLENNIUM * 365 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;
                break;
            default:
                throw new InvalidArgumentException("Invalid unit for real timestamp add/sub: '$unit'");
        }

        return $this->setTimestamp($this->getTimestamp() + $value);
    }

    public function subRealUnit($unit, $value = 1)
    {
        return $this->addRealUnit($unit, -$value);
    }

    public function addUnit($unit, $value = 1, $overflow = null)
    {
        if ($unit === 'weekday') {
            $timeString = $this->toTimeString();
        } elseif ($canOverflow = in_array($unit, [
            'month',
            'year',
        ]) && ($overflow === false || ($overflow === null && !static::{'shouldOverflow'.ucfirst($unit).'s'}()))) {
            $day = $this->day;
        }

        $this->modify((int) $value." $unit");

        if (isset($timeString)) {
            return $this->setTimeFromTimeString($timeString);
        }
        if (isset($canOverflow, $day) && $canOverflow && $day !== $this->day) {
            $this->modify('last day of previous month');
        }

        return $this;
    }

    public function subUnit($unit, $value = 1, $overflow = null)
    {
        return $this->addUnit($unit, -$value, $overflow);
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////////// DIFFERENCES ///////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Get the difference as a CarbonInterval instance
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return CarbonInterval
     */
    public function diffAsCarbonInterval($date = null, $absolute = true)
    {
        return CarbonInterval::instance($this->diff($this->resolveCarbon($date), $absolute));
    }

    /**
     * Get the difference in years
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInYears($date = null, $absolute = true)
    {
        return (int) $this->diff($this->resolveCarbon($date), $absolute)->format('%r%y');
    }

    /**
     * Get the difference in months
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInMonths($date = null, $absolute = true)
    {
        $date = $this->resolveCarbon($date);

        return $this->diffInYears($date, $absolute) * static::MONTHS_PER_YEAR + (int) $this->diff($date, $absolute)->format('%r%m');
    }

    /**
     * Get the difference in weeks
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInWeeks($date = null, $absolute = true)
    {
        return (int) ($this->diffInDays($date, $absolute) / static::DAYS_PER_WEEK);
    }

    /**
     * Get the difference in days
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInDays($date = null, $absolute = true)
    {
        return (int) $this->diff($this->resolveCarbon($date), $absolute)->format('%r%a');
    }

    /**
     * Get the difference in days using a filter closure
     *
     * @param Closure                                       $callback
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInDaysFiltered(Closure $callback, $date = null, $absolute = true)
    {
        return $this->diffFiltered(CarbonInterval::day(), $callback, $date, $absolute);
    }

    /**
     * Get the difference in hours using a filter closure
     *
     * @param Closure                                       $callback
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInHoursFiltered(Closure $callback, $date = null, $absolute = true)
    {
        return $this->diffFiltered(CarbonInterval::hour(), $callback, $date, $absolute);
    }

    /**
     * Get the difference by the given interval using a filter closure
     *
     * @param CarbonInterval                                $ci       An interval to traverse by
     * @param Closure                                       $callback
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffFiltered(CarbonInterval $ci, Closure $callback, $date = null, $absolute = true)
    {
        $start = $this;
        $end = $this->resolveCarbon($date);
        $inverse = false;

        if ($end < $start) {
            $start = $end;
            $end = $this;
            $inverse = true;
        }

        $period = new DatePeriod($start, $ci, $end);
        $values = array_filter(iterator_to_array($period), function ($date) use ($callback) {
            return call_user_func($callback, Carbon::instance($date));
        });

        $diff = count($values);

        return $inverse && !$absolute ? -$diff : $diff;
    }

    /**
     * Get the difference in weekdays
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInWeekdays($date = null, $absolute = true)
    {
        return $this->diffInDaysFiltered(function (Carbon $date) {
            return $date->isWeekday();
        }, $date, $absolute);
    }

    /**
     * Get the difference in weekend days using a filter
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInWeekendDays($date = null, $absolute = true)
    {
        return $this->diffInDaysFiltered(function (Carbon $date) {
            return $date->isWeekend();
        }, $date, $absolute);
    }

    /**
     * Get the difference in hours.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInHours($date = null, $absolute = true)
    {
        return (int) ($this->diffInSeconds($date, $absolute) / static::SECONDS_PER_MINUTE / static::MINUTES_PER_HOUR);
    }

    /**
     * Get the difference in hours using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInRealHours($date = null, $absolute = true)
    {
        return (int) ($this->diffInRealSeconds($date, $absolute) / static::SECONDS_PER_MINUTE / static::MINUTES_PER_HOUR);
    }

    /**
     * Get the difference in minutes.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInMinutes($date = null, $absolute = true)
    {
        return (int) ($this->diffInSeconds($date, $absolute) / static::SECONDS_PER_MINUTE);
    }

    /**
     * Get the difference in minutes using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInRealMinutes($date = null, $absolute = true)
    {
        return (int) ($this->diffInRealSeconds($date, $absolute) / static::SECONDS_PER_MINUTE);
    }

    /**
     * Get the difference in seconds.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInSeconds($date = null, $absolute = true)
    {
        $diff = $this->diff($this->resolveCarbon($date));
        $value = $diff->days * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE +
            $diff->h * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE +
            $diff->i * static::SECONDS_PER_MINUTE +
            $diff->s;

        return $absolute || !$diff->invert ? $value : -$value;
    }

    /**
     * Get the difference in seconds using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInRealSeconds($date = null, $absolute = true)
    {
        $date = $this->resolveCarbon($date);
        $value = $date->getTimestamp() - $this->getTimestamp();

        return $absolute ? abs($value) : $value;
    }

    /**
     * The number of seconds since midnight.
     *
     * @return int
     */
    public function secondsSinceMidnight()
    {
        return $this->diffInSeconds($this->copy()->startOfDay());
    }

    /**
     * The number of seconds until 23:59:59.
     *
     * @return int
     */
    public function secondsUntilEndOfDay()
    {
        return $this->diffInSeconds($this->copy()->endOfDay());
    }

    /**
     * Get the difference in a human readable format in the current locale.
     *
     * When comparing a value in the past to default now:
     * 1 hour ago
     * 5 months ago
     *
     * When comparing a value in the future to default now:
     * 1 hour from now
     * 5 months from now
     *
     * When comparing a value in the past to another value:
     * 1 hour before
     * 5 months before
     *
     * When comparing a value in the future to another value:
     * 1 hour after
     * 5 months after
     *
     * @param Carbon|null $other
     * @param bool        $absolute removes time difference modifiers ago, after, etc
     * @param bool        $short    displays short format of time units
     * @param int         $parts    displays number of parts in the interval
     *
     * @return string
     */
    public function diffForHumans($other = null, $absolute = false, $short = false, $parts = 1)
    {
        $isNow = $other === null;
        $interval = [];

        $parts = min(6, max(1, (int) $parts));
        $count = 1;
        $unit = $short ? 's' : 'second';

        if ($isNow) {
            $other = $this->nowWithSameTz();
        } elseif (!$other instanceof DateTime && !$other instanceof DateTimeInterface) {
            $other = static::parse($other);
        }

        $diffInterval = $this->diff($other);

        $diffIntervalArray = [
            ['value' => $diffInterval->y, 'unit' => 'year',    'unitShort' => 'y'],
            ['value' => $diffInterval->m, 'unit' => 'month',   'unitShort' => 'm'],
            ['value' => $diffInterval->d, 'unit' => 'day',     'unitShort' => 'd'],
            ['value' => $diffInterval->h, 'unit' => 'hour',    'unitShort' => 'h'],
            ['value' => $diffInterval->i, 'unit' => 'minute',  'unitShort' => 'min'],
            ['value' => $diffInterval->s, 'unit' => 'second',  'unitShort' => 's'],
        ];

        foreach ($diffIntervalArray as $diffIntervalData) {
            if ($diffIntervalData['value'] > 0) {
                $unit = $short ? $diffIntervalData['unitShort'] : $diffIntervalData['unit'];
                $count = $diffIntervalData['value'];

                if ($diffIntervalData['unit'] === 'day' && $count >= static::DAYS_PER_WEEK) {
                    $unit = $short ? 'w' : 'week';
                    $count = (int) ($count / static::DAYS_PER_WEEK);

                    $interval[] = static::translator()->transChoice($unit, $count, [':count' => $count]);

                    // get the count days excluding weeks (might be zero)
                    $numOfDaysCount = (int) ($diffIntervalData['value'] - ($count * static::DAYS_PER_WEEK));

                    if ($numOfDaysCount > 0 && count($interval) < $parts) {
                        $unit = $short ? 'd' : 'day';
                        $count = $numOfDaysCount;
                        $interval[] = static::translator()->transChoice($unit, $count, [':count' => $count]);
                    }
                } else {
                    $interval[] = static::translator()->transChoice($unit, $count, [':count' => $count]);
                }
            }

            // break the loop after we get the required number of parts in array
            if (count($interval) >= $parts) {
                break;
            }
        }

        if (count($interval) === 0) {
            if ($isNow && static::getHumanDiffOptions() & self::JUST_NOW) {
                $key = 'diff_now';
                $translation = static::translator()->trans($key);
                if ($translation !== $key) {
                    return $translation;
                }
            }
            $count = static::getHumanDiffOptions() & self::NO_ZERO_DIFF ? 1 : 0;
            $unit = $short ? 's' : 'second';
            $interval[] = static::translator()->transChoice($unit, $count, [':count' => $count]);
        }

        // join the interval parts by a space
        $time = implode(' ', $interval);

        unset($diffIntervalArray, $interval);

        if ($absolute) {
            return $time;
        }

        $isFuture = $diffInterval->invert === 1;

        $transId = $isNow ? ($isFuture ? 'from_now' : 'ago') : ($isFuture ? 'after' : 'before');

        if ($parts === 1) {
            if ($isNow && $unit === 'day') {
                if ($count === 1 && static::getHumanDiffOptions() & self::ONE_DAY_WORDS) {
                    $key = $isFuture ? 'diff_tomorrow' : 'diff_yesterday';
                    $translation = static::translator()->trans($key);
                    if ($translation !== $key) {
                        return $translation;
                    }
                }
                if ($count === 2 && static::getHumanDiffOptions() & self::TWO_DAY_WORDS) {
                    $key = $isFuture ? 'diff_after_tomorrow' : 'diff_before_yesterday';
                    $translation = static::translator()->trans($key);
                    if ($translation !== $key) {
                        return $translation;
                    }
                }
            }
            // Some langs have special pluralization for past and future tense.
            $key = $unit.'_'.$transId;
            $count = isset($count) ? $count : 1;
            if ($key !== static::translator()->transChoice($key, $count)) {
                $time = static::translator()->transChoice($key, $count, [':count' => $count]);
            }
        }

        return static::translator()->trans($transId, [':time' => $time]);
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////////// MODIFIERS ////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Resets the time to 00:00:00 start of day
     *
     * @return static
     */
    public function startOfDay()
    {
        return $this->modify('00:00:00.000000');
    }

    /**
     * Resets the time to 23:59:59 end of day
     *
     * @return static
     */
    public function endOfDay()
    {
        return $this->modify((static::HOURS_PER_DAY - 1).'.'.(static::MINUTES_PER_HOUR - 1).'.'.(static::SECONDS_PER_MINUTE - 1).'.999999');
    }

    /**
     * Resets the date to the first day of the month and the time to 00:00:00
     *
     * @return static
     */
    public function startOfMonth()
    {
        return $this->setDate($this->year, $this->month, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the month and time to 23:59:59
     *
     * @return static
     */
    public function endOfMonth()
    {
        return $this->setDate($this->year, $this->month, $this->daysInMonth)->endOfDay();
    }

    /**
     * Resets the date to the first day of the quarter and the time to 00:00:00
     *
     * @return static
     */
    public function startOfQuarter()
    {
        $month = ($this->quarter - 1) * static::MONTHS_PER_QUARTER + 1;

        return $this->setDate($this->year, $month, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the quarter and time to 23:59:59
     *
     * @return static
     */
    public function endOfQuarter()
    {
        return $this->startOfQuarter()->addMonths(static::MONTHS_PER_QUARTER - 1)->endOfMonth();
    }

    /**
     * Resets the date to the first day of the year and the time to 00:00:00
     *
     * @return static
     */
    public function startOfYear()
    {
        return $this->setDate($this->year, 1, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the year and time to 23:59:59
     *
     * @return static
     */
    public function endOfYear()
    {
        return $this->setDate($this->year, 12, 31)->endOfDay();
    }

    /**
     * Resets the date to the first day of the decade and the time to 00:00:00
     *
     * @return static
     */
    public function startOfDecade()
    {
        $year = $this->year - $this->year % static::YEARS_PER_DECADE;

        return $this->setDate($year, 1, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the decade and time to 23:59:59
     *
     * @return static
     */
    public function endOfDecade()
    {
        $year = $this->year - $this->year % static::YEARS_PER_DECADE + static::YEARS_PER_DECADE - 1;

        return $this->setDate($year, 12, 31)->endOfDay();
    }

    /**
     * Resets the date to the first day of the century and the time to 00:00:00
     *
     * @return static
     */
    public function startOfCentury()
    {
        $year = $this->year - ($this->year - 1) % static::YEARS_PER_CENTURY;

        return $this->setDate($year, 1, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the century and time to 23:59:59
     *
     * @return static
     */
    public function endOfCentury()
    {
        $year = $this->year - 1 - ($this->year - 1) % static::YEARS_PER_CENTURY + static::YEARS_PER_CENTURY;

        return $this->setDate($year, 12, 31)->endOfDay();
    }

    /**
     * Resets the date to the first day of week (defined in $weekStartsAt) and the time to 00:00:00
     *
     * @return static
     */
    public function startOfWeek()
    {
        while ($this->dayOfWeek !== static::$weekStartsAt) {
            $this->subDay();
        }

        return $this->startOfDay();
    }

    /**
     * Resets the date to end of week (defined in $weekEndsAt) and time to 23:59:59
     *
     * @return static
     */
    public function endOfWeek()
    {
        while ($this->dayOfWeek !== static::$weekEndsAt) {
            $this->addDay();
        }

        return $this->endOfDay();
    }

    /**
     * Modify to start of current hour, minutes and seconds become 0
     *
     * @return static
     */
    public function startOfHour()
    {
        return $this->setTime($this->hour, 0, 0);
    }

    /**
     * Modify to end of current hour, minutes and seconds become 59
     *
     * @return static
     */
    public function endOfHour()
    {
        return $this->setTime($this->hour, static::MINUTES_PER_HOUR - 1, static::SECONDS_PER_MINUTE - 1);
    }

    /**
     * Modify to start of current minute, seconds become 0
     *
     * @return static
     */
    public function startOfMinute()
    {
        return $this->setTime($this->hour, $this->minute, 0);
    }

    /**
     * Modify to end of current minute, seconds become 59
     *
     * @return static
     */
    public function endOfMinute()
    {
        return $this->setTime($this->hour, $this->minute, static::SECONDS_PER_MINUTE - 1);
    }

    /**
     * Modify to midday, default to self::$midDayAt
     *
     * @return static
     */
    public function midDay()
    {
        return $this->setTime(self::$midDayAt, 0, 0);
    }

    /**
     * Modify to the next occurrence of a given day of the week.
     * If no dayOfWeek is provided, modify to the next occurrence
     * of the current day of the week.  Use the supplied constants
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int|null $dayOfWeek
     *
     * @return static
     */
    public function next($dayOfWeek = null)
    {
        if ($dayOfWeek === null) {
            $dayOfWeek = $this->dayOfWeek;
        }

        return $this->startOfDay()->modify('next '.static::$days[$dayOfWeek]);
    }

    /**
     * Go forward or backward to the next week- or weekend-day.
     *
     * @param bool $weekday
     * @param bool $forward
     *
     * @return $this
     */
    private function nextOrPreviousDay($weekday = true, $forward = true)
    {
        $step = $forward ? 1 : -1;

        do {
            $this->addDays($step);
        } while ($weekday ? $this->isWeekend() : $this->isWeekday());

        return $this;
    }

    /**
     * Go forward to the next weekday.
     *
     * @return $this
     */
    public function nextWeekday()
    {
        return $this->nextOrPreviousDay();
    }

    /**
     * Go backward to the previous weekday.
     *
     * @return $this
     */
    public function previousWeekday()
    {
        return $this->nextOrPreviousDay(true, false);
    }

    /**
     * Go forward to the next weekend day.
     *
     * @return $this
     */
    public function nextWeekendDay()
    {
        return $this->nextOrPreviousDay(false);
    }

    /**
     * Go backward to the previous weekend day.
     *
     * @return $this
     */
    public function previousWeekendDay()
    {
        return $this->nextOrPreviousDay(false, false);
    }

    /**
     * Modify to the previous occurrence of a given day of the week.
     * If no dayOfWeek is provided, modify to the previous occurrence
     * of the current day of the week.  Use the supplied constants
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int|null $dayOfWeek
     *
     * @return static
     */
    public function previous($dayOfWeek = null)
    {
        if ($dayOfWeek === null) {
            $dayOfWeek = $this->dayOfWeek;
        }

        return $this->startOfDay()->modify('last '.static::$days[$dayOfWeek]);
    }

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current month. If no dayOfWeek is provided, modify to the
     * first day of the current month.  Use the supplied constants
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int|null $dayOfWeek
     *
     * @return static
     */
    public function firstOfMonth($dayOfWeek = null)
    {
        $this->startOfDay();

        if ($dayOfWeek === null) {
            return $this->day(1);
        }

        return $this->modify('first '.static::$days[$dayOfWeek].' of '.$this->format('F').' '.$this->year);
    }

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current month. If no dayOfWeek is provided, modify to the
     * last day of the current month.  Use the supplied constants
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int|null $dayOfWeek
     *
     * @return static
     */
    public function lastOfMonth($dayOfWeek = null)
    {
        $this->startOfDay();

        if ($dayOfWeek === null) {
            return $this->day($this->daysInMonth);
        }

        return $this->modify('last '.static::$days[$dayOfWeek].' of '.$this->format('F').' '.$this->year);
    }

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current month. If the calculated occurrence is outside the scope
     * of the current month, then return false and no modifications are made.
     * Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $nth
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function nthOfMonth($nth, $dayOfWeek)
    {
        $date = $this->copy()->firstOfMonth();
        $check = $date->format('Y-m');
        $date->modify('+'.$nth.' '.static::$days[$dayOfWeek]);

        return $date->format('Y-m') === $check ? $this->modify($date) : false;
    }

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current quarter. If no dayOfWeek is provided, modify to the
     * first day of the current quarter.  Use the supplied constants
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int|null $dayOfWeek day of the week default null
     *
     * @return static
     */
    public function firstOfQuarter($dayOfWeek = null)
    {
        return $this->setDate($this->year, $this->quarter * static::MONTHS_PER_QUARTER - 2, 1)->firstOfMonth($dayOfWeek);
    }

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current quarter. If no dayOfWeek is provided, modify to the
     * last day of the current quarter.  Use the supplied constants
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int|null $dayOfWeek day of the week default null
     *
     * @return static
     */
    public function lastOfQuarter($dayOfWeek = null)
    {
        return $this->setDate($this->year, $this->quarter * static::MONTHS_PER_QUARTER, 1)->lastOfMonth($dayOfWeek);
    }

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current quarter. If the calculated occurrence is outside the scope
     * of the current quarter, then return false and no modifications are made.
     * Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $nth
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function nthOfQuarter($nth, $dayOfWeek)
    {
        $date = $this->copy()->day(1)->month($this->quarter * static::MONTHS_PER_QUARTER);
        $lastMonth = $date->month;
        $year = $date->year;
        $date->firstOfQuarter()->modify('+'.$nth.' '.static::$days[$dayOfWeek]);

        return ($lastMonth < $date->month || $year !== $date->year) ? false : $this->modify($date);
    }

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current year. If no dayOfWeek is provided, modify to the
     * first day of the current year.  Use the supplied constants
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int|null $dayOfWeek day of the week default null
     *
     * @return static
     */
    public function firstOfYear($dayOfWeek = null)
    {
        return $this->month(1)->firstOfMonth($dayOfWeek);
    }

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current year. If no dayOfWeek is provided, modify to the
     * last day of the current year.  Use the supplied constants
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int|null $dayOfWeek day of the week default null
     *
     * @return static
     */
    public function lastOfYear($dayOfWeek = null)
    {
        return $this->month(static::MONTHS_PER_YEAR)->lastOfMonth($dayOfWeek);
    }

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current year. If the calculated occurrence is outside the scope
     * of the current year, then return false and no modifications are made.
     * Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $nth
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function nthOfYear($nth, $dayOfWeek)
    {
        $date = $this->copy()->firstOfYear()->modify('+'.$nth.' '.static::$days[$dayOfWeek]);

        return $this->year === $date->year ? $this->modify($date) : false;
    }

    /**
     * Modify the current instance to the average of a given instance (default now) and the current instance.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|null $date
     *
     * @return static
     */
    public function average($date = null)
    {
        return $this->addSeconds((int) ($this->diffInSeconds($this->resolveCarbon($date), false) / 2));
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////////// SERIALIZATION /////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Return a serialized string of the instance.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize($this);
    }

    /**
     * Create an instance from a serialized string.
     *
     * @param string $value
     *
     * @throws \InvalidArgumentException
     *
     * @return static
     */
    public static function fromSerialized($value)
    {
        $instance = @unserialize($value);

        if (!$instance instanceof static) {
            throw new InvalidArgumentException('Invalid serialized value.');
        }

        return $instance;
    }

    /**
     * The __set_state handler.
     *
     * @param array $array
     *
     * @return static
     */
    public static function __set_state($array)
    {
        return static::instance(parent::__set_state($array));
    }

    /**
     * Prepare the object for JSON serialization.
     *
     * @return array|string
     */
    public function jsonSerialize()
    {
        if (static::$serializer) {
            return call_user_func(static::$serializer, $this);
        }

        $carbon = $this;

        return call_user_func(function () use ($carbon) {
            return get_object_vars($carbon);
        });
    }

    /**
     * JSON serialize all Carbon instances using the given callback.
     *
     * @param callable $callback
     *
     * @return void
     */
    public static function serializeUsing($callback)
    {
        static::$serializer = $callback;
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////////////// MACRO /////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Register a custom macro.
     *
     * @param string          $name
     * @param object|callable $macro
     *
     * @return void
     */
    public static function macro($name, $macro)
    {
        static::$localMacros[$name] = $macro;
    }

    /**
     * Mix another object into the class.
     *
     * @param object $mixin
     *
     * @return void
     */
    public static function mixin($mixin)
    {
        $reflection = new \ReflectionClass($mixin);
        $methods = $reflection->getMethods(
            \ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED
        );

        foreach ($methods as $method) {
            $method->setAccessible(true);

            static::macro($method->name, $method->invoke($mixin));
        }
    }

    /**
     * Checks if macro is registered.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function hasMacro($name)
    {
        return isset(static::$localMacros[$name]);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @throws \BadMethodCallException
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        if (!static::hasMacro($method)) {
            throw new \BadMethodCallException("Method $method does not exist.");
        }

        if (static::$localMacros[$method] instanceof Closure && method_exists('Closure', 'bind')) {
            return call_user_func_array(Closure::bind(static::$localMacros[$method], null, get_called_class()), $parameters);
        }

        return call_user_func_array(static::$localMacros[$method], $parameters);
    }

    public function setUnit($unit, $value = null)
    {
        $this->$unit = $value;

        return $this;
    }

    protected static function singularUnit($unit)
    {
        $unit = rtrim(strtolower($unit), 's');

        if ($unit === 'centurie') {
            return 'century';
        }

        if ($unit === 'millennia') {
            return 'millennium';
        }

        return $unit;
    }

    protected static function pluralUnit($unit)
    {
        $unit = rtrim(strtolower($unit), 's');

        if ($unit === 'century') {
            return 'centuries';
        }

        if ($unit === 'millennium') {
            return 'millennia';
        }

        return "${unit}s";
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @throws \BadMethodCallException|\ReflectionException
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $units = [
            // @call setUnit
            // @call addUnit
            'year',
            // @call setUnit
            // @call addUnit
            'month',
            // @call setUnit
            // @call addUnit
            'day',
            // @call setUnit
            // @call addUnit
            'hour',
            // @call setUnit
            // @call addUnit
            'minute',
            // @call setUnit
            // @call addUnit
            'second',
        ];

        $unit = rtrim($method, 's');
        $action = substr($unit, 0, 3);
        $overflow = null;
        if ($action === 'set') {
            $unit = strtolower(substr($unit, 3));
        }

        if (in_array($unit, $units)) {
            return $this->setUnit($unit, ...$parameters);
        }

        $modifiableUnits = [
            // @call addUnit
            'millennium',
            // @call addUnit
            'century',
            // @call addUnit
            'decade',
            // @call addUnit
            'quarter',
            // @call addUnit
            'week',
            // @call addUnit
            'weekday',
        ];

        if ($action === 'add' || $action === 'sub') {
            $unit = substr($unit, 3);
            if (substr($unit, 0, 4) === 'Real') {
                $unit = static::singularUnit(substr($unit, 4));

                return $this->{"${action}RealUnit"}($unit, ...$parameters);
            }

            if (preg_match('/^(Month|Quarter|Year|Decade|Century|Centurie|Millennium|Millennia)s?(No|With|Without|WithNo)Overflow$/', $unit, $match)) {
                $unit = $match[1];
                $overflow = $match[2] === 'With';
            }
            $unit = static::singularUnit($unit);
        }

        if (in_array($unit, $modifiableUnits) || in_array($unit, $units)) {
            $metaUnits = [
                'millennium' => [static::YEARS_PER_MILLENNIUM, 'year'],
                'century' => [static::YEARS_PER_CENTURY, 'year'],
                'decade' => [static::YEARS_PER_DECADE, 'year'],
                'quarter' => [static::MONTHS_PER_QUARTER, 'month'],
            ];
            $value = $parameters[0] ?? 1;
            if (isset($metaUnits[$unit])) {
                list($factor, $unit) = $metaUnits[$unit];
                $value *= $factor;
            }

            return $this->{"${action}Unit"}($unit, $value, $overflow);
        }

        if (substr($unit, 0, 6) === 'isSame') {
            try {
                return $this->isSameUnit(strtolower(substr($unit, 6)), ...$parameters);
            } catch (InvalidArgumentException $exception) {
                // Try macros
            }
        }

        if (substr($unit, 0, 9) === 'isCurrent') {
            try {
                return $this->isCurrentUnit(strtolower(substr($unit, 9)));
            } catch (ReflectionException $exception) {
                // Try macros
            }
        }

        if (!static::hasMacro($method)) {
            throw new \BadMethodCallException("Method $method does not exist.");
        }

        $macro = static::$localMacros[$method];

        $reflexion = new \ReflectionFunction($macro);
        $reflectionParameters = $reflexion->getParameters();
        $expectedCount = count($reflectionParameters);
        $actualCount = count($parameters);
        if ($expectedCount > $actualCount && $reflectionParameters[$expectedCount - 1]->name === 'self') {
            for ($i = $actualCount; $i < $expectedCount - 1; $i++) {
                $parameters[] = $reflectionParameters[$i]->getDefaultValue();
            }
            $parameters[] = $this;
        }

        if ($macro instanceof Closure && method_exists($macro, 'bindTo')) {
            return call_user_func_array($macro->bindTo($this, get_class($this)), $parameters);
        }

        return call_user_func_array($macro, $parameters);
    }
}
