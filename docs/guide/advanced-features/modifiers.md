# Modifiers

These group of methods perform helpful modifications to the current instance. Most of them are self explanatory from their names... or at least should be. You'll also notice that the startOfXXX(), next() and previous() methods set the time to 00:00:00 and the endOfXXX() methods set the time to 23:59:59 for unit bigger than days.

The only one slightly different is the `average()` function. It moves your instance to the middle date between itself and the provided Carbon argument.

The powerful native [`modify()` method of `DateTime`](https://www.php.net/manual/en/datetime.modify.php) is available untouched. But we also provide an enhanced version of it: `change()` that allows some additional syntax like `"next 3pm"` and that is called internally by `->next()` and `->previous()`.

```php
$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->startOfSecond()->format('s.u');


$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->endOfSecond()->format('s.u');

$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->startOf('second')->format('s.u');

$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->endOf('second')->format('s.u');
// ->startOf() and ->endOf() are dynamic equivalents to those methods

$dt = Carbon::create(2012, 1, 31, 15, 32, 45);
echo $dt->startOfMinute();

$dt = Carbon::create(2012, 1, 31, 15, 32, 45);
echo $dt->endOfMinute();

$dt = Carbon::create(2012, 1, 31, 15, 32, 45);
echo $dt->startOfHour();

$dt = Carbon::create(2012, 1, 31, 15, 32, 45);
echo $dt->endOfHour();

$dt = Carbon::create(2012, 1, 31, 15, 32, 45);
echo Carbon::getMidDayAt();
echo $dt->midDay();
Carbon::setMidDayAt(13);
echo Carbon::getMidDayAt();
echo $dt->midDay();
Carbon::setMidDayAt(12);

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->startOfDay();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->endOfDay();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->startOfMonth();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->endOfMonth();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->startOfYear();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->endOfYear();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->startOfDecade();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->endOfDecade();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->startOfCentury();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->endOfCentury();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->startOfWeek();
var_dump($dt->dayOfWeek == Carbon::MONDAY); // : ISO8601 week starts on Monday

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->endOfWeek();
var_dump($dt->dayOfWeek == Carbon::SUNDAY); // : ISO8601 week ends on Sunday

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->next(Carbon::WEDNESDAY);
var_dump($dt->dayOfWeek == Carbon::WEDNESDAY);
echo $dt->next('Wednesday');
echo $dt->next('04:00');
echo $dt->next('12:00');
echo $dt->next('04:00');

$dt = Carbon::create(2012, 1, 1, 12, 0, 0);
echo $dt->next();

$dt = Carbon::create(2012, 1, 31, 12, 0, 0);
echo $dt->previous(Carbon::WEDNESDAY);
var_dump($dt->dayOfWeek == Carbon::WEDNESDAY);

$dt = Carbon::create(2012, 1, 1, 12, 0, 0);
echo $dt->previous();

$start = Carbon::create(2014, 1, 1, 0, 0, 0);
$end = Carbon::create(2014, 1, 30, 0, 0, 0);
echo $start->average($end);

echo Carbon::create(2014, 5, 30, 0, 0, 0)->firstOfMonth();
echo Carbon::create(2014, 5, 30, 0, 0, 0)->firstOfMonth(Carbon::MONDAY);
echo Carbon::create(2014, 5, 30, 0, 0, 0)->lastOfMonth();
echo Carbon::create(2014, 5, 30, 0, 0, 0)->lastOfMonth(Carbon::TUESDAY);
echo Carbon::create(2014, 5, 30, 0, 0, 0)->nthOfMonth(2, Carbon::SATURDAY);

echo Carbon::create(2014, 5, 30, 0, 0, 0)->firstOfQuarter();
echo Carbon::create(2014, 5, 30, 0, 0, 0)->firstOfQuarter(Carbon::MONDAY);
echo Carbon::create(2014, 5, 30, 0, 0, 0)->lastOfQuarter();
echo Carbon::create(2014, 5, 30, 0, 0, 0)->lastOfQuarter(Carbon::TUESDAY);
echo Carbon::create(2014, 5, 30, 0, 0, 0)->nthOfQuarter(2, Carbon::SATURDAY);
echo Carbon::create(2014, 5, 30, 0, 0, 0)->startOfQuarter();
echo Carbon::create(2014, 5, 30, 0, 0, 0)->endOfQuarter();

echo Carbon::create(2014, 5, 30, 0, 0, 0)->firstOfYear();
echo Carbon::create(2014, 5, 30, 0, 0, 0)->firstOfYear(Carbon::MONDAY);
echo Carbon::create(2014, 5, 30, 0, 0, 0)->lastOfYear();
echo Carbon::create(2014, 5, 30, 0, 0, 0)->lastOfYear(Carbon::TUESDAY);
echo Carbon::create(2014, 5, 30, 0, 0, 0)->nthOfYear(2, Carbon::SATURDAY);

echo Carbon::create(2018, 2, 23, 0, 0, 0)->nextWeekday();
echo Carbon::create(2018, 2, 23, 0, 0, 0)->previousWeekday();
echo Carbon::create(2018, 2, 21, 0, 0, 0)->nextWeekendDay();
echo Carbon::create(2018, 2, 21, 0, 0, 0)->previousWeekendDay();

```

Rounding is also available for any unit:

```php
$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->roundMillisecond()->format('H:i:s.u');

$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->roundSecond()->format('H:i:s.u');

$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->floorSecond()->format('H:i:s.u');

$dt = new Carbon('2012-01-31 15:32:15');
echo $dt->roundMinute()->format('H:i:s');

$dt = new Carbon('2012-01-31 15:32:15');
echo $dt->ceilMinute()->format('H:i:s');

// and so on up to millennia!

// precision rounding can be set, example: rounding to ten minutes
$dt = new Carbon('2012-01-31 15:32:15');
echo $dt->roundMinute(10)->format('H:i:s');

// and round, floor and ceil methods are shortcut for second rounding:
$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->round()->format('H:i:s.u');
$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->floor()->format('H:i:s.u');
$dt = new Carbon('2012-01-31 15:32:45.654321');
echo $dt->ceil()->format('H:i:s.u');

// you can also pass the unit dynamically (and still precision as second argument):
$dt = new Carbon('2012-01-31');
echo $dt->roundUnit('month', 2)->format('Y-m-d');
$dt = new Carbon('2012-01-31');
echo $dt->floorUnit('month')->format('Y-m-d');
$dt = new Carbon('2012-01-31');
echo $dt->ceilUnit('month', 4)->format('Y-m-d');

```
