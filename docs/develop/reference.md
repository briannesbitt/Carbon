# Reference
#### Carbon::__call

Dynamically handle calls to the class.


##### Parameters
- $method `string` magic method name called
- $parameters `array` parameters list
#### Carbon::__callStatic

Dynamically handle calls to the class.


##### Parameters
- $method `string` magic method name called
- $parameters `array` parameters list
#### Carbon::__clone

Update constructedObjectId on cloned.


#### Carbon::__construct

Create a new Carbon instance.

Please see the testing aids section (specifically static::setTestNow())
for more on the possibility of this constructor returning a test instance.
#### Carbon::__debugInfo

Show truthy properties on var_dump().


#### Carbon::__get

Get a part of the Carbon object.


returns `string|int|bool|\DateTimeZone|null`
#### Carbon::__isset

Check if an attribute exists on the object


##### Parameters
- $name `string`
returns `bool`
#### Carbon::__serialize

Returns the values to dump on serialize() called on.


returns `array`
#### Carbon::__set

Set a part of the Carbon object


##### Parameters
- $name `string`
- $value `string|int|\DateTimeZone`
returns `void`
#### Carbon::__set_state

The __set_state handler.


##### Parameters
- $dump `string|array`
returns `static`
#### Carbon::__toString

Format the instance as a string using the set format


##### Examples
```php
echo Carbon::now(); // Carbon instances can be cast to string
```
#### Carbon::__unserialize

Set locale if specified on unserialize() called.


#### Carbon::add

Add given units or interval to the current instance.


##### Parameters
- $unit `\Unit|int|string|\DateInterval|\Closure|\CarbonConverterInterface`
- $value `\Unit|int|float|string`
- $overflow `bool|null`
returns `static`
##### Examples
$date->add('hour', 3)
$date->add(15, 'days')
$date->add(CarbonInterval::days(4))
#### Carbon::addRealUnit




::: warning Deprectated
Prefer to use add addUTCUnit() which more accurately defines what it's doing.

Add seconds to the instance using timestamp. Positive $value travels
forward while negative $value travels into the past.
:::
##### Parameters
- $unit `string`
- $value `int|float|null`
returns `static`
#### Carbon::addUTCUnit

Add seconds to the instance using timestamp. Positive $value travels
forward while negative $value travels into the past.


##### Parameters
- $unit `string`
- $value `int|float|null`
returns `static`
#### Carbon::addUnit

Add given units to the current instance.


#### Carbon::addUnitNoOverflow

Add any unit to a new value without overflowing current other unit given.


##### Parameters
- $valueUnit `string` unit name to modify
- $value `int` amount to add to the input unit
- $overflowUnit `string` unit name to not overflow
#### Carbon::ago

Get the difference in a human readable format in the current locale from an other
instance given to now


##### Parameters
- $syntax `int|array`

if array passed, parameters will be extracted from it, the array may contains:
  - 'syntax' entry (see below)
  - 'short' entry (see below)
  - 'parts' entry (see below)
  - 'options' entry (see below)
  - 'join' entry determines how to join multiple parts of the string
  `  - if $join is a string, it's used as a joiner glue
  `  - if $join is a callable/closure, it get the list of string and should return a string
  `  - if $join is an array, the first item will be the default glue, and the second item
  `    will be used instead of the glue for the last item
  `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
  `  - if $join is missing, a space will be used as glue
  if int passed, it add modifiers:
  Possible values:
  - CarbonInterface::DIFF_ABSOLUTE          no modifiers
  - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
  - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
  Default value: CarbonInterface::DIFF_ABSOLUTE
- $short `bool` displays short format of time units
- $parts `int` maximum number of parts to display (default value: 1: single part)
- $options `int` human diff options
returns `string`
#### Carbon::average

Modify the current instance to the average of a given instance (default now) and the current instance
(second-precision).


##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|null`
returns `static`
#### Carbon::avoidMutation

Clone the current instance if it's mutable.

This method is convenient to ensure you don't mutate the initial object
but avoid to make a useless copy of it if it's already immutable.
returns `static`
#### Carbon::between

Determines if the instance is between two others.

The third argument allow you to specify if bounds are included or not (true by default)
but for when you including/excluding bounds may produce different results in your application,
we recommend to use the explicit methods ->betweenIncluded() or ->betweenExcluded() instead.
##### Parameters
- $equal `bool` Indicates if an equal to comparison should be done
##### Examples
```php
Carbon::parse('2018-07-25')->between('2018-07-14', '2018-08-01'); // true
Carbon::parse('2018-07-25')->between('2018-08-01', '2018-08-20'); // false
Carbon::parse('2018-07-25')->between('2018-07-25', '2018-08-01'); // true
Carbon::parse('2018-07-25')->between('2018-07-25', '2018-08-01', false); // false
```
#### Carbon::betweenExcluded

Determines if the instance is between two others, bounds excluded.


##### Examples
```php
Carbon::parse('2018-07-25')->betweenExcluded('2018-07-14', '2018-08-01'); // true
Carbon::parse('2018-07-25')->betweenExcluded('2018-08-01', '2018-08-20'); // false
Carbon::parse('2018-07-25')->betweenExcluded('2018-07-25', '2018-08-01'); // false
```
#### Carbon::betweenIncluded

Determines if the instance is between two others, bounds included.


##### Examples
```php
Carbon::parse('2018-07-25')->betweenIncluded('2018-07-14', '2018-08-01'); // true
Carbon::parse('2018-07-25')->betweenIncluded('2018-08-01', '2018-08-20'); // false
Carbon::parse('2018-07-25')->betweenIncluded('2018-07-25', '2018-08-01'); // true
```
#### Carbon::calendar

Returns either day of week + time (e.g. "Last Friday at 3:30 PM") if reference time is within 7 days,
or a calendar date (e.g. "10/29/2017") otherwise.

Language, date and time formats will change according to the current locale.
##### Parameters
- $referenceTime `\Carbon|\DateTimeInterface|string|null`
- $formats `array`
returns `string`
#### Carbon::canBeCreatedFromFormat

Checks if the (date)time string is in a given format and valid to create a
new instance.


##### Examples
```php
Carbon::canBeCreatedFromFormat('11:12:45', 'h:i:s'); // true
Carbon::canBeCreatedFromFormat('13:12:45', 'h:i:s'); // false
```
#### Carbon::carbonize

Return the Carbon instance passed through, a now instance in the same timezone
if null given or parse the input if string given.


##### Parameters
- $date `\Carbon|\Carbon\CarbonPeriod|\Carbon\CarbonInterval|\DateInterval|\DatePeriod|\DateTimeInterface|string|null`
returns `static`
#### Carbon::cast

Cast the current instance into the given class.


##### Parameters
- $className `class-string<\T>` The $className::instance() method will be called to cast the current object.
returns `\T`
#### Carbon::ceil

Ceil the current instance second with given precision if specified.


#### Carbon::ceilUnit

Ceil the current instance at the given unit with given precision if specified.


#### Carbon::ceilWeek

Ceil the current instance week.


##### Parameters
- $weekStartsAt `\WeekDay|int|null` optional start allow you to specify the day of week to use to start the week
#### Carbon::change

Similar to native modify() method of DateTime but can handle more grammars.


##### Parameters
- $modifier `string`
returns `static`
##### Examples
```php
echo Carbon::now()->change('next 2pm');
```
#### Carbon::cleanupDumpProperties

Cleanup properties attached to the public scope of DateTime when a dump of the date is requested.

foreach ($date as $_) }
serializer($date)
var_export($date)
get_object_vars($date)
#### Carbon::clone




returns `static`
#### Carbon::closest

Get the closest date from the instance (second-precision).


##### Parameters
- $date1 `\Carbon\Carbon|\DateTimeInterface|mixed`
- $date2 `\Carbon\Carbon|\DateTimeInterface|mixed`
returns `static`
#### Carbon::copy

Get a copy of the instance.


returns `static`
#### Carbon::create

Create a new Carbon instance from a specific date and time.

If any of $year, $month or $day are set to null their now() values will
be used.

If $hour is null it will be set to its now() value and the default
values for $minute and $second will be their now() values.

If $hour is not null then the default values for $minute and $second
will be 0.
##### Parameters
- $year `\DateTimeInterface|string|int|null`
- $month `int|null`
- $day `int|null`
- $hour `int|null`
- $minute `int|null`
- $second `int|null`
- $timezone `\DateTimeZone|string|int|null`
returns `static|null`
#### Carbon::createFromDate

Create a Carbon instance from just a date. The time portion is set to now.


##### Parameters
- $year `int|null`
- $month `int|null`
- $day `int|null`
- $timezone `\DateTimeZone|string|int|null`
returns `static`
#### Carbon::createFromFormat

Create a Carbon instance from a specific format.


##### Parameters
- $format `string` Datetime format
- $time `string`
- $timezone `\DateTimeZone|string|int|null`
returns `static|null`
#### Carbon::createFromIsoFormat

Create a Carbon instance from a specific ISO format (same replacements as ->isoFormat()).


##### Parameters
- $format `string` Datetime format
- $time `string`
- $timezone `\DateTimeZone|string|int|null` optional timezone
- $locale `string|null` locale to be used for LTS, LT, LL, LLL, etc. macro-formats (en by fault, unneeded if no such macro-format in use)
- $translator `\TranslatorInterface|null` optional custom translator to use for macro-formats
returns `static|null`
#### Carbon::createFromLocaleFormat

Create a Carbon instance from a specific format and a string in a given language.


##### Parameters
- $format `string` Datetime format
- $locale `string`
- $time `string`
- $timezone `\DateTimeZone|string|int|null`
returns `static|null`
#### Carbon::createFromLocaleIsoFormat

Create a Carbon instance from a specific ISO format and a string in a given language.


##### Parameters
- $format `string` Datetime ISO format
- $locale `string`
- $time `string`
- $timezone `\DateTimeZone|string|int|null`
returns `static|null`
#### Carbon::createFromTime

Create a Carbon instance from just a time. The date portion is set to today.


##### Parameters
- $hour `int|null`
- $minute `int|null`
- $second `int|null`
- $timezone `\DateTimeZone|string|int|null`
returns `static`
#### Carbon::createFromTimeString

Create a Carbon instance from a time string. The date portion is set to today.


#### Carbon::createFromTimestamp

Create a Carbon instance from a timestamp and set the timezone (UTC by default).

Timestamp input can be given as int, float or a string containing one or more numbers.
#### Carbon::createFromTimestampMs

Create a Carbon instance from a timestamp in milliseconds.

Timestamp input can be given as int, float or a string containing one or more numbers.
#### Carbon::createFromTimestampMsUTC

Create a Carbon instance from a timestamp in milliseconds.

Timestamp input can be given as int, float or a string containing one or more numbers.
##### Parameters
- $timestamp `float|int|string`
returns `static`
#### Carbon::createFromTimestampUTC

Create a Carbon instance from a timestamp keeping the timezone to UTC.

Timestamp input can be given as int, float or a string containing one or more numbers.
#### Carbon::createMidnightDate

Create a Carbon instance from just a date. The time portion is set to midnight.


##### Parameters
- $year `int|null`
- $month `int|null`
- $day `int|null`
- $timezone `\DateTimeZone|string|int|null`
returns `static`
#### Carbon::createSafe

Create a new safe Carbon instance from a specific date and time.

If any of $year, $month or $day are set to null their now() values will
be used.

If $hour is null it will be set to its now() value and the default
values for $minute and $second will be their now() values.

If $hour is not null then the default values for $minute and $second
will be 0.

If one of the set values is not valid, an InvalidDateException
will be thrown.
##### Parameters
- $year `int|null`
- $month `int|null`
- $day `int|null`
- $hour `int|null`
- $minute `int|null`
- $second `int|null`
- $timezone `\DateTimeZone|string|int|null`
returns `static|null`
#### Carbon::createStrict

Create a new Carbon instance from a specific date and time using strict validation.


##### Parameters
- $year `int|null`
- $month `int|null`
- $day `int|null`
- $hour `int|null`
- $minute `int|null`
- $second `int|null`
- $timezone `\DateTimeZone|string|int|null`
returns `static`
#### Carbon::dayOfYear

Get/set the day of year.


##### Parameters
- $value `int|null` new value for day of year if using as setter.
returns `static|int`
#### Carbon::diff




##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `\CarbonInterval`
#### Carbon::diffAsCarbonInterval

Get the difference as a CarbonInterval instance.

Return relative interval (negative if $absolute flag is not set to true and the given date is before
current one).
##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `\CarbonInterval`
#### Carbon::diffAsDateInterval

Get the difference as a DateInterval instance.

Return relative interval (negative if $absolute flag is not set to true and the given date is before
current one).
##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `\DateInterval`
#### Carbon::diffFiltered

Get the difference by the given interval using a filter closure.


##### Parameters
- $ci `\CarbonInterval` An interval to traverse by
- $callback `\Closure`
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `int`
#### Carbon::diffForHumans

Get the difference in a human readable format in the current locale from current instance to an other
instance given (or now if null given).


##### Parameters
- $other `\Carbon|\DateTimeInterface|string|array|null`

if array passed, will be used as parameters array, see $syntax below;
  if null passed, now will be used as comparison reference;
  if any other type, it will be converted to date and used as reference.
- $syntax `int|array`

if array passed, parameters will be extracted from it, the array may contains:
  ⦿ 'syntax' entry (see below)
  ⦿ 'short' entry (see below)
  ⦿ 'parts' entry (see below)
  ⦿ 'options' entry (see below)
  ⦿ 'skip' entry, list of units to skip (array of strings or a single string,
  ` it can be the unit name (singular or plural) or its shortcut
  ` (y, m, w, d, h, min, s, ms, µs).
  ⦿ 'aUnit' entry, prefer "an hour" over "1 hour" if true
  ⦿ 'altNumbers' entry, use alternative numbers if available
  ` (from the current language if true is passed, from the given language(s)
  ` if array or string is passed)
  ⦿ 'join' entry determines how to join multiple parts of the string
  `  - if $join is a string, it's used as a joiner glue
  `  - if $join is a callable/closure, it get the list of string and should return a string
  `  - if $join is an array, the first item will be the default glue, and the second item
  `    will be used instead of the glue for the last item
  `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
  `  - if $join is missing, a space will be used as glue
  ⦿ 'other' entry (see above)
  ⦿ 'minimumUnit' entry determines the smallest unit of time to display can be long or
  `  short form of the units, e.g. 'hour' or 'h' (default value: s)
  ⦿ 'locale' language in which the diff should be output (has no effect if 'translator' key is set)
  ⦿ 'translator' a custom translator to use to translator the output.
  if int passed, it adds modifiers:
  Possible values:
  - CarbonInterface::DIFF_ABSOLUTE          no modifiers
  - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
  - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
  Default value: CarbonInterface::DIFF_ABSOLUTE
- $short `bool` displays short format of time units
- $parts `int` maximum number of parts to display (default value: 1: single unit)
- $options `int` human diff options
##### Examples
```php
echo Carbon::tomorrow()->diffForHumans() . "\n";
echo Carbon::tomorrow()->diffForHumans(['parts' => 2]) . "\n";
echo Carbon::tomorrow()->diffForHumans(['parts' => 3, 'join' => true]) . "\n";
echo Carbon::tomorrow()->diffForHumans(Carbon::yesterday()) . "\n";
echo Carbon::tomorrow()->diffForHumans(Carbon::yesterday(), ['short' => true]) . "\n";
```
#### Carbon::diffInDays

Get the difference in days.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)
returns `float`
#### Carbon::diffInDaysFiltered

Get the difference in days using a filter closure.


##### Parameters
- $callback `\Closure`
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `int`
#### Carbon::diffInHours

Get the difference in hours.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `float`
#### Carbon::diffInHoursFiltered

Get the difference in hours using a filter closure.


##### Parameters
- $callback `\Closure`
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `int`
#### Carbon::diffInMicroseconds

Get the difference in microseconds.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `float`
#### Carbon::diffInMilliseconds

Get the difference in milliseconds.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `float`
#### Carbon::diffInMinutes

Get the difference in minutes.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `float`
#### Carbon::diffInMonths

Get the difference in months.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)
returns `float`
#### Carbon::diffInQuarters

Get the difference in quarters.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)
returns `float`
#### Carbon::diffInSeconds

Get the difference in seconds.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `float`
#### Carbon::diffInUnit




##### Parameters
- $unit `\Unit|string`

microsecond, millisecond, second, minute,
  hour, day, week, month, quarter, year,
  century, millennium
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)
returns `float`
#### Carbon::diffInWeekdays

Get the difference in weekdays.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `int`
#### Carbon::diffInWeekendDays

Get the difference in weekend days using a filter.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
returns `int`
#### Carbon::diffInWeeks

Get the difference in weeks.


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)
returns `float`
#### Carbon::diffInYears

Get the difference in years


##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null`
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)
returns `float`
#### Carbon::disableHumanDiffOption




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### Carbon::enableHumanDiffOption




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### Carbon::endOf

