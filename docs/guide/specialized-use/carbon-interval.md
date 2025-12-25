# CarbonInterval

The CarbonInterval class is [inherited](https://www.php.net/manual/en/language.oop5.inheritance.php) from the PHP [DateInterval](https://www.php.net/manual/en/class.dateinterval.php) class.

```php{no-render}
<?php
class CarbonInterval extends \DateInterval
{
	// code here
}

```

You can create an instance in the following ways:

```php

echo CarbonInterval::createFromFormat('H:i:s', '10:20:00');
echo "\n";

echo CarbonInterval::year();
echo "\n";
echo CarbonInterval::months(3);
echo "\n";
echo CarbonInterval::days(3)->addSeconds(32);
echo "\n";
echo CarbonInterval::weeks(3);
echo "\n";
echo CarbonInterval::days(23);
echo "\n";
// years, months, weeks, days, hours, minutes, seconds, microseconds
echo CarbonInterval::create(2, 0, 5, 1, 1, 2, 7, 123);
echo "\n";
echo CarbonInterval::createFromDateString('3 months');

```

Be careful, Carbon 2 accepts only integer unit values by default, which means: `CarbonInterval::days(3.5)` produces a \[3 days and 0 hours\] interval. In Carbon 3, it will cascade decimal part to smaller units. To enable this behavior in Carbon 2, you can call `CarbonInterval::enableFloatSetters();`.

```php

// Allow decimal numbers
CarbonInterval::enableFloatSetters();
echo CarbonInterval::days(3.5);
echo "\n";

// Disallow decimal numbers
CarbonInterval::enableFloatSetters(false);
echo CarbonInterval::days(3.5);

```

You can add/sub any unit to a given existing interval:

```php

$interval = CarbonInterval::months(3);
echo $interval;
echo "\n";


$interval->subMonths(1);
echo $interval;
echo "\n";


$interval->addDays(15);
echo $interval;

```

We also provide `plus()` and `minus()` method that expect numbers for each unit in the same order than `create()` and can be used in a convenient way with PHP 8:

```php

$interval = CarbonInterval::months(3);
echo $interval;
echo "\n";


$interval->minus(months: 1);
echo $interval;
echo "\n";


$interval->plus(days: 15, hours: 20);
echo $interval;

```

If you find yourself inheriting a `\DateInterval` instance from another library, fear not! You can create a `CarbonInterval` instance via a friendly `instance()` function.

```php
$di = new \DateInterval('P1Y2M'); // <== instance from another API
$ci = CarbonInterval::instance($di);
echo get_class($ci);
echo $ci;

// It creates a new copy of the object when given a CarbonInterval value
$ci2 = CarbonInterval::instance($ci);
var_dump($ci2 === $ci);

// but you can tell to return same object if already an instance of  CarbonInterval
$ci3 = CarbonInterval::instance($ci, skipCopy: true);
var_dump($ci3 === $ci);

// the same option is available on make()
$ci4 = CarbonInterval::make($ci, skipCopy: true);
var_dump($ci4 === $ci);

```

And as the opposite you can extract a raw `DateInterval` from `CarbonInterval` and even cast it in any class that extends `DateInterval`

```php
$ci = CarbonInterval::days(2);
$di = $ci->toDateInterval();
echo get_class($di);
echo $di->d;

// Your custom class can also extends CarbonInterval
class CustomDateInterval extends \DateInterval {}

$di = $ci->cast(CustomDateInterval::class);
echo get_class($di);
echo $di->d;

```

You can compare intervals the same way than Carbon objects, using `equalTo()`, `notEqualTo()` `lessThan()`, `lessThanOrEqualTo()`, `greaterThan()`, `greaterThanOrEqualTo()`, `between()`, `betweenExcluded()`, etc.

Other helpers, but beware the implementation provides helpers to handle weeks but only days are saved. Weeks are calculated based on the total days of the current instance.

```php

echo CarbonInterval::year()->years;
echo CarbonInterval::year()->dayz;
echo CarbonInterval::days(24)->dayz;
echo CarbonInterval::days(24)->daysExcludeWeeks;
echo CarbonInterval::weeks(3)->days(14)->weeks;  // <-- days setter overwrites the current value
echo CarbonInterval::weeks(3)->addDays(14)->weeks;
echo CarbonInterval::weeks(3)->weeks;
echo CarbonInterval::minutes(3)->weeksAndDays(2, 5);

```

CarbonInterval extends DateInterval and you can create both using [ISO-8601 duration format](https://en.wikipedia.org/wiki/ISO_8601#Durations):

```php
$ci = CarbonInterval::create('P1Y2M3D');
var_dump($ci->isEmpty());
$ci = new CarbonInterval('PT0S');
var_dump($ci->isEmpty());

```

Carbon intervals can be created from human-friendly strings thanks to `fromString()` method.

```php
CarbonInterval::fromString('2 minutes 15 seconds');
CarbonInterval::fromString('2m 15s'); // or abbreviated

```

Or create it from an other `DateInterval` / `CarbonInterval` object.

```php
$ci = new CarbonInterval(new \DateInterval('P1Y2M3D'));
var_dump($ci->isEmpty());

```

Note that month abbreviate "mo" to distinguish from minutes and the whole syntax is not case sensitive.

It also has a handy `forHumans()`, which is mapped as the `__toString()` implementation, that prints the interval for humans.

```php

CarbonInterval::setLocale('fr');
echo CarbonInterval::create(2, 1)->forHumans();
echo CarbonInterval::hour()->addSeconds(3);
CarbonInterval::setLocale('en');

```

`forHumans($syntax, $short, $parts, $options)` allow the same option arguments as `Carbon::diffForHumans()` except `$parts` is set to -1 (no limit) by default. [See `Carbon::diffForHumans()` options.](#diff-for-humans-options)

As you can see, you can change the locale of the string using `CarbonInterval::setLocale('fr')`.

As for Carbon, you can use the make method to return a new instance of CarbonInterval from other interval or strings:

```php

$dateInterval = new \DateInterval('P2D');
$carbonInterval = CarbonInterval::month();

echo CarbonInterval::make($dateInterval)->forHumans();
echo CarbonInterval::make($carbonInterval)->forHumans();
echo CarbonInterval::make(5, 'days')->forHumans();
echo CarbonInterval::make('PT3H')->forHumans();
echo CarbonInterval::make('1h 15m')->forHumans();
// forHumans has many options, since version 2.9.0, the recommended way is to pass them as an associative array:
echo CarbonInterval::make('1h 15m')->forHumans(['short' => true]);

// You can create interval from a string in any language:
echo CarbonInterval::parseFromLocale('3 jours et 2 heures', 'fr');
// 'fr' stands for French but can be replaced with any locale code.
// if you don't pass the locale parameter, Carbon::getLocale() (current global locale) is used.

$interval = CarbonInterval::make('1h 15m 45s');
echo $interval->forHumans(['join' => true]);
$esInterval = CarbonInterval::make('1h 15m 45s');
echo $esInterval->forHumans(['join' => true]);
echo $interval->forHumans(['join' => true, 'parts' => 2]);
echo $interval->forHumans(['join' => ' - ']);

// Available syntax modes:
// ago/from now (translated in the current locale)
echo $interval->forHumans(['syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW]);
// before/after (translated in the current locale)
echo $interval->forHumans(['syntax' => CarbonInterface::DIFF_RELATIVE_TO_OTHER]);
// default for intervals (no prefix/suffix):
echo $interval->forHumans(['syntax' => CarbonInterface::DIFF_ABSOLUTE]);

// Available options:
// transform empty intervals into "just now":
echo CarbonInterval::hours(0)->forHumans([
	'options' => CarbonInterface::JUST_NOW,
	'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
]);
// transform empty intervals into "1 second":
echo CarbonInterval::hours(0)->forHumans([
	'options' => CarbonInterface::NO_ZERO_DIFF,
	'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
]);
// transform "1 day ago"/"1 day from now" into "yesterday"/"tomorrow":
echo CarbonInterval::day()->forHumans([
	'options' => CarbonInterface::ONE_DAY_WORDS,
	'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
]);
// transform "2 days ago"/"2 days from now" into "before yesterday"/"after tomorrow":
echo CarbonInterval::days(2)->forHumans([
	'options' => CarbonInterface::TWO_DAY_WORDS,
	'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
]);
// options can be piped:
echo CarbonInterval::days(2)->forHumans([
	'options' => CarbonInterface::ONE_DAY_WORDS | CarbonInterface::TWO_DAY_WORDS,
	'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
]);

// Before version 2.9.0, parameters could only be passed sequentially:
// $interval->forHumans($syntax, $short, $parts, $options)
// and join parameter was not available

```

The add, sub (or subtract), times, shares, multiply and divide methods allow to do proceed intervals calculations:

```php

$interval = CarbonInterval::make('7h 55m');
$interval->add(CarbonInterval::make('17h 35m'));
$interval->subtract(10, 'minutes');
// add(), sub() and subtract() can take DateInterval, CarbonInterval, interval as string or 2 arguments factor and unit
$interval->times(3);

echo $interval->forHumans();
echo "\n";

$interval->shares(7);

echo $interval->forHumans();
echo "\n";
// As you can see add(), times() and shares() operate naively a rounded calculation on each unit

// You also can use multiply() of divide() to cascade units and get precise calculation:
echo CarbonInterval::make('19h 55m')->multiply(3)->forHumans();
echo "\n";
echo CarbonInterval::make('19h 55m')->divide(3)->forHumans();

```

You get pure calculation from your input unit by unit. To cascade minutes into hours, hours into days etc. Use the cascade method:

```php
$interval = CarbonInterval::make('7h 55m');
echo $interval->forHumans();
echo $interval->cascade()->forHumans();

```

Default factors are:

*   1 minute = 60 seconds
*   1 hour = 60 minutes
*   1 day = 24 hour
*   1 week = 7 days
*   1 month = 4 weeks
*   1 year = 12 months

CarbonIntervals do not carry context so they cannot be more precise (no DST, no leap year, no real month length or year length consideration). But you can completely customize those factors. For example to deal with work time logs:

```php

$cascades = CarbonInterval::getCascadeFactors(); // save initial factors

CarbonInterval::setCascadeFactors([
	'minute' => [60, 'seconds'],
	'hour' => [60, 'minutes'],
	'day' => [8, 'hours'],
	'week' => [5, 'days'],
	// in this example the cascade won't go farther than week unit
]);


echo CarbonInterval::fromString('20h')->cascade()->forHumans();
echo CarbonInterval::fromString('10d')->cascade()->forHumans();
echo CarbonInterval::fromString('3w 18d 53h 159m')->cascade()->forHumans();

// You can see currently set factors with getFactor:
echo CarbonInterval::getFactor('minutes', /* per */ 'hour');
echo CarbonInterval::getFactor('days', 'week');

// And common factors can be get with short-cut methods:
echo CarbonInterval::getDaysPerWeek();
echo CarbonInterval::getHoursPerDay();
echo CarbonInterval::getMinutesPerHour();
echo CarbonInterval::getSecondsPerMinute();
echo CarbonInterval::getMillisecondsPerSecond();
echo CarbonInterval::getMicrosecondsPerMillisecond();


CarbonInterval::setCascadeFactors($cascades); // restore original factors


```

Is it possible to convert an interval into a given unit (using provided cascade factors).

```php
echo CarbonInterval::days(3)->addHours(5)->total('hours');
echo CarbonInterval::days(3)->addHours(5)->totalHours;
echo CarbonInterval::months(6)->totalWeeks;
echo CarbonInterval::year()->totalDays;

```

`->total` method and properties need cascaded intervals, if your interval can have overflow, cascade them before calling these feature:

```php
echo CarbonInterval::minutes(1200)->cascade()->total('hours');
echo CarbonInterval::minutes(1200)->cascade()->totalHours;

```

You can also get the ISO 8601 spec of the inverval with `spec()`

```php
echo CarbonInterval::days(3)->addHours(5)->spec();
// By default microseconds are trimmed (as they would fail to recreate a proper DateInterval)
echo CarbonInterval::days(3)->addSeconds(5)->addMicroseconds(987654)->spec();
// But you can explicitly add them:
echo CarbonInterval::days(3)->addSeconds(5)->addMicroseconds(987654)->spec(true);

```

It's also possible to get it from a DateInterval object since to the static helper:

```php
echo CarbonInterval::getDateIntervalSpec(new \DateInterval('P3DT6M10S'));

```

List of date intervals can be sorted thanks to the `compare()` and `compareDateIntervals()` methods:

```php

$halfDay = CarbonInterval::hours(12);
$oneDay = CarbonInterval::day();
$twoDay = CarbonInterval::days(2);


echo CarbonInterval::compareDateIntervals($oneDay, $oneDay);
echo $oneDay->compare($oneDay);
echo CarbonInterval::compareDateIntervals($oneDay, $halfDay);
echo $oneDay->compare($halfDay);
echo CarbonInterval::compareDateIntervals($oneDay, $twoDay);
echo $oneDay->compare($twoDay);


$list = [$twoDay, $halfDay, $oneDay];
usort($list, ['Carbon\CarbonInterval', 'compareDateIntervals']);


echo implode(', ', $list);

```

Alternatively to fixed intervals, Dynamic intervals can be described with a function to step from a date to an other date:

```php
$weekDayInterval = new CarbonInterval(function (CarbonInterface $date, bool $negated): \DateTime {
	// $negated is true when a subtraction is requested, false when an addition is requested
	return $negated
		? $date->subWeekday()
		: $date->addWeekday();
});


echo Carbon::parse('Wednesday')->sub($weekDayInterval)->dayName;
echo "\n";
echo Carbon::parse('Friday')->add($weekDayInterval)->dayName;
echo "\n";

foreach (Carbon::parse('2020-06-01')->range('2020-06-17', $weekDayInterval) as $date) {
	// every week day
	echo ' '.$date->day;
}


```

You can access and modify the closure step definition using `getStep()` and `setStep()` (the setter can take `null` to remove it so it becomes a simple fixed interval. And as long as the interval has a step, it will take the precedence over all fixed units it contains.

You can call `convertDate()` to apply the current dynamic or static interval to a date (`DateTime`, `Carbon` or immutable ones) positively (or negatively passing `true` as a second argument):

```php
$weekDayInterval = new CarbonInterval(function (CarbonInterface $date, bool $negated): \DateTime {
	// $negated is true when a subtraction is requested, false when an addition is requested
	return $negated
		? $date->subWeekday()
		: $date->addWeekday();
});
echo $weekDayInterval->convertDate(new \DateTime('Wednesday'), true)->dayName;
echo $weekDayInterval->convertDate(new \DateTime('Friday'))->dayName;

```

Dump interval values as an array with:

```php

$interval = CarbonInterval::months(2)->addHours(12)->addSeconds(50);


// All the values:
print_r($interval->toArray());

// Values sequence from the biggest to the smallest non-zero ones:
print_r($interval->getValuesSequence());

// Non-zero values:
print_r($interval->getNonZeroValues());

```

Last, a CarbonInterval instance can be converted into a CarbonPeriod instance by calling `toPeriod()` with complementary arguments.

I hear you ask what is a CarbonPeriod instance. Oh! Perfect transition to our next chapter.
