# CarbonPeriod

CarbonPeriod is a human-friendly version of the [DatePeriod](https://www.php.net/manual/en/class.dateperiod.php) with many shortcuts.

```php

// Create a new instance:
$period = new CarbonPeriod('2018-04-21', '3 days', '2018-04-27');
// Use static constructor:
$period = CarbonPeriod::create('2018-04-21', '3 days', '2018-04-27');
// Use the fluent setters:
$period = CarbonPeriod::since('2018-04-21')->days(3)->until('2018-04-27');
// Start from a CarbonInterval:
$period = CarbonInterval::days(3)->toPeriod('2018-04-21', '2018-04-27');
// From a diff:
$period = Carbon::parse('2020-08-29')->diff('2020-09-02')->stepBy('day');
$period = Carbon::parse('2020-08-29')->diff('2020-09-02')->stepBy(12, 'hours');
// toPeriod can also be called from a Carbon or CarbonImmutable instance:
$period = Carbon::parse('2018-04-21')->toPeriod('2018-04-27', '3 days'); // pass end and interval
// interval can be a string, a DateInterval or a CarbonInterval
// You also can pass 2 arguments: number an string:
$period = Carbon::parse('2018-04-21')->toPeriod('2018-04-27', 3, 'days');
// Same as above:
$period = Carbon::parse('2018-04-21')->range('2018-04-27', 3, 'days'); // Carbon::range is an alias of Carbon::toPeriod
// Still the same:
$period = Carbon::parse('2018-04-21')->daysUntil('2018-04-27', 3);
// By default daysUntil will use a 1-day interval:
$period = Carbon::parse('2018-04-21')->daysUntil('2018-04-27'); // same as CarbonPeriod::create('2018-04-21', '1 day', '2018-04-27')
/*
    microsUntil() or microsecondsUntil() provide the same feature for microseconds intervals
    millisUntil() or millisecondsUntil() provide the same feature for milliseconds intervals
    secondsUntil() provides the same feature for seconds intervals
    minutesUntil() provides the same feature for minutes intervals
    hoursUntil() provides the same feature for hours intervals
    weeksUntil() provides the same feature for weeks intervals
    monthsUntil() provides the same feature for months intervals
    quartersUntil() provides the same feature for quarters intervals
    yearsUntil() provides the same feature for years intervals
    decadesUntil() provides the same feature for decades intervals
    centuriesUntil() provides the same feature for centuries intervals
    millenniaUntil() provides the same feature for millennia intervals
*/
// Using number of recurrences:
CarbonPeriod::create('now', '1 day', 3); // now, now + 1 day, now + 2 day
// Can be infinite:
CarbonPeriod::create('now', '2 days', INF); // infinite iteration
CarbonPeriod::create('now', '2 days', INF)->calculateEnd()->isEndOfTime(); // true
CarbonPeriod::create('now', CarbonInterval::days(-2), INF)->calculateEnd()->isStartOfTime(); // true

```

A CarbonPeriod can be constructed in a number of ways:

*   start date, end date and optional interval (by default 1 day),
*   start date, number of recurrences and optional interval,
*   an ISO 8601 interval specification,
*   from another `DatePeriod` or `CarbonPeriod` using `CarbonPeriod::instance($period)` or simply using `new CarbonPeriod($period)`.

Dates can be given as DateTime/Carbon instances, absolute strings like "2007-10-15 15:00" or relative strings, for example "next monday". Interval can be given as DateInterval/CarbonInterval instance, ISO 8601 interval specification like "P4D", or human readable string, for example "4 days".

Default constructor and `create()` methods are very forgiving in terms of argument types and order, so if you want to be more precise the fluent syntax is recommended. On the other hand you can pass dynamic array of values to `createFromArray()` which will do the job of constructing a new instance with the given array as a list of arguments.

CarbonPeriod implements the [Iterator](https://www.php.net/manual/en/class.iterator.php) interface. It means that it can be passed directly to a `foreach` loop:

```php

$period = CarbonPeriod::create('2018-04-21', '3 days', '2018-04-27');

foreach ($period as $key => $date) {
    if ($key) {
        echo ', ';
    }
    echo $date->format('m-d');
}

echo "\n";

// Here is what happens under the hood:
$period->rewind(); // restart the iteration
while ($period->valid()) { // check if current item is valid
    if ($period->key()) { // echo comma if current key is greater than 0
        echo ', ';
    }
    echo $period->current()->format('m-d'); // echo current date
    $period->next(); // move to the next item
}

```

Parameters can be modified during the iteration:

```php

$period = CarbonPeriod::create('2018-04-29', 7);
$dates = [];
foreach ($period as $key => $date) {
    if ($key === 3) {
        $period->invert()->start($date); // invert() is an alias for invertDateInterval()
    }
    $dates[] = $date->format('m-d');
}


echo implode(', ', $dates);

```

Just as DatePeriod, the CarbonPeriod supports [ISO 8601 time interval specification](https://en.wikipedia.org/wiki/ISO_8601#Time_intervals).

Note that the native DatePeriod treats recurrences as a number of times to repeat the interval. Thus it will give one less result when the start date is excluded. Introduction of custom filters in CarbonPeriod made it even more difficult to know the number of results. For that reason we changed the implementation slightly, and recurrences are treated as an overall limit for number of returned dates.

```php

// Possible options are: CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE
// Default value is 0 which will have the same effect as when no options are given.
$period = CarbonPeriod::createFromIso('R4/2012-07-01T00:00:00Z/P7D', CarbonPeriod::EXCLUDE_START_DATE);
$dates = [];
foreach ($period as $date) {
    $dates[] = $date->format('m-d');
}


echo implode(', ', $dates);

```

You can retrieve data from the period with variety of getters:

```php

$period = CarbonPeriod::create('2010-05-06', '2010-05-25', CarbonPeriod::EXCLUDE_START_DATE);

$exclude = $period->getOptions() & CarbonPeriod::EXCLUDE_START_DATE;


echo $period->getStartDate();
echo "\n";
echo $period->getEndDate();
// Note than ->getEndDate() will return null when the end is not fixed.
// For example CarbonPeriod::since('2018-04-21')->times(3) use repetition, so we don't know the end before iteration.
// Then you can use ->calculateEnd() instead that will use getEndDate() if available and else will execute a complete
// iteration to calculate the end date.
echo "\n";
echo $period->getDateInterval();
echo "\n";
echo $exclude ? 'exclude' : 'include';
echo "\n";

var_dump($period->isStartIncluded());
echo "\n";
var_dump($period->isEndIncluded());
echo "\n";
var_dump($period->isStartExcluded());
echo "\n";
var_dump($period->isEndExcluded());
echo "\n";

echo $period->getIncludedStartDate();
// If start is included getIncludedStartDate() = getStartDate()
// If start is excluded getIncludedStartDate() = getStartDate() + 1 interval
echo "\n";
echo $period->getIncludedEndDate();
// If end is included getIncludedEndDate() = getEndDate()
// If end is excluded getIncludedEndDate() = getEndDate() - 1 interval
// If end is null getIncludedEndDate() = calculateEnd(), it means the period is actually iterated to get the last date
echo "\n";

echo $period->toString();
echo "\n";
echo $period; /*implicit toString*/

```

Additional getters let you access the results as an array:

```php
$period = CarbonPeriod::create('2010-05-11', '2010-05-13');

echo $period->count(); // equivalent to count($period)
echo "\n";
echo implode(', ', $period->toArray());
echo "\n";
echo $period->first();
echo "\n";
echo $period->last();

```

Note that if you intend to work using the above functions it's a good idea to store the result of `toArray()` call to a variable and use it instead, because each call performs a full iteration internally.

To change the parameters you can use setter methods:

```php

$period = CarbonPeriod::create('2010-05-01', '2010-05-14', CarbonPeriod::EXCLUDE_END_DATE);


$period->setStartDate('2010-05-11');
echo implode(', ', $period->toArray());
echo "\n";

// Second argument can be optionally used to exclude the date from the results.
$period->setStartDate('2010-05-11', false);
$period->setEndDate('2010-05-14', true);
echo implode(', ', $period->toArray());
echo "\n";

$period->setRecurrences(2);
echo implode(', ', $period->toArray());
echo "\n";

$period->setDateInterval('PT12H');
echo implode(', ', $period->toArray());

// This can also be set to 12 hours in all the following ways:
$period->setDateInterval('12h');
$period->setDateInterval('12 hours');
$period->setDateInterval(12, 'hours');
$period->setDateInterval(12, \Carbon\Unit::Hour);

// And reset to no explicit interval (will then use 1 day if iterated)
$period->resetDateInterval();

```

You can change options using `setOptions()` to replace all options but you also can change them separately:

```php

$period = CarbonPeriod::create('2010-05-06', '2010-05-25');

var_dump($period->isStartExcluded());
var_dump($period->isEndExcluded());

$period->toggleOptions(CarbonPeriod::EXCLUDE_START_DATE, true); // true, false or nothing to invert the option
var_dump($period->isStartExcluded());
var_dump($period->isEndExcluded()); // (unchanged)

$period->excludeEndDate(); // specify false to include, true or omit to exclude
var_dump($period->isStartExcluded()); // (unchanged)
var_dump($period->isEndExcluded());

$period->excludeStartDate(false); // specify false to include, true or omit to exclude
var_dump($period->isStartExcluded());
var_dump($period->isEndExcluded());

```

You can check 2 periods overlap or not:

```php

$period = CarbonPeriod::create('2010-05-06', '2010-05-25');
$period2 = CarbonPeriod::create('2010-05-22', '2010-05-24');


var_dump($period->overlaps('2010-05-22', '2010-06-03'));
var_dump($period->overlaps($period2));


$period = CarbonPeriod::create('2010-05-06 12:00', '2010-05-25');
$start = Carbon::create('2010-05-06 05:00');
$end = Carbon::create('2010-05-06 11:59');

var_dump($period->overlaps($start, $end));

```

As mentioned earlier, per ISO 8601 specification, recurrences is a number of times the interval should be repeated. The native DatePeriod will thus vary the number of returned dates depending on the exclusion of the start date. Meanwhile, CarbonPeriod being more forgiving in terms of input and allowing custom filters, treats recurrences as an overall limit for number of returned dates:

```php

$period = CarbonPeriod::createFromIso('R4/2012-07-01T00:00:00Z/P7D');
$days = [];
foreach ($period as $date) {
    $days[] = $date->format('d');
}


echo $period->getRecurrences();
echo implode(', ', $days);


$days = [];
$period->setRecurrences(3)->excludeStartDate();
foreach ($period as $date) {
    $days[] = $date->format('d');
}


echo $period->getRecurrences();
echo implode(', ', $days);


$days = [];
$period = CarbonPeriod::recurrences(3)->sinceNow();
foreach ($period as $date) {
    $days[] = $date->format('Y-m-d');
}


echo implode(', ', $days);

```

Dates returned by the DatePeriod can be easily filtered. Filters can be used for example to skip certain dates or iterate only over working days or weekends. A filter function should return `true` to accept a date, `false` to skip it but continue searching or `CarbonPeriod::END_ITERATION` to end the iteration.

```php

$period = CarbonPeriod::between('2000-01-01', '2000-01-15');
$weekendFilter = function ($date) {
    return $date->isWeekend();
};
$period->filter($weekendFilter);


$days = [];
foreach ($period as $date) {
    $days[] = $date->format('m-d');
}

echo implode(', ', $days);

```

You also can skip one or more value(s) inside the loop.

```php

$period = CarbonPeriod::between('2000-01-01', '2000-01-10');
$days = [];
foreach ($period as $date) {
    $day = $date->format('m-d');
    $days[] = $day;
    if ($day === '01-04') {
        $period->skip(3);
    }
}

echo implode(', ', $days);

```

`getFilters()` allow you to retrieve all the stored filters in a period. But be aware the recurrences limit and the end date will appear in the returned array as they are stored internally as filters.

```php

$period = CarbonPeriod::end('2000-01-01')->recurrences(3);

var_export($period->getFilters());


```

Filters are stored in a stack and can be managed using a special set of methods:

```php

$period = CarbonPeriod::between('2000-01-01', '2000-01-15');
$weekendFilter = function ($date) {
    return $date->isWeekend();
};


var_dump($period->hasFilter($weekendFilter));
$period->addFilter($weekendFilter);
var_dump($period->hasFilter($weekendFilter));
$period->removeFilter($weekendFilter);
var_dump($period->hasFilter($weekendFilter));

// To avoid storing filters as variables you can name your filters:
$period->prependFilter(function ($date) {
    return $date->isWeekend();
}, 'weekend');

var_dump($period->hasFilter('weekend'));
$period->removeFilter('weekend');
var_dump($period->hasFilter('weekend'));

```

Order in which filters are added can have an impact on the performance and on the result, so you can use `addFilter()` to add a filter in the end of stack; and you can use `prependFilter()` to add one at the beginning. You can even use `setFilters()` to replace all filters. Note that you'll have to keep correct format of the stack and remember about internal filters for recurrences limit and end date. Alternatively you can use `resetFilters()` method and then add new filters one by one.

For example, when you add a custom filter that limits the number of attempted dates, the result will be different if you add it before or after the weekday filter.

```php

// Note that you can pass a name of any Carbon method starting with "is", including macros
$period = CarbonPeriod::between('2018-05-03', '2018-05-25')->filter('isWeekday');



$attempts = 0;
$attemptsFilter = function () use (&$attempts) {
    return ++$attempts <= 5 ? true : CarbonPeriod::END_ITERATION;
};

$period->prependFilter($attemptsFilter, 'attempts');
$days = [];
foreach ($period as $date) {
    $days[] = $date->format('m-d');
}

echo implode(', ', $days);


$attempts = 0;

$period->removeFilter($attemptsFilter)->addFilter($attemptsFilter, 'attempts');
$days = [];
foreach ($period as $date) {
    $days[] = $date->format('m-d');
}

echo implode(', ', $days);

```

Note that the built-in recurrences filter doesn't work this way. It is instead based on the current key which is incremented only once per item, no matter how many dates have to be checked before a valid date is found. This trick makes it work the same both if you put it at the beginning or at the end of the stack.

A number of aliases has been added to simplify building the CarbonPeriod:

```php{no-render}
// "start", "since", "sinceNow":
CarbonPeriod::start('2017-03-10') == CarbonPeriod::create()->setStartDate('2017-03-10');
// Same with optional boolean argument $inclusive to change the option about include/exclude start date:
CarbonPeriod::start('2017-03-10', true) == CarbonPeriod::create()->setStartDate('2017-03-10', true);
// "end", "until", "untilNow":
CarbonPeriod::end('2017-03-20') == CarbonPeriod::create()->setEndDate('2017-03-20');
// Same with optional boolean argument $inclusive to change the option about include/exclude end date:
CarbonPeriod::end('2017-03-20', true) == CarbonPeriod::create()->setEndDate('2017-03-20', true);
// "dates", "between":
CarbonPeriod::dates(..., ...) == CarbonPeriod::create()->setDates(..., ...);
// "recurrences", "times":
CarbonPeriod::recurrences(5) == CarbonPeriod::create()->setRecurrences(5);
// "options":
CarbonPeriod::options(...) == CarbonPeriod::create()->setOptions(...);
// "toggle":
CarbonPeriod::toggle(..., true) == CarbonPeriod::create()->toggleOptions(..., true);
// "filter", "push":
CarbonPeriod::filter(...) == CarbonPeriod::create()->addFilter(...);
// "prepend":
CarbonPeriod::prepend(...) == CarbonPeriod::create()->prependFilter(...);
// "filters":
CarbonPeriod::filters(...) == CarbonPeriod::create()->setFilters(...);
// "interval", "each", "every", "step", "stepBy":
CarbonPeriod::interval(...) == CarbonPeriod::create()->setDateInterval(...);
// "invert":
CarbonPeriod::invert() == CarbonPeriod::create()->invertDateInterval();
// "year", "months", "month", "weeks", "week", "days", "dayz", "day",
// "hours", "hour", "minutes", "minute", "seconds", "second":
CarbonPeriod::hours(5) == CarbonPeriod::create()->setDateInterval(CarbonInterval::hours(5));

```

CarbonPeriod can be easily converted to a human-readable string and ISO 8601 specification:

```php

$period = CarbonPeriod::create('2000-01-01 12:00', '3 days 12 hours', '2000-01-15 12:00');

echo $period->toString();
echo "\n";
echo $period->toIso8601String();

```

Period use and return Carbon instance by default, but you can easily set/get the date class to use in order to get immutable dates for example or any class implementing CarbonInterface.

```php

$period = new CarbonPeriod;
$period->setDateClass(CarbonImmutable::class);
$period->every('3 days 12 hours')->since('2000-01-01 12:00')->until('2000-01-15 12:00');


echo $period->getDateClass();
echo "\n";
echo $period->getStartDate();
echo "\n";
echo get_class($period->getStartDate());

```

CarbonPeriod has `forEach()` and `map()` helper methods:

```php

$period = CarbonPeriod::create('2018-04-21', '3 days', '2018-04-27');


$dates = $period->map(function (Carbon $date) {
    return $date->format('m-d');
});
// Or with PHP 7.4:
// $dates = $period->map(fn(Carbon $date) => $date->format('m-d'));
$array = iterator_to_array($dates); // $dates is a iterable \Generator
var_dump($array);
echo implode(', ', $array);

echo "\n";

// Here is what happens under the hood:

$period->forEach(function (Carbon $date) {
    echo $date->format('m-d')."\n";
});
```

As all other Carbon classes, `CarbonPeriod` has a `cast()` method to convert it:

```php

$period = CarbonPeriod::create('2000-01-01 12:00', '3 days 12 hours', '2000-01-15 12:00');

// It would also works if your class extends DatePeriod
class MyPeriod extends CarbonPeriod {}


echo get_class($period->cast(MyPeriod::class));

// Shortcut to export as raw DatePeriod:
echo get_class($period->toDatePeriod());

```

You can check if periods follow themselves. Period **A** follows period **B** if the first iteration date of **B** equals to the last iteration date of **A** + the interval of **A**. For example `[2019-02-01 => 2019-02-16]` follows `[2019-01-15 => 2019-01-31]` (assuming neither start nor end are excluded via option for those period and assuming those period as a (1 day)-interval.

```php

$a = CarbonPeriod::create('2019-01-15', '2019-01-31');
$b = CarbonPeriod::create('2019-02-01', '2019-02-16');


var_dump($b->follows($a));
var_dump($a->isFollowedBy($b));
// ->isConsecutiveWith($period) is true if it either ->follows($period) or ->isFollowedBy($period)
var_dump($b->isConsecutiveWith($a));
var_dump($a->isConsecutiveWith($b));

```

The `contains()` method allow you to check if a date is in the period range.

```php

$period = CarbonPeriod::create('2019-01-15', '2019-01-31');


var_dump($period->contains('2019-01-22'));

```

The comparison includes start and end unless you excluded them in the option and as for it concerns `contains()`, the exclusion only exclude the exact date, so:

```php

$period = CarbonPeriod::create('2019-01-15', '2019-01-31', CarbonPeriod::EXCLUDE_END_DATE);


var_dump($period->contains('2019-01-31 00:00:00'));
var_dump($period->contains('2019-01-30 23:59:59'));

```

You can use start/end comparisons methods (that ignore exclusions) for more precise comparisons:

*   `startsAt()` start == date
*   `startsBefore()` start < date
*   `startsBeforeOrAt()` start <= date
*   `startsAfter()` start > date
*   `startsAfterOrAt()` start >= date
*   `endsAt()` end == date
*   `endsBefore()` end < date
*   `endsBeforeOrAt()` end <= date
*   `endsAfter()` end > date
*   `endsAfterOrAt()` end >= date
*   `isStarted()` start <= now
*   `isEnded()` end <= now
*   `isInProgress()` started but not ended
