---
order: 1
---

# Getters

The getters are implemented via PHP's `__get()` method. This enables you to access the value as if it was a property rather than a function call.

```php
$dt = Carbon::parse('2012-10-5 23:26:11.123789');

// These getters specifically return integers, ie intval()
var_dump($dt->year);
var_dump($dt->month);
var_dump($dt->day);
var_dump($dt->hour);
var_dump($dt->minute);
var_dump($dt->second);
var_dump($dt->micro);
// dayOfWeek returns a number between 0 (sunday) and 6 (saturday)
var_dump($dt->dayOfWeek);
// dayOfWeekIso returns a number between 1 (monday) and 7 (sunday)
var_dump($dt->dayOfWeekIso);
var_dump($dt->englishDayOfWeek);
var_dump($dt->shortEnglishDayOfWeek);
var_dump($dt->locale('de')->dayName);
var_dump($dt->locale('de')->shortDayName);
var_dump($dt->locale('de')->minDayName);
var_dump($dt->englishMonth);
var_dump($dt->shortEnglishMonth);
var_dump($dt->locale('de')->monthName);
var_dump($dt->locale('de')->shortMonthName);

var_dump($dt->dayOfYear);
var_dump($dt->weekNumberInMonth);
// weekNumberInMonth consider weeks from monday to sunday, so the week 1 will
// contain 1 day if the month start with a sunday, and up to 7 if it starts with a monday
var_dump($dt->weekOfMonth);
// weekOfMonth will returns 1 for the 7 first days of the month, then 2 from the 8th to
// the 14th, 3 from the 15th to the 21st, 4 from 22nd to 28th and 5 above
var_dump($dt->weekOfYear);
var_dump($dt->daysInMonth);
var_dump($dt->timestamp);
var_dump($dt->getTimestamp());
// Millisecond-precise timestamp as int
var_dump($dt->getTimestampMs());
// Millisecond-precise timestamp as float (useful to pass it to JavaScript)
var_dump($dt->valueOf());
// Custom-precision timestamp
var_dump($dt->getPreciseTimestamp(6));
var_dump(Carbon::createFromDate(1975, 5, 21)->age); // calculated vs now in the same tz
var_dump($dt->quarter);

// Returns an int of seconds difference from UTC (+/- sign included)
var_dump(Carbon::createFromTimestampUTC(0)->offset);
var_dump(Carbon::createFromTimestamp(0, 'Europe/Paris')->offset);
var_dump(Carbon::createFromTimestamp(0, 'Europe/Paris')->getOffset());

// Returns an int of hours difference from UTC (+/- sign included)
var_dump(Carbon::createFromTimestamp(0, 'Europe/Paris')->offsetMinutes);
var_dump(Carbon::createFromTimestamp(0, 'Europe/Paris')->offsetHours);

// Returns timezone offset as string
var_dump(Carbon::createFromTimestamp(0, 'Europe/Paris')->getOffsetString());

// Returns timezone as CarbonTimeZone
var_dump(Carbon::createFromTimestamp(0, 'Europe/Paris')->getTimezone());

// Indicates if day light savings time is on
var_dump(Carbon::createFromDate(2012, 1, 1)->dst);
var_dump(Carbon::createFromDate(2012, 9, 1)->dst);
var_dump(Carbon::createFromDate(2012, 9, 1)->isDST());

// Indicates if the instance is in the same timezone as the local timezone
var_dump(Carbon::now()->local);
var_dump(Carbon::now('America/Vancouver')->local);
var_dump(Carbon::now()->isLocal());
var_dump(Carbon::now('America/Vancouver')->isLocal());
var_dump(Carbon::now()->isUtc());
var_dump(Carbon::now('America/Vancouver')->isUtc());
// can also be written ->isUTC()

// Indicates if the instance is in the UTC timezone
var_dump(Carbon::now()->utc);
// London is not UTC on summer time
var_dump(Carbon::parse('2018-10-01', 'Europe/London')->utc);
// London is UTC on winter time
var_dump(Carbon::parse('2018-11-01', 'Europe/London')->utc);
var_dump(Carbon::createFromTimestampUTC(0)->utc);

// Gets the DateTimeZone instance
echo get_class(Carbon::now()->timezone);
echo "\n";
echo get_class(Carbon::now()->tz);
echo "\n";

// Gets the DateTimeZone instance name, shortcut for ->timezone->getName()
echo Carbon::now()->timezoneName;
echo "\n";
echo Carbon::now()->tzName;
echo "\n";

// You can get any property dynamically too:
$unit = 'second';
var_dump(Carbon::now()->get($unit));
// equivalent to:
var_dump(Carbon::now()->$unit);
// If you have plural unit name, use singularUnit()
$unit = Carbon::singularUnit('seconds');
var_dump(Carbon::now()->get($unit));
// Prefer using singularUnit() because some plurals are not the word with S:
var_dump(Carbon::pluralUnit('century'));
var_dump(Carbon::pluralUnit('millennium'));

```