Modify to end of current given unit.


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->startOf(Unit::Month)
  ->endOf(Unit::Week, Carbon::FRIDAY);
```
#### Carbon::endOfCentury

Resets the date to end of the century and time to 23:59:59.999999


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfCentury();
```
#### Carbon::endOfDay

Resets the time to 23:59:59.999999 end of day


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfDay();
```
#### Carbon::endOfDecade

Resets the date to end of the decade and time to 23:59:59.999999


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfDecade();
```
#### Carbon::endOfHour

Modify to end of current hour, minutes and seconds become 59


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfHour();
```
#### Carbon::endOfMillennium

Resets the date to end of the millennium and time to 23:59:59.999999


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfMillennium();
```
#### Carbon::endOfMillisecond

Modify to end of current millisecond, microseconds such as 12345 become 123999


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->endOfSecond()
  ->format('H:i:s.u');
```
#### Carbon::endOfMinute

Modify to end of current minute, seconds become 59


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfMinute();
```
#### Carbon::endOfMonth

Resets the date to end of the month and time to 23:59:59.999999


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfMonth();
```
#### Carbon::endOfQuarter

Resets the date to end of the quarter and time to 23:59:59.999999


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfQuarter();
```
#### Carbon::endOfSecond

Modify to end of current second, microseconds become 999999


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->endOfSecond()
  ->format('H:i:s.u');
```
#### Carbon::endOfWeek

Resets the date to end of week (defined in $weekEndsAt) and time to 23:59:59.999999


##### Parameters
- $weekEndsAt `\WeekDay|int|null` optional end allow you to specify the day of week to use to end the week
returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfWeek() . "\n";
echo Carbon::parse('2018-07-25 12:45:16')->locale('ar')->endOfWeek() . "\n";
echo Carbon::parse('2018-07-25 12:45:16')->endOfWeek(Carbon::SATURDAY) . "\n";
```
#### Carbon::endOfYear

Resets the date to end of the year and time to 23:59:59.999999


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfYear();
```
#### Carbon::eq

Determines if the instance is equal to another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->eq('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->eq(Carbon::parse('2018-07-25 12:45:16')); // true
Carbon::parse('2018-07-25 12:45:16')->eq('2018-07-25 12:45:17'); // false
```
#### Carbon::equalTo

Determines if the instance is equal to another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->equalTo('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->equalTo(Carbon::parse('2018-07-25 12:45:16')); // true
Carbon::parse('2018-07-25 12:45:16')->equalTo('2018-07-25 12:45:17'); // false
```
#### Carbon::executeWithLocale

Set the current locale to the given, execute the passed function, reset the locale to previous one,
then return the result of the closure (or null if the closure was void).


##### Parameters
- $locale `string` locale ex. en
- $func `callable`
returns `mixed`
#### Carbon::farthest

Get the farthest date from the instance (second-precision).


##### Parameters
- $date1 `\Carbon\Carbon|\DateTimeInterface|mixed`
- $date2 `\Carbon\Carbon|\DateTimeInterface|mixed`
returns `static`
#### Carbon::firstOfMonth

Modify to the first occurrence of a given day of the week
in the current month. If no dayOfWeek is provided, modify to the
first day of the current month.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.


##### Parameters
- $dayOfWeek `int|null`
returns `static`
#### Carbon::firstOfQuarter

Modify to the first occurrence of a given day of the week
in the current quarter. If no dayOfWeek is provided, modify to the
first day of the current quarter.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.


##### Parameters
- $dayOfWeek `int|null` day of the week default null
returns `static`
#### Carbon::firstOfYear

Modify to the first occurrence of a given day of the week
in the current year. If no dayOfWeek is provided, modify to the
first day of the current year.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.


##### Parameters
- $dayOfWeek `int|null` day of the week default null
returns `static`
#### Carbon::floor

Round the current instance second with given precision if specified.


#### Carbon::floorUnit

Truncate the current instance at the given unit with given precision if specified.


#### Carbon::floorWeek

Truncate the current instance week.


##### Parameters
- $weekStartsAt `\WeekDay|int|null` optional start allow you to specify the day of week to use to start the week
#### Carbon::format

Returns the formatted date string on success or FALSE on failure.


#### Carbon::from




##### Parameters
- $other `\Carbon|\DateTimeInterface|string|array|null`

if array passed, will be used as parameters array, see $syntax below;
  if null passed, now will be used as comparison reference;
  if any other type, it will be converted to date and used as reference.
- $syntax `int|array`

if array passed, parameters will be extracted from it, the array may contains:
  - 'syntax' entry (see below)
  - 'short' entry (see below)
  - 'parts' entry (see below)
  - 'options' entry (see below)
  - 'join' entry determines how to join multiple parts of the string
  `  - if $join is a string, it's used as a joiner glue
  `  - if $join is a callable/closure, it get the list of string and should return a string
  `  - if $join is an array, the first item will be the default glue, and the second item
  `    will be used instead of the glue for the last item
  `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
  `  - if $join is missing, a space will be used as glue
  - 'other' entry (see above)
  if int passed, it add modifiers:
  Possible values:
  - CarbonInterface::DIFF_ABSOLUTE          no modifiers
  - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
  - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
  Default value: CarbonInterface::DIFF_ABSOLUTE
- $short `bool` displays short format of time units
- $parts `int` maximum number of parts to display (default value: 1: single unit)
- $options `int` human diff options
returns `string`
#### Carbon::fromNow

Get the difference in a human readable format in the current locale from current
instance to now.


##### Parameters
- $syntax `int|array`

if array passed, parameters will be extracted from it, the array may contains:
  - 'syntax' entry (see below)
  - 'short' entry (see below)
  - 'parts' entry (see below)
  - 'options' entry (see below)
  - 'join' entry determines how to join multiple parts of the string
  `  - if $join is a string, it's used as a joiner glue
  `  - if $join is a callable/closure, it get the list of string and should return a string
  `  - if $join is an array, the first item will be the default glue, and the second item
  `    will be used instead of the glue for the last item
  `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
  `  - if $join is missing, a space will be used as glue
  if int passed, it add modifiers:
  Possible values:
  - CarbonInterface::DIFF_ABSOLUTE          no modifiers
  - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
  - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
  Default value: CarbonInterface::DIFF_ABSOLUTE
- $short `bool` displays short format of time units
- $parts `int` maximum number of parts to display (default value: 1: single unit)
- $options `int` human diff options
returns `string`
#### Carbon::fromSerialized

Create an instance from a serialized string.

If $value is not from a trusted source, consider using the allowed_classes option to limit
the types of objects that can be built, for instance:
##### Parameters
- $value `\Stringable|string`
- $options `array` example: ['allowed_classes' => [CarbonImmutable::class]]
returns `static`
##### Examples
```php
$object = Carbon::fromSerialized($value, ['allowed_classes' => [Carbon::class, CarbonImmutable::class]]);
```
#### Carbon::genericMacro

Register a custom macro.


##### Parameters
- $macro `callable`
- $priority `int` marco with higher priority is tried first
returns `void`
#### Carbon::get

Get a part of the Carbon object.


returns `string|int|bool|\DateTimeZone`
#### Carbon::getAltNumber

Returns the alternative number for a given date property if available in the current locale.


##### Parameters
- $key `string` date property
#### Carbon::getAvailableLocales

Returns the list of internally available locales and already loaded custom locales.

(It will ignore custom translator dynamic loading.)
returns `array`
#### Carbon::getAvailableLocalesInfo

Returns list of Language object for each available locale. This object allow you to get the ISO name, native
name, region and variant of the locale.


returns `\Language[]`
#### Carbon::getCalendarFormats

Returns list of calendar formats for ISO formatting.


##### Parameters
- $locale `string|null` current locale used if null
#### Carbon::getDays

Get the days of the week.


#### Carbon::getDaysFromStartOfWeek

Return the number of days since the start of the week (using the current locale or the first parameter
if explicitly given).


##### Parameters
- $weekStartsAt `\WeekDay|int|null`

optional start allow you to specify the day of week to use to start the week,
  if not provided, start of week is inferred from the locale
  (Sunday for en_US, Monday for de_DE, etc.)
#### Carbon::getFallbackLocale

Get the fallback locale.


#### Carbon::getFormatsToIsoReplacements

List of replacements from date() format to isoFormat().


#### Carbon::getHumanDiffOptions

Return default humanDiff() options (merged flags as integer).


#### Carbon::getIsoFormats

Returns list of locale formats for ISO formatting.


##### Parameters
- $locale `string|null` current locale used if null
#### Carbon::getIsoUnits

Returns list of locale units for ISO formatting.


#### Carbon::getLastErrors

{@inheritdoc}


#### Carbon::getLocalMacro

Get the raw callable macro registered globally or locally for a given name.


#### Carbon::getLocalTranslator

Get the translator of the current instance or the default if none set.


#### Carbon::getLocale

Get the current translator locale.


returns `string`
#### Carbon::getMacro

Get the raw callable macro registered globally for a given name.


#### Carbon::getMidDayAt

get midday/noon hour


returns `int`
#### Carbon::getOffsetString

Returns the offset hour and minute formatted with +/- and a given separator (":" by default).

For example, if the time zone is 9 hours 30 minutes, you'll get "+09:30", with "@@" as first
argument, "+09@@30", with "" as first argument, "+0930". Negative offset will return something
like "-12:00".
##### Parameters
- $separator `string` string to place between hours and minutes (":" by default)
#### Carbon::getPaddedUnit

Returns a unit of the instance padded with 0 by default or any other string if specified.


##### Parameters
- $unit `string` Carbon unit name
- $length `int` Length of the output (2 by default)
- $padString `string` String to use for padding ("0" by default)
- $padType `int` Side(s) to pad (STR_PAD_LEFT by default)
#### Carbon::getPreciseTimestamp

Returns a timestamp rounded with the given precision (6 by default).


##### Parameters
- $precision `int`
returns `float`
##### Examples
getPreciseTimestamp()   1532087464437474 (microsecond maximum precision)
getPreciseTimestamp(6)  1532087464437474
getPreciseTimestamp(5)  153208746443747  (1/100000 second precision)
getPreciseTimestamp(4)  15320874644375   (1/10000 second precision)
getPreciseTimestamp(3)  1532087464437    (millisecond precision)
getPreciseTimestamp(2)  153208746444     (1/100 second precision)
getPreciseTimestamp(1)  15320874644      (1/10 second precision)
getPreciseTimestamp(0)  1532087464       (second precision)
getPreciseTimestamp(-1) 153208746        (10 second precision)
getPreciseTimestamp(-2) 15320875         (100 second precision)
#### Carbon::getSettings

Returns current local settings.


#### Carbon::getTestNow

Get the Carbon instance (real or mock) to be returned when a "now"
instance is created.


returns `\Closure|\CarbonInterface|null the current instance used for testing`
#### Carbon::getTimeFormatByPrecision

Return a format from H:i to H:i:s.u according to given unit precision.


##### Parameters
- $unitPrecision `string` "minute", "second", "millisecond" or "microsecond"
#### Carbon::getTimestampMs

Returns the timestamp with millisecond precision.


returns `int`
#### Carbon::getTimezone

Get the TimeZone associated with the Carbon instance (as CarbonTimeZone).


#### Carbon::getTranslatedDayName

Get the translation of the current week day name (with context for languages with multiple forms).


##### Parameters
- $context `string|null` whole format string
- $keySuffix `string` "", "_short" or "_min"
- $defaultValue `string|null` default value if translation missing
#### Carbon::getTranslatedMinDayName

Get the translation of the current abbreviated week day name (with context for languages with multiple forms).


##### Parameters
- $context `string|null` whole format string
#### Carbon::getTranslatedMonthName

Get the translation of the current month day name (with context for languages with multiple forms).


##### Parameters
- $context `string|null` whole format string
- $keySuffix `string` "" or "_short"
- $defaultValue `string|null` default value if translation missing
#### Carbon::getTranslatedShortDayName

Get the translation of the current short week day name (with context for languages with multiple forms).


##### Parameters
- $context `string|null` whole format string
#### Carbon::getTranslatedShortMonthName

Get the translation of the current short month day name (with context for languages with multiple forms).


##### Parameters
- $context `string|null` whole format string
#### Carbon::getTranslationMessage

Returns raw translation message for a given key.


##### Parameters
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
- $translator `\TranslatorInterface` an optional translator to use
returns `string`
#### Carbon::getTranslationMessageWith

Returns raw translation message for a given key.


##### Parameters
- $translator `\TranslatorInterface|null` the translator to use
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
returns `string|\Closure|null`
#### Carbon::getTranslator

Initialize the default translator instance if necessary.


#### Carbon::getWeekEndsAt

Get the last day of week.


##### Parameters
- $locale `string` local to consider the last day of week.
returns `int`
#### Carbon::getWeekStartsAt

Get the first day of week.


returns `int`
#### Carbon::getWeekendDays

Get weekend days


#### Carbon::greaterThan

Determines if the instance is greater (after) than another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:17'); // false
```
#### Carbon::greaterThanOrEqualTo

Determines if the instance is greater (after) than or equal to another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:17'); // false
```
#### Carbon::gt

Determines if the instance is greater (after) than another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:17'); // false
```
#### Carbon::gte

Determines if the instance is greater (after) than or equal to another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:17'); // false
```
#### Carbon::hasFormat

Checks if the (date)time string is in a given format.


##### Examples
```php
Carbon::hasFormat('11:12:45', 'h:i:s'); // true
Carbon::hasFormat('13:12:45', 'h:i:s'); // false
```
#### Carbon::hasFormatWithModifiers

Checks if the (date)time string is in a given format.


##### Parameters
- $date `string`
- $format `string`
returns `bool`
##### Examples
```php
Carbon::hasFormatWithModifiers('31/08/2015', 'd#m#Y'); // true
Carbon::hasFormatWithModifiers('31/08/2015', 'm#d#Y'); // false
```
#### Carbon::hasLocalMacro

Checks if macro is registered globally or locally.


#### Carbon::hasLocalTranslator

Return true if the current instance has its own translator.


#### Carbon::hasMacro

Checks if macro is registered globally.


##### Parameters
- $name `string`
returns `bool`
#### Carbon::hasRelativeKeywords

Determine if a time string will produce a relative date.


returns `bool true if time match a relative date, false if absolute or invalid time string`
#### Carbon::hasTestNow

Determine if there is a valid test instance set. A valid test instance
is anything that is not null.


returns `bool true if there is a test instance, otherwise false`
#### Carbon::instance

Create a Carbon instance from a DateTime one.


#### Carbon::is

Returns true if the current date matches the given string.


##### Parameters
- $tester `string` day name, month name, hour, date, etc. as string
##### Examples
```php
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('2019')); // true
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('2018')); // false
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('2019-06')); // true
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('06-02')); // true
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('2019-06-02')); // true
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('Sunday')); // true
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('June')); // true
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('12:23')); // true
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('12:23:45')); // true
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('12:23:00')); // false
var_dump(Carbon::parse('2019-06-02 12:23:45')->is('12h')); // true
var_dump(Carbon::parse('2019-06-02 15:23:45')->is('3pm')); // true
var_dump(Carbon::parse('2019-06-02 15:23:45')->is('3am')); // false
```
#### Carbon::isAfter

Determines if the instance is greater (after) than another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:17'); // false
```
#### Carbon::isBefore

