# Reference

#### Carbon::__clone

Update constructedObjectId on cloned.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.29.0  | *no arguments* |

----------

#### Carbon::__construct

Create a new Carbon instance.

Please see the testing aids section (specifically static::setTestNow())
for more on the possibility of this constructor returning a test instance.

| History           | Version | Description                                                                                                                                |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `DateTimeInterface\|Carbon\WeekDay\|Carbon\Month\|string\|int\|float\|null $time = null, DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.0.0   | `$time = null, $tz = null`                                                                                                                 |

----------

#### Carbon::__debugInfo

Show truthy properties on var_dump().

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::__get

Get a part of the Carbon object.

returns `string|int|bool|\DateTimeZone|null`

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $name` |
| Method added      | 1.0.0   | `$name`        |

----------

#### Carbon::__isset

Check if an attribute exists on the object

##### Parameters
- $name `string` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 1.2.0   | `$name`     |

----------

#### Carbon::__serialize

Returns the values to dump on serialize() called on.

returns `array`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.21.0  | *no arguments* |

----------

#### Carbon::__set

Set a part of the Carbon object

##### Parameters
- $name `string` 
- $value `string|int|\DateTimeZone` 

returns `void`

| History      | Version | Description     |
|:------------ | ------- | --------------- |
| Method added | 1.0.0   | `$name, $value` |

----------

#### Carbon::__set_state

The __set_state handler.

##### Parameters
- $dump `string|array` 

returns `static`

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 2.0.0   | `$dump`        |
| Prototype changed | 1.24.2  | `$array`       |
| Prototype changed | 1.24.1  | `$state`       |
| Prototype changed | 1.24.0  | `array $state` |
| Prototype changed | 1.23.0  | `$array`       |
| Method added      | 1.0.0   | `array $array` |

----------

#### Carbon::__toString

Format the instance as a string using the set format

##### Examples
```php
echo Carbon::now(); // Carbon instances can be cast to string
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::__unserialize

Set locale if specified on unserialize() called.

| History      | Version | Description   |
|:------------ | ------- | ------------- |
| Method added | 1.21.0  | `array $data` |

----------

#### Carbon::__wakeup

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

| History           | Version | Description                                 |
|:----------------- | ------- | ------------------------------------------- |
| Prototype changed | 3.0.0   | `$unit, $value = 1, ?bool $overflow = null` |
| Prototype changed | 2.0.0   | `$unit, $value = 1, $overflow = null`       |
| Prototype changed | 1.21.0  | `DateInterval $interval`                    |
| Method added      | 1.0.0   | `$interval`                                 |

----------

#### Carbon::addBusinessDay

Add a given number of business days to the current date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addBusinessDays

Add a given number of business days to the current date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addBusinessInterval

Add the given interval taking into account only open time
(if `$open` is true) or only closed time (if `$open` is false).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addCenturies

Add centuries (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addCenturiesNoOverflow

Add centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addCenturiesWithNoOverflow

Add centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addCenturiesWithOverflow

Add centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addCenturiesWithoutOverflow

Add centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addCentury

Add one century to the instance (using date interval).

returns `$this`

#### Carbon::addCenturyNoOverflow

Add one century to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addCenturyWithNoOverflow

Add one century to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addCenturyWithOverflow

Add one century to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::addCenturyWithoutOverflow

Add one century to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addClosedHours

Add the given number of hours taking into account only closed time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addClosedMinutes

Add the given number of minutes taking into account only closed time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addClosedTime

Add the given interval taking into account only closed time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addDay

Add one day to the instance (using date interval).

returns `$this`

#### Carbon::addDays

Add days (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addDecade

Add one decade to the instance (using date interval).

returns `$this`

#### Carbon::addDecadeNoOverflow

Add one decade to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addDecadeWithNoOverflow

Add one decade to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addDecadeWithOverflow

Add one decade to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::addDecadeWithoutOverflow

Add one decade to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addDecades

Add decades (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addDecadesNoOverflow

Add decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addDecadesWithNoOverflow

Add decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addDecadesWithOverflow

Add decades (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addDecadesWithoutOverflow

Add decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addExtraWorkday

Add a workday to the workdays list of a region and optionally init its ID and name.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|null`

#### Carbon::addHoliday

Add a holiday to the holidays list of a region and optionally init its ID, name and observed state.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|null`

#### Carbon::addHolidays

Add a holiday to the holidays list of a region and optionally init their IDs, names and observed states (if provided as array-definitions).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

#### Carbon::addHour

Add one hour to the instance (using date interval).

returns `$this`

#### Carbon::addHours

Add hours (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMicro

Add one microsecond to the instance (using date interval).

returns `$this`

#### Carbon::addMicros

Add microseconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMicrosecond

Add one microsecond to the instance (using date interval).

returns `$this`

#### Carbon::addMicroseconds

Add microseconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMillennia

Add millennia (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMillenniaNoOverflow

Add millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMillenniaWithNoOverflow

Add millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMillenniaWithOverflow

Add millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMillenniaWithoutOverflow

Add millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMillennium

Add one millennium to the instance (using date interval).

returns `$this`

#### Carbon::addMillenniumNoOverflow

Add one millennium to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addMillenniumWithNoOverflow

Add one millennium to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addMillenniumWithOverflow

Add one millennium to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::addMillenniumWithoutOverflow

Add one millennium to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addMilli

Add one millisecond to the instance (using date interval).

returns `$this`

#### Carbon::addMillis

Add milliseconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMillisecond

Add one millisecond to the instance (using date interval).

returns `$this`

#### Carbon::addMilliseconds

Add milliseconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMinute

Add one minute to the instance (using date interval).

returns `$this`

#### Carbon::addMinutes

Add minutes (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMonth

Add one month to the instance (using date interval).

returns `$this`

#### Carbon::addMonthNoOverflow

Add one month to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addMonthWithNoOverflow

Add one month to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addMonthWithOverflow

Add one month to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::addMonthWithoutOverflow

Add one month to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addMonths

Add months (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMonthsNoOverflow

Add months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMonthsWithNoOverflow

Add months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMonthsWithOverflow

Add months (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addMonthsWithoutOverflow

Add months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addOpenHours

Add the given number of hours taking into account only open time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addOpenMinutes

Add the given number of minutes taking into account only open time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addOpenTime

Add the given interval taking into account only open time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::addQuarter

Add one quarter to the instance (using date interval).

returns `$this`

#### Carbon::addQuarterNoOverflow

Add one quarter to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addQuarterWithNoOverflow

Add one quarter to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addQuarterWithOverflow

Add one quarter to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::addQuarterWithoutOverflow

Add one quarter to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addQuarters

Add quarters (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addQuartersNoOverflow

Add quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addQuartersWithNoOverflow

Add quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addQuartersWithOverflow

Add quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addQuartersWithoutOverflow

Add quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

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

| History           | Version | Description                |
|:----------------- | ------- | -------------------------- |
| Prototype changed | 3.0.0   | `string $unit, $value = 1` |
| Method added      | 2.0.0   | `$unit, $value = 1`        |

----------

#### Carbon::addSecond

Add one second to the instance (using date interval).

returns `$this`

#### Carbon::addSeconds

Add seconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCCenturies

Add centuries (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCCentury

Add one century to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCDay

Add one day to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCDays

Add days (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCDecade

Add one decade to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCDecades

Add decades (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCHour

Add one hour to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCHours

Add hours (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCMicro

Add one microsecond to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCMicros

Add microseconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCMicrosecond

Add one microsecond to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCMicroseconds

Add microseconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCMillennia

Add millennia (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCMillennium

Add one millennium to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCMilli

Add one millisecond to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCMillis

Add milliseconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCMillisecond

Add one millisecond to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCMilliseconds

Add milliseconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCMinute

Add one minute to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCMinutes

Add minutes (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCMonth

Add one month to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCMonths

Add months (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCQuarter

Add one quarter to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCQuarters

Add quarters (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCSecond

Add one second to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCSeconds

Add seconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCUnit

Add seconds to the instance using timestamp. Positive $value travels
forward while negative $value travels into the past.

##### Parameters
- $unit `string` 
- $value `int|float|null` 

returns `static`

| History      | Version | Description                |
|:------------ | ------- | -------------------------- |
| Method added | 3.2.0   | `string $unit, $value = 1` |

----------

#### Carbon::addUTCWeek

Add one week to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCWeeks

Add weeks (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUTCYear

Add one year to the instance (using timestamp).

returns `$this`

#### Carbon::addUTCYears

Add years (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addUnit

Add given units to the current instance.

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.1.0   | `Carbon\Unit\|string $unit, $value = 1, ?bool $overflow = null` |
| Prototype changed | 3.0.0   | `string $unit, $value = 1, ?bool $overflow = null`              |
| Method added      | 2.0.0   | `$unit, $value = 1, $overflow = null`                           |

----------

#### Carbon::addUnitNoOverflow

Add any unit to a new value without overflowing current other unit given.

##### Parameters
- $valueUnit `string` unit name to modify
- $value `int` amount to add to the input unit
- $overflowUnit `string` unit name to not overflow

| History           | Version | Description                                           |
|:----------------- | ------- | ----------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $valueUnit, int $value, string $overflowUnit` |
| Method added      | 2.0.0   | `$valueUnit, $value, $overflowUnit`                   |

----------

#### Carbon::addWeek

Add one week to the instance (using date interval).

returns `$this`

#### Carbon::addWeekday

Add one weekday to the instance (using date interval).

returns `$this`

#### Carbon::addWeekdays

Add weekdays (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addWeeks

Add weeks (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addYear

Add one year to the instance (using date interval).

returns `$this`

#### Carbon::addYearNoOverflow

Add one year to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addYearWithNoOverflow

Add one year to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addYearWithOverflow

Add one year to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::addYearWithoutOverflow

Add one year to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::addYears

Add years (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addYearsNoOverflow

Add years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addYearsWithNoOverflow

Add years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addYearsWithOverflow

Add years (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::addYearsWithoutOverflow

Add years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

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

| History           | Version | Description                                                   |
|:----------------- | ------- | ------------------------------------------------------------- |
| Prototype changed | 2.16.0  | `$syntax = null, $short = false, $parts = 1, $options = null` |
| Method added      | 1.39.0  | `$absolute = null, $short = false, $parts = 1`                |

----------

#### Carbon::applyBusinessInterval

Shift current time with a given interval taking into account only open time
(if `$open` is true) or only closed time (if `$open` is false).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::average

Modify the current instance to the average of a given instance (default now) and the current instance
(second-precision).

##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|null` 

returns `static`

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 1.24.0  | `$date = null`                |
| Prototype changed | 1.23.0  | `?self $date = null`          |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null` |
| Method added      | 1.7.0   | `Carbon\Carbon $date = null`  |

----------

#### Carbon::avoidMutation

Clone the current instance if it's mutable.

This method is convenient to ensure you don't mutate the initial object
but avoid to make a useless copy of it if it's already immutable.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.50.0  | *no arguments* |

----------

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

| History           | Version | Description                                                                              |
|:----------------- | ------- | ---------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date1, DateTimeInterface\|string $date2, bool $equal = true` |
| Prototype changed | 1.24.0  | `$date1, $date2, $equal = true`                                                          |
| Prototype changed | 1.23.0  | `self $dt1, self $dt2, $equal = true`                                                    |
| Method added      | 1.3.0   | `Carbon\Carbon $dt1, Carbon\Carbon $dt2, $equal = true`                                  |

----------

#### Carbon::betweenExcluded

Determines if the instance is between two others, bounds excluded.

##### Examples
```php
Carbon::parse('2018-07-25')->betweenExcluded('2018-07-14', '2018-08-01'); // true
Carbon::parse('2018-07-25')->betweenExcluded('2018-08-01', '2018-08-20'); // false
Carbon::parse('2018-07-25')->betweenExcluded('2018-07-25', '2018-08-01'); // false
```

| History           | Version | Description                                                          |
|:----------------- | ------- | -------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date1, DateTimeInterface\|string $date2` |
| Method added      | 2.22.0  | `$date1, $date2`                                                     |

----------

#### Carbon::betweenIncluded

Determines if the instance is between two others, bounds included.

##### Examples
```php
Carbon::parse('2018-07-25')->betweenIncluded('2018-07-14', '2018-08-01'); // true
Carbon::parse('2018-07-25')->betweenIncluded('2018-08-01', '2018-08-20'); // false
Carbon::parse('2018-07-25')->betweenIncluded('2018-07-25', '2018-08-01'); // true
```

| History           | Version | Description                                                          |
|:----------------- | ------- | -------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date1, DateTimeInterface\|string $date2` |
| Method added      | 2.31.0  | `$date1, $date2`                                                     |

----------

#### Carbon::calendar

Returns either day of week + time (e.g. "Last Friday at 3:30 PM") if reference time is within 7 days,
or a calendar date (e.g. "10/29/2017") otherwise.

Language, date and time formats will change according to the current locale.

##### Parameters
- $referenceTime `\Carbon|\DateTimeInterface|string|null` 
- $formats `array` 

returns `string`

| History      | Version | Description                                  |
|:------------ | ------- | -------------------------------------------- |
| Method added | 2.0.0   | `$referenceTime = null, array $formats = []` |

----------

#### Carbon::canBeCreatedFromFormat

Checks if the (date)time string is in a given format and valid to create a
new instance.

##### Examples
```php
Carbon::canBeCreatedFromFormat('11:12:45', 'h:i:s'); // true
Carbon::canBeCreatedFromFormat('13:12:45', 'h:i:s'); // false
```

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `?string $date, string $format` |
| Method added      | 2.39.1  | `$date, $format`                |

----------

#### Carbon::carbonize

Return the Carbon instance passed through, a now instance in the same timezone
if null given or parse the input if string given.

##### Parameters
- $date `\Carbon|\Carbon\CarbonPeriod|\Carbon\CarbonInterval|\DateInterval|\DatePeriod|\DateTimeInterface|string|null` 

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | `$date = null` |

----------

#### Carbon::cast

Cast the current instance into the given class.

##### Parameters
- $className `class-string<\T>` The $className::instance() method will be called to cast the current object.

returns `\T`

| History           | Version | Description         |
|:----------------- | ------- | ------------------- |
| Prototype changed | 2.8.0   | `string $className` |
| Method added      | 1.39.0  | `$className`        |

----------

#### Carbon::ceil

Ceil the current instance second with given precision if specified.

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateInterval\|string\|int\|float $precision = 1` |
| Method added      | 2.0.0   | `$precision = 1`                                  |

----------

#### Carbon::ceilCenturies

Ceil the current instance century with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilCentury

Ceil the current instance century with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilDay

Ceil the current instance day with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilDays

Ceil the current instance day with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilDecade

Ceil the current instance decade with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilDecades

Ceil the current instance decade with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilHour

Ceil the current instance hour with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilHours

Ceil the current instance hour with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMicrosecond

Ceil the current instance microsecond with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMicroseconds

Ceil the current instance microsecond with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMillennia

Ceil the current instance millennium with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMillennium

Ceil the current instance millennium with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMillisecond

Ceil the current instance millisecond with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMilliseconds

Ceil the current instance millisecond with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMinute

Ceil the current instance minute with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMinutes

Ceil the current instance minute with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMonth

Ceil the current instance month with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilMonths

Ceil the current instance month with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilQuarter

Ceil the current instance quarter with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilQuarters

Ceil the current instance quarter with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilSecond

Ceil the current instance second with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilSeconds

Ceil the current instance second with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilUnit

Ceil the current instance at the given unit with given precision if specified.

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $unit, DateInterval\|string\|int\|float $precision = 1` |
| Method added      | 2.0.0   | `$unit, $precision = 1`                                         |

----------

#### Carbon::ceilWeek

Ceil the current instance week.

##### Parameters
- $weekStartsAt `\WeekDay|int|null` optional start allow you to specify the day of week to use to start the week

| History           | Version | Description                                      |
|:----------------- | ------- | ------------------------------------------------ |
| Prototype changed | 3.0.0   | `Carbon\WeekDay\|int\|null $weekStartsAt = null` |
| Method added      | 2.0.0   | `$weekStartsAt = null`                           |

----------

#### Carbon::ceilYear

Ceil the current instance year with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::ceilYears

Ceil the current instance year with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::centuriesInMillennium

Return the number of centuries contained in the current millennium

returns `int`

#### Carbon::centuriesUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each century or every X centuries if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::centuryOfMillennium

Return the value of the century starting from the beginning of the current millennium when called with no parameters, change the current century when called with an integer value

##### Parameters
- `?int $century = null`

returns `int|static`

#### Carbon::change

Similar to native modify() method of DateTime but can handle more grammars.

##### Parameters
- $modifier `string` 

returns `static`

##### Examples
```php
echo Carbon::now()->change('next 2pm');
```

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.20.0  | `$modifier` |

----------

#### Carbon::checkHoliday

Check a holiday definition and unpack it if it's an array.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::checkObservedHoliday

Check if a given holiday ID is observed in the selected zone.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::cleanupDumpProperties

Cleanup properties attached to the public scope of DateTime when a dump of the date is requested.

foreach ($date as $_) }
serializer($date)
var_export($date)
get_object_vars($date)

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.29.0  | *no arguments* |

----------

#### Carbon::clone

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::closedOrNextBusinessOpen

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::closedOrNextOpen

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::closedOrNextOpenExcludingHolidays

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::closedOrPreviousBusinessOpen

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::closedOrPreviousOpen

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::closedOrPreviousOpenExcludingHolidays

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::closest

Get the closest date from the instance (second-precision).

##### Parameters
- $date1 `\Carbon\Carbon|\DateTimeInterface|mixed` 
- $date2 `\Carbon\Carbon|\DateTimeInterface|mixed` 

returns `static`

| History           | Version | Description                              |
|:----------------- | ------- | ---------------------------------------- |
| Prototype changed | 1.24.0  | `$date1, $date2`                         |
| Prototype changed | 1.23.0  | `self $dt1, self $dt2`                   |
| Method added      | 1.21.0  | `Carbon\Carbon $dt1, Carbon\Carbon $dt2` |

----------

#### Carbon::convertOpeningHours

Returns an OpeningHours instance (the one given if already an instance of OpeningHours, or else create
a new one from array definition given).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Spatie\OpeningHours\OpeningHours`

#### Carbon::copy

Get a copy of the instance.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

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

| History           | Version | Description                                                                                          |
|:----------------- | ------- | ---------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `$year = 0, $month = 1, $day = 1, $hour = 0, $minute = 0, $second = 0, $timezone = null`             |
| Prototype changed | 2.0.0   | `$year = 0, $month = 1, $day = 1, $hour = 0, $minute = 0, $second = 0, $tz = null`                   |
| Method added      | 1.0.0   | `$year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null` |

----------

#### Carbon::createFromDate

Create a Carbon instance from just a date. The time portion is set to now.

##### Parameters
- $year `int|null` 
- $month `int|null` 
- $day `int|null` 
- $timezone `\DateTimeZone|string|int|null` 

returns `static`

| History           | Version | Description                                                  |
|:----------------- | ------- | ------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `$year = null, $month = null, $day = null, $timezone = null` |
| Method added      | 1.0.0   | `$year = null, $month = null, $day = null, $tz = null`       |

----------

#### Carbon::createFromFormat

Create a Carbon instance from a specific format.

##### Parameters
- $format `string` Datetime format
- $time `string` 
- $timezone `\DateTimeZone|string|int|null` 

returns `static|null`

| History           | Version | Description                        |
|:----------------- | ------- | ---------------------------------- |
| Prototype changed | 3.0.0   | `$format, $time, $timezone = null` |
| Prototype changed | 1.3.0   | `$format, $time, $tz = null`       |
| Method added      | 1.0.0   | `$format, $time, $object = null`   |

----------

#### Carbon::createFromImmutable

#### Carbon::createFromInterface

#### Carbon::createFromIsoFormat

Create a Carbon instance from a specific ISO format (same replacements as ->isoFormat()).

##### Parameters
- $format `string` Datetime format
- $time `string` 
- $timezone `\DateTimeZone|string|int|null` optional timezone
- $locale `string|null` locale to be used for LTS, LT, LL, LLL, etc. macro-formats (en by fault, unneeded if no such macro-format in use)
- $translator `\TranslatorInterface|null` optional custom translator to use for macro-formats

returns `static|null`

| History           | Version | Description                                                                                                                                     |
|:----------------- | ------- | ----------------------------------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $format, string $time, $timezone = null, ?string $locale = 'en', ?Symfony\Contracts\Translation\TranslatorInterface $translator = null` |
| Method added      | 2.16.0  | `$format, $time, $tz = null, $locale = 'en', $translator = null`                                                                                |

----------

#### Carbon::createFromLocaleFormat

Create a Carbon instance from a specific format and a string in a given language.

##### Parameters
- $format `string` Datetime format
- $locale `string` 
- $time `string` 
- $timezone `\DateTimeZone|string|int|null` 

returns `static|null`

| History           | Version | Description                                                      |
|:----------------- | ------- | ---------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $format, string $locale, string $time, $timezone = null` |
| Method added      | 2.16.0  | `$format, $locale, $time, $tz = null`                            |

----------

#### Carbon::createFromLocaleIsoFormat

Create a Carbon instance from a specific ISO format and a string in a given language.

##### Parameters
- $format `string` Datetime ISO format
- $locale `string` 
- $time `string` 
- $timezone `\DateTimeZone|string|int|null` 

returns `static|null`

| History           | Version | Description                                                      |
|:----------------- | ------- | ---------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $format, string $locale, string $time, $timezone = null` |
| Method added      | 2.16.0  | `$format, $locale, $time, $tz = null`                            |

----------

#### Carbon::createFromTime

Create a Carbon instance from just a time. The date portion is set to today.

##### Parameters
- $hour `int|null` 
- $minute `int|null` 
- $second `int|null` 
- $timezone `\DateTimeZone|string|int|null` 

returns `static`

| History           | Version | Description                                                |
|:----------------- | ------- | ---------------------------------------------------------- |
| Prototype changed | 3.0.0   | `$hour = 0, $minute = 0, $second = 0, $timezone = null`    |
| Prototype changed | 2.0.0   | `$hour = 0, $minute = 0, $second = 0, $tz = null`          |
| Method added      | 1.0.0   | `$hour = null, $minute = null, $second = null, $tz = null` |

----------

#### Carbon::createFromTimeString

Create a Carbon instance from a time string. The date portion is set to today.

| History           | Version | Description                                                      |
|:----------------- | ------- | ---------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $time, DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.25.0  | `$time, $tz = null`                                              |

----------

#### Carbon::createFromTimestamp

Create a Carbon instance from a timestamp and set the timezone (UTC by default).

Timestamp input can be given as int, float or a string containing one or more numbers.

| History           | Version | Description                                                                       |
|:----------------- | ------- | --------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string\|int\|float $timestamp, DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.0.0   | `$timestamp, $tz = null`                                                          |

----------

#### Carbon::createFromTimestampMs

Create a Carbon instance from a timestamp in milliseconds.

Timestamp input can be given as int, float or a string containing one or more numbers.

| History           | Version | Description                                                                       |
|:----------------- | ------- | --------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string\|int\|float $timestamp, DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.23.0  | `$timestamp, $tz = null`                                                          |

----------

#### Carbon::createFromTimestampMsUTC

Create a Carbon instance from a timestamp in milliseconds.

Timestamp input can be given as int, float or a string containing one or more numbers.

##### Parameters
- $timestamp `float|int|string` 

returns `static`

| History      | Version | Description  |
|:------------ | ------- | ------------ |
| Method added | 2.41.0  | `$timestamp` |

----------

#### Carbon::createFromTimestampUTC

Create a Carbon instance from a timestamp keeping the timezone to UTC.

Timestamp input can be given as int, float or a string containing one or more numbers.

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `string\|int\|float $timestamp` |
| Method added      | 1.0.0   | `$timestamp`                    |

----------

#### Carbon::createMidnightDate

Create a Carbon instance from just a date. The time portion is set to midnight.

##### Parameters
- $year `int|null` 
- $month `int|null` 
- $day `int|null` 
- $timezone `\DateTimeZone|string|int|null` 

returns `static`

| History           | Version | Description                                                  |
|:----------------- | ------- | ------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `$year = null, $month = null, $day = null, $timezone = null` |
| Method added      | 1.24.0  | `$year = null, $month = null, $day = null, $tz = null`       |

----------

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

| History           | Version | Description                                                                                                |
|:----------------- | ------- | ---------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `$year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $timezone = null` |
| Method added      | 1.22.0  | `$year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null`       |

----------

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

| History           | Version | Description                                                                                                            |
|:----------------- | ------- | ---------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `?int $year = 0, ?int $month = 1, ?int $day = 1, ?int $hour = 0, ?int $minute = 0, ?int $second = 0, $timezone = null` |
| Method added      | 2.49.0  | `?int $year = 0, ?int $month = 1, ?int $day = 1, ?int $hour = 0, ?int $minute = 0, ?int $second = 0, $tz = null`       |

----------

#### Carbon::currentOrNextBusinessClose

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrNextBusinessDay

Sets the date to the current or next business day (neither a weekend day nor a holiday).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `CarbonInterface|Carbon|CarbonImmutable`

#### Carbon::currentOrNextBusinessOpen

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrNextClose

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrNextCloseIncludingHolidays

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrNextOpen

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrNextOpenExcludingHolidays

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrPreviousBusinessClose

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrPreviousBusinessDay

Sets the date to the current or next business day (neither a weekend day nor a holiday).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `CarbonInterface|Carbon|CarbonImmutable`

#### Carbon::currentOrPreviousBusinessOpen

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrPreviousClose

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrPreviousCloseIncludingHolidays

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrPreviousOpen

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::currentOrPreviousOpenExcludingHolidays

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::day

Set current instance day to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::dayOfCentury

Return the value of the day starting from the beginning of the current century when called with no parameters, change the current day when called with an integer value

##### Parameters
- `?int $day = null`

returns `int|static`

#### Carbon::dayOfDecade

Return the value of the day starting from the beginning of the current decade when called with no parameters, change the current day when called with an integer value

##### Parameters
- `?int $day = null`

returns `int|static`

#### Carbon::dayOfMillennium

Return the value of the day starting from the beginning of the current millennium when called with no parameters, change the current day when called with an integer value

##### Parameters
- `?int $day = null`

returns `int|static`

#### Carbon::dayOfMonth

Return the value of the day starting from the beginning of the current month when called with no parameters, change the current day when called with an integer value

##### Parameters
- `?int $day = null`

returns `int|static`

#### Carbon::dayOfQuarter

Return the value of the day starting from the beginning of the current quarter when called with no parameters, change the current day when called with an integer value

##### Parameters
- `?int $day = null`

returns `int|static`

#### Carbon::dayOfWeek

Return the value of the day starting from the beginning of the current week when called with no parameters, change the current day when called with an integer value

##### Parameters
- `?int $day = null`

returns `int|static`

#### Carbon::dayOfYear

Get/set the day of year.

##### Parameters
- $value `int|null` new value for day of year if using as setter.

returns `static|int`

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `?int $value = null` |
| Method added      | 2.0.0   | `$value = null`      |

----------

#### Carbon::days

Set current instance day to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::daysInCentury

Return the number of days contained in the current century

returns `int`

#### Carbon::daysInDecade

Return the number of days contained in the current decade

returns `int`

#### Carbon::daysInMillennium

Return the number of days contained in the current millennium

returns `int`

#### Carbon::daysInMonth

Return the number of days contained in the current month

returns `int`

#### Carbon::daysInQuarter

Return the number of days contained in the current quarter

returns `int`

#### Carbon::daysInWeek

Return the number of days contained in the current week

returns `int`

#### Carbon::daysInYear

Return the number of days contained in the current year

returns `int`

#### Carbon::daysUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each day or every X days if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::decadeOfCentury

Return the value of the decade starting from the beginning of the current century when called with no parameters, change the current decade when called with an integer value

##### Parameters
- `?int $decade = null`

returns `int|static`

#### Carbon::decadeOfMillennium

Return the value of the decade starting from the beginning of the current millennium when called with no parameters, change the current decade when called with an integer value

##### Parameters
- `?int $decade = null`

returns `int|static`

#### Carbon::decadesInCentury

Return the number of decades contained in the current century

returns `int`

#### Carbon::decadesInMillennium

Return the number of decades contained in the current millennium

returns `int`

#### Carbon::decadesUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each decade or every X decades if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::diff

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `\CarbonInterval`

| History           | Version | Description                                               |
|:----------------- | ------- | --------------------------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false, array $skip = []`  |
| Prototype changed | 2.23.0  | `$date = null, $absolute = false`                         |
| Prototype changed | 1.21.0  | `DateTimeInterface $targetObject, bool $absolute = false` |
| Method added      | 1.0.0   | `$object, $absolute`                                      |

----------

#### Carbon::diffAsBusinessInterval

Return an interval with open/closed business time between the current date and another
given date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `CarbonInterval`

#### Carbon::diffAsCarbonInterval

Get the difference as a CarbonInterval instance.

Return relative interval (negative if $absolute flag is not set to true and the given date is before
current one).

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `\CarbonInterval`

| History           | Version | Description                                                |
|:----------------- | ------- | ---------------------------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false, array $skip = []`   |
| Prototype changed | 2.64.0  | `$date = null, $absolute = true, array $skip = []`         |
| Prototype changed | 2.0.0   | `$date = null, $absolute = true`                           |
| Prototype changed | 1.35.0  | `$date = null, $absolute = true, $trimMicroseconds = true` |
| Method added      | 1.26.0  | `$date = null, $absolute = true`                           |

----------

#### Carbon::diffAsDateInterval

Get the difference as a DateInterval instance.

Return relative interval (negative if $absolute flag is not set to true and the given date is before
current one).

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `\DateInterval`

| History      | Version | Description                            |
|:------------ | ------- | -------------------------------------- |
| Method added | 3.0.0   | `$date = null, bool $absolute = false` |

----------

#### Carbon::diffFiltered

Get the difference by the given interval using a filter closure.

##### Parameters
- $ci `\CarbonInterval` An interval to traverse by
- $callback `\Closure` 
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `int`

| History           | Version | Description                                                                                   |
|:----------------- | ------- | --------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Carbon\CarbonInterval $ci, Closure $callback, $date = null, bool $absolute = false`          |
| Prototype changed | 1.24.0  | `Carbon\CarbonInterval $ci, Closure $callback, $date = null, $absolute = true`                |
| Prototype changed | 1.23.0  | `Carbon\CarbonInterval $ci, Closure $callback, ?self $date = null, $absolute = true`          |
| Prototype changed | 1.21.0  | `Carbon\CarbonInterval $ci, Closure $callback, ?Carbon\Carbon $date = null, $absolute = true` |
| Method added      | 1.18.0  | `Carbon\CarbonInterval $ci, Closure $callback, Carbon\Carbon $date = null, $absolute = true`  |

----------

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

| History           | Version | Description                                                                  |
|:----------------- | ------- | ---------------------------------------------------------------------------- |
| Prototype changed | 2.0.0   | `$other = null, $syntax = null, $short = false, $parts = 1, $options = null` |
| Prototype changed | 1.25.0  | `$other = null, $absolute = false, $short = false, $parts = 1`               |
| Prototype changed | 1.23.0  | `?self $other = null, $absolute = false, $short = false, $parts = 1`         |
| Prototype changed | 1.22.0  | `?Carbon\Carbon $other = null, $absolute = false, $short = false`            |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $other = null, $absolute = false`                            |
| Prototype changed | 1.14.0  | `Carbon\Carbon $other = null, $absolute = false`                             |
| Method added      | 1.0.0   | `Carbon\Carbon $other = null`                                                |

----------

#### Carbon::diffInBusinessDays

Return a number of days with open/closed business time between the current date and another
given date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `int`

#### Carbon::diffInBusinessHours

Return a number of hours with open/closed business time between the current date and another
given date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `float`

#### Carbon::diffInBusinessMinutes

Return a number of minutes with open/closed business time between the current date and another
given date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `float`

#### Carbon::diffInBusinessSeconds

Return a number of seconds with open/closed business time between the current date and another
given date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `float`

#### Carbon::diffInBusinessUnit

Return an interval/count of given unit with open/closed business time between the current date and another
given date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `CarbonInterval|float`

#### Carbon::diffInDays

Get the difference in days.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)

returns `float`

| History           | Version | Description                                               |
|:----------------- | ------- | --------------------------------------------------------- |
| Prototype changed | 3.2.0   | `$date = null, bool $absolute = false, bool $utc = false` |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`                    |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                          |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`                    |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true`           |
| Method added      | 1.0.0   | `Carbon\Carbon $date = null, $absolute = true`            |

----------

#### Carbon::diffInDaysFiltered

Get the difference in days using a filter closure.

##### Parameters
- $callback `\Closure` 
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `int`

| History           | Version | Description                                                        |
|:----------------- | ------- | ------------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `Closure $callback, $date = null, bool $absolute = false`          |
| Prototype changed | 1.24.0  | `Closure $callback, $date = null, $absolute = true`                |
| Prototype changed | 1.23.0  | `Closure $callback, ?self $date = null, $absolute = true`          |
| Prototype changed | 1.21.0  | `Closure $callback, ?Carbon\Carbon $date = null, $absolute = true` |
| Method added      | 1.12.0  | `Closure $callback, Carbon\Carbon $date = null, $absolute = true`  |

----------

#### Carbon::diffInHours

Get the difference in hours.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `float`

| History           | Version | Description                                     |
|:----------------- | ------- | ----------------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`          |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`          |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true` |
| Method added      | 1.0.0   | `Carbon\Carbon $date = null, $absolute = true`  |

----------

#### Carbon::diffInHoursFiltered

Get the difference in hours using a filter closure.

##### Parameters
- $callback `\Closure` 
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `int`

| History           | Version | Description                                                        |
|:----------------- | ------- | ------------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `Closure $callback, $date = null, bool $absolute = false`          |
| Prototype changed | 1.24.0  | `Closure $callback, $date = null, $absolute = true`                |
| Prototype changed | 1.23.0  | `Closure $callback, ?self $date = null, $absolute = true`          |
| Prototype changed | 1.21.0  | `Closure $callback, ?Carbon\Carbon $date = null, $absolute = true` |
| Method added      | 1.18.0  | `Closure $callback, Carbon\Carbon $date = null, $absolute = true`  |

----------

#### Carbon::diffInMicroseconds

Get the difference in microseconds.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `float`

| History           | Version | Description                            |
|:----------------- | ------- | -------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false` |
| Method added      | 1.39.0  | `$date = null, $absolute = true`       |

----------

#### Carbon::diffInMilliseconds

Get the difference in milliseconds.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `float`

| History           | Version | Description                            |
|:----------------- | ------- | -------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false` |
| Method added      | 1.39.0  | `$date = null, $absolute = true`       |

----------

#### Carbon::diffInMinutes

Get the difference in minutes.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `float`

| History           | Version | Description                                     |
|:----------------- | ------- | ----------------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`          |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`          |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true` |
| Method added      | 1.0.0   | `Carbon\Carbon $date = null, $absolute = true`  |

----------

#### Carbon::diffInMonths

Get the difference in months.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)

returns `float`

| History           | Version | Description                                               |
|:----------------- | ------- | --------------------------------------------------------- |
| Prototype changed | 3.2.0   | `$date = null, bool $absolute = false, bool $utc = false` |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`                    |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                          |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`                    |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true`           |
| Method added      | 1.0.0   | `Carbon\Carbon $date = null, $absolute = true`            |

----------

#### Carbon::diffInQuarters

Get the difference in quarters.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)

returns `float`

| History           | Version | Description                                               |
|:----------------- | ------- | --------------------------------------------------------- |
| Prototype changed | 3.2.0   | `$date = null, bool $absolute = false, bool $utc = false` |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`                    |
| Method added      | 2.31.0  | `$date = null, $absolute = true`                          |

----------

#### Carbon::diffInSeconds

Get the difference in seconds.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `float`

| History           | Version | Description                                     |
|:----------------- | ------- | ----------------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`          |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`          |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true` |
| Method added      | 1.0.0   | `Carbon\Carbon $date = null, $absolute = true`  |

----------

#### Carbon::diffInUTCCenturies

Convert current and given date in UTC timezone and return a floating number of centuries.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCDays

Convert current and given date in UTC timezone and return a floating number of days.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCDecades

Convert current and given date in UTC timezone and return a floating number of decades.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCHours

Convert current and given date in UTC timezone and return a floating number of hours.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCMicros

Convert current and given date in UTC timezone and return a floating number of microseconds.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCMicroseconds

Convert current and given date in UTC timezone and return a floating number of microseconds.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCMillennia

Convert current and given date in UTC timezone and return a floating number of millennia.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCMillis

Convert current and given date in UTC timezone and return a floating number of milliseconds.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCMilliseconds

Convert current and given date in UTC timezone and return a floating number of milliseconds.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCMinutes

Convert current and given date in UTC timezone and return a floating number of minutes.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCMonths

Convert current and given date in UTC timezone and return a floating number of months.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCQuarters

Convert current and given date in UTC timezone and return a floating number of quarters.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCSeconds

Convert current and given date in UTC timezone and return a floating number of seconds.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCWeeks

Convert current and given date in UTC timezone and return a floating number of weeks.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

returns `float`

#### Carbon::diffInUTCYears

Convert current and given date in UTC timezone and return a floating number of years.

##### Parameters
- `DateTimeInterface|string|null $date`
- ` bool $absolute = false`

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

| History           | Version | Description                                                                          |
|:----------------- | ------- | ------------------------------------------------------------------------------------ |
| Prototype changed | 3.2.0   | `Carbon\Unit\|string $unit, $date = null, bool $absolute = false, bool $utc = false` |
| Prototype changed | 3.1.0   | `Carbon\Unit\|string $unit, $date = null, bool $absolute = false`                    |
| Method added      | 3.0.0   | `string $unit, $date = null, bool $absolute = false`                                 |

----------

#### Carbon::diffInWeekdays

Get the difference in weekdays.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `int`

| History           | Version | Description                                     |
|:----------------- | ------- | ----------------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`          |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`          |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true` |
| Method added      | 1.12.0  | `Carbon\Carbon $date = null, $absolute = true`  |

----------

#### Carbon::diffInWeekendDays

Get the difference in weekend days using a filter.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference

returns `int`

| History           | Version | Description                                     |
|:----------------- | ------- | ----------------------------------------------- |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`          |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`          |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true` |
| Method added      | 1.12.0  | `Carbon\Carbon $date = null, $absolute = true`  |

----------

#### Carbon::diffInWeeks

Get the difference in weeks.

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)

