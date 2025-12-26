---
order: 5
---
# Migration
## Migrate to Carbon 3

If you plan to migrate from Carbon 2 to Carbon 3, please note the following breaking changes you should take care of.

### createFromTimestamp UTC by default

Timezone for `createFromTimestamp` was previously `date_default_timezone_get()` in Carbon 2.

In Carbon 3, it's now `"UTC"` so to be consistent with `DateTime` behavior when doing `new DateTime('@123')`.

Those who use UTC as default timezone will not be impacted. As a reminder we strongly recommend this setup. See [timezone section](../specialized-use/carbon-time-zone.html)

We also recommend to always call `createFromTimestamp` with 2 parameters (i.e. explicitly pass a timezone) or to use `createFromTimestampUTC()`.

### diffIn\*

Yes, the most impactful change is in `diffIn*` methods. They were returning positive integer by default, they will now return float:

```php
$after = Carbon::now()->addSeconds(2);
$before = Carbon::now();

var_dump($after->diffInSeconds($before));
```

This was: `int(1)` in Carbon 2

This is: `double(-1.999508)` in Carbon 3

In Carbon 3, using `(int) $after->diffInSeconds($before, true)` or `(int) abs($after->diffInSeconds($before))` allows to get explicitly an absolute and truncated value, so the same result as in v2.

### Strong typing

Strong typing added in many method parameters will disallow so usages that was never meant to be supported such as `bool` or `null` in comparison methods.

In Carbon v2 the following return arbitrary results (despite it emits `E_USER_DEPRECATED` notices):

```php{no-render}
var_dump($date->eq(false)); // false
var_dump($date->gte(false)); // true
var_dump($date->gt(false)); // true
var_dump($date->eq(null)); // false
var_dump($date->gte(null)); // true
var_dump($date->gt(null)); // true
```

In Carbon v3, PHPDoc is moving to real types so any of this will throw a `TypeError`, it expects `DateTimeInterface` or `string` to be passed.

### falsable => nullable

`create`, `createFromFormat` , `createFromIsoFormat`, `createFromLocaleFormat` and `createFromLocaleIsoFormat` returned `Carbon|false`, it's now `Carbon|null` (unlocking `?->` chaining and `?? throw` error handling).

### Removal of some deprecated methods

`setUtf8` are `formatLocalized` removed. `formatLocalized` depends on OS language package and relies on `setlocale()` + `strftime()` (the last will be removed from PHP itself). `->isoFormat()` should be used instead which is embedded translation files (so one can rely on getting the same translation everywhere) and is linked to Carbon locale (The current object locale that can be set with `$date->locale('de')` or if not set, the global one that Laravel is already setting using `Carbon::setLocale('de')`). And `setUtf8` is no longer needed since `formatLocalized` is the only method that possibly had non-UTF-8 output.

`setWeekStartsAt` and `setWeekEndsAt` are also removed. You should either specify the day explictly when calling `startOfWeek`, for instance: `->startOfWeek(\Carbon\WeekDay::Wednesday)` or change the locale appriopriately, for instance `->locale('en_US')->startOfWeek()` goes to Sunday, while `->locale('en_GB')->startOfWeek()` goes to Monday, `ar_EG` locale sets it to Saturday, etc.

Note that you can also create custom locales with a different start of week:

```php
\Carbon\Translator::get('en_US@Cinema')->setTranslations([
	'first_day_of_week' => Carbon::FRIDAY,
]);

\Carbon\Translator::get('fr_FR@Cinema')->setTranslations([
	'first_day_of_week' => Carbon::WEDNESDAY,
]);

echo CarbonImmutable::now()->locale('fr_FR')->startOfWeek()->dayName;
echo CarbonImmutable::now()->locale('fr_FR@Cinema')->startOfWeek()->dayName;
echo CarbonImmutable::now()->locale('en_US')->startOfWeek()->dayName;
echo CarbonImmutable::now()->locale('en_US@Cinema')->startOfWeek()->dayName;

```

### Strict timezone

All named argument `tz:` have been replaced with `timezone:` for explicitness and consistency with `DateTime` methods.

It's no longer possible to create a `CarbonTimeZone` object with 0 arguments, the name is now mandatory to construct it.

Creating timezone with a bad/unknown name will now always throw an exception, it's no longer possible to mute them by disabling strict-mode.

### Immutable start and end properties of CarbonPeriod