Determines if the instance is less (before) than another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:17'); // true
```
#### Carbon::isBetween

Determines if the instance is between two others


##### Parameters
- $equal `bool` Indicates if an equal to comparison should be done
##### Examples
```php
Carbon::parse('2018-07-25')->isBetween('2018-07-14', '2018-08-01'); // true
Carbon::parse('2018-07-25')->isBetween('2018-08-01', '2018-08-20'); // false
Carbon::parse('2018-07-25')->isBetween('2018-07-25', '2018-08-01'); // true
Carbon::parse('2018-07-25')->isBetween('2018-07-25', '2018-08-01', false); // false
```
#### Carbon::isBirthday

Check if its the birthday. Compares the date/month values of the two dates.


##### Parameters
- $date `\DateTimeInterface|string|null` The instance to compare with or null to use current day.
returns `bool`
##### Examples
```php
Carbon::now()->subYears(5)->isBirthday(); // true
Carbon::now()->subYears(5)->subDay()->isBirthday(); // false
Carbon::parse('2019-06-05')->isBirthday(Carbon::parse('2001-06-05')); // true
Carbon::parse('2019-06-05')->isBirthday(Carbon::parse('2001-06-06')); // false
```
#### Carbon::isCurrentUnit

Determines if the instance is in the current unit given.


##### Parameters
- $unit `string` The unit to test.
##### Examples
```php
Carbon::now()->isCurrentUnit('hour'); // true
Carbon::now()->subHours(2)->isCurrentUnit('hour'); // false
```
#### Carbon::isDayOfWeek

Checks if this day is a specific day of the week.


##### Parameters
- $dayOfWeek `int|string`
returns `bool`
##### Examples
```php
Carbon::parse('2019-07-17')->isDayOfWeek(Carbon::WEDNESDAY); // true
Carbon::parse('2019-07-17')->isDayOfWeek(Carbon::FRIDAY); // false
Carbon::parse('2019-07-17')->isDayOfWeek('Wednesday'); // true
Carbon::parse('2019-07-17')->isDayOfWeek('Friday'); // false
```
#### Carbon::isEndOfCentury

Determines if the instance is end of century (last day by default but interval can be customized).


#### Carbon::isEndOfDay

Check if the instance is end of day.


##### Parameters
- $checkMicroseconds `bool` check time at microseconds precision
- $interval `\Unit|\DateInterval|\Closure|\CarbonConverterInterface|string|null`

if an interval is specified it will be used as precision
  for instance with "15 minutes", it checks if current date-time
  is in the last 15 minutes of the day, with Unit::Hour, it
  checks if it's in the last hour of the day.
##### Examples
```php
Carbon::parse('2019-02-28 23:59:59.999999')->isEndOfDay(); // true
Carbon::parse('2019-02-28 23:59:59.123456')->isEndOfDay(); // true
Carbon::parse('2019-02-28 23:59:59')->isEndOfDay(); // true
Carbon::parse('2019-02-28 23:59:58.999999')->isEndOfDay(); // false
Carbon::parse('2019-02-28 23:59:59.999999')->isEndOfDay(true); // true
Carbon::parse('2019-02-28 23:59:59.123456')->isEndOfDay(true); // false
Carbon::parse('2019-02-28 23:59:59')->isEndOfDay(true); // false
```
#### Carbon::isEndOfDecade

Determines if the instance is end of decade (last day by default but interval can be customized).


#### Carbon::isEndOfHour

Determines if the instance is end of hour (last microsecond by default but interval can be customized).


#### Carbon::isEndOfMillennium

Determines if the instance is end of millennium (last day by default but interval can be customized).


#### Carbon::isEndOfMillisecond

Determines if the instance is end of millisecond (last microsecond by default but interval can be customized).


#### Carbon::isEndOfMinute

Determines if the instance is end of minute (last microsecond by default but interval can be customized).


#### Carbon::isEndOfMonth

Determines if the instance is end of month (last day by default but interval can be customized).


#### Carbon::isEndOfQuarter

Determines if the instance is end of quarter (last day by default but interval can be customized).


#### Carbon::isEndOfSecond

Determines if the instance is end of second (last microsecond by default but interval can be customized).


#### Carbon::isEndOfTime

Returns true if the date was created using CarbonImmutable::endOfTime()


returns `bool`
#### Carbon::isEndOfUnit

Check if the instance is end of a given unit (tolerating a given interval).


##### Examples
```php
// Check if a date-time is the last 15 minutes of the hour it's in
Carbon::parse('2019-02-28 20:13:00')->isEndOfUnit(Unit::Hour, '15 minutes'); // false
```
#### Carbon::isEndOfWeek

Determines if the instance is end of week (last day by default but interval can be customized).


##### Examples
```php
Carbon::parse('2024-08-31')->endOfWeek()->isEndOfWeek(); // true
Carbon::parse('2024-08-31')->isEndOfWeek(); // false
```
#### Carbon::isEndOfYear

Determines if the instance is end of year (last day by default but interval can be customized).


#### Carbon::isFuture

Determines if the instance is in the future, ie. greater (after) than now.


##### Examples
```php
Carbon::now()->addHours(5)->isFuture(); // true
Carbon::now()->subHours(5)->isFuture(); // false
```
#### Carbon::isImmutable

Returns true if the current class/instance is immutable.


#### Carbon::isLastOfMonth

Check if today is the last day of the Month


##### Examples
```php
Carbon::parse('2019-02-28')->isLastOfMonth(); // true
Carbon::parse('2019-03-28')->isLastOfMonth(); // false
Carbon::parse('2019-03-30')->isLastOfMonth(); // false
Carbon::parse('2019-03-31')->isLastOfMonth(); // true
Carbon::parse('2019-04-30')->isLastOfMonth(); // true
```
#### Carbon::isLeapYear

Determines if the instance is a leap year.


##### Examples
```php
Carbon::parse('2020-01-01')->isLeapYear(); // true
Carbon::parse('2019-01-01')->isLeapYear(); // false
```
#### Carbon::isLongIsoYear

Determines if the instance is a long year (using ISO 8601 year).


##### Examples
```php
Carbon::parse('2015-01-01')->isLongIsoYear(); // true
Carbon::parse('2016-01-01')->isLongIsoYear(); // true
Carbon::parse('2016-01-03')->isLongIsoYear(); // false
Carbon::parse('2019-12-29')->isLongIsoYear(); // false
Carbon::parse('2019-12-30')->isLongIsoYear(); // true
```
#### Carbon::isLongYear

Determines if the instance is a long year (using calendar year).

⚠️ This method completely ignores month and day to use the numeric year number,
it's not correct if the exact date matters. For instance as `2019-12-30` is already
in the first week of the 2020 year, if you want to know from this date if ISO week
year 2020 is a long year, use `isLongIsoYear` instead.
##### Examples
```php
Carbon::create(2015)->isLongYear(); // true
Carbon::create(2016)->isLongYear(); // false
```
#### Carbon::isMidday

Check if the instance is midday.


##### Examples
```php
Carbon::parse('2019-02-28 11:59:59.999999')->isMidday(); // false
Carbon::parse('2019-02-28 12:00:00')->isMidday(); // true
Carbon::parse('2019-02-28 12:00:00.999999')->isMidday(); // true
Carbon::parse('2019-02-28 12:00:01')->isMidday(); // false
```
#### Carbon::isMidnight

Check if the instance is start of day / midnight.


##### Examples
```php
Carbon::parse('2019-02-28 00:00:00')->isMidnight(); // true
Carbon::parse('2019-02-28 00:00:00.999999')->isMidnight(); // true
Carbon::parse('2019-02-28 00:00:01')->isMidnight(); // false
```
#### Carbon::isModifiableUnit

Returns true if a property can be changed via setter.


##### Parameters
- $unit `string`
returns `bool`
#### Carbon::isMutable

Returns true if the current class/instance is mutable.


#### Carbon::isNowOrFuture

Determines if the instance is now or in the future, ie. greater (after) than or equal to now.


##### Examples
```php
Carbon::now()->isNowOrFuture(); // true
Carbon::now()->addHours(5)->isNowOrFuture(); // true
Carbon::now()->subHours(5)->isNowOrFuture(); // false
```
#### Carbon::isNowOrPast

Determines if the instance is now or in the past, ie. less (before) than or equal to now.


##### Examples
```php
Carbon::now()->isNowOrPast(); // true
Carbon::now()->subHours(5)->isNowOrPast(); // true
Carbon::now()->addHours(5)->isNowOrPast(); // false
```
#### Carbon::isPast

Determines if the instance is in the past, ie. less (before) than now.


##### Examples
```php
Carbon::now()->subHours(5)->isPast(); // true
Carbon::now()->addHours(5)->isPast(); // false
```
#### Carbon::isSameAs

Compares the formatted values of the two dates.


##### Parameters
- $format `string` date formats to compare.
- $date `\DateTimeInterface|string` instance to compare with or null to use current day.
##### Examples
```php
Carbon::parse('2019-06-13')->isSameAs('Y-d', Carbon::parse('2019-12-13')); // true
Carbon::parse('2019-06-13')->isSameAs('Y-d', Carbon::parse('2019-06-14')); // false
```
#### Carbon::isSameMonth

Checks if the passed in date is in the same month as the instance´s month.


##### Parameters
- $date `\DateTimeInterface|string` The instance to compare with or null to use the current date.
- $ofSameYear `bool` Check if it is the same month in the same year.
returns `bool`
##### Examples
```php
Carbon::parse('2019-01-12')->isSameMonth(Carbon::parse('2019-01-01')); // true
Carbon::parse('2019-01-12')->isSameMonth(Carbon::parse('2019-02-01')); // false
Carbon::parse('2019-01-12')->isSameMonth(Carbon::parse('2018-01-01')); // false
Carbon::parse('2019-01-12')->isSameMonth(Carbon::parse('2018-01-01'), false); // true
```
#### Carbon::isSameQuarter

Checks if the passed in date is in the same quarter as the instance quarter (and year if needed).


##### Parameters
- $date `\DateTimeInterface|string` The instance to compare with or null to use current day.
- $ofSameYear `bool` Check if it is the same month in the same year.
returns `bool`
##### Examples
```php
Carbon::parse('2019-01-12')->isSameQuarter(Carbon::parse('2019-03-01')); // true
Carbon::parse('2019-01-12')->isSameQuarter(Carbon::parse('2019-04-01')); // false
Carbon::parse('2019-01-12')->isSameQuarter(Carbon::parse('2018-03-01')); // false
Carbon::parse('2019-01-12')->isSameQuarter(Carbon::parse('2018-03-01'), false); // true
```
#### Carbon::isSameUnit

Determines if the instance is in the current unit given.


##### Parameters
- $unit `string` singular unit string
- $date `\DateTimeInterface|string` instance to compare with or null to use current day.
returns `bool`
##### Examples
```php
Carbon::parse('2019-01-13')->isSameUnit('year', Carbon::parse('2019-12-25')); // true
Carbon::parse('2018-12-13')->isSameUnit('year', Carbon::parse('2019-12-25')); // false
```
#### Carbon::isStartOfCentury

Determines if the instance is start of century (first day by default but interval can be customized).


#### Carbon::isStartOfDay

Check if the instance is start of day / midnight.


##### Parameters
- $checkMicroseconds `bool` check time at microseconds precision
- $interval `\Unit|\DateInterval|\Closure|\CarbonConverterInterface|string|null`

if an interval is specified it will be used as precision
  for instance with "15 minutes", it checks if current date-time
  is in the last 15 minutes of the day, with Unit::Hour, it
  checks if it's in the last hour of the day.
##### Examples
```php
Carbon::parse('2019-02-28 00:00:00')->isStartOfDay(); // true
Carbon::parse('2019-02-28 00:00:00.999999')->isStartOfDay(); // true
Carbon::parse('2019-02-28 00:00:01')->isStartOfDay(); // false
Carbon::parse('2019-02-28 00:00:00.000000')->isStartOfDay(true); // true
Carbon::parse('2019-02-28 00:00:00.000012')->isStartOfDay(true); // false
```
#### Carbon::isStartOfDecade

Determines if the instance is start of decade (first day by default but interval can be customized).


#### Carbon::isStartOfHour

Determines if the instance is start of hour (first microsecond by default but interval can be customized).


#### Carbon::isStartOfMillennium

Determines if the instance is start of millennium (first day by default but interval can be customized).


#### Carbon::isStartOfMillisecond

Determines if the instance is start of millisecond (first microsecond by default but interval can be customized).


#### Carbon::isStartOfMinute

Determines if the instance is start of minute (first microsecond by default but interval can be customized).


#### Carbon::isStartOfMonth

Determines if the instance is start of month (first day by default but interval can be customized).


#### Carbon::isStartOfQuarter

Determines if the instance is start of quarter (first day by default but interval can be customized).


#### Carbon::isStartOfSecond

Determines if the instance is start of second (first microsecond by default but interval can be customized).


#### Carbon::isStartOfTime

Returns true if the date was created using CarbonImmutable::startOfTime()


returns `bool`
#### Carbon::isStartOfUnit

Check if the instance is start of a given unit (tolerating a given interval).


##### Examples
```php
// Check if a date-time is the first 15 minutes of the hour it's in
Carbon::parse('2019-02-28 20:13:00')->isStartOfUnit(Unit::Hour, '15 minutes'); // true
```
#### Carbon::isStartOfWeek

Determines if the instance is start of week (first day by default but interval can be customized).


##### Examples
```php
Carbon::parse('2024-08-31')->startOfWeek()->isStartOfWeek(); // true
Carbon::parse('2024-08-31')->isStartOfWeek(); // false
```
#### Carbon::isStartOfYear

Determines if the instance is start of year (first day by default but interval can be customized).


#### Carbon::isStrictModeEnabled

Returns true if the strict mode is globally in use, false else.

(It can be overridden in specific instances.)
returns `bool`
#### Carbon::isToday

Determines if the instance is today.


##### Examples
```php
Carbon::today()->isToday(); // true
Carbon::tomorrow()->isToday(); // false
```
#### Carbon::isTomorrow

Determines if the instance is tomorrow.


##### Examples
```php
Carbon::tomorrow()->isTomorrow(); // true
Carbon::yesterday()->isTomorrow(); // false
```
#### Carbon::isWeekday

Determines if the instance is a weekday.


##### Examples
```php
Carbon::parse('2019-07-14')->isWeekday(); // false
Carbon::parse('2019-07-15')->isWeekday(); // true
```
#### Carbon::isWeekend

Determines if the instance is a weekend day.


##### Examples
```php
Carbon::parse('2019-07-14')->isWeekend(); // true
Carbon::parse('2019-07-15')->isWeekend(); // false
```
#### Carbon::isYesterday

Determines if the instance is yesterday.


##### Examples
```php
Carbon::yesterday()->isYesterday(); // true
Carbon::tomorrow()->isYesterday(); // false
```
#### Carbon::isoFormat

Format in the current language using ISO replacement patterns.


##### Parameters
- $originalFormat `string|null` provide context if a chunk has been passed alone
#### Carbon::isoWeek

Get/set the week number using given first day of week and first
day of year included in the first week. Or use ISO format if no settings
given.


##### Parameters
- $week `int|null`
- $dayOfWeek `int|null`
- $dayOfYear `int|null`
returns `int|static`
#### Carbon::isoWeekYear

Set/get the week number of year using given first day of week and first
day of year included in the first week. Or use ISO format if no settings
given.


##### Parameters
- $year `int|null` if null, act as a getter, if not null, set the year and return current instance.
- $dayOfWeek `int|null` first date of week from 0 (Sunday) to 6 (Saturday)
- $dayOfYear `int|null` first day of year included in the week #1
returns `int|static`
#### Carbon::isoWeekday

Get/set the ISO weekday from 1 (Monday) to 7 (Sunday).


##### Parameters
- $value `\WeekDay|int|null` new value for weekday if using as setter.
#### Carbon::isoWeeksInYear

Get the number of weeks of the current week-year using given first day of week and first
day of year included in the first week. Or use ISO format if no settings
given.


##### Parameters
- $dayOfWeek `int|null` first date of week from 0 (Sunday) to 6 (Saturday)
- $dayOfYear `int|null` first day of year included in the week #1
returns `int`
#### Carbon::jsonSerialize

Prepare the object for JSON serialization.


#### Carbon::lastOfMonth

Modify to the last occurrence of a given day of the week
in the current month. If no dayOfWeek is provided, modify to the
last day of the current month.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.


##### Parameters
- $dayOfWeek `int|null`
returns `static`
#### Carbon::lastOfQuarter

Modify to the last occurrence of a given day of the week
in the current quarter. If no dayOfWeek is provided, modify to the
last day of the current quarter.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.


##### Parameters
- $dayOfWeek `int|null` day of the week default null
returns `static`
#### Carbon::lastOfYear

Modify to the last occurrence of a given day of the week
in the current year. If no dayOfWeek is provided, modify to the
last day of the current year.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.


##### Parameters
- $dayOfWeek `int|null` day of the week default null
returns `static`
#### Carbon::lessThan

Determines if the instance is less (before) than another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:17'); // true
```
#### Carbon::lessThanOrEqualTo

