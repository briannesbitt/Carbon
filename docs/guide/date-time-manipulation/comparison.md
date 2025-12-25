# Comparison

Simple comparison is offered up via the following functions. Remember that the comparison is done in the UTC timezone so things aren't always as they seem.

```php
echo Carbon::now()->tzName;
$first = Carbon::create(2012, 9, 5, 23, 26, 11);
$second = Carbon::create(2012, 9, 5, 20, 26, 11, 'America/Vancouver');

echo $first->toDateTimeString();
echo $first->tzName;
echo $second->toDateTimeString();
echo $second->tzName;

var_dump($first->equalTo($second));
// equalTo is also available on CarbonInterval and CarbonPeriod
var_dump($first->notEqualTo($second));
// notEqualTo is also available on CarbonInterval and CarbonPeriod
var_dump($first->greaterThan($second));
// greaterThan is also available on CarbonInterval
var_dump($first->greaterThanOrEqualTo($second));
// greaterThanOrEqualTo is also available on CarbonInterval
var_dump($first->lessThan($second));
// lessThan is also available on CarbonInterval
var_dump($first->lessThanOrEqualTo($second));
// lessThanOrEqualTo is also available on CarbonInterval

$first->setDateTime(2012, 1, 1, 0, 0, 0);
$second->setDateTime(2012, 1, 1, 0, 0, 0);/*pad(50)*/ // Remember tz is 'America/Vancouver'

var_dump($first->equalTo($second));
var_dump($first->notEqualTo($second));
var_dump($first->greaterThan($second));
var_dump($first->greaterThanOrEqualTo($second));
var_dump($first->lessThan($second));
var_dump($first->lessThanOrEqualTo($second));

// All have short hand aliases and PHP equivalent code:

var_dump($first->eq($second));
var_dump($first->equalTo($second));
var_dump($first == $second);

var_dump($first->ne($second));
var_dump($first->notEqualTo($second));
var_dump($first != $second);

var_dump($first->gt($second));
var_dump($first->greaterThan($second));
var_dump($first->isAfter($second));
var_dump($first > $second);

var_dump($first->gte($second));
var_dump($first->greaterThanOrEqualTo($second));
var_dump($first >= $second);

var_dump($first->lt($second));
var_dump($first->lessThan($second));
var_dump($first->isBefore($second));
var_dump($first < $second);

var_dump($first->lte($second));
var_dump($first->lessThanOrEqualTo($second));
var_dump($first <= $second);

```

Those methods use natural comparisons offered by PHP `$date1 == $date2` so all of them will ignore milli/micro-seconds before PHP 7.1, then take them into account starting with 7.1.

To determine if the current instance is between two other instances you can use the aptly named `between()` method (or `isBetween()` alias). The third parameter indicates if an equal to comparison should be done. The default is true which determines if its between or equal to the boundaries.

```php
$first = Carbon::create(2012, 9, 5, 1);
$second = Carbon::create(2012, 9, 5, 5);
var_dump(Carbon::create(2012, 9, 5, 3)->between($first, $second));
var_dump(Carbon::create(2012, 9, 5, 5)->between($first, $second));
var_dump(Carbon::create(2012, 9, 5, 5)->between($first, $second, false));
var_dump(Carbon::create(2012, 9, 5, 5)->isBetween($first, $second, false));
// Rather than passing false as a third argument, you can use betweenIncluded and betweenExcluded
var_dump(Carbon::create(2012, 9, 5, 5)->betweenIncluded($first, $second));
var_dump(Carbon::create(2012, 9, 5, 5)->betweenExcluded($first, $second));
// All those methods are also available on CarbonInterval

```

Woah! Did you forget min() and max() ? Nope. That is covered as well by the suitably named `min()` and `max()` methods or `minimum()` and `maximum()` aliases. As usual the default parameter is now if null is specified.

```php
$dt1 = Carbon::createMidnightDate(2012, 1, 1);
$dt2 = Carbon::createMidnightDate(2014, 1, 30);
echo $dt1->min($dt2);
echo $dt1->minimum($dt2);
// Also works with string
echo $dt1->minimum('2014-01-30');

$dt1 = Carbon::createMidnightDate(2012, 1, 1);
$dt2 = Carbon::createMidnightDate(2014, 1, 30);
echo $dt1->max($dt2);
echo $dt1->maximum($dt2);

// now is the default param
$dt1 = Carbon::createMidnightDate(2000, 1, 1);
echo $dt1->max();
echo $dt1->maximum();

// Remember min and max PHP native function work fine with dates too:
echo max(Carbon::create('2002-03-15'), Carbon::create('2003-01-07'), Carbon::create('2002-08-25'));
echo min(Carbon::create('2002-03-15'), Carbon::create('2003-01-07'), Carbon::create('2002-08-25'));
// This way you can pass as many dates as you want and get no ambiguities about parameters order


$dt1 = Carbon::createMidnightDate(2010, 4, 1);
$dt2 = Carbon::createMidnightDate(2010, 3, 28);
$dt3 = Carbon::createMidnightDate(2010, 4, 16);


// returns the closest of two date (no matter before or after)
echo $dt1->closest($dt2, $dt3);
echo $dt2->closest($dt1, $dt3);
echo $dt3->closest($dt2, $dt1);

// returns the farthest of two date (no matter before or after)
echo $dt1->farthest($dt2, $dt3);
echo $dt2->farthest($dt1, $dt3);
echo $dt3->farthest($dt2, $dt1);

```

