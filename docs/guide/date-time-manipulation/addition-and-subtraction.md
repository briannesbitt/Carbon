# Addition and Subtraction

The default DateTime provides a couple of different methods for easily adding and subtracting time. There is `modify()`, `add()` and `sub()`. `change()` is an enhanced version of `modify()` that can take _magical_ date/time format string, `'last day of next month'`, that it parses and applies the modification while `add()` and `sub()` can take the same the same kind of string, intervals (`DateInterval` or `CarbonInterval`) or count+unit parameters. But you can still access the native methods of `DateTime` class using `rawAdd()` and `rawSub()`.

```php
$dt = Carbon::create(2012, 1, 31, 0);

echo $dt->toDateTimeString();

echo $dt->addCenturies(5);
echo $dt->addCentury();
echo $dt->subCentury();
echo $dt->subCenturies(5);

echo $dt->addYears(5);
echo $dt->addYear();
echo $dt->subYear();
echo $dt->subYears(5);

echo $dt->addQuarters(2);
echo $dt->addQuarter();
echo $dt->subQuarter();
echo $dt->subQuarters(2);

echo $dt->addMonths(60);
echo $dt->addMonth(); // equivalent of $dt->month($dt->month + 1); so it wraps
echo $dt->subMonth();
echo $dt->subMonths(60);

echo $dt->addDays(29);
echo $dt->addDay();
echo $dt->subDay();
echo $dt->subDays(29);

echo $dt->addWeekdays(4);
echo $dt->addWeekday();
echo $dt->subWeekday();
echo $dt->subWeekdays(4);

echo $dt->addWeeks(3);
echo $dt->addWeek();
echo $dt->subWeek();
echo $dt->subWeeks(3);

echo $dt->addHours(24);
echo $dt->addHour();
echo $dt->subHour();
echo $dt->subHours(24);

echo $dt->addMinutes(61);
echo $dt->addMinute();
echo $dt->subMinute();
echo $dt->subMinutes(61);

echo $dt->addSeconds(61);
echo $dt->addSecond();
echo $dt->subSecond();
echo $dt->subSeconds(61);

echo $dt->addMilliseconds(61);
echo $dt->addMillisecond();
echo $dt->subMillisecond();
echo $dt->subMillisecond(61);

echo $dt->addMicroseconds(61);
echo $dt->addMicrosecond();
echo $dt->subMicrosecond();
echo $dt->subMicroseconds(61);

// and so on for any unit: millenium, century, decade, year, quarter, month, week, day, weekday,
// hour, minute, second, microsecond.

// Generic methods add/sub (or subtract alias) can take many different arguments:
echo $dt->add(61, 'seconds');
echo $dt->sub('1 day');
echo $dt->add(CarbonInterval::months(2));
echo $dt->subtract(new \DateInterval('PT1H'));

```

For fun you can also pass negative values to `addXXX()`, in fact that's how `subXXX()` is implemented.

P.S. Don't worry if you forget and use `addDay(5)` or `subYear(3)`, I have your back ;)

By default, Carbon relies on the underlying parent class PHP DateTime behavior. As a result adding or subtracting months can overflow, example:

```php
$dt = CarbonImmutable::create(2017, 1, 31, 0);

echo $dt->addMonth();
echo "\n";
echo $dt->subMonths(2);

```

Since Carbon 2, you can set a local overflow behavior for each instance:

```php
$dt = CarbonImmutable::create(2017, 1, 31, 0);
$dt->settings([
	'monthOverflow' => false,
]);


echo $dt->addMonth();
echo "\n";
echo $dt->subMonths(2);

```

This will apply for methods `addMonth(s)`, `subMonth(s)`, `add($x, 'month')`, `sub($x, 'month')` and equivalent quarter methods. But it won't apply for intervals objects or strings like `add(CarbonInterval::month())` or `add('1 month')`.

Static helpers exist but are deprecated. If you're sure to need to apply global setting or work with version 1 of Carbon, [check the overflow static helpers section](#overflow-static-helpers)

You can prevent the overflow with `Carbon::useMonthsOverflow(false)`

```php
Carbon::useMonthsOverflow(false);

$dt = Carbon::createMidnightDate(2017, 1, 31);

echo $dt->copy()->addMonth();
echo "\n";
echo $dt->copy()->subMonths(2);

// Call the method with true to allow overflow again
Carbon::resetMonthsOverflow(); // same as Carbon::useMonthsOverflow(true);

```

The method `Carbon::shouldOverflowMonths()` allows you to know if the overflow is currently enabled.

