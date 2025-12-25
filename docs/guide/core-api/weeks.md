---
order: 3
---

# Weeks

If you are familiar with momentjs, you will find all week methods working the same.
Most of them have an iso{Method} variant. Week methods follow the rules of the
current locale (for example with en_US, the default locale, the first day of the
week is Sunday, and the first week of the year is the one that contains January 1st).
ISO methods follow the ISO 8601 norm, meaning weeks start with Monday and the first
week of the year is the one containing January 4th.

```php

$en = CarbonImmutable::now()->locale('en_US');
$ar = CarbonImmutable::now()->locale('ar');

var_dump($en->firstWeekDay);
var_dump($en->lastWeekDay);
var_dump($en->startOfWeek()->format('Y-m-d H:i'));
var_dump($en->endOfWeek()->format('Y-m-d H:i'));


// We still can force to use an other day as start/end of week
$start = $en->startOfWeek(Carbon::TUESDAY);
$end = $en->endOfWeek(Carbon::MONDAY);

var_dump($start->format('Y-m-d H:i'));
var_dump($end->format('Y-m-d H:i'));

var_dump($ar->firstWeekDay);
var_dump($ar->lastWeekDay);
var_dump($ar->startOfWeek()->format('Y-m-d H:i'));
var_dump($ar->endOfWeek()->format('Y-m-d H:i'));

$en = CarbonImmutable::parse('2015-02-05'); // use en_US as default locale

var_dump($en->weeksInYear());
var_dump($en->isoWeeksInYear());

$en = CarbonImmutable::parse('2017-02-05');

var_dump($en->week());
var_dump($en->isoWeek());
var_dump($en->week(1)->format('Y-m-d H:i'));
var_dump($en->isoWeek(1)->format('Y-m-d H:i'));

// weekday/isoWeekday are meant to be used with days constants
var_dump($en->weekday());
var_dump($en->isoWeekday());
var_dump($en->weekday(CarbonInterface::WEDNESDAY)
    ->format('Y-m-d H:i'));
var_dump($en->isoWeekday(CarbonInterface::WEDNESDAY)
    ->format('Y-m-d H:i'));

// getDaysFromStartOfWeek/setDaysFromStartOfWeek return and take a number of days
// taking the current locale into account
$date = CarbonImmutable::parse('2022-12-05')->locale('en_US');

var_dump($date->getDaysFromStartOfWeek());

$date = CarbonImmutable::parse('2022-12-05')->locale('de_AT');

var_dump($date->getDaysFromStartOfWeek());
var_dump($date->setDaysFromStartOfWeek(3)->format('Y-m-d'));

// Or specify explicitly the first day of week
var_dump($date->setDaysFromStartOfWeek(3, CarbonInterface::SUNDAY)->format('Y-m-d'));

$en = CarbonImmutable::parse('2017-01-01');

var_dump($en->weekYear());
var_dump($en->isoWeekYear());
var_dump($en->weekYear(2016)->format('Y-m-d H:i'));
var_dump($en->isoWeekYear(2016)->format('Y-m-d H:i'));
var_dump($en->weekYear(2015)->format('Y-m-d H:i'));
var_dump($en->isoWeekYear(2015)->format('Y-m-d H:i'));

// Note you still can force first day of week and year to use:
$en = CarbonImmutable::parse('2017-01-01');

var_dump($en->weeksInYear(null, 6, 12));
var_dump($en->isoWeeksInYear(null, 6, 12));
var_dump($en->week(null, 6, 12));
var_dump($en->isoWeek(null, 6, 12));
var_dump($en->weekYear(null, 6, 12));
var_dump($en->isoWeekYear(null, 6, 12));
var_dump($en->weekYear(2016, 6, 12)->format('Y-m-d H:i'));
var_dump($en->isoWeekYear(2016, 6, 12)->format('Y-m-d H:i'));
// Then you can see using a method or its ISO variant return identical results

```
