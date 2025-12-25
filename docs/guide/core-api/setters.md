---
order: 2
---

# Setters

The following setters are implemented via PHP's `__set()` method. Its good to take note here that none of the setters, with the obvious exception of explicitly setting the timezone, will change the timezone of the instance. Specifically, setting the timestamp will not set the corresponding timezone to UTC.

```php

$dt = Carbon::now();

$dt->year = 1975;
$dt->month = 13;             // would force year++ and month = 1
$dt->month = 5;
$dt->day = 21;
$dt->hour = 22;
$dt->minute = 32;
$dt->second = 5;

$dt->timestamp = 169957925;  // This will not change the timezone
// Same as:
$dt->setTimestamp(169957925);
$dt->timestamp(169957925);

// Set the timezone via DateTimeZone instance or string
$dt->tz = new \DateTimeZone('Europe/London');
$dt->tz = 'Europe/London';

// The ->timezone is also available for backward compatibility but
// it will be overridden by native php DateTime class as soon as
// the object is dump (passed foreach, serialize, var_export, clone, etc.)
// making the Carbon setter inefficient, if it happen, you can cleanup
// those overridden properties by calling ->cleanupDumpProperties() on
// the instance, but we rather recommend to simply use ->tz instead
// of ->timezone everywhere.

// verbose way:
$dt->setYear(2001);

echo $dt->year;
echo "\n";


// set/get method:
$dt->year(2002);

echo $dt->year();
echo "\n";


// dynamic way:
$dt->set('year', 2003);

echo $dt->get('year');
echo "\n";

// these methods exist for every units even for calculated properties such as:
echo $dt->dayOfYear(35)->format('Y-m-d');

```