```php
Carbon::useMonthsOverflow(false);

$dt = Carbon::createMidnightDate(2017, 1, 31);

echo $dt->copy()->addMonthWithOverflow();
// plural addMonthsWithOverflow() method is also available
echo $dt->copy()->subMonthsWithOverflow(2);
// singular subMonthWithOverflow() method is also available
echo $dt->copy()->addMonthNoOverflow();
// plural addMonthsNoOverflow() method is also available
echo $dt->copy()->subMonthsNoOverflow(2);
// singular subMonthNoOverflow() method is also available

echo $dt->copy()->addMonth();
echo $dt->copy()->subMonths(2);

Carbon::useMonthsOverflow(true);

$dt = Carbon::createMidnightDate(2017, 1, 31);

echo $dt->copy()->addMonthWithOverflow();
echo $dt->copy()->subMonthsWithOverflow(2);
echo $dt->copy()->addMonthNoOverflow();
echo $dt->copy()->subMonthsNoOverflow(2);

echo $dt->copy()->addMonth();
echo $dt->copy()->subMonths(2);

Carbon::resetMonthsOverflow();

```

From version 1.23.0, overflow control is also available on years:

```php
Carbon::useYearsOverflow(false);

$dt = Carbon::createMidnightDate(2020, 2, 29);

var_dump(Carbon::shouldOverflowYears());

echo $dt->copy()->addYearWithOverflow();
// plural addYearsWithOverflow() method is also available
echo $dt->copy()->subYearsWithOverflow(2);
// singular subYearWithOverflow() method is also available
echo $dt->copy()->addYearNoOverflow();
// plural addYearsNoOverflow() method is also available
echo $dt->copy()->subYearsNoOverflow(2);
// singular subYearNoOverflow() method is also available

echo $dt->copy()->addYear();
echo $dt->copy()->subYears(2);

Carbon::useYearsOverflow(true);

$dt = Carbon::createMidnightDate(2020, 2, 29);

var_dump(Carbon::shouldOverflowYears());

echo $dt->copy()->addYearWithOverflow();
echo $dt->copy()->subYearsWithOverflow(2);
echo $dt->copy()->addYearNoOverflow();
echo $dt->copy()->subYearsNoOverflow(2);

echo $dt->copy()->addYear();
echo $dt->copy()->subYears(2);

Carbon::resetYearsOverflow();

```

You also can use `->addMonthsNoOverflow`, `->subMonthsNoOverflow`, `->addMonthsWithOverflow` and `->subMonthsWithOverflow` (or the singular methods with no `s` to "month") to explicitly add/sub months with or without overflow no matter the current mode and the same for any bigger unit (quarter, year, decade, century, millennium).

```php
$dt = Carbon::createMidnightDate(2017, 1, 31)->settings([
	'monthOverflow' => false,
]);

echo $dt->copy()->addMonthWithOverflow();
// plural addMonthsWithOverflow() method is also available
echo $dt->copy()->subMonthsWithOverflow(2);
// singular subMonthWithOverflow() method is also available
echo $dt->copy()->addMonthNoOverflow();
// plural addMonthsNoOverflow() method is also available
echo $dt->copy()->subMonthsNoOverflow(2);
// singular subMonthNoOverflow() method is also available

echo $dt->copy()->addMonth();
echo $dt->copy()->subMonths(2);

$dt = Carbon::createMidnightDate(2017, 1, 31)->settings([
	'monthOverflow' => true,
]);

echo $dt->copy()->addMonthWithOverflow();
echo $dt->copy()->subMonthsWithOverflow(2);
echo $dt->copy()->addMonthNoOverflow();
echo $dt->copy()->subMonthsNoOverflow(2);

echo $dt->copy()->addMonth();
echo $dt->copy()->subMonths(2);

```

The same is available for years.

You also can control overflow for any unit when working with unknown inputs:

```php
$dt = CarbonImmutable::create(2018, 8, 30, 12, 00, 00);

// Add hours without overflowing day
echo $dt->addUnitNoOverflow('hour', 7, 'day');
echo "\n";
echo $dt->addUnitNoOverflow('hour', 14, 'day');
echo "\n";
echo $dt->addUnitNoOverflow('hour', 48, 'day');

echo "\n-------\n";

// Substract hours without overflowing day
echo $dt->subUnitNoOverflow('hour', 7, 'day');
echo "\n";
echo $dt->subUnitNoOverflow('hour', 14, 'day');
echo "\n";
echo $dt->subUnitNoOverflow('hour', 48, 'day');

echo "\n-------\n";

// Set hours without overflowing day
echo $dt->setUnitNoOverflow('hour', -7, 'day');
echo "\n";
echo $dt->setUnitNoOverflow('hour', 14, 'day');
echo "\n";
echo $dt->setUnitNoOverflow('hour', 25, 'day');

echo "\n-------\n";

// Adding hours without overflowing month
echo $dt->addUnitNoOverflow('hour', 7, 'month');
echo "\n";
echo $dt->addUnitNoOverflow('hour', 14, 'month');
echo "\n";
echo $dt->addUnitNoOverflow('hour', 48, 'month');

```

Any modifiable unit can be passed as argument of those methods:

```php
$units = [];
foreach (['millennium', 'century', 'decade', 'year', 'quarter', 'month', 'week', 'weekday', 'day', 'hour', 'minute', 'second', 'millisecond', 'microsecond'] as $unit) {
	$units[$unit] = Carbon::isModifiableUnit($unit);
}


echo json_encode($units, JSON_PRETTY_PRINT);
```