returns `float`

| History           | Version | Description                                               |
|:----------------- | ------- | --------------------------------------------------------- |
| Prototype changed | 3.2.0   | `$date = null, bool $absolute = false, bool $utc = false` |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`                    |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                          |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`                    |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true`           |
| Method added      | 1.11.0  | `Carbon\Carbon $date = null, $absolute = true`            |

----------

#### Carbon::diffInYears

Get the difference in years

##### Parameters
- $date `\Carbon\CarbonInterface|\DateTimeInterface|string|null` 
- $absolute `bool` Get the absolute of the difference
- $utc `bool` Always convert dates to UTC before comparing (if not set, it will do it only if timezones are different)

returns `float`

| History           | Version | Description                                               |
|:----------------- | ------- | --------------------------------------------------------- |
| Prototype changed | 3.2.0   | `$date = null, bool $absolute = false, bool $utc = false` |
| Prototype changed | 3.0.0   | `$date = null, bool $absolute = false`                    |
| Prototype changed | 1.24.0  | `$date = null, $absolute = true`                          |
| Prototype changed | 1.23.0  | `?self $date = null, $absolute = true`                    |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null, $absolute = true`           |
| Method added      | 1.0.0   | `Carbon\Carbon $date = null, $absolute = true`            |

----------

#### Carbon::disableHumanDiffOption

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description            |
|:----------------- | ------- | ---------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOption` |
| Method added      | 1.26.0  | `$humanDiffOption`     |

----------

#### Carbon::enable

#### Carbon::enableHumanDiffOption

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description            |
|:----------------- | ------- | ---------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOption` |
| Method added      | 1.26.0  | `$humanDiffOption`     |

----------

#### Carbon::endOf

Modify to end of current given unit.

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->startOf(Unit::Month)
  ->endOf(Unit::Week, Carbon::FRIDAY);
```

| History           | Version | Description                                |
|:----------------- | ------- | ------------------------------------------ |
| Prototype changed | 3.8.0   | `Carbon\Unit\|string $unit, mixed $params` |
| Prototype changed | 3.0.0   | `string $unit, mixed $params`              |
| Method added      | 2.0.0   | `$unit, $params`                           |

----------

#### Carbon::endOfCentury

Resets the date to end of the century and time to 23:59:59.999999

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfCentury();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.7.0   | *no arguments* |

----------

#### Carbon::endOfDay

Resets the time to 23:59:59.999999 end of day

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfDay();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::endOfDecade

Resets the date to end of the decade and time to 23:59:59.999999

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfDecade();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.7.0   | *no arguments* |

----------

#### Carbon::endOfHour

Modify to end of current hour, minutes and seconds become 59

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfHour();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::endOfMillennium

Resets the date to end of the millennium and time to 23:59:59.999999

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfMillennium();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::endOfMillisecond

Modify to end of current millisecond, microseconds such as 12345 become 123999

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->endOfSecond()
  ->format('H:i:s.u');
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.8.0   | *no arguments* |

----------

#### Carbon::endOfMinute

Modify to end of current minute, seconds become 59

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfMinute();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::endOfMonth

Resets the date to end of the month and time to 23:59:59.999999

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfMonth();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::endOfQuarter

Resets the date to end of the quarter and time to 23:59:59.999999

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfQuarter();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::endOfSeason

#### Carbon::endOfSecond

Modify to end of current second, microseconds become 999999

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->endOfSecond()
  ->format('H:i:s.u');
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.33.0  | *no arguments* |

----------

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

| History           | Version | Description                                    |
|:----------------- | ------- | ---------------------------------------------- |
| Prototype changed | 3.0.0   | `Carbon\WeekDay\|int\|null $weekEndsAt = null` |
| Prototype changed | 2.0.0   | `$weekEndsAt = null`                           |
| Method added      | 1.3.0   | *no arguments*                                 |

----------

#### Carbon::endOfYear

Resets the date to end of the year and time to 23:59:59.999999

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->endOfYear();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.7.0   | *no arguments* |

----------

#### Carbon::eq

Determines if the instance is equal to another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->eq('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->eq(Carbon::parse('2018-07-25 12:45:16')); // true
Carbon::parse('2018-07-25 12:45:16')->eq('2018-07-25 12:45:17'); // false
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.0.0   | `Carbon\Carbon $date`             |

----------

#### Carbon::equalTo

Determines if the instance is equal to another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->equalTo('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->equalTo(Carbon::parse('2018-07-25 12:45:16')); // true
Carbon::parse('2018-07-25 12:45:16')->equalTo('2018-07-25 12:45:17'); // false
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.22.0  | `Carbon\Carbon $date`             |

----------

#### Carbon::executeWithLocale

Set the current locale to the given, execute the passed function, reset the locale to previous one,
then return the result of the closure (or null if the closure was void).

##### Parameters
- $locale `string` locale ex. en
- $func `callable` 

returns `mixed`

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.0   | `string $locale, callable $func` |
| Method added      | 1.31.0  | `$locale, $func`                 |

----------

#### Carbon::farthest

Get the farthest date from the instance (second-precision).

##### Parameters
- $date1 `\Carbon\Carbon|\DateTimeInterface|mixed` 
- $date2 `\Carbon\Carbon|\DateTimeInterface|mixed` 

returns `static`

| History           | Version | Description                              |
|:----------------- | ------- | ---------------------------------------- |
| Prototype changed | 1.24.0  | `$date1, $date2`                         |
| Prototype changed | 1.23.0  | `self $dt1, self $dt2`                   |
| Method added      | 1.21.0  | `Carbon\Carbon $dt1, Carbon\Carbon $dt2` |

----------

#### Carbon::firstOfMonth

Modify to the first occurrence of a given day of the week
in the current month. If no dayOfWeek is provided, modify to the
first day of the current month.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $dayOfWeek `int|null` 

returns `static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 1.3.0   | `$dayOfWeek = null` |

----------

#### Carbon::firstOfQuarter

Modify to the first occurrence of a given day of the week
in the current quarter. If no dayOfWeek is provided, modify to the
first day of the current quarter.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $dayOfWeek `int|null` day of the week default null

returns `static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 1.3.0   | `$dayOfWeek = null` |

----------

#### Carbon::firstOfYear

Modify to the first occurrence of a given day of the week
in the current year. If no dayOfWeek is provided, modify to the
first day of the current year.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $dayOfWeek `int|null` day of the week default null

returns `static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 1.3.0   | `$dayOfWeek = null` |

----------

#### Carbon::floor

Round the current instance second with given precision if specified.

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateInterval\|string\|int\|float $precision = 1` |
| Method added      | 2.0.0   | `$precision = 1`                                  |

----------

#### Carbon::floorCenturies

Truncate the current instance century with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorCentury

Truncate the current instance century with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorDay

Truncate the current instance day with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorDays

Truncate the current instance day with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorDecade

Truncate the current instance decade with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorDecades

Truncate the current instance decade with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorHour

Truncate the current instance hour with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorHours

Truncate the current instance hour with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMicrosecond

Truncate the current instance microsecond with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMicroseconds

Truncate the current instance microsecond with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMillennia

Truncate the current instance millennium with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMillennium

Truncate the current instance millennium with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMillisecond

Truncate the current instance millisecond with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMilliseconds

Truncate the current instance millisecond with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMinute

Truncate the current instance minute with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMinutes

Truncate the current instance minute with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMonth

Truncate the current instance month with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorMonths

Truncate the current instance month with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorQuarter

Truncate the current instance quarter with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorQuarters

Truncate the current instance quarter with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorSecond

Truncate the current instance second with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorSeconds

Truncate the current instance second with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorUnit

Truncate the current instance at the given unit with given precision if specified.

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $unit, DateInterval\|string\|int\|float $precision = 1` |
| Method added      | 2.0.0   | `$unit, $precision = 1`                                         |

----------

#### Carbon::floorWeek

Truncate the current instance week.

##### Parameters
- $weekStartsAt `\WeekDay|int|null` optional start allow you to specify the day of week to use to start the week

| History           | Version | Description                                      |
|:----------------- | ------- | ------------------------------------------------ |
| Prototype changed | 3.0.0   | `Carbon\WeekDay\|int\|null $weekStartsAt = null` |
| Method added      | 2.0.0   | `$weekStartsAt = null`                           |

----------

#### Carbon::floorYear

Truncate the current instance year with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::floorYears

Truncate the current instance year with given precision.

##### Parameters
- `float $precision = 1`

returns `$this`

#### Carbon::format

Returns the formatted date string on success or FALSE on failure.

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $format` |
| Prototype changed | 2.16.0  | `$format`        |
| Prototype changed | 1.21.0  | `string $format` |
| Method added      | 1.0.0   | `$format`        |

----------

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

| History           | Version | Description                                                                  |
|:----------------- | ------- | ---------------------------------------------------------------------------- |
| Prototype changed | 2.0.0   | `$other = null, $syntax = null, $short = false, $parts = 1, $options = null` |
| Method added      | 1.39.0  | `$other = null, $absolute = false, $short = false, $parts = 1`               |

----------

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

| History           | Version | Description                                                   |
|:----------------- | ------- | ------------------------------------------------------------- |
| Prototype changed | 2.0.0   | `$syntax = null, $short = false, $parts = 1, $options = null` |
| Method added      | 1.39.0  | `$absolute = null, $short = false, $parts = 1`                |

----------

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
```php

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 3.10.0  | `$value, array $options = []` |
| Method added      | 1.22.0  | `$value`                      |

----------

#### Carbon::genericMacro

Register a custom macro.

##### Parameters
- $macro `callable` 
- $priority `int` marco with higher priority is tried first

returns `void`

| History           | Version | Description                                  |
|:----------------- | ------- | -------------------------------------------- |
| Prototype changed | 3.0.1   | `callable $macro, int $priority = 0`         |
| Prototype changed | 3.0.0   | `callable\|object $macro, int $priority = 0` |
| Method added      | 2.1.0   | `$macro, $priority = 0`                      |

----------

#### Carbon::get

Get a part of the Carbon object.

returns `string|int|bool|\DateTimeZone`

| History           | Version | Description                 |
|:----------------- | ------- | --------------------------- |
| Prototype changed | 3.1.0   | `Carbon\Unit\|string $name` |
| Prototype changed | 3.0.0   | `string $name`              |
| Method added      | 2.0.0   | `$name`                     |

----------

#### Carbon::getAltNumber

Returns the alternative number for a given date property if available in the current locale.

##### Parameters
- $key `string` date property

| History      | Version | Description   |
|:------------ | ------- | ------------- |
| Method added | 2.14.0  | `string $key` |

----------

#### Carbon::getAvailableLocales

Returns the list of internally available locales and already loaded custom locales.

(It will ignore custom translator dynamic loading.)

returns `array`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.31.0  | *no arguments* |

----------

#### Carbon::getAvailableLocalesInfo

Returns list of Language object for each available locale. This object allow you to get the ISO name, native
name, region and variant of the locale.

returns `\Language[]`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Carbon::getBDDaysList

Get the holidays for the current region selected.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getBusinessDaysInMonth

Get the number of business days in the current month.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `int`

#### Carbon::getCalendarFormats

Returns list of calendar formats for ISO formatting.

##### Parameters
- $locale `string|null` current locale used if null

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 3.0.0   | `?string $locale = null` |
| Method added      | 2.0.0   | `$locale = null`         |

----------

#### Carbon::getCalleeAsMethod

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::getClock

#### Carbon::getCurrentBusinessOpenTimeRangeEnd

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::getCurrentBusinessTimeRangeStart

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::getCurrentDayOpeningHours

Get OpeningHoursForDay instance of the current instance or class.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Spatie\OpeningHours\OpeningHoursForDay`

#### Carbon::getCurrentOpenTimePeriod

Get current open time range as TimeRange instance or false if closed.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `CarbonPeriod|bool`

#### Carbon::getCurrentOpenTimeRange

Get current open time range as TimeRange instance or false if closed.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Spatie\OpeningHours\TimeRange|bool`

#### Carbon::getCurrentOpenTimeRangeEnd

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::getCurrentOpenTimeRangeStart

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::getCurrentOpenTimeRanges

Get open time ranges as array of TimeRange instances that matches the current date and time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Spatie\OpeningHours\TimeRange[]`

#### Carbon::getDBDayId

Get the identifier of the current holiday or false if it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `string|false`

#### Carbon::getDays

Get the days of the week.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.23.0  | *no arguments* |

----------

#### Carbon::getDaysFromStartOfWeek

Return the number of days since the start of the week (using the current locale or the first parameter
if explicitly given).

##### Parameters
- $weekStartsAt `\WeekDay|int|null`
  optional start allow you to specify the day of week to use to start the week,
  if not provided, start of week is inferred from the locale
  (Sunday for en_US, Monday for de_DE, etc.)

| History           | Version | Description                                      |
|:----------------- | ------- | ------------------------------------------------ |
| Prototype changed | 3.0.0   | `Carbon\WeekDay\|int\|null $weekStartsAt = null` |
| Method added      | 2.64.0  | `?int $weekStartsAt = null`                      |

----------

#### Carbon::getExtraWorkdayId

Get the identifier of the current special workday or false if it's not a special workday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `string|false`

#### Carbon::getExtraWorkdays

Get the holidays for the current region selected.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getFallbackLocale

Get the fallback locale.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.16.0  | *no arguments* |

----------

#### Carbon::getFormatsToIsoReplacements

List of replacements from date() format to isoFormat().

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.16.0  | *no arguments* |

----------

#### Carbon::getHolidayData

Get stored data set for the current holiday or null if it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getHolidayDataById

Get stored data set for the a given holiday ID.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getHolidayId

Get the identifier of the current holiday or false if it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `string|false`

#### Carbon::getHolidayName

Get the name of the current holiday (using the locale given in parameter or the current date locale)
or false if it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `string|false`

#### Carbon::getHolidayNamesDictionary

Get the holidays in the given language.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getHolidays

Get the holidays for the current region selected.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getHolidaysAvailableRegions

Get the current holidays region.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getHolidaysRegion

Get the current holidays region.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `null|string`

#### Carbon::getHumanDiffOptions

Return default humanDiff() options (merged flags as integer).

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.26.0  | *no arguments* |

----------

#### Carbon::getIsoFormats

Returns list of locale formats for ISO formatting.

##### Parameters
- $locale `string|null` current locale used if null

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 3.0.0   | `?string $locale = null` |
| Method added      | 2.0.0   | `$locale = null`         |

----------

#### Carbon::getIsoUnits

Returns list of locale units for ISO formatting.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::getLastErrors

{@inheritdoc}

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::getLocalMacro

Get the raw callable macro registered globally or locally for a given name.

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $name` |
| Method added      | 2.29.0  | `$name`        |

----------

#### Carbon::getLocalTranslator

Get the translator of the current instance or the default if none set.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::getLocale

Get the current translator locale.

returns `string`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.18.0  | *no arguments* |

----------

#### Carbon::getMacro

Get the raw callable macro registered globally for a given name.

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $name` |
| Method added      | 2.29.0  | `$name`        |

----------

#### Carbon::getMaxIteration

Get the maximum of loop turns to run before throwing an exception where trying to add
or subtract open/closed time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `int`

#### Carbon::getMethodLoopOnHoliday

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::getMicrosecond

#### Carbon::getMidDayAt

get midday/noon hour

returns `int`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::getMonthBusinessDays

Get list of date objects for each business day in the current month.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getObserveHolidayMethod

Set a holiday as observed/unobserved in the selected zone (can take array of holidays).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::getObservedHolidaysZone

Get the selected zone for observed holidays.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `string|null`

#### Carbon::getOffset

#### Carbon::getOffsetString

Returns the offset hour and minute formatted with +/- and a given separator (":" by default).

For example, if the time zone is 9 hours 30 minutes, you'll get "+09:30", with "@@" as first
argument, "+09@@30", with "" as first argument, "+0930". Negative offset will return something
like "-12:00".

##### Parameters
- $separator `string` string to place between hours and minutes (":" by default)

| History           | Version | Description               |
|:----------------- | ------- | ------------------------- |
| Prototype changed | 3.0.0   | `string $separator = ':'` |
| Method added      | 2.0.0   | `$separator = ':'`        |

----------

#### Carbon::getOpeningHours

Get the opening hours of the class/instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Spatie\OpeningHours\OpeningHours`

#### Carbon::getPaddedUnit

Returns a unit of the instance padded with 0 by default or any other string if specified.

##### Parameters
- $unit `string` Carbon unit name
- $length `int` Length of the output (2 by default)
- $padString `string` String to use for padding ("0" by default)
- $padType `int` Side(s) to pad (STR_PAD_LEFT by default)

| History      | Version | Description                                          |
|:------------ | ------- | ---------------------------------------------------- |
| Method added | 2.0.0   | `$unit, $length = 2, $padString = '0', $padType = 0` |

----------

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

| History      | Version | Description      |
|:------------ | ------- | ---------------- |
| Method added | 2.0.0   | `$precision = 6` |

----------

#### Carbon::getSeason

Return the season of the current date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/season">cmixin/season</a>

returns `Season\SeasonEnum`

#### Carbon::getSettings

Returns current local settings.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.3.0   | *no arguments* |

----------

#### Carbon::getTernaryMethod

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::getTestNow

Get the Carbon instance (real or mock) to be returned when a "now"
instance is created.

returns `\Closure|\CarbonInterface|null the current instance used for testing`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.3.0   | *no arguments* |

----------

#### Carbon::getTimeFormatByPrecision

Return a format from H:i to H:i:s.u according to given unit precision.

##### Parameters
- $unitPrecision `string` "minute", "second", "millisecond" or "microsecond"

| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `string $unitPrecision` |
| Method added      | 2.26.0  | `$unitPrecision`        |

----------

#### Carbon::getTimestamp

#### Carbon::getTimestampMs

Returns the timestamp with millisecond precision.

returns `int`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.51.0  | *no arguments* |

----------

#### Carbon::getTimezone

Get the TimeZone associated with the Carbon instance (as CarbonTimeZone).

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::getTranslatedDayName

Get the translation of the current week day name (with context for languages with multiple forms).

##### Parameters
- $context `string|null` whole format string
- $keySuffix `string` "", "_short" or "_min"
- $defaultValue `string|null` default value if translation missing

| History           | Version | Description                                                                     |
|:----------------- | ------- | ------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `?string $context = null, string $keySuffix = '', ?string $defaultValue = null` |
| Method added      | 2.4.0   | `$context = null, $keySuffix = '', $defaultValue = null`                        |

----------

#### Carbon::getTranslatedMinDayName

Get the translation of the current abbreviated week day name (with context for languages with multiple forms).

##### Parameters
- $context `string|null` whole format string

| History           | Version | Description               |
|:----------------- | ------- | ------------------------- |
| Prototype changed | 3.0.0   | `?string $context = null` |
| Method added      | 2.4.0   | `$context = null`         |

----------

#### Carbon::getTranslatedMonthName

Get the translation of the current month day name (with context for languages with multiple forms).

##### Parameters
- $context `string|null` whole format string
- $keySuffix `string` "" or "_short"
- $defaultValue `string|null` default value if translation missing

| History           | Version | Description                                                                     |
|:----------------- | ------- | ------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `?string $context = null, string $keySuffix = '', ?string $defaultValue = null` |
| Method added      | 2.4.0   | `$context = null, $keySuffix = '', $defaultValue = null`                        |

----------

#### Carbon::getTranslatedShortDayName

