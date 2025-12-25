# Difference

`Carbon` `diff()` and `diffAsCarbonInterval()` methods return a `CarbonInterval` (since Carbon v3, while it returned `DateInterval` in the previous versions).

Check [CarbonInterval chapter](#api-interval) for more information.

We also provide `diffAsDateInterval()` act like `diff()` but returns a `DateInterval` instance.

Carbon add diff methods for each unit too, such as `diffInYears()`, `diffInMonths()` and so on. `diffAsCarbonInterval()` and `diffIn*()` (and `floatDiffIn*()` for versions < 3 when `diffIn*()` methods returned integer values, since Carbon 3, they are deprecated as `diffIn*()` already return floating number, and integer values from it can easily be obtained with an explicit cast `(int)`).

`diffInUnit()` allow to get a diff for a unit calculated dynamically: `->diffInUnit($unit, $date, $absolute)`

All can take 2 optional arguments: date to compare with (if missing, now is used instead), and an absolute boolean option (`false` by default), it returns negative value when the instance the method is called on is greater than the compared date (first argument or now). If set to `true`, that makes the method return an absolute value no matter which date is greater than the other.

```php
echo Carbon::now('America/Vancouver')->diffInSeconds(Carbon::now('Europe/London'));

$dtOttawa = Carbon::createMidnightDate(2000, 1, 1, 'America/Toronto');
$dtVancouver = Carbon::createMidnightDate(2000, 1, 1, 'America/Vancouver');
echo $dtOttawa->diffInHours($dtVancouver);
echo $dtVancouver->diffInHours($dtOttawa);

echo $dtOttawa->diffInHours($dtVancouver, false);
echo $dtVancouver->diffInHours($dtOttawa, false);

$dt = Carbon::createMidnightDate(2012, 1, 31);
echo $dt->diffInDays($dt->copy()->addMonth());
echo $dt->diffInDays($dt->copy()->subMonth(), false);

$dt = Carbon::createMidnightDate(2012, 4, 30);
echo $dt->diffInDays($dt->copy()->addMonth());
echo $dt->diffInDays($dt->copy()->addWeek());

$dt = Carbon::createMidnightDate(2012, 1, 1);
echo $dt->diffInMinutes($dt->copy()->addSeconds(59));
echo $dt->diffInMinutes($dt->copy()->addSeconds(60));
echo $dt->diffInMinutes($dt->copy()->addSeconds(119));
echo $dt->diffInMinutes($dt->copy()->addSeconds(120));

echo $dt->addSeconds(120)->secondsSinceMidnight();

$interval = $dt->diffAsCarbonInterval($dt->copy()->subYears(3), false);
// diffAsCarbonInterval use same arguments as diff($other, $absolute)
// (native method from \DateTime)
// except $absolute is true by default for diffAsCarbonInterval and false for diff
// $absolute parameter allow to get signed value if false, or always positive if true
echo ($interval->invert ? 'minus ' : 'plus ') . $interval->years;

```

These methods have int-truncated results. That means `diffInMinutes` returns 1 for any difference between 1 included and 2 excluded. But same methods are available for float results:

```php
echo Carbon::parse('06:01:23.252987')->floatDiffInSeconds('06:02:34.321450');
echo Carbon::parse('06:01:23')->floatDiffInMinutes('06:02:34');
echo Carbon::parse('06:01:23')->floatDiffInHours('06:02:34');
// Those methods are absolute by default but can return negative value
// setting the second argument to false when start date is greater than end date
echo Carbon::parse('12:01:23')->floatDiffInHours('06:02:34', false);
echo Carbon::parse('2000-01-01 12:00')->floatDiffInDays('2000-02-11 06:00');
echo Carbon::parse('2000-01-01')->floatDiffInWeeks('2000-02-11');
echo Carbon::parse('2000-01-15')->floatDiffInMonths('2000-02-24');
// floatDiffInMonths count as many full months as possible from the start date
// (for instance 31 days if the start is in January), then consider the number
// of days in the months for ending chunks to reach the end date.
// So the following result (ending with 24 march is different from previous one with 24 february):
echo Carbon::parse('2000-02-15 12:00')->floatDiffInMonths('2000-03-24 06:00');
// floatDiffInYears apply the same logic (and so different results with leap years)
echo Carbon::parse('2000-02-15 12:00')->floatDiffInYears('2010-03-24 06:00');

```

::: warning
Important note about the daylight saving times (DST), by default PHP DateTime does not take DST into account, that means for example that a day with only 23 hours like March the 30th 2014 in London will be counted as 24 hours long.
:::

::: warning
Be careful of `floatDiffInMonths()` which can gives you a lower result (`number of months in A < number of months in B`) for an interval having more days (`number of days in A > number of days in B`) due to the variable number of days in months (especially February). By default, we rely on the result of [DateTime::diff](https://www.php.net/manual/en/datetime.diff.php) which is sensitive to overflow. [See issue #2264 for alternative calculations](https://github.com/briannesbitt/Carbon/issues/2264).
:::

```php
$date = new \DateTime('2014-03-30 00:00:00', new \DateTimeZone('Europe/London')); // DST off
echo $date->modify('+25 hours')->format('H:i'); // (DST on, 24 hours only have been actually added)

```

Carbon follow this behavior too for add/sub/diff seconds/minutes/hours. But we provide methods to works with _real_ hours using timestamp:

```php
$date = new Carbon('2014-03-30 00:00:00', 'Europe/London'); // DST off
echo $date->addRealHours(25)->format('H:i'); // (DST on)
echo $date->diffInRealHours('2014-03-30 00:00:00');
echo $date->diffInHours('2014-03-30 00:00:00');
echo $date->diffInRealMinutes('2014-03-30 00:00:00');
echo $date->diffInMinutes('2014-03-30 00:00:00');
echo $date->diffInRealSeconds('2014-03-30 00:00:00');
echo $date->diffInSeconds('2014-03-30 00:00:00');
echo $date->diffInRealMilliseconds('2014-03-30 00:00:00');
echo $date->diffInMilliseconds('2014-03-30 00:00:00');
echo $date->diffInRealMicroseconds('2014-03-30 00:00:00');
echo $date->diffInMicroseconds('2014-03-30 00:00:00');
echo $date->subRealHours(25)->format('H:i'); // (DST off)

// with float diff:
$date = new Carbon('2019-10-27 00:00:00', 'Europe/Paris');
echo $date->floatDiffInRealHours('2019-10-28 12:30:00');
echo $date->floatDiffInHours('2019-10-28 12:30:00');
echo $date->floatDiffInRealMinutes('2019-10-28 12:00:30');
echo $date->floatDiffInMinutes('2019-10-28 12:00:30');
echo $date->floatDiffInRealSeconds('2019-10-28 12:00:00.5');
echo $date->floatDiffInSeconds('2019-10-28 12:00:00.5');
// above day unit, "real" will affect the decimal part based on hours and smaller units
echo $date->floatDiffInRealDays('2019-10-28 12:30:00');
echo $date->floatDiffInDays('2019-10-28 12:30:00');
echo $date->floatDiffInRealWeeks('2019-10-28 12:30:00');
echo $date->floatDiffInWeeks('2019-10-28 12:30:00');
echo $date->floatDiffInRealMonths('2019-10-28 12:30:00');
echo $date->floatDiffInMonths('2019-10-28 12:30:00');
echo $date->floatDiffInRealYears('2019-10-28 12:30:00');
echo $date->floatDiffInYears('2019-10-28 12:30:00');

```

The same way you can use `addRealX()` and `subRealX()` on any unit.

There are also special filter functions `diffInDaysFiltered()`, `diffInHoursFiltered()` and `diffFiltered()`, to help you filter the difference by days, hours or a custom interval. For example to count the weekend days between two instances:

```php

$dt = Carbon::create(2014, 1, 1);
$dt2 = Carbon::create(2014, 12, 31);
$daysForExtraCoding = $dt->diffInDaysFiltered(function(Carbon $date) {
   return $date->isWeekend();
}, $dt2);


echo $daysForExtraCoding;


$dt = Carbon::create(2014, 1, 1)->endOfDay();
$dt2 = $dt->copy()->startOfDay();
$littleHandRotations = $dt->diffFiltered(CarbonInterval::minute(), function(Carbon $date) {
   return $date->minute === 0;
}, $dt2, true); // true as last parameter returns absolute value


echo $littleHandRotations;

$date = Carbon::now()->addSeconds(3666);

echo $date->diffInSeconds();
echo $date->diffInMinutes();
echo $date->diffInHours();
echo $date->diffInDays();

$date = Carbon::create(2016, 1, 5, 22, 40, 32);

echo $date->secondsSinceMidnight();
echo $date->secondsUntilEndOfDay();


$date1 = Carbon::createMidnightDate(2016, 1, 5);
$date2 = Carbon::createMidnightDate(2017, 3, 15);


echo $date1->diffInDays($date2);
echo $date1->diffInWeekdays($date2);
echo $date1->diffInWeekendDays($date2);
echo $date1->diffInWeeks($date2);
echo $date1->diffInMonths($date2);
echo $date1->diffInQuarters($date2);
echo $date1->diffInYears($date2);

```

All diffIn\*Filtered method take 1 callable filter as required parameter and a date object as optional second parameter, if missing, now is used. You may also pass true as third parameter to get absolute values.

For advanced handle of the week/weekend days, use the following tools:

```php
echo implode(', ', Carbon::getDays());


$saturday = new Carbon('first saturday of 2019');
$sunday = new Carbon('first sunday of 2019');
$monday = new Carbon('first monday of 2019');


echo implode(', ', Carbon::getWeekendDays());
var_dump($saturday->isWeekend());
var_dump($sunday->isWeekend());
var_dump($monday->isWeekend());


Carbon::setWeekendDays([
	Carbon::SUNDAY,
	Carbon::MONDAY,
]);


echo implode(', ', Carbon::getWeekendDays());
var_dump($saturday->isWeekend());
var_dump($sunday->isWeekend());
var_dump($monday->isWeekend());


Carbon::setWeekendDays([
	Carbon::SATURDAY,
	Carbon::SUNDAY,
]);
// weekend days and start/end of week or not linked
// start/end of week are driven by the locale


var_dump(Carbon::getWeekStartsAt());
var_dump(Carbon::getWeekEndsAt());
var_dump(Carbon::getWeekStartsAt('ar_EG'));
var_dump(Carbon::getWeekEndsAt('ar_EG'));

```
