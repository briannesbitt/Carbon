---
order: 4
---

# Fluent Setters

You can call any base unit as a setter or some grouped setters:

```php

$dt = Carbon::now();

$dt->year(1975)->month(5)->day(21)->hour(22)->minute(32)->second(5)->toDateTimeString();
$dt->setDate(1975, 5, 21)->setTime(22, 32, 5)->toDateTimeString();
$dt->setDate(1975, 5, 21)->setTimeFromTimeString('22:32:05')->toDateTimeString();
$dt->setDateTime(1975, 5, 21, 22, 32, 5)->toDateTimeString();

// All allow microsecond as optional argument
$dt->year(1975)->month(5)->day(21)->hour(22)->minute(32)->second(5)->microsecond(123456)->toDateTimeString();
$dt->setDate(1975, 5, 21)->setTime(22, 32, 5, 123456)->toDateTimeString();
$dt->setDate(1975, 5, 21)->setTimeFromTimeString('22:32:05.123456')->toDateTimeString();
$dt->setDateTime(1975, 5, 21, 22, 32, 5, 123456)->toDateTimeString();

$dt->timestamp(169957925); // Note: timestamps are UTC but do not change the date timezone

$dt->timezone('Europe/London')->tz('America/Toronto')->setTimezone('America/Vancouver');


```

You also can set date and time separately from other DateTime/Carbon objects:

```php

$source1 = new Carbon('2010-05-16 22:40:10.1');

$dt = new Carbon('2001-01-01 01:01:01.2');
$dt->setTimeFrom($source1);


echo $dt;


$source2 = new \DateTime('2013-09-01 09:22:56.2');

$dt->setDateFrom($source2);


echo $dt;

$dt->setDateTimeFrom($source2); // set date and time including microseconds
// bot not settings as locale, timezone, options.

```