Get the translation of the current short week day name (with context for languages with multiple forms).

##### Parameters
- $context `string|null` whole format string

| History           | Version | Description               |
|:----------------- | ------- | ------------------------- |
| Prototype changed | 3.0.0   | `?string $context = null` |
| Method added      | 2.4.0   | `$context = null`         |

----------

#### Carbon::getTranslatedShortMonthName

Get the translation of the current short month day name (with context for languages with multiple forms).

##### Parameters
- $context `string|null` whole format string

| History           | Version | Description               |
|:----------------- | ------- | ------------------------- |
| Prototype changed | 3.0.0   | `?string $context = null` |
| Method added      | 2.4.0   | `$context = null`         |

----------

#### Carbon::getTranslationMessage

Returns raw translation message for a given key.

##### Parameters
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
- $translator `\TranslatorInterface` an optional translator to use

returns `string`

| History           | Version | Description                                                                        |
|:----------------- | ------- | ---------------------------------------------------------------------------------- |
| Prototype changed | 2.8.0   | `string $key, ?string $locale = null, ?string $default = null, $translator = null` |
| Method added      | 2.0.0   | `string $key, ?string $locale = null, ?string $default = null`                     |

----------

#### Carbon::getTranslationMessageWith

Returns raw translation message for a given key.

##### Parameters
- $translator `\TranslatorInterface|null` the translator to use
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key

returns `string|\Closure|null`

| History      | Version | Description                                                                 |
|:------------ | ------- | --------------------------------------------------------------------------- |
| Method added | 2.8.0   | `$translator, string $key, ?string $locale = null, ?string $default = null` |

----------

#### Carbon::getTranslator

Initialize the default translator instance if necessary.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.18.0  | *no arguments* |

----------

#### Carbon::getWeekEndsAt

Get the last day of week.

##### Parameters
- $locale `string` local to consider the last day of week.

returns `int`

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 3.0.0   | `?string $locale = null` |
| Method added      | 1.20.0  | *no arguments*           |

----------

#### Carbon::getWeekStartsAt

Get the first day of week.

returns `int`

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 3.0.0   | `?string $locale = null` |
| Method added      | 1.20.0  | *no arguments*           |

----------

#### Carbon::getWeekendDays

Get weekend days

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.20.0  | *no arguments* |

----------

#### Carbon::getYearHolidays

Get the holidays dates for a given year (current year if no parameter given).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::getYearHolidaysNextFunction

Get a next() callback to call to iterate over holidays of a year.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `callable`

#### Carbon::greaterThan

Determines if the instance is greater (after) than another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:17'); // false
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.22.0  | `Carbon\Carbon $date`             |

----------

#### Carbon::greaterThanOrEqualTo

Determines if the instance is greater (after) than or equal to another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:17'); // false
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.22.0  | `Carbon\Carbon $date`             |

----------

#### Carbon::gt

Determines if the instance is greater (after) than another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:17'); // false
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.0.0   | `Carbon\Carbon $date`             |

----------

#### Carbon::gte

Determines if the instance is greater (after) than or equal to another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:17'); // false
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.0.0   | `Carbon\Carbon $date`             |

----------

#### Carbon::hasFormat

Checks if the (date)time string is in a given format.

##### Examples
```php
Carbon::hasFormat('11:12:45', 'h:i:s'); // true
Carbon::hasFormat('13:12:45', 'h:i:s'); // false
```

| History           | Version | Description                    |
|:----------------- | ------- | ------------------------------ |
| Prototype changed | 3.0.0   | `string $date, string $format` |
| Method added      | 1.24.0  | `$date, $format`               |

----------

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

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `?string $date, string $format` |
| Prototype changed | 2.41.2  | `$date, $format`                |
| Method added      | 2.41.0  | `string $date, string $format`  |

----------

#### Carbon::hasLocalMacro

Checks if macro is registered globally or locally.

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $name` |
| Method added      | 2.29.0  | `$name`        |

----------

#### Carbon::hasLocalTranslator

Return true if the current instance has its own translator.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.29.0  | *no arguments* |

----------

#### Carbon::hasMacro

Checks if macro is registered globally.

##### Parameters
- $name `string` 

returns `bool`

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $name` |
| Method added      | 1.26.0  | `$name`        |

----------

#### Carbon::hasRelativeKeywords

Determine if a time string will produce a relative date.

returns `bool true if time match a relative date, false if absolute or invalid time string`

| History           | Version | Description     |
|:----------------- | ------- | --------------- |
| Prototype changed | 3.0.0   | `?string $time` |
| Method added      | 1.4.0   | `$time`         |

----------

#### Carbon::hasTestNow

Determine if there is a valid test instance set. A valid test instance
is anything that is not null.

returns `bool true if there is a test instance, otherwise false`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.3.0   | *no arguments* |

----------

#### Carbon::hour

Set current instance hour to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::hourOfCentury

Return the value of the hour starting from the beginning of the current century when called with no parameters, change the current hour when called with an integer value

##### Parameters
- `?int $hour = null`

returns `int|static`

#### Carbon::hourOfDay

Return the value of the hour starting from the beginning of the current day when called with no parameters, change the current hour when called with an integer value

##### Parameters
- `?int $hour = null`

returns `int|static`

#### Carbon::hourOfDecade

Return the value of the hour starting from the beginning of the current decade when called with no parameters, change the current hour when called with an integer value

##### Parameters
- `?int $hour = null`

returns `int|static`

#### Carbon::hourOfMillennium

Return the value of the hour starting from the beginning of the current millennium when called with no parameters, change the current hour when called with an integer value

##### Parameters
- `?int $hour = null`

returns `int|static`

#### Carbon::hourOfMonth

Return the value of the hour starting from the beginning of the current month when called with no parameters, change the current hour when called with an integer value

##### Parameters
- `?int $hour = null`

returns `int|static`

#### Carbon::hourOfQuarter

Return the value of the hour starting from the beginning of the current quarter when called with no parameters, change the current hour when called with an integer value

##### Parameters
- `?int $hour = null`

returns `int|static`

#### Carbon::hourOfWeek

Return the value of the hour starting from the beginning of the current week when called with no parameters, change the current hour when called with an integer value

##### Parameters
- `?int $hour = null`

returns `int|static`

#### Carbon::hourOfYear

Return the value of the hour starting from the beginning of the current year when called with no parameters, change the current hour when called with an integer value

##### Parameters
- `?int $hour = null`

returns `int|static`

#### Carbon::hours

Set current instance hour to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::hoursInCentury

Return the number of hours contained in the current century

returns `int`

#### Carbon::hoursInDay

Return the number of hours contained in the current day

returns `int`

#### Carbon::hoursInDecade

Return the number of hours contained in the current decade

returns `int`

#### Carbon::hoursInMillennium

Return the number of hours contained in the current millennium

returns `int`

#### Carbon::hoursInMonth

Return the number of hours contained in the current month

returns `int`

#### Carbon::hoursInQuarter

Return the number of hours contained in the current quarter

returns `int`

#### Carbon::hoursInWeek

Return the number of hours contained in the current week

returns `int`

#### Carbon::hoursInYear

Return the number of hours contained in the current year

returns `int`

#### Carbon::hoursUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each hour or every X hours if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::initializeHolidaysRegion

#### Carbon::instance

Create a Carbon instance from a DateTime one.

| History           | Version | Description               |
|:----------------- | ------- | ------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface $date` |
| Prototype changed | 1.26.0  | `$date`                   |
| Method added      | 1.0.0   | `DateTime $date`          |

----------

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

| History           | Version | Description                                    |
|:----------------- | ------- | ---------------------------------------------- |
| Prototype changed | 3.6.0   | `Carbon\WeekDay\|Carbon\Month\|string $tester` |
| Method added      | 2.20.0  | `string $tester`                               |

----------

#### Carbon::isAfter

Determines if the instance is greater (after) than another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:15'); // true
Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:17'); // false
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Method added      | 1.39.0  | `$date`                           |

----------

#### Carbon::isBefore

Determines if the instance is less (before) than another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:17'); // true
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Method added      | 1.39.0  | `$date`                           |

----------

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

| History           | Version | Description                                                                              |
|:----------------- | ------- | ---------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date1, DateTimeInterface\|string $date2, bool $equal = true` |
| Method added      | 1.39.0  | `$date1, $date2, $equal = true`                                                          |

----------

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

| History           | Version | Description                                    |
|:----------------- | ------- | ---------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string\|null $date = null` |
| Prototype changed | 1.23.0  | `$date = null`                                 |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null`                  |
| Method added      | 1.14.0  | `Carbon\Carbon $date`                          |

----------

#### Carbon::isBusinessClosed

Returns true if the business is closed or a holiday now (or current date and time) according to current
opening hours.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isBusinessDay

Checks the date to see if it is a business day (extra workday or neither a weekend day nor a holiday).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isBusinessOpen

Returns true if the business is open and not a holiday now (or current date and time) according to current
opening hours.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isClosed

Returns true if the business is open now (or current date and time) according to current opening hours.
/!\ Important: it returns true if the current day is a holiday unless you set a closure handler for it in
the exceptions setting.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isClosedIncludingHolidays

Returns true if the business is closed or a holiday now (or current date and time) according to current
opening hours.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isClosedOn

Returns true if the business is open on a given day according to current opening hours.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isCurrentCentury

Checks if the instance is in the same century as the current moment.

returns `bool`

#### Carbon::isCurrentDay

Checks if the instance is in the same day as the current moment.

returns `bool`

#### Carbon::isCurrentDecade

Checks if the instance is in the same decade as the current moment.

returns `bool`

#### Carbon::isCurrentHour

Checks if the instance is in the same hour as the current moment.

returns `bool`

#### Carbon::isCurrentMicro

Checks if the instance is in the same microsecond as the current moment.

returns `bool`

#### Carbon::isCurrentMicrosecond

Checks if the instance is in the same microsecond as the current moment.

returns `bool`

#### Carbon::isCurrentMillennium

Checks if the instance is in the same millennium as the current moment.

returns `bool`

#### Carbon::isCurrentMilli

Checks if the instance is in the same millisecond as the current moment.

returns `bool`

#### Carbon::isCurrentMillisecond

Checks if the instance is in the same millisecond as the current moment.

returns `bool`

#### Carbon::isCurrentMinute

Checks if the instance is in the same minute as the current moment.

returns `bool`

#### Carbon::isCurrentMonth

Checks if the instance is in the same month as the current moment.

returns `bool`

#### Carbon::isCurrentQuarter

Checks if the instance is in the same quarter as the current moment.

returns `bool`

#### Carbon::isCurrentSecond

Checks if the instance is in the same second as the current moment.

returns `bool`

#### Carbon::isCurrentUnit

Determines if the instance is in the current unit given.

##### Parameters
- $unit `string` The unit to test.

##### Examples
```php
Carbon::now()->isCurrentUnit('hour'); // true
Carbon::now()->subHours(2)->isCurrentUnit('hour'); // false
```

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $unit` |
| Method added      | 2.0.0   | `$unit`        |

----------

#### Carbon::isCurrentWeek

Checks if the instance is in the same week as the current moment.

returns `bool`

#### Carbon::isCurrentYear

Checks if the instance is in the same year as the current moment.

returns `bool`

#### Carbon::isDST

Check if the current instance is in a daylight saving time.

returns `bool`

#### Carbon::isDateTimeInstance

Return true if the given value is a DateTime or DateTimeInterface.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

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

| History      | Version | Description  |
|:------------ | ------- | ------------ |
| Method added | 1.24.0  | `$dayOfWeek` |

----------

#### Carbon::isEndOfCentury

Determines if the instance is end of century (last day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

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

| History           | Version | Description                                                                                                                                                                                                        |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Prototype changed | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|bool $checkMicroseconds = false, Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |
| Prototype changed | 3.0.0   | `bool $checkMicroseconds = false`                                                                                                                                                                                  |
| Method added      | 1.28.0  | `$checkMicroseconds = false`                                                                                                                                                                                       |

----------

#### Carbon::isEndOfDecade

Determines if the instance is end of decade (last day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isEndOfHour

Determines if the instance is end of hour (last microsecond by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isEndOfMillennium

Determines if the instance is end of millennium (last day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isEndOfMillisecond

Determines if the instance is end of millisecond (last microsecond by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isEndOfMinute

Determines if the instance is end of minute (last microsecond by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isEndOfMonth

Determines if the instance is end of month (last day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isEndOfQuarter

Determines if the instance is end of quarter (last day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isEndOfSecond

Determines if the instance is end of second (last microsecond by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isEndOfTime

Returns true if the date was created using CarbonImmutable::endOfTime()

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.48.0  | *no arguments* |

----------

#### Carbon::isEndOfUnit

Check if the instance is end of a given unit (tolerating a given interval).

##### Examples
```php
// Check if a date-time is the last 15 minutes of the hour it's in
Carbon::parse('2019-02-28 20:13:00')->isEndOfUnit(Unit::Hour, '15 minutes'); // false
```

| History      | Version | Description                                                                                                                            |
|:------------ | ------- | -------------------------------------------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit $unit, Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null, mixed $params` |

----------

#### Carbon::isEndOfWeek

Determines if the instance is end of week (last day by default but interval can be customized).

##### Examples
```php
Carbon::parse('2024-08-31')->endOfWeek()->isEndOfWeek(); // true
Carbon::parse('2024-08-31')->isEndOfWeek(); // false
```