`CarbonPeriod` now extends `DatePeriod` so it can now conveniently substitute it anywhere a `DatePeriod` is expected. However, it also inherits the constraint that `->start` and `->end` are immutable properties. We recommend that you use `CarbonPeriodImmutable` which will then be fully compatible (its properties including start and end cannot be modified); while `CarbonPeriod` has setters `->setStartDate()` and `->setEndDate()` that will actually modify from when to when the period iterates and also the value you can retrieve using `->getStartDate()` and `->getEndDate()`, however `->start` and `->end` will still contain initial start and end and not the new values after modification.

### isSame\*

Since Carbon 3, it's no longer allowed to call `isSame*` methods (such as `isSameDay`, `isSameMonth` without parameters. You need to explictly pass a date (string or DateTime object) so it's a comparison between 2: `$a->isSameHour($b)`, in Carbon 2, it was by default using "now" as default value, now you should tell it explictly if you mean it: `$a->isSameHour('now')` or you can use `->isCurrent*` methods instead: `$a->isCurrentHour()`

### Dropped maxValue() and minValue()

Since Carbon 3, `Carbon::minValue()` and `Carbon::maxValue()` have been removed, use `CarbonImmutable::startOfTime()` and `CarbonImmutable::endOfTime()` instead. While the old methods depended on the system and were available on mutable objects, the new ones are arbitrary dates `0001-01-01 00:00:00` and `9999-12-31 23:59:59.999999` only available on `CarbonImmutable`, and you can check a date is at such end using `->isStartOfTime()` and `->isEndOfTime()`.


## Migrate to Carbon 2

If you plan to migrate from Carbon 1 to Carbon 2, please note the following breaking changes you should take care of.

*   Default values (when parameters are omitted) for `$month` and `$day` in the `::create()` method are now `1` (were values from current date in Carbon 1). And default values for `$hour`, `$minute` and `$second` are now `0`, this goes for omitted values, but you still can pass explicitly `null` to get the current value from _now_ (similar behavior as in Carbon 1).
*   Now you get microsecond precision everywhere, it also means 2 dates in the same second but not in the same microsecond are no longer equal.
*   `$date->jsonSerialize()` and `json_encode($date)` no longer returns arrays but simple strings: `"2017-06-27T13:14:15.000000Z"`. This allows to create dates from it easier in JavaScript. You still can get the previous behavior using:

```php
Carbon::serializeUsing(function ($date) {
    return [
        'date' => $date->toDateTimeString(),
    ] + (array) $date->tz;
});
```

*   `$date->setToStringFormat()` with a closure no longer return a format but a final string. So you can return any string and the following in Carbon 1:

```php
Carbon::setToStringFormat(function ($date) {
    return $date->year === 1976 ?
        'jS \o\f F g:i:s a' :
        'jS \o\f F, Y g:i:s a';
});
```

would become in Carbon 2:

```php
Carbon::setToStringFormat(function ($date) {
    return $date->formatLocalized($date->year === 1976 ?
        'jS \o\f F g:i:s a' :
        'jS \o\f F, Y g:i:s a'
    );
});
```

*   `setWeekStartsAt` and `setWeekEndsAt` no longer throw exceptions on values out of ranges, but they are also deprecated.
*   `isSameMonth` and `isCurrentMonth` now returns `false` for same month in different year but you can pass `false` as a second parameter of `isSameMonth` or first parameter of `isCurrentMonth` to compare ignoring the year.
*   `::compareYearWithMonth()` and `::compareYearWithMonth()` have been removed. Strict comparisons are now the default. And you can use the next parameter of isSame/isCurrent set to false to get month-only comparisons.
*   As we dropped PHP 5, `$self` is no longer needed in mixins you should just use `$this` instead.
*   As PHP 7.1+ perfectly supports microseconds, `useMicrosecondsFallback` and `isMicrosecondsFallbackEnabled` are no longer needed and so have been removed.
*   In Carbon 1, calls of an unknown method on `CarbonInterval` (ex: `CarbonInterval::anything()`) just returned null. In Carbon 2 they throw an exception.
*   In Carbon 1, `dayOfYear` started from `0`. In Carbon 2 it starts from `1`.
*   In Carbon 1, `null` was considered as `0` when passed to add/sub method (such as `addDays(null)`, `subMonths(null)`, etc.). In Carbon 2, it behaves the same as no parameters so default to `1`. Anyway, you're discouraged to pass `null` in such methods as it's ambiguous and the behavior for next major version is not guaranteed.
*   That's all folks! Every other methods you used in Carbon 1 should continue to work just the same with Carbon 2.