Determines if the instance is less (before) or equal to another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:17'); // true
```
#### Carbon::locale

Get/set the locale for the current instance.


##### Parameters
- $locale `string|null`
- $fallbackLocales `string`
returns `$this|string`
#### Carbon::localeHasDiffOneDayWords

Returns true if the given locale is internally supported and has words for 1-day diff (just now, yesterday, tomorrow).

Support is considered enabled if the 3 words are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### Carbon::localeHasDiffSyntax

Returns true if the given locale is internally supported and has diff syntax support (ago, from now, before, after).

Support is considered enabled if the 4 sentences are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### Carbon::localeHasDiffTwoDayWords

Returns true if the given locale is internally supported and has words for 2-days diff (before yesterday, after tomorrow).

Support is considered enabled if the 2 words are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### Carbon::localeHasPeriodSyntax

Returns true if the given locale is internally supported and has period syntax support (X times, every X, from X, to X).

Support is considered enabled if the 4 sentences are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### Carbon::localeHasShortUnits

Returns true if the given locale is internally supported and has short-units support.

Support is considered enabled if either year, day or hour has a short variant translated.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### Carbon::lt

Determines if the instance is less (before) than another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:17'); // true
```
#### Carbon::lte

Determines if the instance is less (before) or equal to another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:17'); // true
```
#### Carbon::macro

Register a custom macro.

Pass null macro to remove it.
##### Examples
```php
$userSettings = [
  'locale' => 'pt',
  'timezone' => 'America/Sao_Paulo',
];
Carbon::macro('userFormat', function () use ($userSettings) {
  return $this->copy()->locale($userSettings['locale'])->tz($userSettings['timezone'])->calendar();
});
echo Carbon::yesterday()->hours(11)->userFormat();
```
#### Carbon::make

Make a Carbon instance from given variable if possible.

Always return a new instance. Parse only strings and only these likely to be dates (skip intervals
and recurrences). Throw an exception for invalid format, but otherwise return null.
##### Parameters
- $var `mixed`
returns `static|null`
#### Carbon::max

Get the maximum instance between a given instance (default now) and the current instance.


##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|mixed`
returns `static`
#### Carbon::maximum

Get the maximum instance between a given instance (default now) and the current instance.


##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|mixed`
returns `static`
#### Carbon::meridiem

Return the meridiem of the current time in the current locale.


##### Parameters
- $isLower `bool` if true, returns lowercase variant if available in the current locale.
#### Carbon::midDay

Modify to midday, default to self::$midDayAt


returns `static`
#### Carbon::min

Get the minimum instance between a given instance (default now) and the current instance.


##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|mixed`
returns `static`
#### Carbon::minimum

Get the minimum instance between a given instance (default now) and the current instance.


##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|mixed`
returns `static`
#### Carbon::mixin

Mix another object into the class.


##### Examples
```php
Carbon::mixin(new class {
  public function addMoon() {
    return function () {
      return $this->addDays(30);
    };
  }
  public function subMoon() {
    return function () {
      return $this->subDays(30);
    };
  }
});
$fullMoon = Carbon::create('2018-12-22');
$nextFullMoon = $fullMoon->addMoon();
$blackMoon = Carbon::create('2019-01-06');
$previousBlackMoon = $blackMoon->subMoon();
echo "$nextFullMoon\n";
echo "$previousBlackMoon\n";
```
#### Carbon::modify

Calls \DateTime::modify if mutable or \DateTimeImmutable::modify else.


returns `static`
#### Carbon::ne