| History      | Version | Description                                                                                                                                        |
|:------------ | ------- | -------------------------------------------------------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null, Carbon\WeekDay\|int\|null $weekEndsAt = null` |

----------

#### Carbon::isEndOfYear

Determines if the instance is end of year (last day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isExtraWorkday

Checks the date to see if it is a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isFriday

Checks if the instance day is friday.

returns `bool`

#### Carbon::isFuture

Determines if the instance is in the future, ie. greater (after) than now.

##### Examples
```php
Carbon::now()->addHours(5)->isFuture(); // true
Carbon::now()->subHours(5)->isFuture(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::isHoliday

Checks the date to see if it is a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isImmutable

Returns true if the current class/instance is immutable.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::isInFall

Return either current date is in fall.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/season">cmixin/season</a>

returns `bool`

#### Carbon::isInSpring

Return either current date is in spring.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/season">cmixin/season</a>

returns `bool`

#### Carbon::isInSummer

Return either current date is in summer.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/season">cmixin/season</a>

returns `bool`

#### Carbon::isInWinter

Return either current date is in winter.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/season">cmixin/season</a>

returns `bool`

#### Carbon::isLastCentury

Checks if the instance is in the same century as the current moment last century.

returns `bool`

#### Carbon::isLastDay

Checks if the instance is in the same day as the current moment last day.

returns `bool`

#### Carbon::isLastDecade

Checks if the instance is in the same decade as the current moment last decade.

returns `bool`

#### Carbon::isLastHour

Checks if the instance is in the same hour as the current moment last hour.

returns `bool`

#### Carbon::isLastMicro

Checks if the instance is in the same microsecond as the current moment last microsecond.

returns `bool`

#### Carbon::isLastMicrosecond

Checks if the instance is in the same microsecond as the current moment last microsecond.

returns `bool`

#### Carbon::isLastMillennium

Checks if the instance is in the same millennium as the current moment last millennium.

returns `bool`

#### Carbon::isLastMilli

Checks if the instance is in the same millisecond as the current moment last millisecond.

returns `bool`

#### Carbon::isLastMillisecond

Checks if the instance is in the same millisecond as the current moment last millisecond.

returns `bool`

#### Carbon::isLastMinute

Checks if the instance is in the same minute as the current moment last minute.

returns `bool`

#### Carbon::isLastMonth

Checks if the instance is in the same month as the current moment last month.

returns `bool`

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

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::isLastQuarter

Checks if the instance is in the same quarter as the current moment last quarter.

returns `bool`

#### Carbon::isLastSecond

Checks if the instance is in the same second as the current moment last second.

returns `bool`

#### Carbon::isLastWeek

Checks if the instance is in the same week as the current moment last week.

returns `bool`

#### Carbon::isLastYear

Checks if the instance is in the same year as the current moment last year.

returns `bool`

#### Carbon::isLeapYear

Determines if the instance is a leap year.

##### Examples
```php
Carbon::parse('2020-01-01')->isLeapYear(); // true
Carbon::parse('2019-01-01')->isLeapYear(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::isLocal

Check if the current instance has non-UTC timezone.

returns `bool`

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

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.65.0  | *no arguments* |

----------

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

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::isMidday

Check if the instance is midday.

##### Examples
```php
Carbon::parse('2019-02-28 11:59:59.999999')->isMidday(); // false
Carbon::parse('2019-02-28 12:00:00')->isMidday(); // true
Carbon::parse('2019-02-28 12:00:00.999999')->isMidday(); // true
Carbon::parse('2019-02-28 12:00:01')->isMidday(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.28.0  | *no arguments* |

----------

#### Carbon::isMidnight

Check if the instance is start of day / midnight.

##### Examples
```php
Carbon::parse('2019-02-28 00:00:00')->isMidnight(); // true
Carbon::parse('2019-02-28 00:00:00.999999')->isMidnight(); // true
Carbon::parse('2019-02-28 00:00:01')->isMidnight(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.28.0  | *no arguments* |

----------

#### Carbon::isModifiableUnit

Returns true if a property can be changed via setter.

##### Parameters
- $unit `string` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.0.0   | `$unit`     |

----------

#### Carbon::isMonday

Checks if the instance day is monday.

returns `bool`

#### Carbon::isMutable

Returns true if the current class/instance is mutable.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::isNextCentury

Checks if the instance is in the same century as the current moment next century.

returns `bool`

#### Carbon::isNextDay

Checks if the instance is in the same day as the current moment next day.

returns `bool`

#### Carbon::isNextDecade

Checks if the instance is in the same decade as the current moment next decade.

returns `bool`

#### Carbon::isNextHour

Checks if the instance is in the same hour as the current moment next hour.

returns `bool`

#### Carbon::isNextMicro

Checks if the instance is in the same microsecond as the current moment next microsecond.

returns `bool`

#### Carbon::isNextMicrosecond

Checks if the instance is in the same microsecond as the current moment next microsecond.

returns `bool`

#### Carbon::isNextMillennium

Checks if the instance is in the same millennium as the current moment next millennium.

returns `bool`

#### Carbon::isNextMilli

Checks if the instance is in the same millisecond as the current moment next millisecond.

returns `bool`

#### Carbon::isNextMillisecond

Checks if the instance is in the same millisecond as the current moment next millisecond.

returns `bool`

#### Carbon::isNextMinute

Checks if the instance is in the same minute as the current moment next minute.

returns `bool`

#### Carbon::isNextMonth

Checks if the instance is in the same month as the current moment next month.

returns `bool`

#### Carbon::isNextQuarter

Checks if the instance is in the same quarter as the current moment next quarter.

returns `bool`

#### Carbon::isNextSecond

Checks if the instance is in the same second as the current moment next second.

returns `bool`

#### Carbon::isNextWeek

Checks if the instance is in the same week as the current moment next week.

returns `bool`

#### Carbon::isNextYear

Checks if the instance is in the same year as the current moment next year.

returns `bool`

#### Carbon::isNowOrFuture

Determines if the instance is now or in the future, ie. greater (after) than or equal to now.

##### Examples
```php
Carbon::now()->isNowOrFuture(); // true
Carbon::now()->addHours(5)->isNowOrFuture(); // true
Carbon::now()->subHours(5)->isNowOrFuture(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.9.0   | *no arguments* |

----------

#### Carbon::isNowOrPast

Determines if the instance is now or in the past, ie. less (before) than or equal to now.

##### Examples
```php
Carbon::now()->isNowOrPast(); // true
Carbon::now()->subHours(5)->isNowOrPast(); // true
Carbon::now()->addHours(5)->isNowOrPast(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.9.0   | *no arguments* |

----------

#### Carbon::isObservedHoliday

Checks the date to see if it is a holiday observed in the selected zone.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isOpen

Returns true if the business is open now (or current date and time) according to current opening hours.
/!\ Important: it returns true if the current day is a holiday unless you set a closure handler for it in
the exceptions setting.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isOpenExcludingHolidays

Returns true if the business is open and not a holiday now (or current date and time) according to current
opening hours.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isOpenOn

Returns true if the business is open on a given day according to current opening hours.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `bool`

#### Carbon::isPast

Determines if the instance is in the past, ie. less (before) than now.

##### Examples
```php
Carbon::now()->subHours(5)->isPast(); // true
Carbon::now()->addHours(5)->isPast(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

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

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $format, DateTimeInterface\|string $date` |
| Prototype changed | 1.23.0  | `$format, $date = null`                           |
| Method added      | 1.22.0  | `$format, ?Carbon\Carbon $date = null`            |

----------

#### Carbon::isSameCentury

Checks if the given date is in the same century as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameDay

Checks if the given date is in the same day as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameDecade

Checks if the given date is in the same decade as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameHour

Checks if the given date is in the same hour as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameMicro

Checks if the given date is in the same microsecond as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameMicrosecond

Checks if the given date is in the same microsecond as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameMillennium

Checks if the given date is in the same millennium as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameMilli

Checks if the given date is in the same millisecond as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameMillisecond

Checks if the given date is in the same millisecond as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameMinute

Checks if the given date is in the same minute as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

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

| History           | Version | Description                                                |
|:----------------- | ------- | ---------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date, bool $ofSameYear = true` |
| Prototype changed | 2.0.0   | `$date = null, $ofSameYear = true`                         |
| Prototype changed | 1.29.2  | `$date = null, $ofSameYear = null`                         |
| Prototype changed | 1.23.0  | `$date = null, $ofSameYear = false`                        |
| Method added      | 1.22.0  | `?Carbon\Carbon $date = null, $ofSameYear = false`         |

----------

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

| History           | Version | Description                                                |
|:----------------- | ------- | ---------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date, bool $ofSameYear = true` |
| Prototype changed | 2.0.0   | `$date = null, $ofSameYear = true`                         |
| Prototype changed | 1.29.2  | `$date = null, $ofSameYear = null`                         |
| Method added      | 1.26.4  | `$date = null, $ofSameYear = false`                        |

----------

#### Carbon::isSameSecond

Checks if the given date is in the same second as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

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

| History           | Version | Description                                     |
|:----------------- | ------- | ----------------------------------------------- |
| Prototype changed | 3.0.0   | `string $unit, DateTimeInterface\|string $date` |
| Method added      | 2.0.0   | `$unit, $date = null`                           |

----------

#### Carbon::isSameWeek

Checks if the given date is in the same week as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSameYear

Checks if the given date is in the same year as the instance. If null passed, compare to now (with the same timezone).

##### Parameters
- `DateTimeInterface|string $date`

returns `bool`

#### Carbon::isSaturday

Checks if the instance day is saturday.

returns `bool`

#### Carbon::isStartOfCentury

Determines if the instance is start of century (first day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

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

| History           | Version | Description                                                                                                                                                                                                        |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Prototype changed | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|bool $checkMicroseconds = false, Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |
| Prototype changed | 3.0.0   | `bool $checkMicroseconds = false`                                                                                                                                                                                  |
| Method added      | 1.28.0  | `$checkMicroseconds = false`                                                                                                                                                                                       |

----------

#### Carbon::isStartOfDecade

Determines if the instance is start of decade (first day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStartOfHour

Determines if the instance is start of hour (first microsecond by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStartOfMillennium

Determines if the instance is start of millennium (first day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStartOfMillisecond

Determines if the instance is start of millisecond (first microsecond by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStartOfMinute

Determines if the instance is start of minute (first microsecond by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStartOfMonth

Determines if the instance is start of month (first day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStartOfQuarter

Determines if the instance is start of quarter (first day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStartOfSecond

Determines if the instance is start of second (first microsecond by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStartOfTime

Returns true if the date was created using CarbonImmutable::startOfTime()

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.48.0  | *no arguments* |

----------

#### Carbon::isStartOfUnit

Check if the instance is start of a given unit (tolerating a given interval).

##### Examples
```php
// Check if a date-time is the first 15 minutes of the hour it's in
Carbon::parse('2019-02-28 20:13:00')->isStartOfUnit(Unit::Hour, '15 minutes'); // true
```

| History      | Version | Description                                                                                                                            |
|:------------ | ------- | -------------------------------------------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit $unit, Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null, mixed $params` |

----------

#### Carbon::isStartOfWeek

Determines if the instance is start of week (first day by default but interval can be customized).

##### Examples
```php
Carbon::parse('2024-08-31')->startOfWeek()->isStartOfWeek(); // true
Carbon::parse('2024-08-31')->isStartOfWeek(); // false
```

| History      | Version | Description                                                                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null, Carbon\WeekDay\|int\|null $weekStartsAt = null` |

----------

#### Carbon::isStartOfYear

Determines if the instance is start of year (first day by default but interval can be customized).

| History      | Version | Description                                                                                          |
|:------------ | ------- | ---------------------------------------------------------------------------------------------------- |
| Method added | 3.8.0   | `Carbon\Unit\|DateInterval\|Closure\|Carbon\CarbonConverterInterface\|string\|null $interval = null` |

----------

#### Carbon::isStrictModeEnabled

Returns true if the strict mode is globally in use, false else.

(It can be overridden in specific instances.)

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::isSunday

Checks if the instance day is sunday.

returns `bool`

#### Carbon::isThursday

Checks if the instance day is thursday.

returns `bool`

#### Carbon::isToday

Determines if the instance is today.

##### Examples
```php
Carbon::today()->isToday(); // true
Carbon::tomorrow()->isToday(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::isTomorrow

Determines if the instance is tomorrow.

##### Examples
```php
Carbon::tomorrow()->isTomorrow(); // true
Carbon::yesterday()->isTomorrow(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::isTuesday

Checks if the instance day is tuesday.

returns `bool`

#### Carbon::isUtc

Check if the current instance has UTC timezone. (Both isUtc and isUTC cases are valid.)

returns `bool`

#### Carbon::isValid

Check if the current instance is a valid date.

returns `bool`

#### Carbon::isWednesday

Checks if the instance day is wednesday.

returns `bool`

#### Carbon::isWeekday

Determines if the instance is a weekday.

##### Examples
```php
Carbon::parse('2019-07-14')->isWeekday(); // false
Carbon::parse('2019-07-15')->isWeekday(); // true
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::isWeekend

Determines if the instance is a weekend day.

##### Examples
```php
Carbon::parse('2019-07-14')->isWeekend(); // true
Carbon::parse('2019-07-15')->isWeekend(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::isYesterday

Determines if the instance is yesterday.

##### Examples
```php
Carbon::yesterday()->isYesterday(); // true
Carbon::tomorrow()->isYesterday(); // false
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::isoFormat

Format in the current language using ISO replacement patterns.

##### Parameters
- $originalFormat `string|null` provide context if a chunk has been passed alone

| History           | Version | Description                                      |
|:----------------- | ------- | ------------------------------------------------ |
| Prototype changed | 2.16.0  | `string $format, ?string $originalFormat = null` |
| Method added      | 2.0.0   | `string $format`                                 |

----------

#### Carbon::isoWeek

Get/set the week number using given first day of week and first
day of year included in the first week. Or use ISO format if no settings
given.

##### Parameters
- $week `int|null` 
- $dayOfWeek `int|null` 
- $dayOfYear `int|null` 

returns `int|static`

| History      | Version | Description                                          |
|:------------ | ------- | ---------------------------------------------------- |
| Method added | 2.0.0   | `$week = null, $dayOfWeek = null, $dayOfYear = null` |

----------

#### Carbon::isoWeekYear

Set/get the week number of year using given first day of week and first
day of year included in the first week. Or use ISO format if no settings
given.

##### Parameters
- $year `int|null` if null, act as a getter, if not null, set the year and return current instance.
- $dayOfWeek `int|null` first date of week from 0 (Sunday) to 6 (Saturday)
- $dayOfYear `int|null` first day of year included in the week #1

returns `int|static`

| History      | Version | Description                                          |
|:------------ | ------- | ---------------------------------------------------- |
| Method added | 2.0.0   | `$year = null, $dayOfWeek = null, $dayOfYear = null` |

----------

#### Carbon::isoWeekday

Get/set the ISO weekday from 1 (Monday) to 7 (Sunday).

##### Parameters
- $value `\WeekDay|int|null` new value for weekday if using as setter.

| History           | Version | Description                               |
|:----------------- | ------- | ----------------------------------------- |
| Prototype changed | 3.0.0   | `Carbon\WeekDay\|int\|null $value = null` |
| Method added      | 2.0.0   | `$value = null`                           |

----------

#### Carbon::isoWeeksInYear

Get the number of weeks of the current week-year using given first day of week and first
day of year included in the first week. Or use ISO format if no settings
given.

##### Parameters
- $dayOfWeek `int|null` first date of week from 0 (Sunday) to 6 (Saturday)
- $dayOfYear `int|null` first day of year included in the week #1

returns `int`

| History      | Version | Description                            |
|:------------ | ------- | -------------------------------------- |
| Method added | 2.0.0   | `$dayOfWeek = null, $dayOfYear = null` |

----------

#### Carbon::jsonSerialize

Prepare the object for JSON serialization.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.26.0  | *no arguments* |

----------

#### Carbon::lastOfMonth

Modify to the last occurrence of a given day of the week
in the current month. If no dayOfWeek is provided, modify to the
last day of the current month.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $dayOfWeek `int|null` 

returns `static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 1.3.0   | `$dayOfWeek = null` |

----------

#### Carbon::lastOfQuarter

Modify to the last occurrence of a given day of the week
in the current quarter. If no dayOfWeek is provided, modify to the
last day of the current quarter.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $dayOfWeek `int|null` day of the week default null

returns `static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 1.3.0   | `$dayOfWeek = null` |

----------

#### Carbon::lastOfYear

Modify to the last occurrence of a given day of the week
in the current year. If no dayOfWeek is provided, modify to the
last day of the current year.  Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $dayOfWeek `int|null` day of the week default null

returns `static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 1.3.0   | `$dayOfWeek = null` |

----------

#### Carbon::lessThan

Determines if the instance is less (before) than another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:17'); // true
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.22.0  | `Carbon\Carbon $date`             |

----------

#### Carbon::lessThanOrEqualTo

Determines if the instance is less (before) or equal to another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:17'); // true
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.22.0  | `Carbon\Carbon $date`             |

----------

#### Carbon::locale

Get/set the locale for the current instance.

##### Parameters
- $locale `string|null` 
- $fallbackLocales `string` 

returns `$this|string`

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `?string $locale = null, string $fallbackLocales` |
| Prototype changed | 2.16.0  | `?string $locale = null, $fallbackLocales`        |
| Method added      | 2.0.0   | `?string $locale = null`                          |

----------

#### Carbon::localeHasDiffOneDayWords

Returns true if the given locale is internally supported and has words for 1-day diff (just now, yesterday, tomorrow).

Support is considered enabled if the 3 words are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 1.31.0  | `$locale`        |

----------

#### Carbon::localeHasDiffSyntax

Returns true if the given locale is internally supported and has diff syntax support (ago, from now, before, after).

Support is considered enabled if the 4 sentences are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 1.31.0  | `$locale`        |

----------

#### Carbon::localeHasDiffTwoDayWords

Returns true if the given locale is internally supported and has words for 2-days diff (before yesterday, after tomorrow).

Support is considered enabled if the 2 words are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 1.31.0  | `$locale`        |

----------

#### Carbon::localeHasPeriodSyntax

Returns true if the given locale is internally supported and has period syntax support (X times, every X, from X, to X).

Support is considered enabled if the 4 sentences are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 1.31.0  | `$locale`   |

----------

#### Carbon::localeHasShortUnits

Returns true if the given locale is internally supported and has short-units support.

Support is considered enabled if either year, day or hour has a short variant translated.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 1.31.0  | `$locale`        |

----------

#### Carbon::longAbsoluteDiffForHumans

Get the difference (long format, 'Absolute' mode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)

##### Parameters
- `DateTimeInterface $other = null`
- ` int $parts = 1`

returns `string`

#### Carbon::longRelativeDiffForHumans

Get the difference (long format, 'Relative' mode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)

##### Parameters
- `DateTimeInterface $other = null`
- ` int $parts = 1`

returns `string`

#### Carbon::longRelativeToNowDiffForHumans

Get the difference (long format, 'RelativeToNow' mode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)

##### Parameters
- `DateTimeInterface $other = null`
- ` int $parts = 1`

returns `string`

#### Carbon::longRelativeToOtherDiffForHumans

Get the difference (long format, 'RelativeToOther' mode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)

##### Parameters
- `DateTimeInterface $other = null`
- ` int $parts = 1`

returns `string`

#### Carbon::lt

Determines if the instance is less (before) than another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:17'); // true
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.0.0   | `Carbon\Carbon $date`             |

----------

#### Carbon::lte

Determines if the instance is less (before) or equal to another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:15'); // false
Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:16'); // true
Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:17'); // true
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.0.0   | `Carbon\Carbon $date`             |

----------

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

| History           | Version | Description                             |
|:----------------- | ------- | --------------------------------------- |
| Prototype changed | 3.0.1   | `string $name, ?callable $macro`        |
| Prototype changed | 3.0.0   | `string $name, callable\|object $macro` |
| Method added      | 1.26.0  | `$name, $macro`                         |

----------

#### Carbon::make

Make a Carbon instance from given variable if possible.

Always return a new instance. Parse only strings and only these likely to be dates (skip intervals
and recurrences). Throw an exception for invalid format, but otherwise return null.

##### Parameters
- $var `mixed` 

returns `static|null`

| History           | Version | Description                                         |
|:----------------- | ------- | --------------------------------------------------- |
| Prototype changed | 3.6.0   | `$var, DateTimeZone\|string\|null $timezone = null` |
| Method added      | 1.28.0  | `$var`                                              |

----------

#### Carbon::max

Get the maximum instance between a given instance (default now) and the current instance.

##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|mixed` 

returns `static`

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 1.24.0  | `$date = null`                |
| Prototype changed | 1.23.0  | `?self $date = null`          |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null` |
| Method added      | 1.8.0   | `Carbon\Carbon $date = null`  |

----------

#### Carbon::maximum

Get the maximum instance between a given instance (default now) and the current instance.

##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|mixed` 

returns `static`

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 1.24.0  | `$date = null`                |
| Prototype changed | 1.23.0  | `?self $date = null`          |
| Method added      | 1.22.0  | `?Carbon\Carbon $date = null` |

----------

#### Carbon::meridiem

Return the meridiem of the current time in the current locale.

##### Parameters
- $isLower `bool` if true, returns lowercase variant if available in the current locale.

| History      | Version | Description             |
|:------------ | ------- | ----------------------- |
| Method added | 2.14.0  | `bool $isLower = false` |

----------

#### Carbon::micro

Set current instance microsecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::micros

Set current instance microsecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::microsUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each microsecond or every X microseconds if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::microsecond

Set current instance microsecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::microsecondOfCentury

Return the value of the microsecond starting from the beginning of the current century when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfDay

Return the value of the microsecond starting from the beginning of the current day when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfDecade

Return the value of the microsecond starting from the beginning of the current decade when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfHour

Return the value of the microsecond starting from the beginning of the current hour when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfMillennium

Return the value of the microsecond starting from the beginning of the current millennium when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfMillisecond

Return the value of the microsecond starting from the beginning of the current millisecond when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfMinute

Return the value of the microsecond starting from the beginning of the current minute when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfMonth

Return the value of the microsecond starting from the beginning of the current month when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfQuarter

Return the value of the microsecond starting from the beginning of the current quarter when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfSecond

Return the value of the microsecond starting from the beginning of the current second when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfWeek

Return the value of the microsecond starting from the beginning of the current week when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microsecondOfYear

Return the value of the microsecond starting from the beginning of the current year when called with no parameters, change the current microsecond when called with an integer value

##### Parameters
- `?int $microsecond = null`

returns `int|static`

#### Carbon::microseconds

Set current instance microsecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::microsecondsInCentury

Return the number of microseconds contained in the current century

returns `int`

#### Carbon::microsecondsInDay

Return the number of microseconds contained in the current day

returns `int`

#### Carbon::microsecondsInDecade

Return the number of microseconds contained in the current decade

returns `int`

#### Carbon::microsecondsInHour

Return the number of microseconds contained in the current hour

returns `int`

#### Carbon::microsecondsInMillennium

Return the number of microseconds contained in the current millennium

returns `int`

#### Carbon::microsecondsInMillisecond

Return the number of microseconds contained in the current millisecond

returns `int`

#### Carbon::microsecondsInMinute

Return the number of microseconds contained in the current minute

returns `int`

#### Carbon::microsecondsInMonth

Return the number of microseconds contained in the current month

returns `int`

#### Carbon::microsecondsInQuarter

Return the number of microseconds contained in the current quarter

returns `int`

#### Carbon::microsecondsInSecond

Return the number of microseconds contained in the current second

returns `int`

#### Carbon::microsecondsInWeek

Return the number of microseconds contained in the current week

returns `int`

#### Carbon::microsecondsInYear

Return the number of microseconds contained in the current year

returns `int`

#### Carbon::microsecondsUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each microsecond or every X microseconds if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::midDay

Modify to midday, default to self::$midDayAt

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::millenniaUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each millennium or every X millennia if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::milli

Set current instance millisecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::millis

Set current instance millisecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::millisUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each millisecond or every X milliseconds if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::millisecond

Set current instance millisecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::millisecondOfCentury

Return the value of the millisecond starting from the beginning of the current century when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfDay

Return the value of the millisecond starting from the beginning of the current day when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfDecade

Return the value of the millisecond starting from the beginning of the current decade when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfHour

Return the value of the millisecond starting from the beginning of the current hour when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfMillennium

Return the value of the millisecond starting from the beginning of the current millennium when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfMinute

Return the value of the millisecond starting from the beginning of the current minute when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfMonth

Return the value of the millisecond starting from the beginning of the current month when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfQuarter

Return the value of the millisecond starting from the beginning of the current quarter when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfSecond

Return the value of the millisecond starting from the beginning of the current second when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfWeek

Return the value of the millisecond starting from the beginning of the current week when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::millisecondOfYear

Return the value of the millisecond starting from the beginning of the current year when called with no parameters, change the current millisecond when called with an integer value

##### Parameters
- `?int $millisecond = null`

returns `int|static`

#### Carbon::milliseconds

Set current instance millisecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::millisecondsInCentury

Return the number of milliseconds contained in the current century

returns `int`

#### Carbon::millisecondsInDay

Return the number of milliseconds contained in the current day

returns `int`

#### Carbon::millisecondsInDecade

Return the number of milliseconds contained in the current decade

returns `int`

#### Carbon::millisecondsInHour

Return the number of milliseconds contained in the current hour

returns `int`

#### Carbon::millisecondsInMillennium

Return the number of milliseconds contained in the current millennium

returns `int`

#### Carbon::millisecondsInMinute

Return the number of milliseconds contained in the current minute

returns `int`

#### Carbon::millisecondsInMonth

Return the number of milliseconds contained in the current month

returns `int`

#### Carbon::millisecondsInQuarter

Return the number of milliseconds contained in the current quarter

returns `int`

#### Carbon::millisecondsInSecond

Return the number of milliseconds contained in the current second

returns `int`

#### Carbon::millisecondsInWeek

Return the number of milliseconds contained in the current week

returns `int`

#### Carbon::millisecondsInYear

Return the number of milliseconds contained in the current year

returns `int`

#### Carbon::millisecondsUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each millisecond or every X milliseconds if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::min

Get the minimum instance between a given instance (default now) and the current instance.

##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|mixed` 

returns `static`

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 1.24.0  | `$date = null`                |
| Prototype changed | 1.23.0  | `?self $date = null`          |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $date = null` |
| Method added      | 1.8.0   | `Carbon\Carbon $date = null`  |

----------

#### Carbon::minimum

Get the minimum instance between a given instance (default now) and the current instance.

##### Parameters
- $date `\Carbon\Carbon|\DateTimeInterface|mixed` 

returns `static`

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 1.24.0  | `$date = null`                |
| Prototype changed | 1.23.0  | `?self $date = null`          |
| Method added      | 1.22.0  | `?Carbon\Carbon $date = null` |

----------

#### Carbon::minute

Set current instance minute to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::minuteOfCentury

Return the value of the minute starting from the beginning of the current century when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minuteOfDay

Return the value of the minute starting from the beginning of the current day when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minuteOfDecade

Return the value of the minute starting from the beginning of the current decade when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minuteOfHour

Return the value of the minute starting from the beginning of the current hour when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minuteOfMillennium

Return the value of the minute starting from the beginning of the current millennium when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minuteOfMonth

Return the value of the minute starting from the beginning of the current month when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minuteOfQuarter

Return the value of the minute starting from the beginning of the current quarter when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minuteOfWeek

Return the value of the minute starting from the beginning of the current week when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minuteOfYear

Return the value of the minute starting from the beginning of the current year when called with no parameters, change the current minute when called with an integer value

##### Parameters
- `?int $minute = null`

returns `int|static`

#### Carbon::minutes

Set current instance minute to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::minutesInCentury

Return the number of minutes contained in the current century

returns `int`

#### Carbon::minutesInDay

Return the number of minutes contained in the current day

returns `int`

#### Carbon::minutesInDecade

Return the number of minutes contained in the current decade

returns `int`

#### Carbon::minutesInHour

Return the number of minutes contained in the current hour

returns `int`

#### Carbon::minutesInMillennium

Return the number of minutes contained in the current millennium

returns `int`

#### Carbon::minutesInMonth

Return the number of minutes contained in the current month

returns `int`

#### Carbon::minutesInQuarter

Return the number of minutes contained in the current quarter

returns `int`

#### Carbon::minutesInWeek

Return the number of minutes contained in the current week

returns `int`

#### Carbon::minutesInYear

Return the number of minutes contained in the current year

returns `int`

#### Carbon::minutesUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each minute or every X minutes if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

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

| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `object\|string $mixin` |
| Method added      | 1.26.0  | `$mixin`                |

----------

#### Carbon::modify

Calls \DateTime::modify if mutable or \DateTimeImmutable::modify else.

returns `static`

| History           | Version | Description        |
|:----------------- | ------- | ------------------ |
| Prototype changed | 2.23.0  | `$modify`          |
| Prototype changed | 1.23.0  | `string $modifier` |
| Prototype changed | 1.22.0  | `$modify`          |
| Prototype changed | 1.21.0  | `string $modifier` |
| Method added      | 1.0.0   | `$modify`          |

----------

#### Carbon::month

Set current instance month to the given value.

##### Parameters
- `Month|int $value`

returns `$this`

#### Carbon::monthOfCentury

Return the value of the month starting from the beginning of the current century when called with no parameters, change the current month when called with an integer value

##### Parameters
- `?int $month = null`

returns `int|static`

#### Carbon::monthOfDecade

Return the value of the month starting from the beginning of the current decade when called with no parameters, change the current month when called with an integer value

##### Parameters
- `?int $month = null`

returns `int|static`

#### Carbon::monthOfMillennium

Return the value of the month starting from the beginning of the current millennium when called with no parameters, change the current month when called with an integer value

##### Parameters
- `?int $month = null`

returns `int|static`

#### Carbon::monthOfQuarter

Return the value of the month starting from the beginning of the current quarter when called with no parameters, change the current month when called with an integer value

##### Parameters
- `?int $month = null`

returns `int|static`

#### Carbon::monthOfYear

Return the value of the month starting from the beginning of the current year when called with no parameters, change the current month when called with an integer value

##### Parameters
- `?int $month = null`

returns `int|static`

#### Carbon::months

Set current instance month to the given value.

##### Parameters
- `Month|int $value`

returns `$this`

#### Carbon::monthsInCentury

Return the number of months contained in the current century

returns `int`

#### Carbon::monthsInDecade

Return the number of months contained in the current decade

returns `int`

#### Carbon::monthsInMillennium

Return the number of months contained in the current millennium

returns `int`

#### Carbon::monthsInQuarter

Return the number of months contained in the current quarter

returns `int`

#### Carbon::monthsInYear

Return the number of months contained in the current year

returns `int`

#### Carbon::monthsUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each month or every X months if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::ne

Determines if the instance is not equal to another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->ne('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->ne(Carbon::parse('2018-07-25 12:45:16')); // false
Carbon::parse('2018-07-25 12:45:16')->ne('2018-07-25 12:45:17'); // true
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.0.0   | `Carbon\Carbon $date`             |

----------

#### Carbon::next

Modify to the next occurrence of a given modifier such as a day of
the week. If no modifier is provided, modify to the next occurrence
of the current day of the week. Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $modifier `string|int|null` 

returns `static`

| History           | Version | Description         |
|:----------------- | ------- | ------------------- |
| Prototype changed | 2.20.0  | `$modifier = null`  |
| Method added      | 1.3.0   | `$dayOfWeek = null` |

----------

#### Carbon::nextBusinessClose

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::nextBusinessDay

Sets the date to the next business day (neither a weekend day nor a holiday).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `CarbonInterface|Carbon|CarbonImmutable`

#### Carbon::nextBusinessOpen

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::nextClose

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::nextCloseIncludingHolidays

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::nextOpen

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::nextOpenExcludingHolidays

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::nextWeekday

Go forward to the next weekday.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::nextWeekendDay

Go forward to the next weekend day.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::normalizeDay

Returns day English name in lower case.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `string`

#### Carbon::notEqualTo

Determines if the instance is not equal to another

##### Examples
```php
Carbon::parse('2018-07-25 12:45:16')->notEqualTo('2018-07-25 12:45:16'); // false
Carbon::parse('2018-07-25 12:45:16')->notEqualTo(Carbon::parse('2018-07-25 12:45:16')); // false
Carbon::parse('2018-07-25 12:45:16')->notEqualTo('2018-07-25 12:45:17'); // true
```

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 1.24.0  | `$date`                           |
| Prototype changed | 1.23.0  | `self $date`                      |
| Method added      | 1.22.0  | `Carbon\Carbon $date`             |

----------

#### Carbon::now

Get a Carbon instance for the current date and time.

| History           | Version | Description                                        |
|:----------------- | ------- | -------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.0.0   | `$tz = null`                                       |

----------

#### Carbon::nowWithSameTz

Returns a present instance in the same timezone.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::nthOfMonth

Modify to the given occurrence of a given day of the week
in the current month. If the calculated occurrence is outside the scope
of the current month, then return false and no modifications are made.

Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $nth `int` 
- $dayOfWeek `int` 

returns `mixed`

| History      | Version | Description        |
|:------------ | ------- | ------------------ |
| Method added | 1.3.0   | `$nth, $dayOfWeek` |

----------

#### Carbon::nthOfQuarter

Modify to the given occurrence of a given day of the week
in the current quarter. If the calculated occurrence is outside the scope
of the current quarter, then return false and no modifications are made.

Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $nth `int` 
- $dayOfWeek `int` 

returns `mixed`

| History      | Version | Description        |
|:------------ | ------- | ------------------ |
| Method added | 1.3.0   | `$nth, $dayOfWeek` |

----------

#### Carbon::nthOfYear

Modify to the given occurrence of a given day of the week
in the current year. If the calculated occurrence is outside the scope
of the current year, then return false and no modifications are made.

Use the supplied constants to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $nth `int` 
- $dayOfWeek `int` 

returns `mixed`

| History      | Version | Description        |
|:------------ | ------- | ------------------ |
| Method added | 1.3.0   | `$nth, $dayOfWeek` |

----------

#### Carbon::observeAllHolidays

Set a holiday as observed/unobserved in the selected zone (can take array of holidays).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::observeHoliday

Set a holiday as observed/unobserved in the selected zone (can take array of holidays).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::observeHolidays

Set a holiday as observed/unobserved in the selected zone (can take array of holidays).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::openOrNextBusinessClose

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::openOrNextClose

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::openOrNextCloseIncludingHolidays

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::openOrPreviousBusinessClose

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::openOrPreviousClose

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::openOrPreviousCloseIncludingHolidays

Get a method that return current date-time if $testMethod applied on it return true,
else return the result of $method called on it.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::ordinal

Return a property with its ordinal.

| History      | Version | Description                           |
|:------------ | ------- | ------------------------------------- |
| Method added | 2.0.0   | `string $key, ?string $period = null` |

----------

#### Carbon::parse

Create a carbon instance from a string.

This is an alias for the constructor that allows better fluent syntax
as it allows you to do Carbon::parse('Monday next week')->fn() rather
than (new Carbon('Monday next week'))->fn().

| History           | Version | Description                                                                                                                         |
|:----------------- | ------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|Carbon\WeekDay\|Carbon\Month\|string\|int\|float\|null $time, DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.3.0   | `$time = null, $tz = null`                                                                                                          |

----------

#### Carbon::parseFromLocale

Create a carbon instance from a localized string (in French, Japanese, Arabic, etc.).

##### Parameters
- $time `string` date/time string in the given language (may also contain English).
- $locale `string|null`
  if locale is null or not specified, current global locale will be
  used instead.
- $timezone `\DateTimeZone|string|int|null` optional timezone for the new instance.

| History           | Version | Description                                                                              |
|:----------------- | ------- | ---------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $time, ?string $locale = null, DateTimeZone\|string\|int\|null $timezone = null` |
| Prototype changed | 2.35.0  | `$time, $locale = null, $tz = null`                                                      |
| Method added      | 2.16.0  | `$time, $locale, $tz = null`                                                             |

----------

#### Carbon::pluralUnit

Returns standardized plural of a given singular/plural unit name (in English).

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | `string $unit` |

----------

#### Carbon::previous

Modify to the previous occurrence of a given modifier such as a day of
the week. If no dayOfWeek is provided, modify to the previous occurrence
of the current day of the week. Use the supplied constants
to indicate the desired dayOfWeek, ex. static::MONDAY.

##### Parameters
- $modifier `string|int|null` 

returns `static`

| History           | Version | Description         |
|:----------------- | ------- | ------------------- |
| Prototype changed | 2.20.0  | `$modifier = null`  |
| Method added      | 1.3.0   | `$dayOfWeek = null` |

----------

#### Carbon::previousBusinessClose

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::previousBusinessDay

Sets the date to the next business day (neither a weekend day nor a holiday).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `CarbonInterface|Carbon|CarbonImmutable`

#### Carbon::previousBusinessOpen

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::previousClose

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::previousCloseIncludingHolidays

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::previousOpen

Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
return a date, then convert it into a Carbon/sub-class instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|bool`

#### Carbon::previousOpenExcludingHolidays

Loop on the current instance (or now if called statically) with a given method until it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::previousWeekday

Go backward to the previous weekday.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::previousWeekendDay

Go backward to the previous weekend day.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::pushHoliday

Push a holiday to the holidays list of a region.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|null`

#### Carbon::pushToBDList

Push a day into a given list list of a region.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|null`

#### Carbon::pushWorkday

Push a workday to the workdays list of a region.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|null`

#### Carbon::quarterOfCentury

Return the value of the quarter starting from the beginning of the current century when called with no parameters, change the current quarter when called with an integer value

##### Parameters
- `?int $quarter = null`

returns `int|static`

#### Carbon::quarterOfDecade

Return the value of the quarter starting from the beginning of the current decade when called with no parameters, change the current quarter when called with an integer value

##### Parameters
- `?int $quarter = null`

returns `int|static`

#### Carbon::quarterOfMillennium

Return the value of the quarter starting from the beginning of the current millennium when called with no parameters, change the current quarter when called with an integer value

##### Parameters
- `?int $quarter = null`

returns `int|static`

#### Carbon::quarterOfYear

Return the value of the quarter starting from the beginning of the current year when called with no parameters, change the current quarter when called with an integer value

##### Parameters
- `?int $quarter = null`

returns `int|static`

#### Carbon::quartersInCentury

Return the number of quarters contained in the current century

returns `int`

#### Carbon::quartersInDecade

Return the number of quarters contained in the current decade

returns `int`

#### Carbon::quartersInMillennium

Return the number of quarters contained in the current millennium

returns `int`

#### Carbon::quartersInYear

Return the number of quarters contained in the current year

returns `int`

#### Carbon::quartersUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each quarter or every X quarters if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::range

Create a iterable CarbonPeriod object from current date to a given end date (and optional interval).

##### Parameters
- $end `\DateTimeInterface|\Carbon|\CarbonImmutable|null` period end date
- $interval `int|\DateInterval|string|null` period default interval or number of the given $unit
- $unit `string|null` if specified, $interval must be an integer

| History      | Version | Description                                   |
|:------------ | ------- | --------------------------------------------- |
| Method added | 2.20.0  | `$end = null, $interval = null, $unit = null` |

----------

#### Carbon::rawAdd

Call native PHP DateTime/DateTimeImmutable add() method.

##### Parameters
- $interval `\DateInterval` 

returns `static`

| History      | Version | Description              |
|:------------ | ------- | ------------------------ |
| Method added | 2.36.0  | `DateInterval $interval` |

----------

#### Carbon::rawCreateFromFormat

Create a Carbon instance from a specific format.

##### Parameters
- $format `string` Datetime format
- $time `string` 
- $timezone `\DateTimeZone|string|int|null` 

returns `static|null`

| History           | Version | Description                                      |
|:----------------- | ------- | ------------------------------------------------ |
| Prototype changed | 3.0.0   | `string $format, string $time, $timezone = null` |
| Method added      | 2.16.0  | `$format, $time, $tz = null`                     |

----------

#### Carbon::rawFormat

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $format` |
| Method added      | 2.16.0  | `$format`        |

----------

#### Carbon::rawParse

Create a carbon instance from a string.

This is an alias for the constructor that allows better fluent syntax
as it allows you to do Carbon::parse('Monday next week')->fn() rather
than (new Carbon('Monday next week'))->fn().

| History           | Version | Description                                                                                                                         |
|:----------------- | ------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|Carbon\WeekDay\|Carbon\Month\|string\|int\|float\|null $time, DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 2.16.0  | `$time = null, $tz = null`                                                                                                          |

----------

#### Carbon::rawSub

Call native PHP DateTime/DateTimeImmutable sub() method.

| History      | Version | Description              |
|:------------ | ------- | ------------------------ |
| Method added | 2.36.0  | `DateInterval $interval` |

----------

#### Carbon::resetHolidays

Reset the holidays list.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

#### Carbon::resetMacros

Remove all macros and generic macros.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::resetMonthsOverflow

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::resetOpeningHours

Reset the opening hours for the class/instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::resetToStringFormat

Reset the format used to the default when type juggling a Carbon instance to a string

returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.5.0   | *no arguments* |

----------

#### Carbon::resetYearsOverflow

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::round

Round the current instance second with given precision if specified.

| History           | Version | Description                                                                             |
|:----------------- | ------- | --------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateInterval\|string\|int\|float $precision = 1, callable\|string $function = 'round'` |
| Method added      | 2.0.0   | `$precision = 1, $function = 'round'`                                                   |

----------

#### Carbon::roundCenturies

Round the current instance century with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundCentury

Round the current instance century with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundDay

Round the current instance day with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundDays

Round the current instance day with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundDecade

Round the current instance decade with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundDecades

Round the current instance decade with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundHour

Round the current instance hour with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundHours

Round the current instance hour with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMicrosecond

Round the current instance microsecond with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMicroseconds

Round the current instance microsecond with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMillennia

Round the current instance millennium with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMillennium

Round the current instance millennium with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMillisecond

Round the current instance millisecond with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMilliseconds

Round the current instance millisecond with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMinute

Round the current instance minute with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMinutes

Round the current instance minute with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMonth

Round the current instance month with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundMonths

Round the current instance month with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundQuarter

Round the current instance quarter with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundQuarters

Round the current instance quarter with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundSecond

Round the current instance second with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundSeconds

Round the current instance second with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundUnit

Round the current instance at the given unit with given precision if specified and the given function.

| History           | Version | Description                                                                                           |
|:----------------- | ------- | ----------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $unit, DateInterval\|string\|int\|float $precision = 1, callable\|string $function = 'round'` |
| Method added      | 2.0.0   | `$unit, $precision = 1, $function = 'round'`                                                          |

----------

#### Carbon::roundWeek

Round the current instance week.

##### Parameters
- $weekStartsAt `\WeekDay|int|null` optional start allow you to specify the day of week to use to start the week

| History           | Version | Description                                      |
|:----------------- | ------- | ------------------------------------------------ |
| Prototype changed | 3.0.0   | `Carbon\WeekDay\|int\|null $weekStartsAt = null` |
| Method added      | 2.0.0   | `$weekStartsAt = null`                           |

----------

#### Carbon::roundYear

Round the current instance year with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::roundYears

Round the current instance year with given precision using the given function.

##### Parameters
- `float $precision = 1`
- ` string $function = "round"`

returns `$this`

#### Carbon::safeCallOnOpeningHours

Call a method on the OpeningHours of the current instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `mixed`

#### Carbon::second

Set current instance second to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::secondOfCentury

Return the value of the second starting from the beginning of the current century when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfDay

Return the value of the second starting from the beginning of the current day when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfDecade

Return the value of the second starting from the beginning of the current decade when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfHour

Return the value of the second starting from the beginning of the current hour when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfMillennium

Return the value of the second starting from the beginning of the current millennium when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfMinute

Return the value of the second starting from the beginning of the current minute when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfMonth

Return the value of the second starting from the beginning of the current month when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfQuarter

Return the value of the second starting from the beginning of the current quarter when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfWeek

Return the value of the second starting from the beginning of the current week when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::secondOfYear

Return the value of the second starting from the beginning of the current year when called with no parameters, change the current second when called with an integer value

##### Parameters
- `?int $second = null`

returns `int|static`

#### Carbon::seconds

Set current instance second to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::secondsInCentury

Return the number of seconds contained in the current century

returns `int`

#### Carbon::secondsInDay

Return the number of seconds contained in the current day

returns `int`

#### Carbon::secondsInDecade

Return the number of seconds contained in the current decade

returns `int`

#### Carbon::secondsInHour

Return the number of seconds contained in the current hour

returns `int`

#### Carbon::secondsInMillennium

Return the number of seconds contained in the current millennium

returns `int`

#### Carbon::secondsInMinute

Return the number of seconds contained in the current minute

returns `int`

#### Carbon::secondsInMonth

Return the number of seconds contained in the current month

returns `int`

#### Carbon::secondsInQuarter

Return the number of seconds contained in the current quarter

returns `int`

#### Carbon::secondsInWeek

Return the number of seconds contained in the current week

returns `int`

#### Carbon::secondsInYear

Return the number of seconds contained in the current year

returns `int`

#### Carbon::secondsSinceMidnight

The number of seconds since midnight.

returns `float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.14.0  | *no arguments* |

----------

#### Carbon::secondsUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each second or every X seconds if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::secondsUntilEndOfDay

The number of seconds until 23:59:59.

returns `float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.14.0  | *no arguments* |

----------

#### Carbon::serialize

Return a serialized string of the instance.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::serializeUsing

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
            You should rather transform Carbon object before the serialization.

JSON serialize all Carbon instances using the given callback.
:::
| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.0   | `callable\|string\|null $format` |
| Method added      | 1.26.0  | `$callback`                      |

----------

#### Carbon::set

Set a part of the Carbon object.

returns `$this`

| History           | Version | Description                                                                                            |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------------ |
| Prototype changed | 3.1.0   | `Carbon\Unit\|array\|string $name, DateTimeZone\|Carbon\Month\|string\|int\|float\|null $value = null` |
| Prototype changed | 3.0.0   | `array\|string $name, DateTimeZone\|Carbon\Month\|string\|int\|float\|null $value = null`              |
| Method added      | 2.0.0   | `$name, $value = null`                                                                                 |

----------

#### Carbon::setBusinessDayChecker

Checks the date to see if it is a business day (neither a weekend day nor a holiday).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::setDate

Set the date with gregorian year, month and day numbers.

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `int $year, int $month, int $day` |
| Prototype changed | 2.23.0  | `$year, $month, $day`             |
| Prototype changed | 2.0.0   | `int $year, int $month, int $day` |
| Prototype changed | 1.22.0  | `$year, $month, $day`             |
| Prototype changed | 1.21.0  | `int $year, int $month, int $day` |
| Method added      | 1.0.0   | `$year, $month, $day`             |

----------

#### Carbon::setDateFrom

Set the year, month, and date for this instance to that of the passed instance.

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 2.0.0   | `$date = null`                    |
| Method added      | 1.26.0  | `$date`                           |

----------

#### Carbon::setDateTime

Set the date and time all together.

| History           | Version | Description                                                                                       |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `int $year, int $month, int $day, int $hour, int $minute, int $second = 0, int $microseconds = 0` |
| Prototype changed | 2.0.0   | `$year, $month, $day, $hour, $minute, $second = 0, $microseconds = 0`                             |
| Prototype changed | 1.12.0  | `$year, $month, $day, $hour, $minute, $second = 0`                                                |
| Method added      | 1.0.0   | `$year, $month, $day, $hour, $minute, $second`                                                    |

----------

#### Carbon::setDateTimeFrom

Set the date and time for this instance to that of the passed instance.

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Method added      | 2.0.0   | `$date = null`                    |

----------

#### Carbon::setDay

Set current instance day to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setDays

Set current instance day to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setDaysFromStartOfWeek

Set the day (keeping the current time) to the start of the week + the number of days passed as the first
parameter. First day of week is driven by the locale unless explicitly set with the second parameter.

##### Parameters
- $numberOfDays `int` number of days to add after the start of the current week
- $weekStartsAt `\WeekDay|int|null`
  optional start allow you to specify the day of week to use to start the week,
  if not provided, start of week is inferred from the locale
  (Sunday for en_US, Monday for de_DE, etc.)

| History           | Version | Description                                                         |
|:----------------- | ------- | ------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `int $numberOfDays, Carbon\WeekDay\|int\|null $weekStartsAt = null` |
| Method added      | 2.64.0  | `int $numberOfDays, ?int $weekStartsAt = null`                      |

----------

#### Carbon::setExtraWorkdayGetter

Set the strategy to get the extra workday ID from a date object.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::setExtraWorkdays

Set the holidays list.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

#### Carbon::setFallbackLocale

Set the fallback locale.

##### Parameters
- $locale `string` 

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.16.0  | `$locale`        |

----------

#### Carbon::setHolidayData

Set stored data set for the current holiday, does nothing if it's not a holiday.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::setHolidayDataById

Set stored data set for the a given holiday ID.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::setHolidayGetter

Set the strategy to get the holiday ID from a date object.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::setHolidayName

Set/change the name of holiday by ID for a given language (or a list of languages).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface|null`

#### Carbon::setHolidayObserveStatus

Set a holiday as observed/unobserved in the selected zone.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::setHolidays

Set the holidays list.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

#### Carbon::setHolidaysRegion

Set the holidays region (see src/Cmixin/Holidays for examples).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

#### Carbon::setHour

Set current instance hour to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setHours

Set current instance hour to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setHumanDiffOptions

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOptions` |
| Method added      | 1.26.0  | `$humanDiffOptions`     |

----------

#### Carbon::setISODate

Set a date according to the ISO 8601 standard - using weeks and day offsets rather than specific dates.

| History           | Version | Description                                |
|:----------------- | ------- | ------------------------------------------ |
| Prototype changed | 3.0.0   | `int $year, int $week, int $day = 1`       |
| Prototype changed | 2.23.0  | `$year, $week, $day = 1`                   |
| Prototype changed | 1.21.0  | `int $year, int $week, int $dayOfWeek = 1` |
| Method added      | 1.0.0   | `$year, $week, $day`                       |

----------

#### Carbon::setLocalTranslator

Set the translator for the current instance.

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator` |
| Method added      | 2.0.0   | `Symfony\Component\Translation\TranslatorInterface $translator` |

----------

#### Carbon::setLocale

Set the current translator locale and indicate if the source locale file exists.

Pass 'auto' as locale to use the closest language to the current LC_TIME locale.

##### Parameters
- $locale `string` locale ex. en

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 1.18.0  | `$locale`        |

----------

#### Carbon::setMaxIteration

Set the maximum of loop turns to run before throwing an exception where trying to add
or subtract open/closed time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

#### Carbon::setMicro

Set current instance microsecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setMicros

Set current instance microsecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setMicrosecond

#### Carbon::setMicroseconds

Set current instance microsecond to the given value.

##### Parameters
- `int $value`

returns `$this`

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

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 1.24.0  | `$hour`     |

----------

#### Carbon::setMilli

Set current instance millisecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setMillis

Set current instance millisecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setMillisecond

Set current instance millisecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setMilliseconds

Set current instance millisecond to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setMinute

Set current instance minute to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setMinutes

Set current instance minute to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setMonth

Set current instance month to the given value.

##### Parameters
- `Month|int $value`

returns `$this`

#### Carbon::setMonths

Set current instance month to the given value.

##### Parameters
- `Month|int $value`

returns `$this`

#### Carbon::setObservedHolidaysZone

Set the selected zone for observed holidays. So next observe methods will be saved and considered in this
given custom zone.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::setOpeningHours

Set the opening hours for the class/instance.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::setSeasonConfig

#### Carbon::setSecond

Set current instance second to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setSeconds

Set current instance second to the given value.

##### Parameters
- `int $value`

returns `$this`

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

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.0   | `mixed $testNow = null`          |
| Prototype changed | 1.22.0  | `$testNow = null`                |
| Prototype changed | 1.21.0  | `?Carbon\Carbon $testNow = null` |
| Method added      | 1.3.0   | `Carbon\Carbon $testNow = null`  |

----------

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

| History           | Version | Description                         |
|:----------------- | ------- | ----------------------------------- |
| Prototype changed | 3.0.0   | `$testNow = null, $timezone = null` |
| Method added      | 2.54.0  | `$testNow = null, $tz = null`       |

----------

#### Carbon::setTime

Resets the current time of the DateTime object to a different time.

| History           | Version | Description                                                      |
|:----------------- | ------- | ---------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `int $hour, int $minute, int $second = 0, int $microseconds = 0` |
| Prototype changed | 2.23.0  | `$hour, $minute, $second = 0, $microseconds = 0`                 |
| Prototype changed | 1.21.0  | `int $hour, int $minute, int $second = 0, int $microsecond = 0`  |
| Prototype changed | 1.15.0  | `$hour, $minute, $second, $microseconds`                         |
| Method added      | 1.0.0   | `$hour, $minute, $second = 0`                                    |

----------

#### Carbon::setTimeFrom

Set the hour, minute, second and microseconds for this instance to that of the passed instance.

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeInterface\|string $date` |
| Prototype changed | 2.0.0   | `$date = null`                    |
| Method added      | 1.26.0  | `$date`                           |

----------

#### Carbon::setTimeFromTimeString

Set the time by time string.

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $time` |
| Method added      | 1.21.0  | `$time`        |

----------

#### Carbon::setTimestamp

Set the instance's timestamp.

Timestamp input can be given as int, float or a string containing one or more numbers.

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `string\|int\|float $timestamp` |
| Prototype changed | 2.41.0  | `$unixTimestamp`                |
| Prototype changed | 2.23.0  | `$unixtimestamp`                |
| Prototype changed | 1.21.0  | `int $timestamp`                |
| Method added      | 1.0.0   | `$unixtimestamp`                |

----------

#### Carbon::setTimezone

Set the instance's timezone from a string or object.

| History           | Version | Description                           |
|:----------------- | ------- | ------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int $timeZone` |
| Method added      | 1.0.0   | `$value`                              |

----------

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

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `Closure\|string\|null $format` |
| Method added      | 1.5.0   | `$format`                       |

----------

#### Carbon::setTranslator

Set the default translator instance to use.

##### Parameters
- $translator `\TranslatorInterface` 

returns `void`

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator` |
| Method added      | 1.18.0  | `Symfony\Component\Translation\TranslatorInterface $translator` |

----------

#### Carbon::setUnit

Set specified unit to new given value.

##### Parameters
- $unit `string` year, month, day, hour, minute, second or microsecond
- $value `\Month|int` new value for given unit

| History           | Version | Description                                                  |
|:----------------- | ------- | ------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `string $unit, Carbon\Month\|int\|float\|null $value = null` |
| Method added      | 2.0.0   | `$unit, $value = null`                                       |

----------

#### Carbon::setUnitNoOverflow

Set any unit to a new value without overflowing current other unit given.

##### Parameters
- $valueUnit `string` unit name to modify
- $value `int` new value for the input unit
- $overflowUnit `string` unit name to not overflow

| History           | Version | Description                                           |
|:----------------- | ------- | ----------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $valueUnit, int $value, string $overflowUnit` |
| Method added      | 2.0.0   | `$valueUnit, $value, $overflowUnit`                   |

----------

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
| History           | Version | Description   |
|:----------------- | ------- | ------------- |
| Prototype changed | 3.0.0   | `array $days` |
| Method added      | 1.20.0  | `$days`       |

----------

#### Carbon::setYear

Set current instance year to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::setYears

Set current instance year to the given value.

##### Parameters
- `int $value`

returns `$this`

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

| History      | Version | Description       |
|:------------ | ------- | ----------------- |
| Method added | 2.0.0   | `array $settings` |

----------

#### Carbon::shiftTimezone

Set the instance's timezone from a string or object and add/subtract the offset difference.

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string $value` |
| Method added      | 2.0.0   | `$value`                      |

----------

#### Carbon::shortAbsoluteDiffForHumans

Get the difference (short format, 'Absolute' mode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)

##### Parameters
- `DateTimeInterface $other = null`
- ` int $parts = 1`

returns `string`

#### Carbon::shortRelativeDiffForHumans

Get the difference (short format, 'Relative' mode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)

##### Parameters
- `DateTimeInterface $other = null`
- ` int $parts = 1`

returns `string`

#### Carbon::shortRelativeToNowDiffForHumans

Get the difference (short format, 'RelativeToNow' mode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)

##### Parameters
- `DateTimeInterface $other = null`
- ` int $parts = 1`

returns `string`

#### Carbon::shortRelativeToOtherDiffForHumans

Get the difference (short format, 'RelativeToOther' mode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)

##### Parameters
- `DateTimeInterface $other = null`
- ` int $parts = 1`

returns `string`

#### Carbon::shouldOverflowMonths

Get the month overflow global behavior (can be overridden in specific instances).

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::shouldOverflowYears

Get the month overflow global behavior (can be overridden in specific instances).

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::shouldRaiseMissingCalendarExtensionException

#### Carbon::since

| History           | Version | Description                                                                  |
|:----------------- | ------- | ---------------------------------------------------------------------------- |
| Prototype changed | 2.0.0   | `$other = null, $syntax = null, $short = false, $parts = 1, $options = null` |
| Method added      | 1.39.0  | `$other = null, $absolute = false, $short = false, $parts = 1`               |

----------

#### Carbon::singularUnit

Returns standardized singular of a given singular/plural unit name (in English).

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | `string $unit` |

----------

#### Carbon::skipMissingCalendarExtensionException

@codeCoverageIgnore

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `void`

#### Carbon::sleep

#### Carbon::standardizeHolidaysRegion

Return a standardized region name.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `string`

#### Carbon::startOf

Modify to start of current given unit.

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->startOf(Unit::Month)
  ->endOf(Unit::Week, Carbon::FRIDAY);
```

| History           | Version | Description                                |
|:----------------- | ------- | ------------------------------------------ |
| Prototype changed | 3.8.0   | `Carbon\Unit\|string $unit, mixed $params` |
| Prototype changed | 3.0.0   | `string $unit, mixed $params`              |
| Method added      | 2.0.0   | `$unit, $params`                           |

----------

#### Carbon::startOfCentury

Resets the date to the first day of the century and the time to 00:00:00

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfCentury();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.7.0   | *no arguments* |

----------

#### Carbon::startOfDay

Resets the time to 00:00:00 start of day

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfDay();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::startOfDecade

Resets the date to the first day of the decade and the time to 00:00:00

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfDecade();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.7.0   | *no arguments* |

----------

#### Carbon::startOfHour

Modify to start of current hour, minutes and seconds become 0

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfHour();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::startOfMillennium

Resets the date to the first day of the millennium and the time to 00:00:00

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfMillennium();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::startOfMillisecond

Modify to start of current millisecond, microseconds such as 12345 become 123000

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->startOfSecond()
  ->format('H:i:s.u');
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.8.0   | *no arguments* |

----------

#### Carbon::startOfMinute

Modify to start of current minute, seconds become 0

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfMinute();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::startOfMonth

Resets the date to the first day of the month and the time to 00:00:00

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfMonth();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::startOfQuarter

Resets the date to the first day of the quarter and the time to 00:00:00

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfQuarter();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.22.0  | *no arguments* |

----------

#### Carbon::startOfSeason

#### Carbon::startOfSecond

Modify to start of current second, microseconds become 0

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16.334455')
  ->startOfSecond()
  ->format('H:i:s.u');
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.33.0  | *no arguments* |

----------

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

| History           | Version | Description                                      |
|:----------------- | ------- | ------------------------------------------------ |
| Prototype changed | 3.0.0   | `Carbon\WeekDay\|int\|null $weekStartsAt = null` |
| Prototype changed | 2.0.0   | `$weekStartsAt = null`                           |
| Method added      | 1.3.0   | *no arguments*                                   |

----------

#### Carbon::startOfYear

Resets the date to the first day of the year and the time to 00:00:00

returns `static`

##### Examples
```php
echo Carbon::parse('2018-07-25 12:45:16')->startOfYear();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.7.0   | *no arguments* |

----------

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

| History           | Version | Description                                 |
|:----------------- | ------- | ------------------------------------------- |
| Prototype changed | 3.0.0   | `$unit, $value = 1, ?bool $overflow = null` |
| Prototype changed | 2.0.0   | `$unit, $value = 1, $overflow = null`       |
| Prototype changed | 1.21.0  | `DateInterval $interval`                    |
| Method added      | 1.0.0   | `$interval`                                 |

----------

#### Carbon::subBusinessDay

Add a given number of business days to the current date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subBusinessDays

Add a given number of business days to the current date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subBusinessInterval

Add the given interval taking into account only open time
(if `$open` is true) or only closed time (if `$open` is false).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subCenturies

Sub centuries (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subCenturiesNoOverflow

Sub centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subCenturiesWithNoOverflow

Sub centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subCenturiesWithOverflow

Sub centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subCenturiesWithoutOverflow

Sub centuries (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subCentury

Sub one century to the instance (using date interval).

returns `$this`

#### Carbon::subCenturyNoOverflow

Sub one century to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subCenturyWithNoOverflow

Sub one century to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subCenturyWithOverflow

Sub one century to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::subCenturyWithoutOverflow

Sub one century to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subClosedHours

Subtract the given number of hours taking into account only closed time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subClosedMinutes

Subtract the given number of minutes taking into account only closed time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subClosedTime

Subtract the given interval taking into account only closed time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subDay

Sub one day to the instance (using date interval).

returns `$this`

#### Carbon::subDays

Sub days (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subDecade

Sub one decade to the instance (using date interval).

returns `$this`

#### Carbon::subDecadeNoOverflow

Sub one decade to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subDecadeWithNoOverflow

Sub one decade to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subDecadeWithOverflow

Sub one decade to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::subDecadeWithoutOverflow

Sub one decade to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subDecades

Sub decades (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subDecadesNoOverflow

Sub decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subDecadesWithNoOverflow

Sub decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subDecadesWithOverflow

Sub decades (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subDecadesWithoutOverflow

Sub decades (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subHour

Sub one hour to the instance (using date interval).

returns `$this`

#### Carbon::subHours

Sub hours (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMicro

Sub one microsecond to the instance (using date interval).

returns `$this`

#### Carbon::subMicros

Sub microseconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMicrosecond

Sub one microsecond to the instance (using date interval).

returns `$this`

#### Carbon::subMicroseconds

Sub microseconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMillennia

Sub millennia (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMillenniaNoOverflow

Sub millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMillenniaWithNoOverflow

Sub millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMillenniaWithOverflow

Sub millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMillenniaWithoutOverflow

Sub millennia (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMillennium

Sub one millennium to the instance (using date interval).

returns `$this`

#### Carbon::subMillenniumNoOverflow

Sub one millennium to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subMillenniumWithNoOverflow

Sub one millennium to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subMillenniumWithOverflow

Sub one millennium to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::subMillenniumWithoutOverflow

Sub one millennium to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subMilli

Sub one millisecond to the instance (using date interval).

returns `$this`

#### Carbon::subMillis

Sub milliseconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMillisecond

Sub one millisecond to the instance (using date interval).

returns `$this`

#### Carbon::subMilliseconds

Sub milliseconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMinute

Sub one minute to the instance (using date interval).

returns `$this`

#### Carbon::subMinutes

Sub minutes (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMonth

Sub one month to the instance (using date interval).

returns `$this`

#### Carbon::subMonthNoOverflow

Sub one month to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subMonthWithNoOverflow

Sub one month to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subMonthWithOverflow

Sub one month to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::subMonthWithoutOverflow

Sub one month to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subMonths

Sub months (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMonthsNoOverflow

Sub months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMonthsWithNoOverflow

Sub months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMonthsWithOverflow

Sub months (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subMonthsWithoutOverflow

Sub months (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subOpenHours

Subtract the given number of hours taking into account only open time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subOpenMinutes

Subtract the given number of minutes taking into account only open time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subOpenTime

Subtract the given interval taking into account only open time.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subQuarter

Sub one quarter to the instance (using date interval).

returns `$this`

#### Carbon::subQuarterNoOverflow

Sub one quarter to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subQuarterWithNoOverflow

Sub one quarter to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subQuarterWithOverflow

Sub one quarter to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::subQuarterWithoutOverflow

Sub one quarter to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subQuarters

Sub quarters (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subQuartersNoOverflow

Sub quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subQuartersWithNoOverflow

Sub quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subQuartersWithOverflow

Sub quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subQuartersWithoutOverflow

Sub quarters (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

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

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.0.0   | `$unit, $value = 1` |

----------

#### Carbon::subSecond

Sub one second to the instance (using date interval).

returns `$this`

#### Carbon::subSeconds

Sub seconds (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCCenturies

Sub centuries (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCCentury

Sub one century to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCDay

Sub one day to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCDays

Sub days (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCDecade

Sub one decade to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCDecades

Sub decades (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCHour

Sub one hour to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCHours

Sub hours (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCMicro

Sub one microsecond to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCMicros

Sub microseconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCMicrosecond

Sub one microsecond to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCMicroseconds

Sub microseconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCMillennia

Sub millennia (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCMillennium

Sub one millennium to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCMilli

Sub one millisecond to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCMillis

Sub milliseconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCMillisecond

Sub one millisecond to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCMilliseconds

Sub milliseconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCMinute

Sub one minute to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCMinutes

Sub minutes (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCMonth

Sub one month to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCMonths

Sub months (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCQuarter

Sub one quarter to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCQuarters

Sub quarters (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCSecond

Sub one second to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCSeconds

Sub seconds (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCUnit

Subtract seconds to the instance using timestamp. Positive $value travels
into the past while negative $value travels forward.

##### Parameters
- $unit `string` 
- $value `int` 

returns `static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 3.2.0   | `$unit, $value = 1` |

----------

#### Carbon::subUTCWeek

Sub one week to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCWeeks

Sub weeks (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUTCYear

Sub one year to the instance (using timestamp).

returns `$this`

#### Carbon::subUTCYears

Sub years (the $value count passed in) to the instance (using timestamp).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subUnit

Subtract given units to the current instance.

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.1.0   | `Carbon\Unit\|string $unit, $value = 1, ?bool $overflow = null` |
| Prototype changed | 3.0.0   | `string $unit, $value = 1, ?bool $overflow = null`              |
| Method added      | 2.0.0   | `$unit, $value = 1, $overflow = null`                           |

----------

#### Carbon::subUnitNoOverflow

Subtract any unit to a new value without overflowing current other unit given.

##### Parameters
- $valueUnit `string` unit name to modify
- $value `int` amount to subtract to the input unit
- $overflowUnit `string` unit name to not overflow

| History           | Version | Description                                           |
|:----------------- | ------- | ----------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $valueUnit, int $value, string $overflowUnit` |
| Method added      | 2.0.0   | `$valueUnit, $value, $overflowUnit`                   |

----------

#### Carbon::subWeek

Sub one week to the instance (using date interval).

returns `$this`

#### Carbon::subWeekday

Sub one weekday to the instance (using date interval).

returns `$this`

#### Carbon::subWeekdays

Sub weekdays (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subWeeks

Sub weeks (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subYear

Sub one year to the instance (using date interval).

returns `$this`

#### Carbon::subYearNoOverflow

Sub one year to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subYearWithNoOverflow

Sub one year to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subYearWithOverflow

Sub one year to the instance (using date interval) with overflow explicitly allowed.

returns `$this`

#### Carbon::subYearWithoutOverflow

Sub one year to the instance (using date interval) with overflow explicitly forbidden.

returns `$this`

#### Carbon::subYears

Sub years (the $value count passed in) to the instance (using date interval).

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subYearsNoOverflow

Sub years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subYearsWithNoOverflow

Sub years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subYearsWithOverflow

Sub years (the $value count passed in) to the instance (using date interval) with overflow explicitly allowed.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subYearsWithoutOverflow

Sub years (the $value count passed in) to the instance (using date interval) with overflow explicitly forbidden.

##### Parameters
- `int|float $value = 1`

returns `$this`

#### Carbon::subtract

Subtract given units or interval to the current instance.

##### Parameters
- $unit `\Unit|int|string|\DateInterval` 
- $value `\Unit|int|float|string` 
- $overflow `bool|null` 

returns `static`

| History           | Version | Description                                 |
|:----------------- | ------- | ------------------------------------------- |
| Prototype changed | 3.0.0   | `$unit, $value = 1, ?bool $overflow = null` |
| Method added      | 2.0.0   | `$unit, $value = 1, $overflow = null`       |

----------

#### Carbon::subtractBusinessDay

Add a given number of business days to the current date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::subtractBusinessDays

Add a given number of business days to the current date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `Carbon|CarbonImmutable|CarbonInterface`

#### Carbon::swapDateTimeParam

Store a first variable as Carbon instance into the second variable if the first one is a date.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

#### Carbon::timespan

Get the difference in a human-readable format in the current locale from current instance to another
instance given (or now if null given).

returns `string`

| History      | Version | Description                       |
|:------------ | ------- | --------------------------------- |
| Method added | 2.16.0  | `$other = null, $timezone = null` |

----------

#### Carbon::timestamp

Set the instance's timestamp.

Timestamp input can be given as int, float or a string containing one or more numbers.

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `string\|int\|float $timestamp` |
| Prototype changed | 2.41.0  | `$unixTimestamp`                |
| Method added      | 1.0.0   | `$value`                        |

----------

#### Carbon::timezone

| History           | Version | Description                        |
|:----------------- | ------- | ---------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int $value` |
| Method added      | 1.0.0   | `$value`                           |

----------

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

| History           | Version | Description                                                                  |
|:----------------- | ------- | ---------------------------------------------------------------------------- |
| Prototype changed | 2.0.0   | `$other = null, $syntax = null, $short = false, $parts = 1, $options = null` |
| Method added      | 1.39.0  | `$other = null, $absolute = false, $short = false, $parts = 1`               |

----------

#### Carbon::toArray

Get default array representation.

##### Examples
```php
var_dump(Carbon::now()->toArray());
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::toAtomString

Format the instance as ATOM

##### Examples
```php
echo Carbon::now()->toAtomString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toCookieString

Format the instance as COOKIE

##### Examples
```php
echo Carbon::now()->toCookieString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toDate

##### Examples
```php
var_dump(Carbon::now()->toDate());
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::toDateString

Format the instance as date

##### Examples
```php
echo Carbon::now()->toDateString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::toDateTime

Return native DateTime PHP object matching the current instance.

##### Examples
```php
var_dump(Carbon::now()->toDateTime());
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::toDateTimeImmutable

Return native toDateTimeImmutable PHP object matching the current instance.

##### Examples
```php
var_dump(Carbon::now()->toDateTimeImmutable());
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### Carbon::toDateTimeLocalString

Format the instance as date and time T-separated with no timezone

##### Examples
```php
echo Carbon::now()->toDateTimeLocalString();
echo "\n";
echo Carbon::now()->toDateTimeLocalString('minute'); // You can specify precision among: minute, second, millisecond and microsecond
```

| History           | Version | Description                        |
|:----------------- | ------- | ---------------------------------- |
| Prototype changed | 3.0.0   | `string $unitPrecision = 'second'` |
| Prototype changed | 2.26.0  | `$unitPrecision = 'second'`        |
| Method added      | 1.39.0  | *no arguments*                     |

----------

#### Carbon::toDateTimeString

Format the instance as date and time

##### Examples
```php
echo Carbon::now()->toDateTimeString();
```

| History           | Version | Description                        |
|:----------------- | ------- | ---------------------------------- |
| Prototype changed | 3.0.0   | `string $unitPrecision = 'second'` |
| Prototype changed | 2.26.0  | `$unitPrecision = 'second'`        |
| Method added      | 1.0.0   | *no arguments*                     |

----------

#### Carbon::toDayDateTimeString

Format the instance with day, date and time

##### Examples
```php
echo Carbon::now()->toDayDateTimeString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::toFormattedDateString

Format the instance as a readable date

##### Examples
```php
echo Carbon::now()->toFormattedDateString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.0.0   | *no arguments* |

----------

#### Carbon::toFormattedDayDateString

Format the instance with the day, and a readable date

##### Examples
```php
echo Carbon::now()->toFormattedDayDateString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.62.0  | *no arguments* |

----------

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

| History           | Version | Description                |
|:----------------- | ------- | -------------------------- |
| Prototype changed | 3.0.0   | `bool $keepOffset = false` |
| Method added      | 1.39.0  | `$keepOffset = false`      |

----------

#### Carbon::toImmutable

Return a immutable copy of the instance.

returns `\CarbonImmutable`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::toIso8601String

Format the instance as ISO8601

##### Examples
```php
echo Carbon::now()->toIso8601String();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toIso8601ZuluString

Convert the instance to UTC and return as Zulu ISO8601

##### Examples
```php
echo Carbon::now()->toIso8601ZuluString();
```

| History           | Version | Description                        |
|:----------------- | ------- | ---------------------------------- |
| Prototype changed | 3.0.0   | `string $unitPrecision = 'second'` |
| Prototype changed | 2.26.0  | `$unitPrecision = 'second'`        |
| Method added      | 1.24.0  | *no arguments*                     |

----------

#### Carbon::toJSON

Return the ISO-8601 string (ex: 1977-04-22T06:00:00Z) with UTC timezone.

##### Examples
```php
echo Carbon::now('America/Toronto')->toJSON();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::toMutable

Return a mutable copy of the instance.

returns `\Carbon`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

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

| History           | Version | Description                                                   |
|:----------------- | ------- | ------------------------------------------------------------- |
| Prototype changed | 2.0.0   | `$syntax = null, $short = false, $parts = 1, $options = null` |
| Method added      | 1.39.0  | `$absolute = null, $short = false, $parts = 1`                |

----------

#### Carbon::toObject

Get default object representation.

##### Examples
```php
var_dump(Carbon::now()->toObject());
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::toPeriod

Create a iterable CarbonPeriod object from current date to a given end date (and optional interval).

##### Parameters
- $end `\DateTimeInterface|\Carbon|\CarbonImmutable|int|null` period end date or recurrences count if int
- $interval `int|\DateInterval|string|null` period default interval or number of the given $unit
- $unit `string|null` if specified, $interval must be an integer

| History      | Version | Description                                   |
|:------------ | ------- | --------------------------------------------- |
| Method added | 2.20.0  | `$end = null, $interval = null, $unit = null` |

----------

#### Carbon::toRfc1036String

Format the instance as RFC1036

##### Examples
```php
echo Carbon::now()->toRfc1036String();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toRfc1123String

Format the instance as RFC1123

##### Examples
```php
echo Carbon::now()->toRfc1123String();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toRfc2822String

Format the instance as RFC2822

##### Examples
```php
echo Carbon::now()->toRfc2822String();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toRfc3339String

Format the instance as RFC3339.

##### Examples
```php
echo Carbon::now()->toRfc3339String() . "\n";
echo Carbon::now()->toRfc3339String(true) . "\n";
```

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 3.0.0   | `bool $extended = false` |
| Prototype changed | 2.39.0  | `$extended = false`      |
| Method added      | 1.13.0  | *no arguments*           |

----------

#### Carbon::toRfc7231String

Format the instance as RFC7231

##### Examples
```php
echo Carbon::now()->toRfc7231String();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.24.0  | *no arguments* |

----------

#### Carbon::toRfc822String

Format the instance as RFC822

##### Examples
```php
echo Carbon::now()->toRfc822String();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toRfc850String

Format the instance as RFC850

##### Examples
```php
echo Carbon::now()->toRfc850String();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toRssString

Format the instance as RSS

##### Examples
```php
echo Carbon::now()->toRssString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::toString

Returns english human-readable complete date string.

##### Examples
```php
echo Carbon::now()->toString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.39.0  | *no arguments* |

----------

#### Carbon::toTimeString

Format the instance as time

##### Examples
```php
echo Carbon::now()->toTimeString();
```

| History           | Version | Description                        |
|:----------------- | ------- | ---------------------------------- |
| Prototype changed | 3.0.0   | `string $unitPrecision = 'second'` |
| Prototype changed | 2.26.0  | `$unitPrecision = 'second'`        |
| Method added      | 1.0.0   | *no arguments*                     |

----------

#### Carbon::toW3cString

Format the instance as W3C

##### Examples
```php
echo Carbon::now()->toW3cString();
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.13.0  | *no arguments* |

----------

#### Carbon::today

Create a Carbon instance for today.

| History           | Version | Description                                        |
|:----------------- | ------- | -------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.1.0   | `$tz = null`                                       |

----------

#### Carbon::tomorrow

Create a Carbon instance for tomorrow.

| History           | Version | Description                                        |
|:----------------- | ------- | -------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.1.0   | `$tz = null`                                       |

----------

#### Carbon::translate

Translate using translation string or callback available.

##### Parameters
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `string|int|float|null` number if plural
- $translator `\TranslatorInterface|null` an optional translator to use
- $altNumbers `bool` pass true to use alternative numbers

returns `string`

| History           | Version | Description                                                                                                                                                                     |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $key, array $parameters = [], string\|int\|float\|null $number = null, ?Symfony\Contracts\Translation\TranslatorInterface $translator = null, bool $altNumbers = false` |
| Prototype changed | 2.23.0  | `string $key, array $parameters = [], $number = null, ?Symfony\Component\Translation\TranslatorInterface $translator = null, bool $altNumbers = false`                          |
| Prototype changed | 2.8.0   | `string $key, array $parameters = [], $number = null, ?Symfony\Component\Translation\TranslatorInterface $translator = null`                                                    |
| Method added      | 2.0.0   | `string $key, array $parameters = [], $number = null`                                                                                                                           |

----------

#### Carbon::translateNumber

Returns the alternative number for a given integer if available in the current locale.

##### Parameters
- $number `int` 

returns `string`

| History      | Version | Description   |
|:------------ | ------- | ------------- |
| Method added | 2.23.0  | `int $number` |

----------

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

| History           | Version | Description                                                                    |
|:----------------- | ------- | ------------------------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `string $timeString, ?string $from = null, ?string $to = null, int $mode = 31` |
| Prototype changed | 2.35.0  | `$timeString, $from = null, $to = null, $mode = 31`                            |
| Method added      | 2.16.0  | `$timeString, $from = null, $to = null, $mode = 15`                            |

----------

#### Carbon::translateTimeStringTo

Translate a time string from the current locale (`$date->locale()`) to another one.

##### Parameters
- $timeString `string` time string to translate
- $to `string|null` output locale of the result returned ("en" by default)

returns `string`

| History           | Version | Description                              |
|:----------------- | ------- | ---------------------------------------- |
| Prototype changed | 3.0.0   | `string $timeString, ?string $to = null` |
| Method added      | 2.16.0  | `$timeString, $to = null`                |

----------

#### Carbon::translateWith

Translate using translation string or callback available.

##### Parameters
- $translator `\TranslatorInterface` an optional translator to use
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `int|float|null` number if plural

returns `string`

| History           | Version | Description                                                                                                          |
|:----------------- | ------- | -------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator, string $key, array $parameters = [], $number = null` |
| Method added      | 2.8.0   | `Symfony\Component\Translation\TranslatorInterface $translator, string $key, array $parameters = [], $number = null` |

----------

#### Carbon::translatedFormat

Format as ->format() do (using date replacements patterns from https://php.net/manual/en/function.date.php)
but translate words whenever possible (months, day names, etc.) using the current locale.

| History      | Version | Description      |
|:------------ | ------- | ---------------- |
| Method added | 2.16.0  | `string $format` |

----------

#### Carbon::tz

Set the timezone or returns the timezone name if no arguments passed.

returns `($value is null ? string : static)`

| History           | Version | Description                                     |
|:----------------- | ------- | ----------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int\|null $value = null` |
| Prototype changed | 2.0.0   | `$value = null`                                 |
| Method added      | 1.0.0   | `$value`                                        |

----------

#### Carbon::unix

returns `int`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::unobserveAllHolidays

Set a holiday as observed/unobserved in the selected zone (can take array of holidays).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::unobserveHoliday

Set a holiday as observed/unobserved in the selected zone (can take array of holidays).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::unobserveHolidays

Set a holiday as observed/unobserved in the selected zone (can take array of holidays).

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `$this|null`

#### Carbon::unpackHoliday

Unpack a holiday array definition.

> [!NOTE]
> Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>

returns `array`

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

| History           | Version | Description                                                                  |
|:----------------- | ------- | ---------------------------------------------------------------------------- |
| Prototype changed | 2.0.0   | `$other = null, $syntax = null, $short = false, $parts = 1, $options = null` |
| Method added      | 1.39.0  | `$other = null, $absolute = false, $short = false, $parts = 1`               |

----------

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

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 3.0.0   | `bool $monthsOverflow = true` |
| Method added      | 1.22.0  | `$monthsOverflow = true`      |

----------

#### Carbon::useStrictMode

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
##### Parameters
- $strictModeEnabled `bool` 

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.0   | `bool $strictModeEnabled = true` |
| Method added      | 2.0.0   | `$strictModeEnabled = true`      |

----------

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

| History           | Version | Description                  |
|:----------------- | ------- | ---------------------------- |
| Prototype changed | 3.0.0   | `bool $yearsOverflow = true` |
| Method added      | 1.24.0  | `$yearsOverflow = true`      |

----------

#### Carbon::utc

Set the instance's timezone to UTC.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::utcOffset

Returns the minutes offset to UTC if no arguments passed, else set the timezone with given minutes shift passed.

| History           | Version | Description                 |
|:----------------- | ------- | --------------------------- |
| Prototype changed | 2.44.0  | `?int $minuteOffset = null` |
| Method added      | 2.0.0   | `?int $offset = null`       |

----------

#### Carbon::valueOf

Returns the milliseconds timestamps used amongst other by Date javascript objects.

returns `float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Carbon::week

Get/set the week number using given first day of week and first
day of year included in the first week. Or use US format if no settings
given (Sunday / Jan 6).

##### Parameters
- $week `int|null` 
- $dayOfWeek `int|null` 
- $dayOfYear `int|null` 

returns `int|static`

| History      | Version | Description                                          |
|:------------ | ------- | ---------------------------------------------------- |
| Method added | 2.0.0   | `$week = null, $dayOfWeek = null, $dayOfYear = null` |

----------

#### Carbon::weekOfCentury

Return the value of the week starting from the beginning of the current century when called with no parameters, change the current week when called with an integer value

##### Parameters
- `?int $week = null`

returns `int|static`

#### Carbon::weekOfDecade

Return the value of the week starting from the beginning of the current decade when called with no parameters, change the current week when called with an integer value

##### Parameters
- `?int $week = null`

returns `int|static`

#### Carbon::weekOfMillennium

Return the value of the week starting from the beginning of the current millennium when called with no parameters, change the current week when called with an integer value

##### Parameters
- `?int $week = null`

returns `int|static`

#### Carbon::weekOfMonth

Return the value of the week starting from the beginning of the current month when called with no parameters, change the current week when called with an integer value

##### Parameters
- `?int $week = null`

returns `int|static`

#### Carbon::weekOfQuarter

Return the value of the week starting from the beginning of the current quarter when called with no parameters, change the current week when called with an integer value

##### Parameters
- `?int $week = null`

returns `int|static`

#### Carbon::weekOfYear

Return the value of the week starting from the beginning of the current year when called with no parameters, change the current week when called with an integer value

##### Parameters
- `?int $week = null`

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

| History      | Version | Description                                          |
|:------------ | ------- | ---------------------------------------------------- |
| Method added | 2.0.0   | `$year = null, $dayOfWeek = null, $dayOfYear = null` |

----------

#### Carbon::weekday

Get/set the weekday from 0 (Sunday) to 6 (Saturday).

##### Parameters
- $value `\WeekDay|int|null` new value for weekday if using as setter.

| History           | Version | Description                               |
|:----------------- | ------- | ----------------------------------------- |
| Prototype changed | 3.0.0   | `Carbon\WeekDay\|int\|null $value = null` |
| Method added      | 2.0.0   | `$value = null`                           |

----------

#### Carbon::weeksInCentury

Return the number of weeks contained in the current century

returns `int`

#### Carbon::weeksInDecade

Return the number of weeks contained in the current decade

returns `int`

#### Carbon::weeksInMillennium

Return the number of weeks contained in the current millennium

returns `int`

#### Carbon::weeksInMonth

Return the number of weeks contained in the current month

returns `int`

#### Carbon::weeksInQuarter

Return the number of weeks contained in the current quarter

returns `int`

#### Carbon::weeksInYear

Get the number of weeks of the current week-year using given first day of week and first
day of year included in the first week. Or use US format if no settings
given (Sunday / Jan 6).

##### Parameters
- $dayOfWeek `int|null` first date of week from 0 (Sunday) to 6 (Saturday)
- $dayOfYear `int|null` first day of year included in the week #1

returns `int`

| History      | Version | Description                            |
|:------------ | ------- | -------------------------------------- |
| Method added | 2.0.0   | `$dayOfWeek = null, $dayOfYear = null` |

----------

#### Carbon::weeksUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each week or every X weeks if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::withTestNow

Temporarily sets a static date to be used within the callback.

Using setTestNow to set the date, executing the callback, then
clearing the test instance.

/!\ Use this method for unit tests only.

##### Parameters
- $testNow `\DateTimeInterface|\Closure|static|string|false|null` real or mock Carbon instance
- $callback `callable` 

returns `\T`

| History           | Version | Description                          |
|:----------------- | ------- | ------------------------------------ |
| Prototype changed | 3.0.0   | `mixed $testNow, callable $callback` |
| Prototype changed | 2.67.0  | `$testNow, $callback`                |
| Method added      | 2.41.0  | `$testNow = null, $callback = null`  |

----------

#### Carbon::year

Set current instance year to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::yearOfCentury

Return the value of the year starting from the beginning of the current century when called with no parameters, change the current year when called with an integer value

##### Parameters
- `?int $year = null`

returns `int|static`

#### Carbon::yearOfDecade

Return the value of the year starting from the beginning of the current decade when called with no parameters, change the current year when called with an integer value

##### Parameters
- `?int $year = null`

returns `int|static`

#### Carbon::yearOfMillennium

Return the value of the year starting from the beginning of the current millennium when called with no parameters, change the current year when called with an integer value

##### Parameters
- `?int $year = null`

returns `int|static`

#### Carbon::years

Set current instance year to the given value.

##### Parameters
- `int $value`

returns `$this`

#### Carbon::yearsInCentury

Return the number of years contained in the current century

returns `int`

#### Carbon::yearsInDecade

Return the number of years contained in the current decade

returns `int`

#### Carbon::yearsInMillennium

Return the number of years contained in the current millennium

returns `int`

#### Carbon::yearsUntil

Return an iterable period from current date to given end (string, DateTime or Carbon instance) for each year or every X years if a factor is given.

##### Parameters
- `$endDate = null`
- ` int|float $factor = 1`

returns `CarbonPeriod`

#### Carbon::yesterday

Create a Carbon instance for yesterday.

| History           | Version | Description                                        |
|:----------------- | ------- | -------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int\|null $timezone = null` |
| Method added      | 1.1.0   | `$tz = null`                                       |

----------

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

| History           | Version | Description                                                                                                                         |
|:----------------- | ------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `$years = null, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null` |
| Prototype changed | 2.0.0   | `$years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null`    |
| Method added      | 1.18.0  | `$years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null`                          |

----------

#### CarbonInterval::__debugInfo

Show truthy properties on var_dump().

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.17.0  | *no arguments* |

----------

#### CarbonInterval::__get

Get a part of the CarbonInterval object.

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $name` |
| Method added      | 1.18.0  | `$name`        |

----------

#### CarbonInterval::__serialize

Returns the values to dump on serialize() called on.

returns `array`

#### CarbonInterval::__set

Set a part of the CarbonInterval object.

##### Parameters
- $name `string` 
- $value `int` 

| History           | Version | Description            |
|:----------------- | ------- | ---------------------- |
| Prototype changed | 3.0.0   | `string $name, $value` |
| Prototype changed | 2.0.0   | `$name, $value`        |
| Method added      | 1.18.0  | `$name, $val`          |

----------

#### CarbonInterval::__set_state

Evaluate the PHP generated by var_export() and recreate the exported CarbonInterval instance.

##### Parameters
- $dump `array` data as exported by var_export()

returns `static`

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 2.71.0  | `$dump`        |
| Method added      | 1.18.0  | `array $array` |

----------

#### CarbonInterval::__toString

Format the instance as a string using the forHumans() function.

returns `string`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.18.0  | *no arguments* |

----------

#### CarbonInterval::__unserialize

Set locale if specified on unserialize() called.

returns `void`

#### CarbonInterval::__wakeup

#### CarbonInterval::abs

Invert the interval if it's inverted.

##### Parameters
- $absolute `bool` do nothing if set to false

returns `$this`

| History      | Version | Description              |
|:------------ | ------- | ------------------------ |
| Method added | 3.0.0   | `bool $absolute = false` |

----------

#### CarbonInterval::absolute

##### Parameters
- $absolute `bool` do nothing if set to false

returns `$this`

| History      | Version | Description             |
|:------------ | ------- | ----------------------- |
| Method added | 3.0.0   | `bool $absolute = true` |

----------

#### CarbonInterval::add

Add the passed interval to the current instance.

##### Parameters
- $unit `string|\DateInterval` 
- $value `int|float` 

returns `$this`

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 2.4.0   | `$unit, $value = 1`      |
| Method added      | 1.18.0  | `DateInterval $interval` |

----------

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

| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `object\|string $mixin` |
| Method added      | 2.23.0  | `$mixin`                |

----------

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

| History           | Version | Description                                  |
|:----------------- | ------- | -------------------------------------------- |
| Prototype changed | 3.0.0   | `$interval1, $interval2, bool $equal = true` |
| Method added      | 2.22.0  | `$interval1, $interval2, $equal = true`      |

----------

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

| History      | Version | Description              |
|:------------ | ------- | ------------------------ |
| Method added | 2.22.0  | `$interval1, $interval2` |

----------

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

| History      | Version | Description              |
|:------------ | ------- | ------------------------ |
| Method added | 2.31.0  | `$interval1, $interval2` |

----------

#### CarbonInterval::cascade

Convert overflowed values into bigger units.

returns `$this`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.28.0  | *no arguments* |

----------

#### CarbonInterval::cast

Cast the current instance into the given class.

returns `\T`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.23.0  | `string $className` |

----------

#### CarbonInterval::ceil

Ceil the current instance second with given precision if specified.

returns `$this`

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateInterval\|string\|int\|float $precision = 1` |
| Method added      | 2.23.0  | `$precision = 1`                                  |

----------

#### CarbonInterval::ceilUnit

Ceil the current instance at the given unit with given precision if specified.

##### Parameters
- $unit `string` 
- $precision `float|int|string|\DateInterval|null` 

returns `$this`

| History           | Version | Description                    |
|:----------------- | ------- | ------------------------------ |
| Prototype changed | 3.0.0   | `string $unit, $precision = 1` |
| Method added      | 2.23.0  | `$unit, $precision = 1`        |

----------

#### CarbonInterval::clone

Get a copy of the instance.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.22.0  | *no arguments* |

----------

#### CarbonInterval::compare

Comparing with passed interval.

##### Parameters
- $interval `\DateInterval` 

returns `int 0, 1 or -1`

| History      | Version | Description              |
|:------------ | ------- | ------------------------ |
| Method added | 1.24.0  | `DateInterval $interval` |

----------

#### CarbonInterval::compareDateIntervals

Comparing 2 date intervals.

##### Parameters
- $first `\DateInterval` 
- $second `\DateInterval` 

returns `int 0, 1 or -1`

| History           | Version | Description                                 |
|:----------------- | ------- | ------------------------------------------- |
| Prototype changed | 2.21.0  | `DateInterval $first, DateInterval $second` |
| Method added      | 1.26.0  | `DateInterval $a, DateInterval $b`          |

----------

#### CarbonInterval::convertDate

Take a date and apply either the step if set, or the current interval else.

The interval/step is applied negatively (typically subtraction instead of addition) if $negated is true.

##### Parameters
- $dateTime `\DateTimeInterface` 
- $negated `bool` 

returns `\CarbonInterface`

| History      | Version | Description                                          |
|:------------ | ------- | ---------------------------------------------------- |
| Method added | 2.36.0  | `DateTimeInterface $dateTime, bool $negated = false` |

----------

#### CarbonInterval::copy

Get a copy of the instance.

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.28.0  | *no arguments* |

----------

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

| History           | Version | Description                                                                                                                         |
|:----------------- | ------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `$years = null, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null` |
| Prototype changed | 2.5.0   | `$years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null`    |
| Method added      | 1.18.0  | `$years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null`                          |

----------

#### CarbonInterval::createFromDateString

Sets up a DateInterval from the relative parts of the string.

##### Parameters
- $datetime `string` 

returns `static`

| History           | Version | Description        |
|:----------------- | ------- | ------------------ |
| Prototype changed | 3.0.0   | `string $datetime` |
| Prototype changed | 2.0.0   | `$time`            |
| Prototype changed | 1.21.0  | `string $datetime` |
| Method added      | 1.18.0  | `$time`            |

----------

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

| History      | Version | Description                         |
|:------------ | ------- | ----------------------------------- |
| Method added | 2.27.0  | `string $format, ?string $interval` |

----------

#### CarbonInterval::diff

Create an interval from the difference between 2 dates.

##### Parameters
- $start `\Carbon\Carbon|\DateTimeInterface|mixed` 
- $end `\Carbon\Carbon|\DateTimeInterface|mixed` 

returns `static`

| History      | Version | Description                                                     |
|:------------ | ------- | --------------------------------------------------------------- |
| Method added | 3.0.0   | `$start, $end = null, bool $absolute = false, array $skip = []` |

----------

#### CarbonInterval::disableHumanDiffOption

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description            |
|:----------------- | ------- | ---------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOption` |
| Method added      | 2.0.0   | `$humanDiffOption`     |

----------

#### CarbonInterval::divide

Divide and cascade current instance by a given divider.

##### Parameters
- $divider `float|int` 

returns `$this`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.20.0  | `$divider`  |

----------

#### CarbonInterval::enableFloatSetters

This option allow you to opt-in for the Carbon 3 behavior where float
values will no longer be cast to integer (so truncated).

⚠️ This settings will be applied globally, which mean your whole application
code including the third-party dependencies that also may use Carbon will
adopt the new behavior.

| History      | Version | Description                        |
|:------------ | ------- | ---------------------------------- |
| Method added | 2.70.0  | `bool $floatSettersEnabled = true` |

----------

#### CarbonInterval::enableHumanDiffOption

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description            |
|:----------------- | ------- | ---------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOption` |
| Method added      | 2.0.0   | `$humanDiffOption`     |

----------

#### CarbonInterval::end

Return the end date if interval was created from a difference between 2 dates.

returns `\CarbonInterface|null`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.0.0   | *no arguments* |

----------

#### CarbonInterval::eq

Determines if the instance is equal to another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::equalTo

Determines if the instance is equal to another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::executeWithLocale

Set the current locale to the given, execute the passed function, reset the locale to previous one,
then return the result of the closure (or null if the closure was void).

##### Parameters
- $locale `string` locale ex. en
- $func `callable` 

returns `mixed`

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.0   | `string $locale, callable $func` |
| Method added      | 2.0.0   | `$locale, $func`                 |

----------

#### CarbonInterval::floor

Round the current instance second with given precision if specified.

returns `$this`

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateInterval\|string\|int\|float $precision = 1` |
| Method added      | 2.23.0  | `$precision = 1`                                  |

----------

#### CarbonInterval::floorUnit

Truncate the current instance at the given unit with given precision if specified.

##### Parameters
- $unit `string` 
- $precision `float|int|string|\DateInterval|null` 

returns `$this`

| History           | Version | Description                    |
|:----------------- | ------- | ------------------------------ |
| Prototype changed | 3.0.0   | `string $unit, $precision = 1` |
| Method added      | 2.23.0  | `$unit, $precision = 1`        |

----------

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

| History           | Version | Description                                                    |
|:----------------- | ------- | -------------------------------------------------------------- |
| Prototype changed | 2.0.0   | `$syntax = null, $short = false, $parts = -1, $options = null` |
| Prototype changed | 1.28.0  | `$short = false`                                               |
| Method added      | 1.18.0  | *no arguments*                                                 |

----------

#### CarbonInterval::format

Returns the formatted date string on success or FALSE on failure.

returns `string`

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

| History           | Version | Description                  |
|:----------------- | ------- | ---------------------------- |
| Prototype changed | 3.0.0   | `string $intervalDefinition` |
| Method added      | 1.25.0  | `$intervalDefinition`        |

----------

#### CarbonInterval::get

Get a part of the CarbonInterval object.

| History           | Version | Description                 |
|:----------------- | ------- | --------------------------- |
| Prototype changed | 3.1.0   | `Carbon\Unit\|string $name` |
| Prototype changed | 3.0.0   | `string $name`              |
| Method added      | 2.37.0  | `$name`                     |

----------

#### CarbonInterval::getAvailableLocales

Returns the list of internally available locales and already loaded custom locales.

(It will ignore custom translator dynamic loading.)

returns `array`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::getAvailableLocalesInfo

Returns list of Language object for each available locale. This object allow you to get the ISO name, native
name, region and variant of the locale.

returns `\Language[]`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### CarbonInterval::getCascadeFactors

Mapping of units and factors for cascading.

Should only be modified by changing the factors or referenced constants.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.28.0  | *no arguments* |

----------

#### CarbonInterval::getClock

#### CarbonInterval::getDateIntervalSpec

Get the interval_spec string of a date interval.

##### Parameters
- $interval `\DateInterval` 

returns `string`

| History           | Version | Description                                                            |
|:----------------- | ------- | ---------------------------------------------------------------------- |
| Prototype changed | 2.64.0  | `DateInterval $interval, bool $microseconds = false, array $skip = []` |
| Prototype changed | 2.61.0  | `DateInterval $interval, bool $microseconds = false`                   |
| Method added      | 1.26.0  | `DateInterval $interval`                                               |

----------

#### CarbonInterval::getDaysPerWeek

Returns current config for days per week.

returns `int|float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.28.0  | *no arguments* |

----------

#### CarbonInterval::getFactor

Returns the factor for a given source-to-target couple.

##### Parameters
- $source `string` 
- $target `string` 

returns `int|float|null`

| History      | Version | Description        |
|:------------ | ------- | ------------------ |
| Method added | 1.28.0  | `$source, $target` |

----------

#### CarbonInterval::getFactorWithDefault

Returns the factor for a given source-to-target couple if set,
else try to find the appropriate constant as the factor, such as Carbon::DAYS_PER_WEEK.

##### Parameters
- $source `string` 
- $target `string` 

returns `int|float|null`

| History      | Version | Description        |
|:------------ | ------- | ------------------ |
| Method added | 2.55.0  | `$source, $target` |

----------

#### CarbonInterval::getFallbackLocale

Get the fallback locale.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.16.0  | *no arguments* |

----------

#### CarbonInterval::getHoursPerDay

Returns current config for hours per day.

returns `int|float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.28.0  | *no arguments* |

----------

#### CarbonInterval::getHumanDiffOptions

Return default humanDiff() options (merged flags as integer).

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::getLocalTranslator

Get the translator of the current instance or the default if none set.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::getLocale

Get the current translator locale.

returns `string`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.18.0  | *no arguments* |

----------

#### CarbonInterval::getMicrosecondsPerMillisecond

Returns current config for microseconds per second.

returns `int|float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::getMillisecondsPerSecond

Returns current config for microseconds per second.

returns `int|float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::getMinutesPerHour

Returns current config for minutes per hour.

returns `int|float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::getNonZeroValues

Returns interval non-zero values as an array where key are the unit names and values the counts.

returns `int[]`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.27.0  | *no arguments* |

----------

#### CarbonInterval::getSecondsPerMinute

Returns current config for seconds per minute.

returns `int|float`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::getSettings

Returns current local settings.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.3.0   | *no arguments* |

----------

#### CarbonInterval::getStep

Get the dynamic step in use.

returns `\Closure`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.36.0  | *no arguments* |

----------

#### CarbonInterval::getTranslationMessage

Returns raw translation message for a given key.

##### Parameters
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
- $translator `\TranslatorInterface` an optional translator to use

returns `string`

| History      | Version | Description                                                                        |
|:------------ | ------- | ---------------------------------------------------------------------------------- |
| Method added | 2.8.0   | `string $key, ?string $locale = null, ?string $default = null, $translator = null` |

----------

#### CarbonInterval::getTranslationMessageWith

Returns raw translation message for a given key.

##### Parameters
- $translator `\TranslatorInterface|null` the translator to use
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key

returns `string|\Closure|null`

| History      | Version | Description                                                                 |
|:------------ | ------- | --------------------------------------------------------------------------- |
| Method added | 2.8.0   | `$translator, string $key, ?string $locale = null, ?string $default = null` |

----------

#### CarbonInterval::getTranslator

Initialize the default translator instance if necessary.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.18.0  | *no arguments* |

----------

#### CarbonInterval::getValuesSequence

Returns interval values as an array where key are the unit names and values the counts
from the biggest non-zero one the the smallest non-zero one.

returns `int[]`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.27.0  | *no arguments* |

----------

#### CarbonInterval::greaterThan

Determines if the instance is greater (longer) than another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::greaterThanOrEqualTo

Determines if the instance is greater (longer) than or equal to another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::gt

Determines if the instance is greater (longer) than another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::gte

Determines if the instance is greater (longer) than or equal to another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::hasLocalTranslator

Return true if the current instance has its own translator.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.29.0  | *no arguments* |

----------

#### CarbonInterval::hasMacro

Check if macro is registered.

##### Parameters
- $name `string` 

returns `bool`

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $name` |
| Method added      | 1.28.0  | `$name`        |

----------

#### CarbonInterval::hasNegativeValues

#### CarbonInterval::hasPositiveValues

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

| History           | Version | Description                                                        |
|:----------------- | ------- | ------------------------------------------------------------------ |
| Prototype changed | 2.70.0  | `DateInterval $interval, array $skip = [], bool $skipCopy = false` |
| Prototype changed | 2.64.0  | `DateInterval $interval, array $skip = []`                         |
| Prototype changed | 2.21.0  | `DateInterval $interval`                                           |
| Prototype changed | 2.0.0   | `DateInterval $di`                                                 |
| Prototype changed | 1.35.0  | `DateInterval $di, $trimMicroseconds = true`                       |
| Method added      | 1.18.0  | `DateInterval $di`                                                 |

----------

#### CarbonInterval::invert

Invert the interval.

##### Parameters
- $inverted `bool|int`
  if a parameter is passed, the passed value cast as 1 or 0 is used
  as the new value of the ->invert property.

returns `$this`

| History           | Version | Description        |
|:----------------- | ------- | ------------------ |
| Prototype changed | 2.37.0  | `$inverted = null` |
| Method added      | 1.28.0  | *no arguments*     |

----------

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

| History           | Version | Description                                  |
|:----------------- | ------- | -------------------------------------------- |
| Prototype changed | 3.0.0   | `$interval1, $interval2, bool $equal = true` |
| Method added      | 2.22.0  | `$interval1, $interval2, $equal = true`      |

----------

#### CarbonInterval::isEmpty

Returns true if the interval is empty for each unit.

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::isStrictModeEnabled

Returns true if the strict mode is globally in use, false else.

(It can be overridden in specific instances.)

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::lessThan

Determines if the instance is less (shorter) than another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::lessThanOrEqualTo

Determines if the instance is less (shorter) than or equal to another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::locale

Get/set the locale for the current instance.

##### Parameters
- $locale `string|null` 
- $fallbackLocales `string` 

returns `$this|string`

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `?string $locale = null, string $fallbackLocales` |
| Prototype changed | 2.16.0  | `?string $locale = null, $fallbackLocales`        |
| Method added      | 2.0.0   | `?string $locale = null`                          |

----------

#### CarbonInterval::localeHasDiffOneDayWords

Returns true if the given locale is internally supported and has words for 1-day diff (just now, yesterday, tomorrow).

Support is considered enabled if the 3 words are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

#### CarbonInterval::localeHasDiffSyntax

Returns true if the given locale is internally supported and has diff syntax support (ago, from now, before, after).

Support is considered enabled if the 4 sentences are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

#### CarbonInterval::localeHasDiffTwoDayWords

Returns true if the given locale is internally supported and has words for 2-days diff (before yesterday, after tomorrow).

Support is considered enabled if the 2 words are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

#### CarbonInterval::localeHasPeriodSyntax

Returns true if the given locale is internally supported and has period syntax support (X times, every X, from X, to X).

Support is considered enabled if the 4 sentences are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.0.0   | `$locale`   |

----------

#### CarbonInterval::localeHasShortUnits

Returns true if the given locale is internally supported and has short-units support.

Support is considered enabled if either year, day or hour has a short variant translated.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

#### CarbonInterval::lt

Determines if the instance is less (shorter) than another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::lte

Determines if the instance is less (shorter) than or equal to another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

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

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.1   | `string $name, ?callable $macro` |
| Prototype changed | 3.0.0   | `string $name, $macro`           |
| Method added      | 1.28.0  | `$name, $macro`                  |

----------

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

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 2.70.0  | `$interval, $unit = null, bool $skipCopy = false` |
| Prototype changed | 2.34.0  | `$interval, $unit = null`                         |
| Method added      | 1.28.0  | `$var`                                            |

----------

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

| History      | Version | Description                                                                                                 |
|:------------ | ------- | ----------------------------------------------------------------------------------------------------------- |
| Method added | 2.45.0  | `$years = 0, $months = 0, $weeks = 0, $days = 0, $hours = 0, $minutes = 0, $seconds = 0, $microseconds = 0` |

----------

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

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 1.28.0  | `$mixin`    |

----------

#### CarbonInterval::multiply

Multiply and cascade current instance by a given factor.

##### Parameters
- $factor `float|int` 

returns `$this`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.20.0  | `$factor`   |

----------

#### CarbonInterval::ne

Determines if the instance is not equal to another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::notEqualTo

Determines if the instance is not equal to another

##### Parameters
- $interval `\CarbonInterval|\DateInterval|mixed` 

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.22.0  | `$interval` |

----------

#### CarbonInterval::optimize

Get rid of the original input, start date and end date that may be kept in memory.

returns `$this`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.0.0   | *no arguments* |

----------

#### CarbonInterval::original

Return the original source used to create the current interval.

returns `array|int|string|\DateInterval|mixed|null`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.0.0   | *no arguments* |

----------

#### CarbonInterval::parseFromLocale

Creates a CarbonInterval from string using a different locale.

##### Parameters
- $interval `string` interval string in the given language (may also contain English).
- $locale `string|null` if locale is null or not specified, current global locale will be used instead.

returns `static`

| History           | Version | Description                                |
|:----------------- | ------- | ------------------------------------------ |
| Prototype changed | 3.0.0   | `string $interval, ?string $locale = null` |
| Prototype changed | 2.35.0  | `$interval, $locale = null`                |
| Method added      | 2.21.0  | `$interval, $locale`                       |

----------

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

| History      | Version | Description                                                                                                 |
|:------------ | ------- | ----------------------------------------------------------------------------------------------------------- |
| Method added | 2.45.0  | `$years = 0, $months = 0, $weeks = 0, $days = 0, $hours = 0, $minutes = 0, $seconds = 0, $microseconds = 0` |

----------

#### CarbonInterval::resetMonthsOverflow

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::resetToStringFormat

Reset the format used to the default when type juggling a Carbon instance to a string

returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.63.0  | *no arguments* |

----------

#### CarbonInterval::resetYearsOverflow

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::round

Round the current instance second with given precision if specified.

##### Parameters
- $precision `float|int|string|\DateInterval|null` 
- $function `string` 

returns `$this`

| History           | Version | Description                                  |
|:----------------- | ------- | -------------------------------------------- |
| Prototype changed | 3.0.0   | `$precision = 1, string $function = 'round'` |
| Method added      | 2.23.0  | `$precision = 1, $function = 'round'`        |

----------

#### CarbonInterval::roundUnit

Round the current instance at the given unit with given precision if specified and the given function.

| History           | Version | Description                                                                                 |
|:----------------- | ------- | ------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $unit, DateInterval\|string\|int\|float $precision = 1, string $function = 'round'` |
| Method added      | 2.23.0  | `$unit, $precision = 1, $function = 'round'`                                                |

----------

#### CarbonInterval::set

Set a part of the CarbonInterval object.

##### Parameters
- $name `\Unit|string|array` 
- $value `int` 

returns `$this`

| History      | Version | Description            |
|:------------ | ------- | ---------------------- |
| Method added | 2.37.0  | `$name, $value = null` |

----------

#### CarbonInterval::setCascadeFactors

Set default cascading factors for ->cascade() method.

##### Parameters
- $cascadeFactors `array` 

| History      | Version | Description             |
|:------------ | ------- | ----------------------- |
| Method added | 1.28.0  | `array $cascadeFactors` |

----------

#### CarbonInterval::setFallbackLocale

Set the fallback locale.

##### Parameters
- $locale `string` 

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.16.0  | `$locale`        |

----------

#### CarbonInterval::setHumanDiffOptions

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOptions` |
| Method added      | 2.0.0   | `$humanDiffOptions`     |

----------

#### CarbonInterval::setLocalTranslator

Set the translator for the current instance.

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator` |
| Method added      | 2.0.0   | `Symfony\Component\Translation\TranslatorInterface $translator` |

----------

#### CarbonInterval::setLocale

Set the current translator locale and indicate if the source locale file exists.

Pass 'auto' as locale to use the closest language to the current LC_TIME locale.

##### Parameters
- $locale `string` locale ex. en

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 1.18.0  | `$locale`        |

----------

#### CarbonInterval::setStep

Set a step to apply instead of a fixed interval to get the new date.

Or pass null to switch to fixed interval.

##### Parameters
- $step `\Closure|null` 

| History      | Version | Description      |
|:------------ | ------- | ---------------- |
| Method added | 2.36.0  | `?Closure $step` |

----------

#### CarbonInterval::setTimezone

Set the instance's timezone from a string or object.

| History           | Version | Description                           |
|:----------------- | ------- | ------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int $timezone` |
| Method added      | 2.52.0  | `$tzName`                             |

----------

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

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `Closure\|string\|null $format` |
| Method added      | 2.63.0  | `$format`                       |

----------

#### CarbonInterval::setTranslator

Set the default translator instance to use.

##### Parameters
- $translator `\TranslatorInterface` 

returns `void`

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator` |
| Method added      | 1.18.0  | `Symfony\Component\Translation\TranslatorInterface $translator` |

----------

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

| History      | Version | Description       |
|:------------ | ------- | ----------------- |
| Method added | 2.0.0   | `array $settings` |

----------

#### CarbonInterval::shares

Divide current instance by a given divider. shares() is naive, it divides each unit separately
and the result is rounded for each unit. So 5 hours and 20 minutes shared by 3 becomes 2 hours
and 7 minutes.

Use shares() when you want a fast and approximated calculation that does not cascade units.

For a precise and cascaded calculation,

##### Parameters
- $divider `float|int` 

returns `$this`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.20.0  | `$divider`  |

----------

#### CarbonInterval::shiftTimezone

Set the instance's timezone from a string or object and add/subtract the offset difference.

| History           | Version | Description                           |
|:----------------- | ------- | ------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int $timezone` |
| Method added      | 2.3.0   | `$tzName`                             |

----------

#### CarbonInterval::shouldOverflowMonths

Get the month overflow global behavior (can be overridden in specific instances).

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::shouldOverflowYears

Get the month overflow global behavior (can be overridden in specific instances).

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonInterval::spec

Get the interval_spec string.

returns `string`

| History           | Version | Description                  |
|:----------------- | ------- | ---------------------------- |
| Prototype changed | 2.61.0  | `bool $microseconds = false` |
| Method added      | 1.22.0  | *no arguments*               |

----------

#### CarbonInterval::start

Return the start date if interval was created from a difference between 2 dates.

returns `\CarbonInterface|null`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.0.0   | *no arguments* |

----------

#### CarbonInterval::stepBy

Decompose the current interval into

##### Parameters
- $interval `mixed|int|\DateInterval|string|\Closure|\Unit|null` interval or number of the given $unit
- $unit `\Unit|string|null` if specified, $interval must be an integer

returns `\CarbonPeriod`

| History      | Version | Description                                         |
|:------------ | ------- | --------------------------------------------------- |
| Method added | 3.0.0   | `$interval, Carbon\Unit\|string\|null $unit = null` |

----------

#### CarbonInterval::sub

Subtract the passed interval to the current instance.

##### Parameters
- $unit `string|\DateInterval` 
- $value `int|float` 

returns `$this`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.4.0   | `$unit, $value = 1` |

----------

#### CarbonInterval::subtract

Subtract the passed interval to the current instance.

##### Parameters
- $unit `string|\DateInterval` 
- $value `int|float` 

returns `$this`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.4.0   | `$unit, $value = 1` |

----------

#### CarbonInterval::times

Multiply current instance given number of times. times() is naive, it multiplies each unit
(so day can be greater than 31, hour can be greater than 23, etc.) and the result is rounded
separately for each unit.

Use times() when you want a fast and approximated calculation that does not cascade units.

For a precise and cascaded calculation,

##### Parameters
- $factor `float|int` 

returns `$this`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 1.27.0  | `$factor`   |

----------

#### CarbonInterval::toArray

Returns interval values as an array where key are the unit names and values the counts.

returns `int[]`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.27.0  | *no arguments* |

----------

#### CarbonInterval::toDateInterval

Return native DateInterval PHP object matching the current instance.

returns `\DateInterval`

##### Examples
```php
var_dump(CarbonInterval::hours(2)->toDateInterval());
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonInterval::toPeriod

Convert the interval to a CarbonPeriod.

##### Parameters
- $params `\DateTimeInterface|string|int` Start date, [end date or recurrences] and optional settings.

returns `\CarbonPeriod`

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 2.0.0   | `$params`      |
| Method added      | 1.29.0  | *no arguments* |

----------

#### CarbonInterval::total

Get amount of given unit equivalent to the interval.

##### Parameters
- $unit `string` 

returns `float`

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $unit` |
| Method added      | 1.28.0  | `$unit`        |

----------

#### CarbonInterval::translate

Translate using translation string or callback available.

##### Parameters
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `string|int|float|null` number if plural
- $translator `\TranslatorInterface|null` an optional translator to use
- $altNumbers `bool` pass true to use alternative numbers

returns `string`

| History           | Version | Description                                                                                                                                                                     |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $key, array $parameters = [], string\|int\|float\|null $number = null, ?Symfony\Contracts\Translation\TranslatorInterface $translator = null, bool $altNumbers = false` |
| Prototype changed | 2.23.0  | `string $key, array $parameters = [], $number = null, ?Symfony\Component\Translation\TranslatorInterface $translator = null, bool $altNumbers = false`                          |
| Method added      | 2.8.0   | `string $key, array $parameters = [], $number = null, ?Symfony\Component\Translation\TranslatorInterface $translator = null`                                                    |

----------

#### CarbonInterval::translateNumber

Returns the alternative number for a given integer if available in the current locale.

##### Parameters
- $number `int` 

returns `string`

| History      | Version | Description   |
|:------------ | ------- | ------------- |
| Method added | 2.23.0  | `int $number` |

----------

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

| History           | Version | Description                                                                    |
|:----------------- | ------- | ------------------------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `string $timeString, ?string $from = null, ?string $to = null, int $mode = 31` |
| Prototype changed | 2.35.0  | `$timeString, $from = null, $to = null, $mode = 31`                            |
| Method added      | 2.16.0  | `$timeString, $from = null, $to = null, $mode = 15`                            |

----------

#### CarbonInterval::translateTimeStringTo

Translate a time string from the current locale (`$date->locale()`) to another one.

##### Parameters
- $timeString `string` time string to translate
- $to `string|null` output locale of the result returned ("en" by default)

returns `string`

| History           | Version | Description                              |
|:----------------- | ------- | ---------------------------------------- |
| Prototype changed | 3.0.0   | `string $timeString, ?string $to = null` |
| Method added      | 2.16.0  | `$timeString, $to = null`                |

----------

#### CarbonInterval::translateWith

Translate using translation string or callback available.

##### Parameters
- $translator `\TranslatorInterface` an optional translator to use
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `int|float|null` number if plural

returns `string`

| History           | Version | Description                                                                                                          |
|:----------------- | ------- | -------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator, string $key, array $parameters = [], $number = null` |
| Method added      | 2.8.0   | `Symfony\Component\Translation\TranslatorInterface $translator, string $key, array $parameters = [], $number = null` |

----------

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

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 3.0.0   | `bool $monthsOverflow = true` |
| Method added      | 2.0.0   | `$monthsOverflow = true`      |

----------

#### CarbonInterval::useStrictMode

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
##### Parameters
- $strictModeEnabled `bool` 

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.0   | `bool $strictModeEnabled = true` |
| Method added      | 2.0.0   | `$strictModeEnabled = true`      |

----------

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

| History           | Version | Description                  |
|:----------------- | ------- | ---------------------------- |
| Prototype changed | 3.0.0   | `bool $yearsOverflow = true` |
| Method added      | 2.0.0   | `$yearsOverflow = true`      |

----------

#### CarbonInterval::weeksAndDays

Allow setting of weeks and days to be cumulative.

##### Parameters
- $weeks `int` Number of weeks to set
- $days `int` Number of days to set

returns `static`

| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `int $weeks, int $days` |
| Method added      | 1.18.0  | `$weeks, $days`         |

----------

#### CarbonPeriod::__construct

CarbonPeriod constructor.

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 2.0.0   | `$arguments`   |
| Method added      | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::__debugInfo

Show truthy properties on var_dump().

returns `array`

#### CarbonPeriod::__get

Get a property allowing both `DatePeriod` snakeCase and camelCase names.

##### Parameters
- $name `string` 

returns `bool|\CarbonInterface|\CarbonInterval|int|null`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.41.0  | `string $name` |

----------

#### CarbonPeriod::__isset

Check if an attribute exists on the object

##### Parameters
- $name `string` 

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.41.0  | `string $name` |

----------

#### CarbonPeriod::__serialize

Returns the values to dump on serialize() called on.

returns `array`

#### CarbonPeriod::__set_state

The __set_state handler.

returns `CarbonPeriod`

#### CarbonPeriod::__toString

Convert the date period into a string.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::__unserialize

Set locale if specified on unserialize() called.

returns `void`

#### CarbonPeriod::__wakeup

#### CarbonPeriod::addFilter

Add a filter to the stack.

| History           | Version | Description                                        |
|:----------------- | ------- | -------------------------------------------------- |
| Prototype changed | 3.0.0   | `callable\|string $callback, ?string $name = null` |
| Method added      | 1.29.0  | `$callback, $name = null`                          |

----------

#### CarbonPeriod::baseDebugInfo

Show truthy properties on var_dump().

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.0.0   | *no arguments* |

----------

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

| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `object\|string $mixin` |
| Method added      | 2.23.0  | `$mixin`                |

----------

#### CarbonPeriod::calculateEnd

Returns the end is set, else calculated from start and recurrences.

##### Parameters
- $rounding `string|null` Optional rounding 'floor', 'ceil', 'round' using the period interval.

returns `\CarbonInterface`

| History           | Version | Description                |
|:----------------- | ------- | -------------------------- |
| Prototype changed | 2.23.0  | `?string $rounding = null` |
| Method added      | 2.20.0  | *no arguments*             |

----------

#### CarbonPeriod::cast

Cast the current instance into the given class.

##### Parameters
- $className `string` The $className::instance() method will be called to cast the current object.

returns `\DatePeriod|object`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.23.0  | `string $className` |

----------

#### CarbonPeriod::ceil

Ceil the current instance second with given precision if specified (else period interval is used).

| History           | Version | Description                                                |
|:----------------- | ------- | ---------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateInterval\|string\|int\|float\|null $precision = null` |
| Method added      | 2.23.0  | `$precision = null`                                        |

----------

#### CarbonPeriod::ceilUnit

Ceil the current instance at the given unit with given precision if specified.

| History           | Version | Description                                                           |
|:----------------- | ------- | --------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $unit, DateInterval\|string\|int\|float\|null $precision = 1` |
| Method added      | 2.23.0  | `$unit, $precision = 1`                                               |

----------

#### CarbonPeriod::clone

returns `static`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.22.0  | *no arguments* |

----------

#### CarbonPeriod::contains

Return true if the given date is between start and end.

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::copy

Get a copy of the instance.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.22.0  | *no arguments* |

----------

#### CarbonPeriod::count

Count dates in the date period.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::create

Create a new instance.

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 2.0.0   | `$params`      |
| Method added      | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::createFromArray

Create a new instance from an array of parameters.

| History      | Version | Description     |
|:------------ | ------- | --------------- |
| Method added | 1.29.0  | `array $params` |

----------

#### CarbonPeriod::createFromISO8601String

#### CarbonPeriod::createFromIso

Create CarbonPeriod from ISO 8601 string.

| History           | Version | Description                         |
|:----------------- | ------- | ----------------------------------- |
| Prototype changed | 3.0.0   | `string $iso, ?int $options = null` |
| Method added      | 1.29.0  | `$iso, $options = null`             |

----------

#### CarbonPeriod::current

Return the current date.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::disableHumanDiffOption

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description            |
|:----------------- | ------- | ---------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOption` |
| Method added      | 2.0.0   | `$humanDiffOption`     |

----------

#### CarbonPeriod::enableHumanDiffOption

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description            |
|:----------------- | ------- | ---------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOption` |
| Method added      | 2.0.0   | `$humanDiffOption`     |

----------

#### CarbonPeriod::endsAfter

Determines if the end date is after another given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::endsAfterOrAt

Determines if the end date is after or the same as a given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::endsAt

Determines if the end date is the same as a given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::endsBefore

Determines if the end date is before another given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::endsBeforeOrAt

Determines if the end date is before or the same as a given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::eq

Determines if the instance is equal to another.

Warning: if options differ, instances will never be equal.

| History           | Version | Description     |
|:----------------- | ------- | --------------- |
| Prototype changed | 3.0.0   | `mixed $period` |
| Method added      | 2.22.0  | `$period`       |

----------

#### CarbonPeriod::equalTo

Determines if the instance is equal to another.

Warning: if options differ, instances will never be equal.

| History           | Version | Description     |
|:----------------- | ------- | --------------- |
| Prototype changed | 3.0.0   | `mixed $period` |
| Method added      | 2.22.0  | `$period`       |

----------

#### CarbonPeriod::excludeEndDate

Toggle EXCLUDE_END_DATE option.

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `bool $state = true` |
| Method added      | 1.29.0  | `$state = true`      |

----------

#### CarbonPeriod::excludeStartDate

Toggle EXCLUDE_START_DATE option.

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `bool $state = true` |
| Method added      | 1.29.0  | `$state = true`      |

----------

#### CarbonPeriod::executeWithLocale

Set the current locale to the given, execute the passed function, reset the locale to previous one,
then return the result of the closure (or null if the closure was void).

##### Parameters
- $locale `string` locale ex. en
- $func `callable` 

returns `mixed`

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.0   | `string $locale, callable $func` |
| Method added      | 2.0.0   | `$locale, $func`                 |

----------

#### CarbonPeriod::first

Return the first date in the date period.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::floor

Round the current instance second with given precision if specified (else period interval is used).

| History           | Version | Description                                                |
|:----------------- | ------- | ---------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateInterval\|string\|int\|float\|null $precision = null` |
| Method added      | 2.23.0  | `$precision = null`                                        |

----------

#### CarbonPeriod::floorUnit

Truncate the current instance at the given unit with given precision if specified.

| History           | Version | Description                                                           |
|:----------------- | ------- | --------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $unit, DateInterval\|string\|int\|float\|null $precision = 1` |
| Method added      | 2.23.0  | `$unit, $precision = 1`                                               |

----------

#### CarbonPeriod::follows

Return true if the current period follows a given other period (with no overlap).

For instance, [2019-08-01 -> 2019-08-12] follows [2019-07-29 -> 2019-07-31]
Note than in this example, follows() would be false if 2019-08-01 or 2019-07-31 was excluded by options.

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `mixed $period, mixed $arguments` |
| Method added      | 2.23.0  | `$period, $arguments`             |

----------

#### CarbonPeriod::forEach

Execute a given function on each date of the period.

##### Examples
```php
Carbon::create('2020-11-29')->daysUntil('2020-12-24')->forEach(function (Carbon $date) {
  echo $date->diffInDays('2020-12-25')." days before Christmas!\n";
});
```

| History      | Version | Description          |
|:------------ | ------- | -------------------- |
| Method added | 2.22.0  | `callable $callback` |

----------

#### CarbonPeriod::get

Get a property allowing both `DatePeriod` snakeCase and camelCase names.

##### Parameters
- $name `string` 

returns `bool|\CarbonInterface|\CarbonInterval|int|null`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.45.0  | `string $name` |

----------

#### CarbonPeriod::getAvailableLocales

Returns the list of internally available locales and already loaded custom locales.

(It will ignore custom translator dynamic loading.)

returns `array`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::getAvailableLocalesInfo

Returns list of Language object for each available locale. This object allow you to get the ISO name, native
name, region and variant of the locale.

returns `\Language[]`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### CarbonPeriod::getClock

#### CarbonPeriod::getDateClass

Returns iteration item date class.

returns `string`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::getDateInterval

Get the underlying date interval.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::getEndDate

Get end date of the period.

##### Parameters
- $rounding `string|null` Optional rounding 'floor', 'ceil', 'round' using the period interval.

| History           | Version | Description                |
|:----------------- | ------- | -------------------------- |
| Prototype changed | 2.23.0  | `?string $rounding = null` |
| Method added      | 1.29.0  | *no arguments*             |

----------

#### CarbonPeriod::getFallbackLocale

Get the fallback locale.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.16.0  | *no arguments* |

----------

#### CarbonPeriod::getFilters

Get filters stack.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::getHumanDiffOptions

Return default humanDiff() options (merged flags as integer).

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::getIncludedEndDate

Return the end if it's included by option, else return the end - 1 period interval.

Warning: if the period has no fixed end, this method will iterate the period to calculate it.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::getIncludedStartDate

Return the start if it's included by option, else return the start + 1 period interval.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::getIterator

#### CarbonPeriod::getLocalTranslator

Get the translator of the current instance or the default if none set.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::getLocale

Get the current translator locale.

returns `string`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::getOptions

Get the period options.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::getRecurrences

Get number of recurrences.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::getSettings

Returns current local settings.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.3.0   | *no arguments* |

----------

#### CarbonPeriod::getStartDate

Get start date of the period.

##### Parameters
- $rounding `string|null` Optional rounding 'floor', 'ceil', 'round' using the period interval.

| History           | Version | Description                |
|:----------------- | ------- | -------------------------- |
| Prototype changed | 2.23.0  | `?string $rounding = null` |
| Method added      | 1.29.0  | *no arguments*             |

----------

#### CarbonPeriod::getTranslationMessage

Returns raw translation message for a given key.

##### Parameters
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key
- $translator `\TranslatorInterface` an optional translator to use

returns `string`

| History      | Version | Description                                                                        |
|:------------ | ------- | ---------------------------------------------------------------------------------- |
| Method added | 2.8.0   | `string $key, ?string $locale = null, ?string $default = null, $translator = null` |

----------

#### CarbonPeriod::getTranslationMessageWith

Returns raw translation message for a given key.

##### Parameters
- $translator `\TranslatorInterface|null` the translator to use
- $key `string` key to find
- $locale `string|null` current locale used if null
- $default `string|null` default value if translation returns the key

returns `string|\Closure|null`

| History      | Version | Description                                                                 |
|:------------ | ------- | --------------------------------------------------------------------------- |
| Method added | 2.8.0   | `$translator, string $key, ?string $locale = null, ?string $default = null` |

----------

#### CarbonPeriod::getTranslator

Initialize the default translator instance if necessary.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::hasFilter

Return whether given instance or name is in the filter stack.

| History           | Version | Description                |
|:----------------- | ------- | -------------------------- |
| Prototype changed | 3.0.0   | `callable\|string $filter` |
| Method added      | 1.29.0  | `$filter`                  |

----------

#### CarbonPeriod::hasLocalTranslator

Return true if the current instance has its own translator.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.29.0  | *no arguments* |

----------

#### CarbonPeriod::hasMacro

Check if macro is registered.

| History           | Version | Description    |
|:----------------- | ------- | -------------- |
| Prototype changed | 3.0.0   | `string $name` |
| Method added      | 1.29.0  | `$name`        |

----------

#### CarbonPeriod::instance

Create a new instance from a DatePeriod or CarbonPeriod object.

| History           | Version | Description     |
|:----------------- | ------- | --------------- |
| Prototype changed | 3.0.0   | `mixed $period` |
| Method added      | 2.22.0  | `$period`       |

----------

#### CarbonPeriod::invertDateInterval

Invert the period date interval.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::isConsecutiveWith

Return true if the given period either follows or is followed by the current one.

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `mixed $period, mixed $arguments` |
| Method added      | 2.23.0  | `$period, $arguments`             |

----------

#### CarbonPeriod::isEndExcluded

Returns true if the end date should be excluded.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::isEndIncluded

Returns true if the end date should be included.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::isEnded

Return true if end date is now or later.

(Rather start/end are included by options is ignored.)

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::isFollowedBy

Return true if the given other period follows the current one (with no overlap).

For instance, [2019-07-29 -> 2019-07-31] is followed by [2019-08-01 -> 2019-08-12]
Note than in this example, isFollowedBy() would be false if 2019-08-01 or 2019-07-31 was excluded by options.

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `mixed $period, mixed $arguments` |
| Method added      | 2.23.0  | `$period, $arguments`             |

----------

#### CarbonPeriod::isInProgress

Return true if now is between start date (included) and end date (excluded).

(Rather start/end are included by options is ignored.)

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::isStartExcluded

Returns true if the start date should be excluded.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::isStartIncluded

Returns true if the start date should be included.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::isStarted

Return true if start date is now or later.

(Rather start/end are included by options is ignored.)

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::isStrictModeEnabled

Returns true if the strict mode is globally in use, false else.

(It can be overridden in specific instances.)

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::isUnfilteredAndEndLess

Return `true` if the period has no custom filter and is guaranteed to be endless.

Note that we can't check if a period is endless as soon as it has custom filters
because filters can emit `CarbonPeriod::END_ITERATION` to stop the iteration in
a way we can't predict without actually iterating the period.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.59.0  | *no arguments* |

----------

#### CarbonPeriod::jsonSerialize

Specify data which should be serialized to JSON.

returns `\CarbonInterface[]`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::key

Return the current key.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::last

Return the last date in the date period.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::locale

Get/set the locale for the current instance.

##### Parameters
- $locale `string|null` 
- $fallbackLocales `string` 

returns `$this|string`

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `?string $locale = null, string $fallbackLocales` |
| Prototype changed | 2.16.0  | `?string $locale = null, $fallbackLocales`        |
| Method added      | 2.0.0   | `?string $locale = null`                          |

----------

#### CarbonPeriod::localeHasDiffOneDayWords

Returns true if the given locale is internally supported and has words for 1-day diff (just now, yesterday, tomorrow).

Support is considered enabled if the 3 words are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

#### CarbonPeriod::localeHasDiffSyntax

Returns true if the given locale is internally supported and has diff syntax support (ago, from now, before, after).

Support is considered enabled if the 4 sentences are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

#### CarbonPeriod::localeHasDiffTwoDayWords

Returns true if the given locale is internally supported and has words for 2-days diff (before yesterday, after tomorrow).

Support is considered enabled if the 2 words are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

#### CarbonPeriod::localeHasPeriodSyntax

Returns true if the given locale is internally supported and has period syntax support (X times, every X, from X, to X).

Support is considered enabled if the 4 sentences are translated in the given locale.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 2.0.0   | `$locale`   |

----------

#### CarbonPeriod::localeHasShortUnits

Returns true if the given locale is internally supported and has short-units support.

Support is considered enabled if either year, day or hour has a short variant translated.

##### Parameters
- $locale `string` locale ex. en

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

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

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.1   | `string $name, ?callable $macro` |
| Prototype changed | 3.0.0   | `string $name, $macro`           |
| Method added      | 1.29.0  | `$name, $macro`                  |

----------

#### CarbonPeriod::make

Make a CarbonPeriod instance from given variable if possible.

| History           | Version | Description  |
|:----------------- | ------- | ------------ |
| Prototype changed | 3.0.0   | `mixed $var` |
| Method added      | 2.22.0  | `$var`       |

----------

#### CarbonPeriod::map

Execute a given function on each date of the period and yield the result of this function.

##### Examples
```php
$period = Carbon::create('2020-11-29')->daysUntil('2020-12-24');
echo implode("\n", iterator_to_array($period->map(function (Carbon $date) {
  return $date->diffInDays('2020-12-25').' days before Christmas!';
})));
```

| History      | Version | Description          |
|:------------ | ------- | -------------------- |
| Method added | 2.22.0  | `callable $callback` |

----------

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

| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `object\|string $mixin` |
| Method added      | 1.29.0  | `$mixin`                |

----------

#### CarbonPeriod::ne

Determines if the instance is not equal to another.

Warning: if options differ, instances will never be equal.

| History           | Version | Description     |
|:----------------- | ------- | --------------- |
| Prototype changed | 3.0.0   | `mixed $period` |
| Method added      | 2.22.0  | `$period`       |

----------

#### CarbonPeriod::next

Move forward to the next date.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::notEqualTo

Determines if the instance is not equal to another.

Warning: if options differ, instances will never be equal.

| History           | Version | Description     |
|:----------------- | ------- | --------------- |
| Prototype changed | 3.0.0   | `mixed $period` |
| Method added      | 2.22.0  | `$period`       |

----------

#### CarbonPeriod::overlaps

Returns true if the current period overlaps the given one (if 1 parameter passed)
or the period between 2 dates (if 2 parameters passed).

##### Parameters
- $rangeOrRangeStart `\CarbonPeriod|\DateTimeInterface|\Carbon|\CarbonImmutable|string` 
- $rangeEnd `\DateTimeInterface|\Carbon|\CarbonImmutable|string|null` 

returns `bool`

| History           | Version | Description                                        |
|:----------------- | ------- | -------------------------------------------------- |
| Prototype changed | 3.0.0   | `mixed $rangeOrRangeStart, mixed $rangeEnd = null` |
| Method added      | 2.20.0  | `$rangeOrRangeStart, $rangeEnd = null`             |

----------

#### CarbonPeriod::prependFilter

Prepend a filter to the stack.

| History           | Version | Description                                        |
|:----------------- | ------- | -------------------------------------------------- |
| Prototype changed | 3.0.0   | `callable\|string $callback, ?string $name = null` |
| Method added      | 1.29.0  | `$callback, $name = null`                          |

----------

#### CarbonPeriod::removeFilter

Remove a filter by instance or name.

| History           | Version | Description                |
|:----------------- | ------- | -------------------------- |
| Prototype changed | 3.0.0   | `callable\|string $filter` |
| Method added      | 1.29.0  | `$filter`                  |

----------

#### CarbonPeriod::resetDateInterval

Reset the date interval to the default value.

Difference with simply setting interval to 1-day is that P1D will not appear when calling toIso8601String()
and also next adding to the interval won't include the default 1-day.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 3.0.0   | *no arguments* |

----------

#### CarbonPeriod::resetFilters

Reset filters stack.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::resetMonthsOverflow

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::resetToStringFormat

Reset the format used to the default when type juggling a Carbon instance to a string

returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.63.0  | *no arguments* |

----------

#### CarbonPeriod::resetYearsOverflow

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
are available for quarters, years, decade, centuries, millennia (singular and plural forms).
:::
returns `void`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::rewind

Rewind to the start date.

Iterating over a date in the UTC timezone avoids bug during backward DST change.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::round

Round the current instance second with given precision if specified (else period interval is used).

| History           | Version | Description                                                                                      |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `DateInterval\|string\|int\|float\|null $precision = null, callable\|string $function = 'round'` |
| Method added      | 2.23.0  | `$precision = null, $function = 'round'`                                                         |

----------

#### CarbonPeriod::roundUnit

Round the current instance at the given unit with given precision if specified and the given function.

| History           | Version | Description                                                                                                 |
|:----------------- | ------- | ----------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $unit, DateInterval\|string\|int\|float\|null $precision = 1, callable\|string $function = 'round'` |
| Method added      | 2.23.0  | `$unit, $precision = 1, $function = 'round'`                                                                |

----------

#### CarbonPeriod::setDateClass

Set the iteration item class.

##### Parameters
- $dateClass `string` 

returns `static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.0.0   | `string $dateClass` |

----------

#### CarbonPeriod::setDateInterval

Change the period date interval.

##### Parameters
- $interval `\DateInterval|\Unit|string|int` 
- $unit `\Unit|string` the unit of $interval if it's a number

returns `static`

| History           | Version | Description                                               |
|:----------------- | ------- | --------------------------------------------------------- |
| Prototype changed | 3.0.0   | `mixed $interval, Carbon\Unit\|string\|null $unit = null` |
| Method added      | 1.29.0  | `$interval`                                               |

----------

#### CarbonPeriod::setDates

Set start and end date.

##### Parameters
- $start `\DateTime|\DateTimeInterface|string` 
- $end `\DateTime|\DateTimeInterface|string|null` 

returns `static`

| History           | Version | Description                |
|:----------------- | ------- | -------------------------- |
| Prototype changed | 3.0.0   | `mixed $start, mixed $end` |
| Method added      | 1.29.0  | `$start, $end`             |

----------

#### CarbonPeriod::setEndDate

Change the period end date.

##### Parameters
- $date `\DateTime|\DateTimeInterface|string|null` 
- $inclusive `bool|null` 

returns `static`

| History           | Version | Description                            |
|:----------------- | ------- | -------------------------------------- |
| Prototype changed | 3.0.0   | `mixed $date, ?bool $inclusive = null` |
| Method added      | 1.29.0  | `$date, $inclusive = null`             |

----------

#### CarbonPeriod::setFallbackLocale

Set the fallback locale.

##### Parameters
- $locale `string` 

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.16.0  | `$locale`        |

----------

#### CarbonPeriod::setFilters

Set filters stack.

| History      | Version | Description      |
|:------------ | ------- | ---------------- |
| Method added | 1.29.0  | `array $filters` |

----------

#### CarbonPeriod::setHumanDiffOptions

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
| History           | Version | Description             |
|:----------------- | ------- | ----------------------- |
| Prototype changed | 3.0.0   | `int $humanDiffOptions` |
| Method added      | 2.0.0   | `$humanDiffOptions`     |

----------

#### CarbonPeriod::setLocalTranslator

Set the translator for the current instance.

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator` |
| Method added      | 2.0.0   | `Symfony\Component\Translation\TranslatorInterface $translator` |

----------

#### CarbonPeriod::setLocale

Set the current translator locale and indicate if the source locale file exists.

Pass 'auto' as locale to use the closest language to the current LC_TIME locale.

##### Parameters
- $locale `string` locale ex. en

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `string $locale` |
| Method added      | 2.0.0   | `$locale`        |

----------

#### CarbonPeriod::setOptions

Change the period options.

##### Parameters
- $options `int|null` 

returns `static`

| History           | Version | Description     |
|:----------------- | ------- | --------------- |
| Prototype changed | 3.0.0   | `?int $options` |
| Method added      | 1.29.0  | `$options`      |

----------

#### CarbonPeriod::setRecurrences

Add a recurrences filter (set maximum number of recurrences).

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `int\|float\|null $recurrences` |
| Method added      | 1.29.0  | `$recurrences`                  |

----------

#### CarbonPeriod::setStartDate

Change the period start date.

##### Parameters
- $date `\DateTime|\DateTimeInterface|string` 
- $inclusive `bool|null` 

returns `static`

| History           | Version | Description                            |
|:----------------- | ------- | -------------------------------------- |
| Prototype changed | 3.0.0   | `mixed $date, ?bool $inclusive = null` |
| Method added      | 1.29.0  | `$date, $inclusive = null`             |

----------

#### CarbonPeriod::setTimezone

Set the instance's timezone from a string or object and apply it to start/end.

| History           | Version | Description                           |
|:----------------- | ------- | ------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int $timezone` |
| Method added      | 2.52.0  | `$timezone`                           |

----------

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

| History           | Version | Description                     |
|:----------------- | ------- | ------------------------------- |
| Prototype changed | 3.0.0   | `Closure\|string\|null $format` |
| Method added      | 2.63.0  | `$format`                       |

----------

#### CarbonPeriod::setTranslator

Set the default translator instance to use.

##### Parameters
- $translator `\TranslatorInterface` 

returns `void`

| History           | Version | Description                                                     |
|:----------------- | ------- | --------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator` |
| Method added      | 2.0.0   | `Symfony\Component\Translation\TranslatorInterface $translator` |

----------

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

| History      | Version | Description       |
|:------------ | ------- | ----------------- |
| Method added | 2.0.0   | `array $settings` |

----------

#### CarbonPeriod::shiftTimezone

Set the instance's timezone from a string or object and add/subtract the offset difference to start/end.

| History           | Version | Description                           |
|:----------------- | ------- | ------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int $timezone` |
| Method added      | 2.3.0   | `$timezone`                           |

----------

#### CarbonPeriod::shouldOverflowMonths

Get the month overflow global behavior (can be overridden in specific instances).

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::shouldOverflowYears

Get the month overflow global behavior (can be overridden in specific instances).

returns `bool`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### CarbonPeriod::skip

Skip iterations and returns iteration state (false if ended, true if still valid).

##### Parameters
- $count `int` steps number to skip (1 by default)

returns `bool`

| History           | Version | Description      |
|:----------------- | ------- | ---------------- |
| Prototype changed | 3.0.0   | `int $count = 1` |
| Method added      | 1.30.0  | `$count = 1`     |

----------

#### CarbonPeriod::spec

Format the date period as ISO 8601.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::startsAfter

Determines if the start date is after another given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::startsAfterOrAt

Determines if the start date is after or the same as a given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::startsAt

Determines if the start date is the same as a given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::startsBefore

Determines if the start date is before another given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::startsBeforeOrAt

Determines if the start date is before or the same as a given date.

(Rather start/end are included by options is ignored.)

| History           | Version | Description          |
|:----------------- | ------- | -------------------- |
| Prototype changed | 3.0.0   | `mixed $date = null` |
| Method added      | 2.23.0  | `$date = null`       |

----------

#### CarbonPeriod::toArray

Convert the date period into an array without changing current iteration state.

returns `\CarbonInterface[]`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::toDatePeriod

Return native DatePeriod PHP object matching the current instance.

##### Examples
```php
var_dump(CarbonPeriod::create('2021-01-05', '2021-02-15')->toDatePeriod());
```

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.23.0  | *no arguments* |

----------

#### CarbonPeriod::toIso8601String

Format the date period as ISO 8601.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::toString

Convert the date period into a string.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonPeriod::toggleOptions

Toggle given options on or off.

##### Parameters
- $options `int` 
- $state `bool|null` 

returns `static`

| History           | Version | Description                         |
|:----------------- | ------- | ----------------------------------- |
| Prototype changed | 3.0.0   | `int $options, ?bool $state = null` |
| Method added      | 1.29.0  | `$options, $state = null`           |

----------

#### CarbonPeriod::translate

Translate using translation string or callback available.

##### Parameters
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `string|int|float|null` number if plural
- $translator `\TranslatorInterface|null` an optional translator to use
- $altNumbers `bool` pass true to use alternative numbers

returns `string`

| History           | Version | Description                                                                                                                                                                     |
|:----------------- | ------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `string $key, array $parameters = [], string\|int\|float\|null $number = null, ?Symfony\Contracts\Translation\TranslatorInterface $translator = null, bool $altNumbers = false` |
| Prototype changed | 2.23.0  | `string $key, array $parameters = [], $number = null, ?Symfony\Component\Translation\TranslatorInterface $translator = null, bool $altNumbers = false`                          |
| Method added      | 2.8.0   | `string $key, array $parameters = [], $number = null, ?Symfony\Component\Translation\TranslatorInterface $translator = null`                                                    |

----------

#### CarbonPeriod::translateNumber

Returns the alternative number for a given integer if available in the current locale.

##### Parameters
- $number `int` 

returns `string`

| History      | Version | Description   |
|:------------ | ------- | ------------- |
| Method added | 2.23.0  | `int $number` |

----------

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

| History           | Version | Description                                                                    |
|:----------------- | ------- | ------------------------------------------------------------------------------ |
| Prototype changed | 3.0.0   | `string $timeString, ?string $from = null, ?string $to = null, int $mode = 31` |
| Prototype changed | 2.35.0  | `$timeString, $from = null, $to = null, $mode = 31`                            |
| Method added      | 2.16.0  | `$timeString, $from = null, $to = null, $mode = 15`                            |

----------

#### CarbonPeriod::translateTimeStringTo

Translate a time string from the current locale (`$date->locale()`) to another one.

##### Parameters
- $timeString `string` time string to translate
- $to `string|null` output locale of the result returned ("en" by default)

returns `string`

| History           | Version | Description                              |
|:----------------- | ------- | ---------------------------------------- |
| Prototype changed | 3.0.0   | `string $timeString, ?string $to = null` |
| Method added      | 2.16.0  | `$timeString, $to = null`                |

----------

#### CarbonPeriod::translateWith

Translate using translation string or callback available.

##### Parameters
- $translator `\TranslatorInterface` an optional translator to use
- $key `string` key to find
- $parameters `array` replacement parameters
- $number `int|float|null` number if plural

returns `string`

| History           | Version | Description                                                                                                          |
|:----------------- | ------- | -------------------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `Symfony\Contracts\Translation\TranslatorInterface $translator, string $key, array $parameters = [], $number = null` |
| Method added      | 2.8.0   | `Symfony\Component\Translation\TranslatorInterface $translator, string $key, array $parameters = [], $number = null` |

----------

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

| History           | Version | Description                   |
|:----------------- | ------- | ----------------------------- |
| Prototype changed | 3.0.0   | `bool $monthsOverflow = true` |
| Method added      | 2.0.0   | `$monthsOverflow = true`      |

----------

#### CarbonPeriod::useStrictMode

::: warning Deprectated 
To avoid conflict between different third-party libraries, static setters should not be used.
You should rather use the ->settings() method.
:::
##### Parameters
- $strictModeEnabled `bool` 

| History           | Version | Description                      |
|:----------------- | ------- | -------------------------------- |
| Prototype changed | 3.0.0   | `bool $strictModeEnabled = true` |
| Method added      | 2.0.0   | `$strictModeEnabled = true`      |

----------

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

| History           | Version | Description                  |
|:----------------- | ------- | ---------------------------- |
| Prototype changed | 3.0.0   | `bool $yearsOverflow = true` |
| Method added      | 2.0.0   | `$yearsOverflow = true`      |

----------

#### CarbonPeriod::valid

Check if the current position is valid.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.29.0  | *no arguments* |

----------

#### CarbonTimeZone::__construct

Create a new Carbon instance.

Please see the testing aids section (specifically static::setTestNow())
for more on the possibility of this constructor returning a test instance.

#### CarbonTimeZone::__serialize

Returns the values to dump on serialize() called on.

returns `array`

#### CarbonTimeZone::__set_state

The __set_state handler.

returns `CarbonTimeZone`

#### CarbonTimeZone::__toString

Cast to string (get timezone name).

returns `string`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.0  | *no arguments* |

----------

#### CarbonTimeZone::__unserialize

Set locale if specified on unserialize() called.

returns `void`

#### CarbonTimeZone::__wakeup

#### CarbonTimeZone::cast

Cast the current instance into the given class.

##### Parameters
- $className `class-string<\DateTimeZone>` The $className::instance() method will be called to cast the current object.

returns `\DateTimeZone|mixed`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.23.0  | `string $className` |

----------

#### CarbonTimeZone::create

Create a CarbonTimeZone from mixed input.

##### Parameters
- $object `\DateTimeZone|string|int|null` 

returns `false|static`

| History      | Version | Description      |
|:------------ | ------- | ---------------- |
| Method added | 2.0.0   | `$object = null` |

----------

#### CarbonTimeZone::createFromHourOffset

Create a CarbonTimeZone from int/float hour offset.

##### Parameters
- $hourOffset `float` number of hour of the timezone shift (can be decimal).

returns `false|static`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.33.0  | `float $hourOffset` |

----------

#### CarbonTimeZone::createFromMinuteOffset

Create a CarbonTimeZone from int/float minute offset.

##### Parameters
- $minuteOffset `float` number of total minutes of the timezone shift.

returns `false|static`

| History      | Version | Description           |
|:------------ | ------- | --------------------- |
| Method added | 2.33.0  | `float $minuteOffset` |

----------

#### CarbonTimeZone::getAbbr

##### Parameters
- $dst `bool` 

returns `string`

| History           | Version | Description         |
|:----------------- | ------- | ------------------- |
| Prototype changed | 3.0.0   | `bool $dst = false` |
| Method added      | 2.0.0   | `$dst = false`      |

----------

#### CarbonTimeZone::getAbbreviatedName

Returns abbreviated name of the current timezone according to DST setting.

##### Parameters
- $dst `bool` 

returns `string`

| History           | Version | Description         |
|:----------------- | ------- | ------------------- |
| Prototype changed | 3.0.0   | `bool $dst = false` |
| Method added      | 2.0.0   | `$dst = false`      |

----------

#### CarbonTimeZone::getClock

#### CarbonTimeZone::getLocation

#### CarbonTimeZone::getName

#### CarbonTimeZone::getOffset

#### CarbonTimeZone::getOffsetNameFromMinuteOffset

Convert a total minutes offset into a standardized timezone offset string.

##### Parameters
- $minutes `float` number of total minutes of the timezone shift.

returns `string`

| History      | Version | Description      |
|:------------ | ------- | ---------------- |
| Method added | 2.33.0  | `float $minutes` |

----------

#### CarbonTimeZone::getTransitions

#### CarbonTimeZone::getType

Return the type number:

Type 1; A UTC offset, such as -0300
Type 2; A timezone abbreviation, such as GMT
Type 3: A timezone identifier, such as Europe/London

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.61.0  | *no arguments* |

----------

#### CarbonTimeZone::instance

Create a CarbonTimeZone from mixed input.

##### Parameters
- $object `\DateTimeZone|string|int|false|null` original value to get CarbonTimeZone from it.
- $objectDump `\DateTimeZone|string|int|false|null` dump of the object for error messages.

returns `static|null`

| History           | Version | Description                                                                                                 |
|:----------------- | ------- | ----------------------------------------------------------------------------------------------------------- |
| Prototype changed | 3.0.0   | `DateTimeZone\|string\|int\|false\|null $object, DateTimeZone\|string\|int\|false\|null $objectDump = null` |
| Prototype changed | 2.10.0  | `$object = null, $objectDump = null`                                                                        |
| Method added      | 2.0.0   | `$object = null`                                                                                            |

----------

#### CarbonTimeZone::listAbbreviations

#### CarbonTimeZone::listIdentifiers

#### CarbonTimeZone::toOffsetName

Get the offset as string "sHH:MM" (such as "+00:00" or "-12:30").

| History      | Version | Description                       |
|:------------ | ------- | --------------------------------- |
| Method added | 2.10.0  | `?DateTimeInterface $date = null` |

----------

#### CarbonTimeZone::toOffsetTimeZone

Returns a new CarbonTimeZone object using the offset string instead of region string.

| History      | Version | Description                       |
|:------------ | ------- | --------------------------------- |
| Method added | 2.10.0  | `?DateTimeInterface $date = null` |

----------

#### CarbonTimeZone::toRegionName

Returns the first region string (such as "America/Toronto") that matches the current timezone or
false if no match is found.

| History           | Version | Description                                       |
|:----------------- | ------- | ------------------------------------------------- |
| Prototype changed | 3.0.0   | `?DateTimeInterface $date = null, int $isDST = 1` |
| Method added      | 2.10.0  | `?DateTimeInterface $date = null, $isDst = 1`     |

----------

#### CarbonTimeZone::toRegionTimeZone

Returns a new CarbonTimeZone object using the region string instead of offset string.

| History      | Version | Description                       |
|:------------ | ------- | --------------------------------- |
| Method added | 2.10.0  | `?DateTimeInterface $date = null` |

----------

#### Language::__construct

Create a new Carbon instance.

Please see the testing aids section (specifically static::setTestNow())
for more on the possibility of this constructor returning a test instance.

#### Language::__toString

Returns the original locale ID.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::all

Get the list of the known languages.

returns `array`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getCode

Returns the code of the locale "en"/"fr".

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getFullIsoDescription

Get a string with long ISO name, region in parentheses if applicable, variant in parentheses if applicable.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getFullIsoName

Returns the long ISO language name.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getFullNativeDescription

Get a string with long native name, region in parentheses if applicable, variant in parentheses if applicable.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getFullNativeName

Return the full name of the language in this language.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getId

Returns the original locale ID.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getIsoDescription

Get a string with short ISO name, region in parentheses if applicable, variant in parentheses if applicable.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getIsoName

Returns the short ISO language name.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getNames

Get both isoName and nativeName as an array.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getNativeDescription

Get a string with short native name, region in parentheses if applicable, variant in parentheses if applicable.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getNativeName

Get the short name of the language in this language.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getRegion

Returns the region part of the locale.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getRegionName

Returns the region name for the current language.

⚠ ISO 3166-2 short name provided with no warranty, should not
be used for any purpose to show official state names.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getVariant

Returns the variant code such as cyrl/latn.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::getVariantName

Returns the variant such as Cyrillic/Latin.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::jsonSerialize

Get a string with short ISO name, region in parentheses if applicable, variant in parentheses if applicable.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::regions

Get the list of the known regions.

⚠ ISO 3166-2 short name provided with no warranty, should not
be used for any purpose to show official state names.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.10.1  | *no arguments* |

----------

#### Language::setIsoName

Set the ISO language name.

| History      | Version | Description       |
|:------------ | ------- | ----------------- |
| Method added | 2.10.1  | `string $isoName` |

----------

#### Language::setNativeName

Set the name of the language in this language.

| History      | Version | Description          |
|:------------ | ------- | -------------------- |
| Method added | 2.10.1  | `string $nativeName` |

----------

#### Translator::__construct

Create a new Carbon instance.

Please see the testing aids section (specifically static::setTestNow())
for more on the possibility of this constructor returning a test instance.

#### Translator::__debugInfo

Show locale on var_dump().

returns `array`

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.17.0  | *no arguments* |

----------

#### Translator::__serialize

Returns the values to dump on serialize() called on.

returns `array`

#### Translator::__unserialize

Set locale if specified on unserialize() called.

returns `void`

#### Translator::addDirectory

Add a directory to the list translation files are searched in.

##### Parameters
- $directory `string` new directory

returns `$this`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.0.0   | `string $directory` |

----------

#### Translator::addGlobalParameter

#### Translator::addLoader

Adds a Loader.

##### Parameters
- $format `string` The name of the loader (@see addResource())

| History           | Version | Description                                                                    |
|:----------------- | ------- | ------------------------------------------------------------------------------ |
| Prototype changed | 2.27.0  | `string $format, Symfony\Component\Translation\Loader\LoaderInterface $loader` |
| Method added      | 1.25.0  | `$format, Symfony\Component\Translation\Loader\LoaderInterface $loader`        |

----------

#### Translator::addResource

Adds a Resource.

##### Parameters
- $format `string` The name of the loader (@see addLoader())
- $resource `mixed` The resource name

| History           | Version | Description                                                               |
|:----------------- | ------- | ------------------------------------------------------------------------- |
| Prototype changed | 2.55.0  | `string $format, mixed $resource, string $locale, ?string $domain = null` |
| Prototype changed | 2.27.0  | `string $format, $resource, string $locale, ?string $domain = null`       |
| Method added      | 1.25.0  | `$format, $resource, $locale, $domain = null`                             |

----------

#### Translator::get

Return a singleton instance of Translator.

##### Parameters
- $locale `string|null` optional initial locale ("en" - english by default)

returns `static`

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 3.0.0   | `?string $locale = null` |
| Method added      | 1.25.0  | `$locale = null`         |

----------

#### Translator::getAvailableLocales

Returns the list of internally available locales and already loaded custom locales.

(It will ignore custom translator dynamic loading.)

##### Parameters
- $prefix `string` prefix required to filter result

returns `array`

| History           | Version | Description           |
|:----------------- | ------- | --------------------- |
| Prototype changed | 3.0.0   | `string $prefix = ''` |
| Method added      | 2.0.0   | `$prefix = ''`        |

----------

#### Translator::getCatalogue

#### Translator::getCatalogues

#### Translator::getDirectories

Returns the list of directories translation files are searched in.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 2.0.0   | *no arguments* |

----------

#### Translator::getFallbackLocales

Gets the fallback locales.

| History      | Version | Description    |
|:------------ | ------- | -------------- |
| Method added | 1.25.0  | *no arguments* |

----------

#### Translator::getFromCatalogue

@param mixed                                                    $translator

returns `mixed`

#### Translator::getGlobalParameters

#### Translator::getLocale

Get the current translator locale.

returns `string`

#### Translator::getLocalesFiles

Returns the list of files matching a given locale prefix (or all if empty).

##### Parameters
- $prefix `string` prefix required to filter result

returns `array`

| History           | Version | Description           |
|:----------------- | ------- | --------------------- |
| Prototype changed | 3.0.0   | `string $prefix = ''` |
| Method added      | 2.0.0   | `$prefix = ''`        |

----------

#### Translator::getMessages

Get messages of a locale, if none given, return all the
languages.

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 3.0.0   | `?string $locale = null` |
| Method added      | 1.25.0  | `$locale = null`         |

----------

#### Translator::removeDirectory

Remove a directory from the list translation files are searched in.

##### Parameters
- $directory `string` directory path

returns `$this`

| History      | Version | Description         |
|:------------ | ------- | ------------------- |
| Method added | 2.0.0   | `string $directory` |

----------

#### Translator::resetMessages

Reset messages of a locale (all locale if no locale passed).

Remove custom messages and reload initial messages from matching
file in Lang directory.

| History           | Version | Description              |
|:----------------- | ------- | ------------------------ |
| Prototype changed | 3.0.0   | `?string $locale = null` |
| Method added      | 1.25.0  | `$locale = null`         |

----------

#### Translator::setConfigCacheFactory

#### Translator::setDirectories

Set list of directories translation files are searched in.

##### Parameters
- $directories `array` new directories list

returns `$this`

| History      | Version | Description          |
|:------------ | ------- | -------------------- |
| Method added | 2.0.0   | `array $directories` |

----------

#### Translator::setFallbackLocales

Sets the fallback locales.

##### Parameters
- $locales `string[]` 

| History      | Version | Description      |
|:------------ | ------- | ---------------- |
| Method added | 1.25.0  | `array $locales` |

----------

#### Translator::setLocale

Set the current translator locale and indicate if the source locale file exists

##### Parameters
- $locale `string` locale ex. en

| History      | Version | Description |
|:------------ | ------- | ----------- |
| Method added | 1.25.0  | `$locale`   |

----------

#### Translator::setMessages

Set messages of a locale and take file first if present.

##### Parameters
- $locale `string` 
- $messages `array` 

returns `$this`

| History           | Version | Description                       |
|:----------------- | ------- | --------------------------------- |
| Prototype changed | 3.0.0   | `string $locale, array $messages` |
| Method added      | 1.25.0  | `$locale, $messages`              |

----------

#### Translator::setTranslations

Set messages of the current locale and take file first if present.

##### Parameters
- $messages `array` 

returns `$this`

| History           | Version | Description       |
|:----------------- | ------- | ----------------- |
| Prototype changed | 3.0.0   | `array $messages` |
| Method added      | 2.9.0   | `$messages`       |

----------

#### Translator::trans