To handle the most used cases there are some simple helper functions that hopefully are obvious from their names. For the methods that compare to `now()` (ex. isToday()) in some manner, the `now()` is created in the same timezone as the instance.

```php

$dt = Carbon::now();
$dt2 = Carbon::createFromDate(1987, 4, 23);

$dt->isSameAs('w', $dt2); // w is the date of the week, so this will return true if $dt and $dt2
                          // the same day of week (both monday or both sunday, etc.)
                          // you can use any format and combine as much as you want.
$dt->isFuture();
$dt->isNowOrFuture();
$dt->isPast();
$dt->isNowOrPast();

$dt->isSameYear($dt2);
$dt->isCurrentYear();
$dt->isNextYear();
$dt->isLastYear();
$dt->isLongIsoYear(); // see https://en.wikipedia.org/wiki/ISO_8601#Week_dates
Carbon::create(2015)->isLongYear(); // isLongIsoYear() check a given date,
    // while isLongYear() will ignore month/day and just check a given year number
$dt->isLeapYear();

$dt->isSameQuarter($dt2); // same quarter of the same year of the given date
$dt->isSameQuarter($dt2, false); // same quarter (3 months) no matter the year of the given date
$dt->isCurrentQuarter();
$dt->isNextQuarter(); // date is in the next quarter
$dt->isLastQuarter(); // in previous quarter

$dt->isSameMonth($dt2); // same month of the same year of the given date
$dt->isSameMonth($dt2, false); // same month no matter the year of the given date
$dt->isCurrentMonth();
$dt->isNextMonth();
$dt->isLastMonth();

$dt->isWeekday();
$dt->isWeekend();
$dt->isMonday();
$dt->isTuesday();
$dt->isWednesday();
$dt->isThursday();
$dt->isFriday();
$dt->isSaturday();
$dt->isSunday();
$dt->isDayOfWeek(Carbon::SATURDAY); // is a saturday
$dt->isLastOfMonth(); // is the last day of the month

$dt->is('Sunday');
$dt->is('June');
$dt->is('2019');
$dt->is('12:23');
$dt->is('2 June 2019');
$dt->is('06-02');

$dt->isSameDay($dt2); // Same day of same month of same year
$dt->isCurrentDay();
$dt->isYesterday();
$dt->isToday();
$dt->isTomorrow();
$dt->isNextWeek();
$dt->isLastWeek();

$dt->isSameHour($dt2);
$dt->isCurrentHour();
$dt->isSameMinute($dt2);
$dt->isCurrentMinute();
$dt->isSameSecond($dt2);
$dt->isCurrentSecond();

$dt->isStartOfDay(); // check if hour is 00:00:00
$dt->isMidnight(); // check if hour is 00:00:00 (isStartOfDay alias)
$dt->isEndOfDay(); // check if hour is 23:59:59
$dt->isMidday(); // check if hour is 12:00:00 (or other midday hour set with Carbon::setMidDayAt())

$born = Carbon::createFromDate(1987, 4, 23);
$noCake = Carbon::createFromDate(2014, 9, 26);
$yesCake = Carbon::createFromDate(2014, 4, 23);
$overTheHill = Carbon::now()->subYears(50);
var_dump($born->isBirthday($noCake));
var_dump($born->isBirthday($yesCake));
var_dump($overTheHill->isBirthday()); // default compare it to today!

// isStartOfX, isEndOfX, isCurrentX, isSameX, isNextX and isLastX are available for each unit

```

The methods `isStartOfMillisecond`, `isEndOfMillisecond`, `isStartOfSecond`, `isEndOfSecond`, `isStartOfMinute`, `isEndOfMinute`, `isStartOfHour`, `isEndOfHour`, `isStartOfDay` and `isEndOfDay` will use 1 microsecond as the default interval to be considered as the start/end, which means `isEndOfDay` returns `true` only for 23:59:59.999999, `false` for 23:59:59.999998.

The methods `isStartOfWeek`, `isEndOfWeek`, `isStartOfMonth`, `isEndOfMonth`, `isStartOfQuarter`, `isEndOfQuarter`, `isStartOfYear`, `isEndOfYear`, `isStartOfDecade`, `isEndOfDecade`, `isStartOfCentury`, `isEndOfCentury`, `isStartOfMillennium` and `isEndOfMillennium` will use 1 day as the default interval to be considered as the start/end. isStartOfUnit

But you can customize this interval: `$date->isStartOfDay(interval: '4 hours')` (`true` if the current time is >= `00:00:00.000000` and <= `03:59:59.999999`).

`$date->isEndOfCentury(interval: Unit::Year)` (`true` if the current year is the last one of a century, i.e. ends with 00).

`isStartOfUnit` and `isEndOfUnit` allow this check with dynamic unit: `$date->isStartOfUnit(Unit::Year, interval: '1 month')`, `$date->isStartOfUnit(Unit::Week, Unit::Hour)`