Determines if the instance is not equal to another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->ne('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->ne(Carbon::parse('2018-07-25 12:45:16')); // false
Carbon::parse('2018-07-25 12:45:16')->ne('2018-07-25 12:45:17'); // true
```
#### Carbon::next

Modify to the next occurrence of a given modifier such as a day of
the week. If no modifier is provided, modify to the next occurrence
of the current day of the week. Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.


##### Parameters
- $modifier `string|int|null`
returns `static`
#### Carbon::nextWeekday

Go forward to the next weekday.


returns `static`
#### Carbon::nextWeekendDay

Go forward to the next weekend day.


returns `static`
#### Carbon::notEqualTo

Determines if the instance is not equal to another


##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->notEqualTo('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->notEqualTo(Carbon::parse('2018-07-25 12:45:16')); // false
Carbon::parse('2018-07-25 12:45:16')->notEqualTo('2018-07-25 12:45:17'); // true
```
#### Carbon::now

Get a Carbon instance for the current date and time.


#### Carbon::nowWithSameTz

Returns a present instance in the same timezone.


returns `static`
#### Carbon::nthOfMonth

Modify to the given occurrence of a given day of the week
in the current month. If the calculated occurrence is outside the scope
of the current month, then return false and no modifications are made.

Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.
##### Parameters
- $nth `int`
- $dayOfWeek `int`
returns `mixed`
#### Carbon::nthOfQuarter

Modify to the given occurrence of a given day of the week
in the current quarter. If the calculated occurrence is outside the scope
of the current quarter, then return false and no modifications are made.

Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.
##### Parameters
- $nth `int`
- $dayOfWeek `int`
returns `mixed`
#### Carbon::nthOfYear

Modify to the given occurrence of a given day of the week
in the current year. If the calculated occurrence is outside the scope
of the current year, then return false and no modifications are made.

Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.
##### Parameters
- $nth `int`
- $dayOfWeek `int`
returns `mixed`
#### Carbon::ordinal

Return a property with its ordinal.


#### Carbon::parse

Create a carbon instance from a string.

This is an alias for the constructor that allows better fluent syntax
as it allows you to do Carbon::parse('Monday next week')->fn() rather
than (new Carbon('Monday next week'))->fn().
#### Carbon::parseFromLocale

Create a carbon instance from a localized string (in French, Japanese, Arabic, etc.).


##### Parameters
- $time `string` date/time string in the given language (may also contain English).
- $locale `string|null`

if locale is null or not specified, current global locale will be
  used instead.
- $timezone `\DateTimeZone|string|int|null` optional timezone for the new instance.
#### Carbon::pluralUnit

Returns standardized plural of a given singular/plural unit name (in English).


#### Carbon::previous

Modify to the previous occurrence of a given modifier such as a day of
the week. If no dayOfWeek is provided, modify to the previous occurrence
of the current day of the week. Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.


##### Parameters
- $modifier `string|int|null`
returns `static`
#### Carbon::previousWeekday

Go backward to the previous weekday.


returns `static`
#### Carbon::previousWeekendDay

Go backward to the previous weekend day.


returns `static`
#### Carbon::range

Create a iterable CarbonPeriod object from current date to a given end date (and optional interval).


##### Parameters
- $end `\DateTimeInterface|\Carbon|\CarbonImmutable|null` period end date
- $interval `int|\DateInterval|string|null` period default interval or number of the given $unit
- $unit `string|null` if specified, $interval must be an integer
#### Carbon::rawAdd

Call native PHP DateTime/DateTimeImmutable add() method.


##### Parameters
- $interval `\DateInterval`
returns `static`
#### Carbon::rawCreateFromFormat

Create a Carbon instance from a specific format.


##### Parameters
- $format `string` Datetime format
- $time `string`
- $timezone `\DateTimeZone|string|int|null`
returns `static|null`
#### Carbon::rawFormat




#### Carbon::rawParse

Create a carbon instance from a string.

This is an alias for the constructor that allows better fluent syntax
as it allows you to do Carbon::parse('Monday next week')->fn() rather
than (new Carbon('Monday next week'))->fn().
#### Carbon::rawSub

Call native PHP DateTime/DateTimeImmutable sub() method.


#### Carbon::resetMacros

Remove all macros and generic macros.


#### Carbon::resetMonthsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`
#### Carbon::resetToStringFormat

Reset the format used to the default when type juggling a Carbon instance to a string


returns `void`
#### Carbon::resetYearsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`
#### Carbon::round

Round the current instance second with given precision if specified.


#### Carbon::roundUnit

Round the current instance at the given unit with given precision if specified and the given function.


#### Carbon::roundWeek

Round the current instance week.


##### Parameters
- $weekStartsAt `\WeekDay|int|null` optional start allow you to specify the day of week to use to start the week
#### Carbon::secondsSinceMidnight

The number of seconds since midnight.


returns `float`
#### Carbon::secondsUntilEndOfDay

The number of seconds until 23:59:59.


returns `float`
#### Carbon::serialize

Return a serialized string of the instance.


#### Carbon::serializeUsing




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
            You should rather transform Carbon object before the serialization.

JSON serialize all Carbon instances using the given callback.
:::
#### Carbon::set

Set a part of the Carbon object.


returns `$this`
#### Carbon::setDate

Set the date with gregorian year, month and day numbers.


#### Carbon::setDateFrom

Set the year, month, and date for this instance to that of the passed instance.


#### Carbon::setDateTime

Set the date and time all together.


#### Carbon::setDateTimeFrom

Set the date and time for this instance to that of the passed instance.


#### Carbon::setDaysFromStartOfWeek

Set the day (keeping the current time) to the start of the week + the number of days passed as the first
parameter. First day of week is driven by the locale unless explicitly set with the second parameter.


##### Parameters
- $numberOfDays `int` number of days to add after the start of the current week
- $weekStartsAt `\WeekDay|int|null`

optional start allow you to specify the day of week to use to start the week,
  if not provided, start of week is inferred from the locale
  (Sunday for en_US, Monday for de_DE, etc.)
#### Carbon::setFallbackLocale

Set the fallback locale.


##### Parameters
- $locale `string`
#### Carbon::setHumanDiffOptions




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### Carbon::setISODate

Set a date according to the ISO 8601 standard - using weeks and day offsets rather than specific dates.


#### Carbon::setLocalTranslator

Set the translator for the current instance.


#### Carbon::setLocale

Set the current translator locale and indicate if the source locale file exists.

Pass 'auto' as locale to use the closest language to the current LC_TIME locale.
##### Parameters
- $locale `string` locale ex. en
#### Carbon::setMidDayAt




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
            You should rather consider mid-day is always 12pm, then if you need to test if it's an other
            hour, test it explicitly:
                $date->format('G') == 13
            or to set explicitly to a given hour:
                $date->setTime(13, 0, 0, 0)

Set midday/noon hour
:::
##### Parameters
- $hour `int` midday hour
returns `void`
#### Carbon::setTestNow

Set a Carbon instance (real or mock) to be returned when a "now"
instance is created.  The provided instance will be returned
specifically under the following conditions:
  - A call to the static now() method, ex. Carbon::now()
  - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
  - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
  - When a string containing the desired time is passed to Carbon::parse().

Note the timezone parameter was left out of the examples above and
has no affect as the mock value will be returned regardless of its value.

Only the moment is mocked with setTestNow(), the timezone will still be the one passed
as parameter of date_default_timezone_get() as a fallback (see setTestNowAndTimezone()).

To clear the test instance call this method using the default
parameter of null.

/!\ Use this method for unit tests only.
##### Parameters
- $testNow `\DateTimeInterface|\Closure|static|string|false|null` real or mock Carbon instance
#### Carbon::setTestNowAndTimezone

Set a Carbon instance (real or mock) to be returned when a "now"
instance is created.  The provided instance will be returned
specifically under the following conditions:
  - A call to the static now() method, ex. Carbon::now()
  - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
  - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
  - When a string containing the desired time is passed to Carbon::parse().

It will also align default timezone (e.g. call date_default_timezone_set()) with
the second argument or if null, with the timezone of the given date object.

To clear the test instance call this method using the default
parameter of null.

/!\ Use this method for unit tests only.
##### Parameters
- $testNow `\DateTimeInterface|\Closure|static|string|false|null` real or mock Carbon instance
#### Carbon::setTime

Resets the current time of the DateTime object to a different time.


#### Carbon::setTimeFrom

Set the hour, minute, second and microseconds for this instance to that of the passed instance.


#### Carbon::setTimeFromTimeString

Set the time by time string.


#### Carbon::setTimestamp

Set the instance's timestamp.

Timestamp input can be given as int, float or a string containing one or more numbers.
#### Carbon::setTimezone

Set the instance's timezone from a string or object.


#### Carbon::setToStringFormat




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
            You should rather let Carbon object being cast to string with DEFAULT_TO_STRING_FORMAT, and
            use other method or custom format passed to format() method if you need to dump another string
            format.

Set the default format used when type juggling a Carbon instance to a string.
:::
##### Parameters
- $format `string|\Closure|null`
returns `void`
#### Carbon::setTranslator

Set the default translator instance to use.


##### Parameters
- $translator `\TranslatorInterface`
returns `void`
#### Carbon::setUnit

Set specified unit to new given value.


##### Parameters
- $unit `string` year, month, day, hour, minute, second or microsecond
- $value `\Month|int` new value for given unit
#### Carbon::setUnitNoOverflow

Set any unit to a new value without overflowing current other unit given.


##### Parameters
- $valueUnit `string` unit name to modify
- $value `int` new value for the input unit
- $overflowUnit `string` unit name to not overflow
#### Carbon::setWeekendDays




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
            You should rather consider week-end is always saturday and sunday, and if you have some custom
            week-end days to handle, give to those days an other name and create a macro for them:

            ```
            Carbon::macro('isDayOff', function ($date) {
                return $date->isSunday() || $date->isMonday();
            });
            Carbon::macro('isNotDayOff', function ($date) {
                return !$date->isDayOff();
            });
            if ($someDate->isDayOff()) ...
            if ($someDate->isNotDayOff()) ...
            // Add 5 not-off days
            $count = 5;
            while ($someDate->isDayOff() || ($count-- > 0)) {
                $someDate->addDay();
            }
            ```

Set weekend days
:::
#### Carbon::settings

Set specific options.

- strictMode: true|false|null
- monthOverflow: true|false|null
- yearOverflow: true|false|null
- humanDiffOptions: int|null
- toStringFormat: string|Closure|null
- toJsonFormat: string|Closure|null
- locale: string|null
- timezone: \DateTimeZone|string|int|null
- macros: array|null
- genericMacros: array|null
##### Parameters
- $settings `array`
returns `$this|static`
#### Carbon::shiftTimezone

Set the instance's timezone from a string or object and add/subtract the offset difference.


#### Carbon::shouldOverflowMonths

Get the month overflow global behavior (can be overridden in specific instances).


returns `bool`
#### Carbon::shouldOverflowYears

Get the month overflow global behavior (can be overridden in specific instances).


returns `bool`
#### Carbon::since




#### Carbon::singularUnit

Returns standardized singular of a given singular/plural unit name (in English).


#### Carbon::startOf

Modify to start of current given unit.


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->startOf(Unit::Month)
  ->endOf(Unit::Week, Carbon::FRIDAY);
```
#### Carbon::startOfCentury

Resets the date to the first day of the century and the time to 00:00:00


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfCentury();
```
#### Carbon::startOfDay

Resets the time to 00:00:00 start of day


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfDay();
```
#### Carbon::startOfDecade

Resets the date to the first day of the decade and the time to 00:00:00


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfDecade();
```
#### Carbon::startOfHour

Modify to start of current hour, minutes and seconds become 0


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfHour();
```
#### Carbon::startOfMillennium

Resets the date to the first day of the millennium and the time to 00:00:00


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfMillennium();
```
#### Carbon::startOfMillisecond

Modify to start of current millisecond, microseconds such as 12345 become 123000


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->startOfSecond()
  ->format('H:i:s.u');
```
#### Carbon::startOfMinute

Modify to start of current minute, seconds become 0


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfMinute();
```
#### Carbon::startOfMonth

Resets the date to the first day of the month and the time to 00:00:00


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfMonth();
```
#### Carbon::startOfQuarter

Resets the date to the first day of the quarter and the time to 00:00:00


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfQuarter();
```
#### Carbon::startOfSecond

Modify to start of current second, microseconds become 0


##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->startOfSecond()
  ->format('H:i:s.u');
```
#### Carbon::startOfWeek

Resets the date to the first day of week (defined in $weekStartsAt) and the time to 00:00:00


##### Parameters
- $weekStartsAt `\WeekDay|int|null` optional start allow you to specify the day of week to use to start the week
returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfWeek() . "\n";
echo Carbon::parse('2018-07-25 12:45:16')->locale('ar')->startOfWeek() . "\n";
echo Carbon::parse('2018-07-25 12:45:16')->startOfWeek(Carbon::SUNDAY) . "\n";
```
#### Carbon::startOfYear

Resets the date to the first day of the year and the time to 00:00:00


returns `static`
##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfYear();
```
#### Carbon::sub

Subtract given units or interval to the current instance.


##### Parameters
- $unit `\Unit|int|string|\DateInterval|\Closure|\CarbonConverterInterface`
- $value `\Unit|int|float|string`
- $overflow `bool|null`
returns `static`
##### Examples
$date->sub('hour', 3)
$date->sub(15, 'days')
$date->sub(CarbonInterval::days(4))
#### Carbon::subRealUnit




::: warning Deprectated
Prefer to use add subUTCUnit() which more accurately defines what it's doing.

Subtract seconds to the instance using timestamp. Positive $value travels
into the past while negative $value travels forward.
:::
##### Parameters
- $unit `string`
- $value `int`
returns `static`
#### Carbon::subUTCUnit

Subtract seconds to the instance using timestamp. Positive $value travels
into the past while negative $value travels forward.


##### Parameters
- $unit `string`
- $value `int`
returns `static`
#### Carbon::subUnit

Subtract given units to the current instance.


#### Carbon::subUnitNoOverflow

Subtract any unit to a new value without overflowing current other unit given.


##### Parameters
- $valueUnit `string` unit name to modify
- $value `int` amount to subtract to the input unit
- $overflowUnit `string` unit name to not overflow
#### Carbon::subtract

Subtract given units or interval to the current instance.


##### Parameters
- $unit `\Unit|int|string|\DateInterval`
- $value `\Unit|int|float|string`
- $overflow `bool|null`
returns `static`
#### Carbon::timespan

Get the difference in a human-readable format in the current locale from current instance to another
instance given (or now if null given).


returns `string`
#### Carbon::timestamp

Set the instance's timestamp.

Timestamp input can be given as int, float or a string containing one or more numbers.
#### Carbon::timezone




#### Carbon::to

Get the difference in a human readable format in the current locale from an other
instance given (or now if null given) to current instance.

When comparing a value in the past to default now:
1 hour from now
5 months from now

When comparing a value in the future to default now:
1 hour ago
5 months ago

When comparing a value in the past to another value:
1 hour after
5 months after

When comparing a value in the future to another value:
1 hour before
5 months before
##### Parameters
- $other `\Carbon|\DateTimeInterface|string|array|null`

if array passed, will be used as parameters array, see $syntax below;
  if null passed, now will be used as comparison reference;
  if any other type, it will be converted to date and used as reference.
- $syntax `int|array`

if array passed, parameters will be extracted from it, the array may contains:
  - 'syntax' entry (see below)
  - 'short' entry (see below)
  - 'parts' entry (see below)
  - 'options' entry (see below)
  - 'join' entry determines how to join multiple parts of the string
  `  - if $join is a string, it's used as a joiner glue
  `  - if $join is a callable/closure, it get the list of string and should return a string
  `  - if $join is an array, the first item will be the default glue, and the second item
  `    will be used instead of the glue for the last item
  `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
  `  - if $join is missing, a space will be used as glue
  - 'other' entry (see above)
  if int passed, it add modifiers:
  Possible values:
  - CarbonInterface::DIFF_ABSOLUTE          no modifiers
  - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
  - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
  Default value: CarbonInterface::DIFF_ABSOLUTE
- $short `bool` displays short format of time units
- $parts `int` maximum number of parts to display (default value: 1: single unit)
- $options `int` human diff options
returns `string`
#### Carbon::toArray

Get default array representation.


##### Examples
```php
var_dump(Carbon::now()->toArray());
```
#### Carbon::toAtomString

Format the instance as ATOM


##### Examples
```php
echo Carbon::now()->toAtomString();
```
#### Carbon::toCookieString

Format the instance as COOKIE


##### Examples
```php
echo Carbon::now()->toCookieString();
```
#### Carbon::toDate




##### Examples
```php
var_dump(Carbon::now()->toDate());
```
#### Carbon::toDateString

Format the instance as date


##### Examples
```php
echo Carbon::now()->toDateString();
```
#### Carbon::toDateTime

Return native DateTime PHP object matching the current instance.


##### Examples
```php
var_dump(Carbon::now()->toDateTime());
```
#### Carbon::toDateTimeImmutable

Return native toDateTimeImmutable PHP object matching the current instance.


##### Examples
```php
var_dump(Carbon::now()->toDateTimeImmutable());
```
#### Carbon::toDateTimeLocalString

Format the instance as date and time T-separated with no timezone


##### Examples
```php
echo Carbon::now()->toDateTimeLocalString();
echo "\n";
echo Carbon::now()->toDateTimeLocalString('minute'); // You can specify precision among: minute, second, millisecond and microsecond
```
#### Carbon::toDateTimeString

Format the instance as date and time


##### Examples
```php
echo Carbon::now()->toDateTimeString();
```
#### Carbon::toDayDateTimeString

Format the instance with day, date and time


##### Examples
```php
echo Carbon::now()->toDayDateTimeString();
```
#### Carbon::toFormattedDateString

Format the instance as a readable date


##### Examples
```php
echo Carbon::now()->toFormattedDateString();
```
#### Carbon::toFormattedDayDateString

Format the instance with the day, and a readable date


##### Examples
```php
echo Carbon::now()->toFormattedDayDateString();
```
#### Carbon::toISOString

Return the ISO-8601 string (ex: 1977-04-22T06:00:00Z, if $keepOffset truthy, offset will be kept:
1977-04-22T01:00:00-05:00).


##### Parameters
- $keepOffset `bool` Pass true to keep the date offset. Else forced to UTC.
##### Examples
```php
echo Carbon::now('America/Toronto')->toISOString() . "\n";
echo Carbon::now('America/Toronto')->toISOString(true) . "\n";
```
#### Carbon::toImmutable

Return a immutable copy of the instance.


returns `\CarbonImmutable`
#### Carbon::toIso8601String

Format the instance as ISO8601


##### Examples
```php
echo Carbon::now()->toIso8601String();
```
#### Carbon::toIso8601ZuluString

Convert the instance to UTC and return as Zulu ISO8601


##### Examples
```php
echo Carbon::now()->toIso8601ZuluString();
```
#### Carbon::toJSON

Return the ISO-8601 string (ex: 1977-04-22T06:00:00Z) with UTC timezone.


##### Examples
```php
echo Carbon::now('America/Toronto')->toJSON();
```
#### Carbon::toMutable

Return a mutable copy of the instance.


returns `\Carbon`
#### Carbon::toNow

Get the difference in a human readable format in the current locale from an other
instance given to now


##### Parameters
- $syntax `int|array`

if array passed, parameters will be extracted from it, the array may contains:
  - 'syntax' entry (see below)
  - 'short' entry (see below)
  - 'parts' entry (see below)
  - 'options' entry (see below)
  - 'join' entry determines how to join multiple parts of the string
  `  - if $join is a string, it's used as a joiner glue
  `  - if $join is a callable/closure, it get the list of string and should return a string
  `  - if $join is an array, the first item will be the default glue, and the second item
  `    will be used instead of the glue for the last item
  `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
  `  - if $join is missing, a space will be used as glue
  if int passed, it add modifiers:
  Possible values:
  - CarbonInterface::DIFF_ABSOLUTE          no modifiers
  - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
  - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
  Default value: CarbonInterface::DIFF_ABSOLUTE
- $short `bool` displays short format of time units
- $parts `int` maximum number of parts to display (default value: 1: single part)
- $options `int` human diff options
returns `string`
#### Carbon::toObject

Get default object representation.


##### Examples
```php
var_dump(Carbon::now()->toObject());
```
#### Carbon::toPeriod

Create a iterable CarbonPeriod object from current date to a given end date (and optional interval).


##### Parameters
- $end `\DateTimeInterface|\Carbon|\CarbonImmutable|int|null` period end date or recurrences count if int
- $interval `int|\DateInterval|string|null` period default interval or number of the given $unit
- $unit `string|null` if specified, $interval must be an integer
#### Carbon::toRfc1036String

Format the instance as RFC1036


##### Examples
```php
echo Carbon::now()->toRfc1036String();
```
#### Carbon::toRfc1123String

Format the instance as RFC1123


##### Examples
```php
echo Carbon::now()->toRfc1123String();
```
#### Carbon::toRfc2822String

Format the instance as RFC2822


##### Examples
```php
echo Carbon::now()->toRfc2822String();
```
#### Carbon::toRfc3339String

Format the instance as RFC3339.


##### Examples
```php
echo Carbon::now()->toRfc3339String() . "\n";
echo Carbon::now()->toRfc3339String(true) . "\n";
```
#### Carbon::toRfc7231String

Format the instance as RFC7231


##### Examples
```php
echo Carbon::now()->toRfc7231String();
```
#### Carbon::toRfc822String

Format the instance as RFC822


##### Examples
```php
echo Carbon::now()->toRfc822String();
```
#### Carbon::toRfc850String

Format the instance as RFC850


##### Examples
```php
echo Carbon::now()->toRfc850String();
```
#### Carbon::toRssString

Format the instance as RSS


##### Examples
```php
echo Carbon::now()->toRssString();
```
#### Carbon::toString

Returns english human-readable complete date string.


##### Examples
```php
echo Carbon::now()->toString();
```
#### Carbon::toTimeString

Format the instance as time


##### Examples
```php
echo Carbon::now()->toTimeString();
```
#### Carbon::toW3cString

Format the instance as W3C


##### Examples
```php
echo Carbon::now()->toW3cString();
```
#### Carbon::today

Create a Carbon instance for today.


#### Carbon::tomorrow

Create a Carbon instance for tomorrow.


#### Carbon::translate

Translate using translation string or callback available.


##### Parameters
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `string|int|float|null` number if plural
- $translator `\TranslatorInterface|null` an optional translator to use
- $altNumbers `bool` pass true to use alternative numbers
returns `string`
#### Carbon::translateNumber

Returns the alternative number for a given integer if available in the current locale.


##### Parameters
- $number `int`
returns `string`
#### Carbon::translateTimeString

Translate a time string from a locale to an other.


##### Parameters
- $timeString `string` date/time/duration string to translate (may also contain English)
- $from `string|null` input locale of the $timeString parameter (`Carbon::getLocale()` by default)
- $to `string|null` output locale of the result returned (`"en"` by default)
- $mode `int`

specify what to translate with options:
  - CarbonInterface::TRANSLATE_ALL (default)
  - CarbonInterface::TRANSLATE_MONTHS
  - CarbonInterface::TRANSLATE_DAYS
  - CarbonInterface::TRANSLATE_UNITS
  - CarbonInterface::TRANSLATE_MERIDIEM
  You can use pipe to group: CarbonInterface::TRANSLATE_MONTHS | CarbonInterface::TRANSLATE_DAYS
returns `string`
#### Carbon::translateTimeStringTo

Translate a time string from the current locale (`$date->locale()`) to another one.


##### Parameters
- $timeString `string` time string to translate
- $to `string|null` output locale of the result returned ("en" by default)
returns `string`
#### Carbon::translateWith

Translate using translation string or callback available.


##### Parameters
- $translator `\TranslatorInterface` an optional translator to use
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `int|float|null` number if plural
returns `string`
#### Carbon::translatedFormat

Format as ->format() do (using date replacements patterns from https://php.net/manual/en/function.date.php)
but translate words whenever possible (months, day names, etc.) using the current locale.


#### Carbon::tz

Set the timezone or returns the timezone name if no arguments passed.


returns `($value is null ? string : static)`
#### Carbon::unix




returns `int`
#### Carbon::until




##### Parameters
- $other `\Carbon|\DateTimeInterface|string|array|null`

if array passed, will be used as parameters array, see $syntax below;
  if null passed, now will be used as comparison reference;
  if any other type, it will be converted to date and used as reference.
- $syntax `int|array`

if array passed, parameters will be extracted from it, the array may contains:
  - 'syntax' entry (see below)
  - 'short' entry (see below)
  - 'parts' entry (see below)
  - 'options' entry (see below)
  - 'join' entry determines how to join multiple parts of the string
  `  - if $join is a string, it's used as a joiner glue
  `  - if $join is a callable/closure, it get the list of string and should return a string
  `  - if $join is an array, the first item will be the default glue, and the second item
  `    will be used instead of the glue for the last item
  `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
  `  - if $join is missing, a space will be used as glue
  - 'other' entry (see above)
  if int passed, it add modifiers:
  Possible values:
  - CarbonInterface::DIFF_ABSOLUTE          no modifiers
  - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
  - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
  Default value: CarbonInterface::DIFF_ABSOLUTE
- $short `bool` displays short format of time units
- $parts `int` maximum number of parts to display (default value: 1: single unit)
- $options `int` human diff options
returns `string`
#### Carbon::useMonthsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
##### Parameters
- $monthsOverflow `bool`
returns `void`
#### Carbon::useStrictMode




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
##### Parameters
- $strictModeEnabled `bool`
#### Carbon::useYearsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
##### Parameters
- $yearsOverflow `bool`
returns `void`
#### Carbon::utc

Set the instance's timezone to UTC.


#### Carbon::utcOffset

Returns the minutes offset to UTC if no arguments passed, else set the timezone with given minutes shift passed.


#### Carbon::valueOf

Returns the milliseconds timestamps used amongst other by Date javascript objects.


returns `float`
#### Carbon::week

Get/set the week number using given first day of week and first
day of year included in the first week. Or use US format if no settings
given (Sunday / Jan 6).


##### Parameters
- $week `int|null`
- $dayOfWeek `int|null`
- $dayOfYear `int|null`
returns `int|static`
#### Carbon::weekYear

Set/get the week number of year using given first day of week and first
day of year included in the first week. Or use US format if no settings
given (Sunday / Jan 6).


##### Parameters
- $year `int|null` if null, act as a getter, if not null, set the year and return current instance.
- $dayOfWeek `int|null` first date of week from 0 (Sunday) to 6 (Saturday)
- $dayOfYear `int|null` first day of year included in the week #1
returns `int|static`
#### Carbon::weekday

Get/set the weekday from 0 (Sunday) to 6 (Saturday).


##### Parameters
- $value `\WeekDay|int|null` new value for weekday if using as setter.
#### Carbon::weeksInYear

Get the number of weeks of the current week-year using given first day of week and first
day of year included in the first week. Or use US format if no settings
given (Sunday / Jan 6).


##### Parameters
- $dayOfWeek `int|null` first date of week from 0 (Sunday) to 6 (Saturday)
- $dayOfYear `int|null` first day of year included in the week #1
returns `int`
#### Carbon::withTestNow

Temporarily sets a static date to be used within the callback.

Using setTestNow to set the date, executing the callback, then
clearing the test instance.

/!\ Use this method for unit tests only.
##### Parameters
- $testNow `\DateTimeInterface|\Closure|static|string|false|null` real or mock Carbon instance
- $callback `callable`
returns `\T`
#### Carbon::yesterday

Create a Carbon instance for yesterday.


#### CarbonInterval::__call

Allow fluent calls on the setters... CarbonInterval::years(3)->months(5)->day().

Note: This is done using the magic method to allow static and instance methods to
have the same names.
##### Parameters
- $method `string` magic method name called
- $parameters `array` parameters list
returns `static|int|float|string`
#### CarbonInterval::__callStatic

Provide static helpers to create instances.  Allows CarbonInterval::years(3).

Note: This is done using the magic method to allow static and instance methods to
have the same names.
##### Parameters
- $method `string` magic method name called
- $parameters `array` parameters list
returns `static|mixed|null`
#### CarbonInterval::__construct

Create a new CarbonInterval instance.


##### Parameters
- $years `\Closure|\DateInterval|string|int|null`
- $months `int|float|null`
- $weeks `int|float|null`
- $days `int|float|null`
- $hours `int|float|null`
- $minutes `int|float|null`
- $seconds `int|float|null`
- $microseconds `int|float|null`
#### CarbonInterval::__debugInfo

Show truthy properties on var_dump().


#### CarbonInterval::__get

Get a part of the CarbonInterval object.


#### CarbonInterval::__set

Set a part of the CarbonInterval object.


##### Parameters
- $name `string`
- $value `int`
#### CarbonInterval::__set_state

Evaluate the PHP generated by var_export() and recreate the exported CarbonInterval instance.


##### Parameters
- $dump `array` data as exported by var_export()
returns `static`
#### CarbonInterval::__toString

Format the instance as a string using the forHumans() function.


returns `string`
#### CarbonInterval::abs

Invert the interval if it's inverted.


##### Parameters
- $absolute `bool` do nothing if set to false
returns `$this`
#### CarbonInterval::absolute




##### Parameters
- $absolute `bool` do nothing if set to false
returns `$this`
#### CarbonInterval::add

Add the passed interval to the current instance.


##### Parameters
- $unit `string|\DateInterval`
- $value `int|float`
returns `$this`
#### CarbonInterval::baseMixin

Mix another object into the class.


##### Examples
```php
Carbon::mixin(new class {
  public function addMoon() {
    return function () {
      return $this->addDays(30);
    };
  }
  public function subMoon() {
    return function () {
      return $this->subDays(30);
    };
  }
});
$fullMoon = Carbon::create('2018-12-22');
$nextFullMoon = $fullMoon->addMoon();
$blackMoon = Carbon::create('2019-01-06');
$previousBlackMoon = $blackMoon->subMoon();
echo "$nextFullMoon\n";
echo "$previousBlackMoon\n";
```
#### CarbonInterval::between

Determines if the instance is between two others.

The third argument allow you to specify if bounds are included or not (true by default)
but for when you including/excluding bounds may produce different results in your application,
we recommend to use the explicit methods ->betweenIncluded() or ->betweenExcluded() instead.
##### Parameters
- $interval1 `\CarbonInterval|\DateInterval|mixed`
- $interval2 `\CarbonInterval|\DateInterval|mixed`
- $equal `bool` Indicates if an equal to comparison should be done
returns `bool`
##### Examples
```php
CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(3)); // true
CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::hours(36)); // false
CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(2)); // true
CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(2), false); // false
```
#### CarbonInterval::betweenExcluded

Determines if the instance is between two others, bounds excluded.


##### Parameters
- $interval1 `\CarbonInterval|\DateInterval|mixed`
- $interval2 `\CarbonInterval|\DateInterval|mixed`
returns `bool`
##### Examples
```php
CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(3)); // true
CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::hours(36)); // false
CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(2)); // false
```
#### CarbonInterval::betweenIncluded

Determines if the instance is between two others, bounds excluded.


##### Parameters
- $interval1 `\CarbonInterval|\DateInterval|mixed`
- $interval2 `\CarbonInterval|\DateInterval|mixed`
returns `bool`
##### Examples
```php
CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(3)); // true
CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::hours(36)); // false
CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(2)); // true
```
#### CarbonInterval::cascade

Convert overflowed values into bigger units.


returns `$this`
#### CarbonInterval::cast

Cast the current instance into the given class.


returns `\T`
#### CarbonInterval::ceil

Ceil the current instance second with given precision if specified.


returns `$this`
#### CarbonInterval::ceilUnit

Ceil the current instance at the given unit with given precision if specified.


##### Parameters
- $unit `string`
- $precision `float|int|string|\DateInterval|null`
returns `$this`
#### CarbonInterval::clone

Get a copy of the instance.


returns `static`
#### CarbonInterval::compare

Comparing with passed interval.


##### Parameters
- $interval `\DateInterval`
returns `int 0, 1 or -1`
#### CarbonInterval::compareDateIntervals

Comparing 2 date intervals.


##### Parameters
- $first `\DateInterval`
- $second `\DateInterval`
returns `int 0, 1 or -1`
#### CarbonInterval::convertDate

Take a date and apply either the step if set, or the current interval else.

The interval/step is applied negatively (typically subtraction instead of addition) if $negated is true.
##### Parameters
- $dateTime `\DateTimeInterface`
- $negated `bool`
returns `\CarbonInterface`
#### CarbonInterval::copy

Get a copy of the instance.


returns `static`
#### CarbonInterval::create

Create a new CarbonInterval instance from specific values.

This is an alias for the constructor that allows better fluent
syntax as it allows you to do CarbonInterval::create(1)->fn() rather than
(new CarbonInterval(1))->fn().
##### Parameters
- $years `int`
- $months `int`
- $weeks `int`
- $days `int`
- $hours `int`
- $minutes `int`
- $seconds `int`
- $microseconds `int`
returns `static`
#### CarbonInterval::createFromDateString

Sets up a DateInterval from the relative parts of the string.


##### Parameters
- $datetime `string`
returns `static`
#### CarbonInterval::createFromFormat

Parse a string into a new CarbonInterval object according to the specified format.


##### Parameters
- $format `string` Format of the $interval input string
- $interval `string|null` Input string to convert into an interval
returns `static`
##### Examples
```php
echo Carboninterval::createFromFormat('H:i', '1:30');
```
#### CarbonInterval::diff

Create an interval from the difference between 2 dates.


##### Parameters
- $start `\Carbon\Carbon|\DateTimeInterface|mixed`
- $end `\Carbon\Carbon|\DateTimeInterface|mixed`
returns `static`
#### CarbonInterval::disableHumanDiffOption




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### CarbonInterval::divide

Divide and cascade current instance by a given divider.


##### Parameters
- $divider `float|int`
returns `$this`
#### CarbonInterval::enableFloatSetters

This option allow you to opt-in for the Carbon 3 behavior where float
values will no longer be cast to integer (so truncated).

⚠️ This settings will be applied globally, which mean your whole application
code including the third-party dependencies that also may use Carbon will
adopt the new behavior.
#### CarbonInterval::enableHumanDiffOption




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### CarbonInterval::end

Return the end date if interval was created from a difference between 2 dates.


returns `\CarbonInterface|null`
#### CarbonInterval::eq

Determines if the instance is equal to another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::equalTo

Determines if the instance is equal to another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::executeWithLocale

Set the current locale to the given, execute the passed function, reset the locale to previous one,
then return the result of the closure (or null if the closure was void).


##### Parameters
- $locale `string` locale ex. en
- $func `callable`
returns `mixed`
#### CarbonInterval::floor

Round the current instance second with given precision if specified.


returns `$this`
#### CarbonInterval::floorUnit

Truncate the current instance at the given unit with given precision if specified.


##### Parameters
- $unit `string`
- $precision `float|int|string|\DateInterval|null`
returns `$this`
#### CarbonInterval::forHumans

Get the current interval in a human readable format in the current locale.


##### Parameters
- $syntax `int|array`

if array passed, parameters will be extracted from it, the array may contain:
  ⦿ 'syntax' entry (see below)
  ⦿ 'short' entry (see below)
  ⦿ 'parts' entry (see below)
  ⦿ 'options' entry (see below)
  ⦿ 'skip' entry, list of units to skip (array of strings or a single string,
  ` it can be the unit name (singular or plural) or its shortcut
  ` (y, m, w, d, h, min, s, ms, µs).
  ⦿ 'aUnit' entry, prefer "an hour" over "1 hour" if true
  ⦿ 'altNumbers' entry, use alternative numbers if available
  ` (from the current language if true is passed, from the given language(s)
  ` if array or string is passed)
  ⦿ 'join' entry determines how to join multiple parts of the string
  `  - if $join is a string, it's used as a joiner glue
  `  - if $join is a callable/closure, it get the list of string and should return a string
  `  - if $join is an array, the first item will be the default glue, and the second item
  `    will be used instead of the glue for the last item
  `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
  `  - if $join is missing, a space will be used as glue
  ⦿ 'minimumUnit' entry determines the smallest unit of time to display can be long or
  `  short form of the units, e.g. 'hour' or 'h' (default value: s)
  ⦿ 'locale' language in which the diff should be output (has no effect if 'translator' key is set)
  ⦿ 'translator' a custom translator to use to translator the output.
  if int passed, it adds modifiers:
  Possible values:
  - CarbonInterface::DIFF_ABSOLUTE          no modifiers
  - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
  - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
  Default value: CarbonInterface::DIFF_ABSOLUTE
- $short `bool` displays short format of time units
- $parts `int` maximum number of parts to display (default value: -1: no limits)
- $options `int` human diff options
returns `string`
##### Examples
```php
echo CarbonInterval::fromString('4d 3h 40m')->forHumans() . "\n";
echo CarbonInterval::fromString('4d 3h 40m')->forHumans(['parts' => 2]) . "\n";
echo CarbonInterval::fromString('4d 3h 40m')->forHumans(['parts' => 3, 'join' => true]) . "\n";
echo CarbonInterval::fromString('4d 3h 40m')->forHumans(['short' => true]) . "\n";
echo CarbonInterval::fromString('1d 24h')->forHumans(['join' => ' or ']) . "\n";
echo CarbonInterval::fromString('1d 24h')->forHumans(['minimumUnit' => 'hour']) . "\n";
```
#### CarbonInterval::fromString

Creates a CarbonInterval from string.

Format:

Suffix | Unit    | Example | DateInterval expression
-------|---------|---------|------------------------
y      | years   |   1y    | P1Y
mo     | months  |   3mo   | P3M
w      | weeks   |   2w    | P2W
d      | days    |  28d    | P28D
h      | hours   |   4h    | PT4H
m      | minutes |  12m    | PT12M
s      | seconds |  59s    | PT59S

e. g. `1w 3d 4h 32m 23s` is converted to 10 days 4 hours 32 minutes and 23 seconds.

Special cases:
 - An empty string will return a zero interval
 - Fractions are allowed for weeks, days, hours and minutes and will be converted
   and rounded to the next smaller value (caution: 0.5w = 4d)
##### Parameters
- $intervalDefinition `string`
returns `static`
#### CarbonInterval::get

Get a part of the CarbonInterval object.


#### CarbonInterval::getAvailableLocales

Returns the list of internally available locales and already loaded custom locales.

(It will ignore custom translator dynamic loading.)
returns `array`
#### CarbonInterval::getAvailableLocalesInfo

Returns list of Language object for each available locale. This object allow you to get the ISO name, native
name, region and variant of the locale.


returns `\Language[]`
#### CarbonInterval::getCascadeFactors

Mapping of units and factors for cascading.

Should only be modified by changing the factors or referenced constants.
#### CarbonInterval::getDateIntervalSpec

Get the interval_spec string of a date interval.


##### Parameters
- $interval `\DateInterval`
returns `string`
#### CarbonInterval::getDaysPerWeek

Returns current config for days per week.


returns `int|float`
#### CarbonInterval::getFactor

Returns the factor for a given source-to-target couple.


##### Parameters
- $source `string`
- $target `string`
returns `int|float|null`
#### CarbonInterval::getFactorWithDefault

Returns the factor for a given source-to-target couple if set,
else try to find the appropriate constant as the factor, such as Carbon::DAYS_PER_WEEK.


##### Parameters
- $source `string`
- $target `string`
returns `int|float|null`
#### CarbonInterval::getFallbackLocale

Get the fallback locale.


#### CarbonInterval::getHoursPerDay

Returns current config for hours per day.


returns `int|float`
#### CarbonInterval::getHumanDiffOptions

Return default humanDiff() options (merged flags as integer).


#### CarbonInterval::getLocalTranslator

Get the translator of the current instance or the default if none set.


#### CarbonInterval::getLocale

Get the current translator locale.


returns `string`
#### CarbonInterval::getMicrosecondsPerMillisecond

Returns current config for microseconds per second.


returns `int|float`
#### CarbonInterval::getMillisecondsPerSecond

Returns current config for microseconds per second.


returns `int|float`
#### CarbonInterval::getMinutesPerHour

Returns current config for minutes per hour.


returns `int|float`
#### CarbonInterval::getNonZeroValues

Returns interval non-zero values as an array where key are the unit names and values the counts.


returns `int[]`
#### CarbonInterval::getSecondsPerMinute

Returns current config for seconds per minute.


returns `int|float`
#### CarbonInterval::getSettings

Returns current local settings.


#### CarbonInterval::getStep

Get the dynamic step in use.


returns `\Closure`
#### CarbonInterval::getTranslationMessage

Returns raw translation message for a given key.


##### Parameters
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
- $translator `\TranslatorInterface` an optional translator to use
returns `string`
#### CarbonInterval::getTranslationMessageWith

Returns raw translation message for a given key.


##### Parameters
- $translator `\TranslatorInterface|null` the translator to use
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
returns `string|\Closure|null`
#### CarbonInterval::getTranslator

Initialize the default translator instance if necessary.


#### CarbonInterval::getValuesSequence

Returns interval values as an array where key are the unit names and values the counts
from the biggest non-zero one the the smallest non-zero one.


returns `int[]`
#### CarbonInterval::greaterThan

Determines if the instance is greater (longer) than another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::greaterThanOrEqualTo

Determines if the instance is greater (longer) than or equal to another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::gt

Determines if the instance is greater (longer) than another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::gte

Determines if the instance is greater (longer) than or equal to another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::hasLocalTranslator

Return true if the current instance has its own translator.


#### CarbonInterval::hasMacro

Check if macro is registered.


##### Parameters
- $name `string`
returns `bool`
#### CarbonInterval::instance

Create a CarbonInterval instance from a DateInterval one.  Can not instance
DateInterval objects created from DateTime::diff() as you can't externally
set the $days field.


##### Parameters
- $interval `\DateInterval`
- $skipCopy `bool`

set to true to return the passed object
  (without copying it) if it's already of the
  current class
returns `static`
#### CarbonInterval::invert

Invert the interval.


##### Parameters
- $inverted `bool|int`

if a parameter is passed, the passed value cast as 1 or 0 is used
  as the new value of the ->invert property.
returns `$this`
#### CarbonInterval::isBetween

Determines if the instance is between two others


##### Parameters
- $interval1 `\CarbonInterval|\DateInterval|mixed`
- $interval2 `\CarbonInterval|\DateInterval|mixed`
- $equal `bool` Indicates if an equal to comparison should be done
returns `bool`
##### Examples
```php
CarbonInterval::hours(48)->isBetween(CarbonInterval::day(), CarbonInterval::days(3)); // true
CarbonInterval::hours(48)->isBetween(CarbonInterval::day(), CarbonInterval::hours(36)); // false
CarbonInterval::hours(48)->isBetween(CarbonInterval::day(), CarbonInterval::days(2)); // true
CarbonInterval::hours(48)->isBetween(CarbonInterval::day(), CarbonInterval::days(2), false); // false
```
#### CarbonInterval::isEmpty

Returns true if the interval is empty for each unit.


returns `bool`
#### CarbonInterval::isStrictModeEnabled

Returns true if the strict mode is globally in use, false else.

(It can be overridden in specific instances.)
returns `bool`
#### CarbonInterval::lessThan

Determines if the instance is less (shorter) than another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::lessThanOrEqualTo

Determines if the instance is less (shorter) than or equal to another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::locale

Get/set the locale for the current instance.


##### Parameters
- $locale `string|null`
- $fallbackLocales `string`
returns `$this|string`
#### CarbonInterval::localeHasDiffOneDayWords

Returns true if the given locale is internally supported and has words for 1-day diff (just now, yesterday, tomorrow).

Support is considered enabled if the 3 words are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonInterval::localeHasDiffSyntax

Returns true if the given locale is internally supported and has diff syntax support (ago, from now, before, after).

Support is considered enabled if the 4 sentences are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonInterval::localeHasDiffTwoDayWords

Returns true if the given locale is internally supported and has words for 2-days diff (before yesterday, after tomorrow).

Support is considered enabled if the 2 words are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonInterval::localeHasPeriodSyntax

Returns true if the given locale is internally supported and has period syntax support (X times, every X, from X, to X).

Support is considered enabled if the 4 sentences are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonInterval::localeHasShortUnits

Returns true if the given locale is internally supported and has short-units support.

Support is considered enabled if either year, day or hour has a short variant translated.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonInterval::lt

Determines if the instance is less (shorter) than another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::lte

Determines if the instance is less (shorter) than or equal to another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::macro

Register a custom macro.

Pass null macro to remove it.
##### Examples
```php
CarbonInterval::macro('twice', function () {
  return $this->times(2);
});
echo CarbonInterval::hours(2)->twice();
```
#### CarbonInterval::make

Make a CarbonInterval instance from given variable if possible.

Always return a new instance. Parse only strings and only these likely to be intervals (skip dates
and recurrences). Throw an exception for invalid format, but otherwise return null.
##### Parameters
- $interval `mixed|int|\DateInterval|string|\Closure|\Unit|null` interval or number of the given $unit
- $unit `\Unit|string|null` if specified, $interval must be an integer
- $skipCopy `bool`

set to true to return the passed object
  (without copying it) if it's already of the
  current class
returns `static|null`
#### CarbonInterval::minus

Add given parameters to the current interval.


##### Parameters
- $years `int`
- $months `int`
- $weeks `int|float`
- $days `int|float`
- $hours `int|float`
- $minutes `int|float`
- $seconds `int|float`
- $microseconds `int|float`
returns `$this`
#### CarbonInterval::mixin

Register macros from a mixin object.


##### Parameters
- $mixin `object|string`
returns `void`
##### Examples
```php
CarbonInterval::mixin(new class {
  public function daysToHours() {
    return function () {
      $this->hours += $this->days;
      $this->days = 0;

      return $this;
    };
  }
  public function hoursToDays() {
    return function () {
      $this->days += $this->hours;
      $this->hours = 0;

      return $this;
    };
  }
});
echo CarbonInterval::hours(5)->hoursToDays() . "\n";
echo CarbonInterval::days(5)->daysToHours() . "\n";
```
#### CarbonInterval::multiply

Multiply and cascade current instance by a given factor.


##### Parameters
- $factor `float|int`
returns `$this`
#### CarbonInterval::ne

Determines if the instance is not equal to another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::notEqualTo

Determines if the instance is not equal to another


##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed`
returns `bool`
#### CarbonInterval::optimize

Get rid of the original input, start date and end date that may be kept in memory.


returns `$this`
#### CarbonInterval::original

Return the original source used to create the current interval.


returns `array|int|string|\DateInterval|mixed|null`
#### CarbonInterval::parseFromLocale

Creates a CarbonInterval from string using a different locale.


##### Parameters
- $interval `string` interval string in the given language (may also contain English).
- $locale `string|null` if locale is null or not specified, current global locale will be used instead.
returns `static`
#### CarbonInterval::plus

Add given parameters to the current interval.


##### Parameters
- $years `int`
- $months `int`
- $weeks `int|float`
- $days `int|float`
- $hours `int|float`
- $minutes `int|float`
- $seconds `int|float`
- $microseconds `int|float`
returns `$this`
#### CarbonInterval::resetMonthsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`
#### CarbonInterval::resetToStringFormat

Reset the format used to the default when type juggling a Carbon instance to a string


returns `void`
#### CarbonInterval::resetYearsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`
#### CarbonInterval::round

Round the current instance second with given precision if specified.


##### Parameters
- $precision `float|int|string|\DateInterval|null`
- $function `string`
returns `$this`
#### CarbonInterval::roundUnit

Round the current instance at the given unit with given precision if specified and the given function.


#### CarbonInterval::set

Set a part of the CarbonInterval object.


##### Parameters
- $name `\Unit|string|array`
- $value `int`
returns `$this`
#### CarbonInterval::setCascadeFactors

Set default cascading factors for ->cascade() method.


##### Parameters
- $cascadeFactors `array`
#### CarbonInterval::setFallbackLocale

Set the fallback locale.


##### Parameters
- $locale `string`
#### CarbonInterval::setHumanDiffOptions




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### CarbonInterval::setLocalTranslator

Set the translator for the current instance.


#### CarbonInterval::setLocale

Set the current translator locale and indicate if the source locale file exists.

Pass 'auto' as locale to use the closest language to the current LC_TIME locale.
##### Parameters
- $locale `string` locale ex. en
#### CarbonInterval::setStep

Set a step to apply instead of a fixed interval to get the new date.

Or pass null to switch to fixed interval.
##### Parameters
- $step `\Closure|null`
#### CarbonInterval::setTimezone

Set the instance's timezone from a string or object.


#### CarbonInterval::setToStringFormat




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
            You should rather let Carbon object being cast to string with DEFAULT_TO_STRING_FORMAT, and
            use other method or custom format passed to format() method if you need to dump another string
            format.

Set the default format used when type juggling a Carbon instance to a string.
:::
##### Parameters
- $format `string|\Closure|null`
returns `void`
#### CarbonInterval::setTranslator

Set the default translator instance to use.


##### Parameters
- $translator `\TranslatorInterface`
returns `void`
#### CarbonInterval::settings

Set specific options.

- strictMode: true|false|null
- monthOverflow: true|false|null
- yearOverflow: true|false|null
- humanDiffOptions: int|null
- toStringFormat: string|Closure|null
- toJsonFormat: string|Closure|null
- locale: string|null
- timezone: \DateTimeZone|string|int|null
- macros: array|null
- genericMacros: array|null
##### Parameters
- $settings `array`
returns `$this|static`
#### CarbonInterval::shares

Divide current instance by a given divider. shares() is naive, it divides each unit separately
and the result is rounded for each unit. So 5 hours and 20 minutes shared by 3 becomes 2 hours
and 7 minutes.

Use shares() when you want a fast and approximated calculation that does not cascade units.

For a precise and cascaded calculation,
##### Parameters
- $divider `float|int`
returns `$this`
#### CarbonInterval::shiftTimezone

Set the instance's timezone from a string or object and add/subtract the offset difference.


#### CarbonInterval::shouldOverflowMonths

Get the month overflow global behavior (can be overridden in specific instances).


returns `bool`
#### CarbonInterval::shouldOverflowYears

Get the month overflow global behavior (can be overridden in specific instances).


returns `bool`
#### CarbonInterval::spec

Get the interval_spec string.


returns `string`
#### CarbonInterval::start

Return the start date if interval was created from a difference between 2 dates.


returns `\CarbonInterface|null`
#### CarbonInterval::stepBy

Decompose the current interval into


##### Parameters
- $interval `mixed|int|\DateInterval|string|\Closure|\Unit|null` interval or number of the given $unit
- $unit `\Unit|string|null` if specified, $interval must be an integer
returns `\CarbonPeriod`
#### CarbonInterval::sub

Subtract the passed interval to the current instance.


##### Parameters
- $unit `string|\DateInterval`
- $value `int|float`
returns `$this`
#### CarbonInterval::subtract

Subtract the passed interval to the current instance.


##### Parameters
- $unit `string|\DateInterval`
- $value `int|float`
returns `$this`
#### CarbonInterval::times

Multiply current instance given number of times. times() is naive, it multiplies each unit
(so day can be greater than 31, hour can be greater than 23, etc.) and the result is rounded
separately for each unit.

Use times() when you want a fast and approximated calculation that does not cascade units.

For a precise and cascaded calculation,
##### Parameters
- $factor `float|int`
returns `$this`
#### CarbonInterval::toArray

Returns interval values as an array where key are the unit names and values the counts.


returns `int[]`
#### CarbonInterval::toDateInterval

Return native DateInterval PHP object matching the current instance.


returns `\DateInterval`
##### Examples
```php
var_dump(CarbonInterval::hours(2)->toDateInterval());
```
#### CarbonInterval::toPeriod

Convert the interval to a CarbonPeriod.


##### Parameters
- $params `\DateTimeInterface|string|int` Start date, [end date or recurrences] and optional settings.
returns `\CarbonPeriod`
#### CarbonInterval::total

Get amount of given unit equivalent to the interval.


##### Parameters
- $unit `string`
returns `float`
#### CarbonInterval::translate

Translate using translation string or callback available.


##### Parameters
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `string|int|float|null` number if plural
- $translator `\TranslatorInterface|null` an optional translator to use
- $altNumbers `bool` pass true to use alternative numbers
returns `string`
#### CarbonInterval::translateNumber

Returns the alternative number for a given integer if available in the current locale.


##### Parameters
- $number `int`
returns `string`
#### CarbonInterval::translateTimeString

Translate a time string from a locale to an other.


##### Parameters
- $timeString `string` date/time/duration string to translate (may also contain English)
- $from `string|null` input locale of the $timeString parameter (`Carbon::getLocale()` by default)
- $to `string|null` output locale of the result returned (`"en"` by default)
- $mode `int`

specify what to translate with options:
  - CarbonInterface::TRANSLATE_ALL (default)
  - CarbonInterface::TRANSLATE_MONTHS
  - CarbonInterface::TRANSLATE_DAYS
  - CarbonInterface::TRANSLATE_UNITS
  - CarbonInterface::TRANSLATE_MERIDIEM
  You can use pipe to group: CarbonInterface::TRANSLATE_MONTHS | CarbonInterface::TRANSLATE_DAYS
returns `string`
#### CarbonInterval::translateTimeStringTo

Translate a time string from the current locale (`$date->locale()`) to another one.


##### Parameters
- $timeString `string` time string to translate
- $to `string|null` output locale of the result returned ("en" by default)
returns `string`
#### CarbonInterval::translateWith

Translate using translation string or callback available.


##### Parameters
- $translator `\TranslatorInterface` an optional translator to use
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `int|float|null` number if plural
returns `string`
#### CarbonInterval::useMonthsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
##### Parameters
- $monthsOverflow `bool`
returns `void`
#### CarbonInterval::useStrictMode




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
##### Parameters
- $strictModeEnabled `bool`
#### CarbonInterval::useYearsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
##### Parameters
- $yearsOverflow `bool`
returns `void`
#### CarbonInterval::weeksAndDays

Allow setting of weeks and days to be cumulative.


##### Parameters
- $weeks `int` Number of weeks to set
- $days `int` Number of days to set
returns `static`
#### CarbonPeriod::__call

Add aliases for setters.

CarbonPeriod::days(3)->hours(5)->invert()
    ->sinceNow()->until('2010-01-10')
    ->filter(...)
    ->count()

Note: We use magic method to let static and instance aliases with the same names.
#### CarbonPeriod::__callStatic

Provide static proxy for instance aliases.


#### CarbonPeriod::__construct

CarbonPeriod constructor.


#### CarbonPeriod::__get

Get a property allowing both `DatePeriod` snakeCase and camelCase names.


##### Parameters
- $name `string`
returns `bool|\CarbonInterface|\CarbonInterval|int|null`
#### CarbonPeriod::__isset

Check if an attribute exists on the object


##### Parameters
- $name `string`
returns `bool`
#### CarbonPeriod::__toString

Convert the date period into a string.


#### CarbonPeriod::addFilter

Add a filter to the stack.


#### CarbonPeriod::baseDebugInfo

Show truthy properties on var_dump().


#### CarbonPeriod::baseMixin

Mix another object into the class.


##### Examples
```php
Carbon::mixin(new class {
  public function addMoon() {
    return function () {
      return $this->addDays(30);
    };
  }
  public function subMoon() {
    return function () {
      return $this->subDays(30);
    };
  }
});
$fullMoon = Carbon::create('2018-12-22');
$nextFullMoon = $fullMoon->addMoon();
$blackMoon = Carbon::create('2019-01-06');
$previousBlackMoon = $blackMoon->subMoon();
echo "$nextFullMoon\n";
echo "$previousBlackMoon\n";
```
#### CarbonPeriod::calculateEnd

Returns the end is set, else calculated from start and recurrences.


##### Parameters
- $rounding `string|null` Optional rounding 'floor', 'ceil', 'round' using the period interval.
returns `\CarbonInterface`
#### CarbonPeriod::cast

Cast the current instance into the given class.


##### Parameters
- $className `string` The $className::instance() method will be called to cast the current object.
returns `\DatePeriod|object`
#### CarbonPeriod::ceil

Ceil the current instance second with given precision if specified (else period interval is used).


#### CarbonPeriod::ceilUnit

Ceil the current instance at the given unit with given precision if specified.


#### CarbonPeriod::clone




returns `static`
#### CarbonPeriod::contains

Return true if the given date is between start and end.


#### CarbonPeriod::copy

Get a copy of the instance.


#### CarbonPeriod::count

Count dates in the date period.


#### CarbonPeriod::create

Create a new instance.


#### CarbonPeriod::createFromArray

Create a new instance from an array of parameters.


#### CarbonPeriod::createFromIso

Create CarbonPeriod from ISO 8601 string.


#### CarbonPeriod::current

Return the current date.


#### CarbonPeriod::disableHumanDiffOption




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### CarbonPeriod::enableHumanDiffOption




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### CarbonPeriod::endsAfter

Determines if the end date is after another given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::endsAfterOrAt

Determines if the end date is after or the same as a given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::endsAt

Determines if the end date is the same as a given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::endsBefore

Determines if the end date is before another given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::endsBeforeOrAt

Determines if the end date is before or the same as a given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::eq

Determines if the instance is equal to another.

Warning: if options differ, instances will never be equal.
#### CarbonPeriod::equalTo

Determines if the instance is equal to another.

Warning: if options differ, instances will never be equal.
#### CarbonPeriod::excludeEndDate

Toggle EXCLUDE_END_DATE option.


#### CarbonPeriod::excludeStartDate

Toggle EXCLUDE_START_DATE option.


#### CarbonPeriod::executeWithLocale

Set the current locale to the given, execute the passed function, reset the locale to previous one,
then return the result of the closure (or null if the closure was void).


##### Parameters
- $locale `string` locale ex. en
- $func `callable`
returns `mixed`
#### CarbonPeriod::first

Return the first date in the date period.


#### CarbonPeriod::floor

Round the current instance second with given precision if specified (else period interval is used).


#### CarbonPeriod::floorUnit

Truncate the current instance at the given unit with given precision if specified.


#### CarbonPeriod::follows

Return true if the current period follows a given other period (with no overlap).

For instance, [2019-08-01 -> 2019-08-12] follows [2019-07-29 -> 2019-07-31]
Note than in this example, follows() would be false if 2019-08-01 or 2019-07-31 was excluded by options.
#### CarbonPeriod::forEach

Execute a given function on each date of the period.


##### Examples
```php
Carbon::create('2020-11-29')->daysUntil('2020-12-24')->forEach(function (Carbon $date) {
  echo $date->diffInDays('2020-12-25')." days before Christmas!\n";
});
```
#### CarbonPeriod::get

Get a property allowing both `DatePeriod` snakeCase and camelCase names.


##### Parameters
- $name `string`
returns `bool|\CarbonInterface|\CarbonInterval|int|null`
#### CarbonPeriod::getAvailableLocales

Returns the list of internally available locales and already loaded custom locales.

(It will ignore custom translator dynamic loading.)
returns `array`
#### CarbonPeriod::getAvailableLocalesInfo

Returns list of Language object for each available locale. This object allow you to get the ISO name, native
name, region and variant of the locale.


returns `\Language[]`
#### CarbonPeriod::getDateClass

Returns iteration item date class.


returns `string`
#### CarbonPeriod::getDateInterval

Get the underlying date interval.


#### CarbonPeriod::getEndDate

Get end date of the period.


##### Parameters
- $rounding `string|null` Optional rounding 'floor', 'ceil', 'round' using the period interval.
#### CarbonPeriod::getFallbackLocale

Get the fallback locale.


#### CarbonPeriod::getFilters

Get filters stack.


#### CarbonPeriod::getHumanDiffOptions

Return default humanDiff() options (merged flags as integer).


#### CarbonPeriod::getIncludedEndDate

Return the end if it's included by option, else return the end - 1 period interval.

Warning: if the period has no fixed end, this method will iterate the period to calculate it.
#### CarbonPeriod::getIncludedStartDate

Return the start if it's included by option, else return the start + 1 period interval.


#### CarbonPeriod::getLocalTranslator

Get the translator of the current instance or the default if none set.


#### CarbonPeriod::getLocale

Get the current translator locale.


returns `string`
#### CarbonPeriod::getOptions

Get the period options.


#### CarbonPeriod::getRecurrences

Get number of recurrences.


#### CarbonPeriod::getSettings

Returns current local settings.


#### CarbonPeriod::getStartDate

Get start date of the period.


##### Parameters
- $rounding `string|null` Optional rounding 'floor', 'ceil', 'round' using the period interval.
#### CarbonPeriod::getTranslationMessage

Returns raw translation message for a given key.


##### Parameters
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
- $translator `\TranslatorInterface` an optional translator to use
returns `string`
#### CarbonPeriod::getTranslationMessageWith

Returns raw translation message for a given key.


##### Parameters
- $translator `\TranslatorInterface|null` the translator to use
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
returns `string|\Closure|null`
#### CarbonPeriod::getTranslator

Initialize the default translator instance if necessary.


#### CarbonPeriod::hasFilter

Return whether given instance or name is in the filter stack.


#### CarbonPeriod::hasLocalTranslator

Return true if the current instance has its own translator.


#### CarbonPeriod::hasMacro

Check if macro is registered.


#### CarbonPeriod::instance

Create a new instance from a DatePeriod or CarbonPeriod object.


#### CarbonPeriod::invertDateInterval

Invert the period date interval.


#### CarbonPeriod::isConsecutiveWith

Return true if the given period either follows or is followed by the current one.


#### CarbonPeriod::isEndExcluded

Returns true if the end date should be excluded.


#### CarbonPeriod::isEndIncluded

Returns true if the end date should be included.


#### CarbonPeriod::isEnded

Return true if end date is now or later.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::isFollowedBy

Return true if the given other period follows the current one (with no overlap).

For instance, [2019-07-29 -> 2019-07-31] is followed by [2019-08-01 -> 2019-08-12]
Note than in this example, isFollowedBy() would be false if 2019-08-01 or 2019-07-31 was excluded by options.
#### CarbonPeriod::isInProgress

Return true if now is between start date (included) and end date (excluded).

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::isStartExcluded

Returns true if the start date should be excluded.


#### CarbonPeriod::isStartIncluded

Returns true if the start date should be included.


#### CarbonPeriod::isStarted

Return true if start date is now or later.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::isStrictModeEnabled

Returns true if the strict mode is globally in use, false else.

(It can be overridden in specific instances.)
returns `bool`
#### CarbonPeriod::isUnfilteredAndEndLess

Return `true` if the period has no custom filter and is guaranteed to be endless.

Note that we can't check if a period is endless as soon as it has custom filters
because filters can emit `CarbonPeriod::END_ITERATION` to stop the iteration in
a way we can't predict without actually iterating the period.
#### CarbonPeriod::jsonSerialize

Specify data which should be serialized to JSON.


returns `\CarbonInterface[]`
#### CarbonPeriod::key

Return the current key.


#### CarbonPeriod::last

Return the last date in the date period.


#### CarbonPeriod::locale

Get/set the locale for the current instance.


##### Parameters
- $locale `string|null`
- $fallbackLocales `string`
returns `$this|string`
#### CarbonPeriod::localeHasDiffOneDayWords

Returns true if the given locale is internally supported and has words for 1-day diff (just now, yesterday, tomorrow).

Support is considered enabled if the 3 words are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonPeriod::localeHasDiffSyntax

Returns true if the given locale is internally supported and has diff syntax support (ago, from now, before, after).

Support is considered enabled if the 4 sentences are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonPeriod::localeHasDiffTwoDayWords

Returns true if the given locale is internally supported and has words for 2-days diff (before yesterday, after tomorrow).

Support is considered enabled if the 2 words are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonPeriod::localeHasPeriodSyntax

Returns true if the given locale is internally supported and has period syntax support (X times, every X, from X, to X).

Support is considered enabled if the 4 sentences are translated in the given locale.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonPeriod::localeHasShortUnits

Returns true if the given locale is internally supported and has short-units support.

Support is considered enabled if either year, day or hour has a short variant translated.
##### Parameters
- $locale `string` locale ex. en
returns `bool`
#### CarbonPeriod::macro

Register a custom macro.

Pass null macro to remove it.
##### Examples
```php
CarbonPeriod::macro('middle', function () {
  return $this->getStartDate()->average($this->getEndDate());
});
echo CarbonPeriod::since('2011-05-12')->until('2011-06-03')->middle();
```
#### CarbonPeriod::make

Make a CarbonPeriod instance from given variable if possible.


#### CarbonPeriod::map

Execute a given function on each date of the period and yield the result of this function.


##### Examples
```php
$period = Carbon::create('2020-11-29')->daysUntil('2020-12-24');
echo implode("\n", iterator_to_array($period->map(function (Carbon $date) {
  return $date->diffInDays('2020-12-25').' days before Christmas!';
})));
```
#### CarbonPeriod::mixin

Register macros from a mixin object.


##### Examples
```php
CarbonPeriod::mixin(new class {
  public function addDays() {
    return function ($count = 1) {
      return $this->setStartDate(
        $this->getStartDate()->addDays($count)
      )->setEndDate(
        $this->getEndDate()->addDays($count)
      );
    };
  }
  public function subDays() {
    return function ($count = 1) {
      return $this->setStartDate(
        $this->getStartDate()->subDays($count)
      )->setEndDate(
        $this->getEndDate()->subDays($count)
      );
    };
  }
});
echo CarbonPeriod::create('2000-01-01', '2000-02-01')->addDays(5)->subDays(3);
```
#### CarbonPeriod::ne

Determines if the instance is not equal to another.

Warning: if options differ, instances will never be equal.
#### CarbonPeriod::next

Move forward to the next date.


#### CarbonPeriod::notEqualTo

Determines if the instance is not equal to another.

Warning: if options differ, instances will never be equal.
#### CarbonPeriod::overlaps

Returns true if the current period overlaps the given one (if 1 parameter passed)
or the period between 2 dates (if 2 parameters passed).


##### Parameters
- $rangeOrRangeStart `\CarbonPeriod|\DateTimeInterface|\Carbon|\CarbonImmutable|string`
- $rangeEnd `\DateTimeInterface|\Carbon|\CarbonImmutable|string|null`
returns `bool`
#### CarbonPeriod::prependFilter

Prepend a filter to the stack.


#### CarbonPeriod::removeFilter

Remove a filter by instance or name.


#### CarbonPeriod::resetDateInterval

Reset the date interval to the default value.

Difference with simply setting interval to 1-day is that P1D will not appear when calling toIso8601String()
and also next adding to the interval won't include the default 1-day.
#### CarbonPeriod::resetFilters

Reset filters stack.


#### CarbonPeriod::resetMonthsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`
#### CarbonPeriod::resetToStringFormat

Reset the format used to the default when type juggling a Carbon instance to a string


returns `void`
#### CarbonPeriod::resetYearsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`
#### CarbonPeriod::rewind

Rewind to the start date.

Iterating over a date in the UTC timezone avoids bug during backward DST change.
#### CarbonPeriod::round

Round the current instance second with given precision if specified (else period interval is used).


#### CarbonPeriod::roundUnit

Round the current instance at the given unit with given precision if specified and the given function.


#### CarbonPeriod::setDateClass

Set the iteration item class.


##### Parameters
- $dateClass `string`
returns `static`
#### CarbonPeriod::setDateInterval

Change the period date interval.


##### Parameters
- $interval `\DateInterval|\Unit|string|int`
- $unit `\Unit|string` the unit of $interval if it's a number
returns `static`
#### CarbonPeriod::setDates

Set start and end date.


##### Parameters
- $start `\DateTime|\DateTimeInterface|string`
- $end `\DateTime|\DateTimeInterface|string|null`
returns `static`
#### CarbonPeriod::setEndDate

Change the period end date.


##### Parameters
- $date `\DateTime|\DateTimeInterface|string|null`
- $inclusive `bool|null`
returns `static`
#### CarbonPeriod::setFallbackLocale

Set the fallback locale.


##### Parameters
- $locale `string`
#### CarbonPeriod::setFilters

Set filters stack.


#### CarbonPeriod::setHumanDiffOptions




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
#### CarbonPeriod::setLocalTranslator

Set the translator for the current instance.


#### CarbonPeriod::setLocale

Set the current translator locale and indicate if the source locale file exists.

Pass 'auto' as locale to use the closest language to the current LC_TIME locale.
##### Parameters
- $locale `string` locale ex. en
#### CarbonPeriod::setOptions

Change the period options.


##### Parameters
- $options `int|null`
returns `static`
#### CarbonPeriod::setRecurrences

Add a recurrences filter (set maximum number of recurrences).


#### CarbonPeriod::setStartDate

Change the period start date.


##### Parameters
- $date `\DateTime|\DateTimeInterface|string`
- $inclusive `bool|null`
returns `static`
#### CarbonPeriod::setTimezone

Set the instance's timezone from a string or object and apply it to start/end.


#### CarbonPeriod::setToStringFormat




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
            You should rather let Carbon object being cast to string with DEFAULT_TO_STRING_FORMAT, and
            use other method or custom format passed to format() method if you need to dump another string
            format.

Set the default format used when type juggling a Carbon instance to a string.
:::
##### Parameters
- $format `string|\Closure|null`
returns `void`
#### CarbonPeriod::setTranslator

Set the default translator instance to use.


##### Parameters
- $translator `\TranslatorInterface`
returns `void`
#### CarbonPeriod::settings

Set specific options.

- strictMode: true|false|null
- monthOverflow: true|false|null
- yearOverflow: true|false|null
- humanDiffOptions: int|null
- toStringFormat: string|Closure|null
- toJsonFormat: string|Closure|null
- locale: string|null
- timezone: \DateTimeZone|string|int|null
- macros: array|null
- genericMacros: array|null
##### Parameters
- $settings `array`
returns `$this|static`
#### CarbonPeriod::shiftTimezone

Set the instance's timezone from a string or object and add/subtract the offset difference to start/end.


#### CarbonPeriod::shouldOverflowMonths

Get the month overflow global behavior (can be overridden in specific instances).


returns `bool`
#### CarbonPeriod::shouldOverflowYears

Get the month overflow global behavior (can be overridden in specific instances).


returns `bool`
#### CarbonPeriod::skip

Skip iterations and returns iteration state (false if ended, true if still valid).


##### Parameters
- $count `int` steps number to skip (1 by default)
returns `bool`
#### CarbonPeriod::spec

Format the date period as ISO 8601.


#### CarbonPeriod::startsAfter

Determines if the start date is after another given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::startsAfterOrAt

Determines if the start date is after or the same as a given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::startsAt

Determines if the start date is the same as a given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::startsBefore

Determines if the start date is before another given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::startsBeforeOrAt

Determines if the start date is before or the same as a given date.

(Rather start/end are included by options is ignored.)
#### CarbonPeriod::toArray

Convert the date period into an array without changing current iteration state.


returns `\CarbonInterface[]`
#### CarbonPeriod::toDatePeriod

Return native DatePeriod PHP object matching the current instance.


##### Examples
```php
var_dump(CarbonPeriod::create('2021-01-05', '2021-02-15')->toDatePeriod());
```
#### CarbonPeriod::toIso8601String

Format the date period as ISO 8601.


#### CarbonPeriod::toString

Convert the date period into a string.


#### CarbonPeriod::toggleOptions

Toggle given options on or off.


##### Parameters
- $options `int`
- $state `bool|null`
returns `static`
#### CarbonPeriod::translate

Translate using translation string or callback available.


##### Parameters
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `string|int|float|null` number if plural
- $translator `\TranslatorInterface|null` an optional translator to use
- $altNumbers `bool` pass true to use alternative numbers
returns `string`
#### CarbonPeriod::translateNumber

Returns the alternative number for a given integer if available in the current locale.


##### Parameters
- $number `int`
returns `string`
#### CarbonPeriod::translateTimeString

Translate a time string from a locale to an other.


##### Parameters
- $timeString `string` date/time/duration string to translate (may also contain English)
- $from `string|null` input locale of the $timeString parameter (`Carbon::getLocale()` by default)
- $to `string|null` output locale of the result returned (`"en"` by default)
- $mode `int`

specify what to translate with options:
  - CarbonInterface::TRANSLATE_ALL (default)
  - CarbonInterface::TRANSLATE_MONTHS
  - CarbonInterface::TRANSLATE_DAYS
  - CarbonInterface::TRANSLATE_UNITS
  - CarbonInterface::TRANSLATE_MERIDIEM
  You can use pipe to group: CarbonInterface::TRANSLATE_MONTHS | CarbonInterface::TRANSLATE_DAYS
returns `string`
#### CarbonPeriod::translateTimeStringTo

Translate a time string from the current locale (`$date->locale()`) to another one.


##### Parameters
- $timeString `string` time string to translate
- $to `string|null` output locale of the result returned ("en" by default)
returns `string`
#### CarbonPeriod::translateWith

Translate using translation string or callback available.


##### Parameters
- $translator `\TranslatorInterface` an optional translator to use
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `int|float|null` number if plural
returns `string`
#### CarbonPeriod::useMonthsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
##### Parameters
- $monthsOverflow `bool`
returns `void`
#### CarbonPeriod::useStrictMode




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
##### Parameters
- $strictModeEnabled `bool`
#### CarbonPeriod::useYearsOverflow




::: warning Deprectated
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
##### Parameters
- $yearsOverflow `bool`
returns `void`
#### CarbonPeriod::valid

Check if the current position is valid.


#### CarbonTimeZone::__toString

Cast to string (get timezone name).


returns `string`
#### CarbonTimeZone::cast

Cast the current instance into the given class.


##### Parameters
- $className `class-string<\DateTimeZone>` The $className::instance() method will be called to cast the current object.
returns `\DateTimeZone|mixed`
#### CarbonTimeZone::create

Create a CarbonTimeZone from mixed input.


##### Parameters
- $object `\DateTimeZone|string|int|null`
returns `false|static`
#### CarbonTimeZone::createFromHourOffset

Create a CarbonTimeZone from int/float hour offset.


##### Parameters
- $hourOffset `float` number of hour of the timezone shift (can be decimal).
returns `false|static`
#### CarbonTimeZone::createFromMinuteOffset

Create a CarbonTimeZone from int/float minute offset.


##### Parameters
- $minuteOffset `float` number of total minutes of the timezone shift.
returns `false|static`
#### CarbonTimeZone::getAbbr




##### Parameters
- $dst `bool`
returns `string`
#### CarbonTimeZone::getAbbreviatedName

Returns abbreviated name of the current timezone according to DST setting.


##### Parameters
- $dst `bool`
returns `string`
#### CarbonTimeZone::getOffsetNameFromMinuteOffset

Convert a total minutes offset into a standardized timezone offset string.


##### Parameters
- $minutes `float` number of total minutes of the timezone shift.
returns `string`
#### CarbonTimeZone::getType

Return the type number:

Type 1; A UTC offset, such as -0300
Type 2; A timezone abbreviation, such as GMT
Type 3: A timezone identifier, such as Europe/London
#### CarbonTimeZone::instance

Create a CarbonTimeZone from mixed input.


##### Parameters
- $object `\DateTimeZone|string|int|false|null` original value to get CarbonTimeZone from it.
- $objectDump `\DateTimeZone|string|int|false|null` dump of the object for error messages.
returns `static|null`
#### CarbonTimeZone::toOffsetName

Get the offset as string "sHH:MM" (such as "+00:00" or "-12:30").


#### CarbonTimeZone::toOffsetTimeZone

Returns a new CarbonTimeZone object using the offset string instead of region string.


#### CarbonTimeZone::toRegionName

Returns the first region string (such as "America/Toronto") that matches the current timezone or
false if no match is found.


#### CarbonTimeZone::toRegionTimeZone

Returns a new CarbonTimeZone object using the region string instead of offset string.


#### Language::__toString

Returns the original locale ID.


#### Language::all

Get the list of the known languages.


returns `array`
#### Language::getCode

Returns the code of the locale "en"/"fr".


#### Language::getFullIsoDescription

Get a string with long ISO name, region in parentheses if applicable, variant in parentheses if applicable.


#### Language::getFullIsoName

Returns the long ISO language name.


#### Language::getFullNativeDescription

Get a string with long native name, region in parentheses if applicable, variant in parentheses if applicable.


#### Language::getFullNativeName

Return the full name of the language in this language.


#### Language::getId

Returns the original locale ID.


#### Language::getIsoDescription

Get a string with short ISO name, region in parentheses if applicable, variant in parentheses if applicable.


#### Language::getIsoName

Returns the short ISO language name.


#### Language::getNames

Get both isoName and nativeName as an array.


#### Language::getNativeDescription

Get a string with short native name, region in parentheses if applicable, variant in parentheses if applicable.


#### Language::getNativeName

Get the short name of the language in this language.


#### Language::getRegion

Returns the region part of the locale.


#### Language::getRegionName

Returns the region name for the current language.

⚠ ISO 3166-2 short name provided with no warranty, should not
be used for any purpose to show official state names.
#### Language::getVariant

Returns the variant code such as cyrl/latn.


#### Language::getVariantName

Returns the variant such as Cyrillic/Latin.


#### Language::jsonSerialize

Get a string with short ISO name, region in parentheses if applicable, variant in parentheses if applicable.


#### Language::regions

Get the list of the known regions.

⚠ ISO 3166-2 short name provided with no warranty, should not
be used for any purpose to show official state names.
#### Language::setIsoName

Set the ISO language name.


#### Language::setNativeName

Set the name of the language in this language.


#### Translator::__debugInfo

Show locale on var_dump().


returns `array`
#### Translator::addDirectory

Add a directory to the list translation files are searched in.


##### Parameters
- $directory `string` new directory
returns `$this`
#### Translator::addLoader

Adds a Loader.


##### Parameters
- $format `string` The name of the loader (@see addResource())
#### Translator::addResource

Adds a Resource.


##### Parameters
- $format `string` The name of the loader (@see addLoader())
- $resource `mixed` The resource name
#### Translator::get

Return a singleton instance of Translator.


##### Parameters
- $locale `string|null` optional initial locale ("en" - english by default)
returns `static`
#### Translator::getAvailableLocales

Returns the list of internally available locales and already loaded custom locales.

(It will ignore custom translator dynamic loading.)
##### Parameters
- $prefix `string` prefix required to filter result
returns `array`
#### Translator::getDirectories

Returns the list of directories translation files are searched in.


#### Translator::getFallbackLocales

Gets the fallback locales.


#### Translator::getLocalesFiles

Returns the list of files matching a given locale prefix (or all if empty).


##### Parameters
- $prefix `string` prefix required to filter result
returns `array`
#### Translator::getMessages

Get messages of a locale, if none given, return all the
languages.


#### Translator::removeDirectory

Remove a directory from the list translation files are searched in.


##### Parameters
- $directory `string` directory path
returns `$this`
#### Translator::resetMessages

Reset messages of a locale (all locale if no locale passed).

Remove custom messages and reload initial messages from matching
file in Lang directory.
#### Translator::setDirectories

Set list of directories translation files are searched in.


##### Parameters
- $directories `array` new directories list
returns `$this`
#### Translator::setFallbackLocales

Sets the fallback locales.


##### Parameters
- $locales `string[]`
#### Translator::setLocale

Set the current translator locale and indicate if the source locale file exists


##### Parameters
- $locale `string` locale ex. en
#### Translator::setMessages

Set messages of a locale and take file first if present.


##### Parameters
- $locale `string`
- $messages `array`
returns `$this`
#### Translator::setTranslations

Set messages of the current locale and take file first if present.


##### Parameters
- $messages `array`
returns `$this`
