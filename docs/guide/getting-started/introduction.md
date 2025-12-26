---
order: 1
---

# Introduction

The Carbon class is [inherited](https://www.php.net/manual/en/language.oop5.inheritance.php)
from the PHP [DateTime](https://www.php.net/manual/en/class.datetime.php) class.

```php {no-render}
namespace Carbon;

class Carbon extends \DateTime
{
    // code here
}
```

You can see from the code snippet above that the Carbon class is declared in the Carbon namespace. You need to
import the namespace to use Carbon without having to provide its fully qualified name each time.

```php {no-render}
use Carbon\Carbon;
```

Examples in this documentation will assume you imported classes of the Carbon namespace this way.

If you're using Laravel, you may check [our Laravel configuration and best-practices recommendations](/guide/getting-started/laravel).

If you're using Symfony, you may check [our Symfony configuration and best-practices recommendations](/guide/getting-started/symfony).

We also provide CarbonImmutable class extending [DateTimeImmutable](https://www.php.net/manual/en/class.datetimeimmutable.php).
The same methods are available on both classes but when you use a modifier on a Carbon
instance, it modifies and returns the same instance, when you use it on CarbonImmutable,
it returns a new instance with the new value.

```php
$mutable = Carbon::now();
$immutable = CarbonImmutable::now();
$modifiedMutable = $mutable->add(1, 'day');
$modifiedImmutable = CarbonImmutable::now()->add(1, 'day');

var_dump($modifiedMutable === $mutable);
var_dump($mutable->isoFormat('dddd D'));
var_dump($modifiedMutable->isoFormat('dddd D'));

// So it means $mutable and $modifiedMutable are the same object
// both set to now + 1 day.
var_dump($modifiedImmutable === $immutable);
var_dump($immutable->isoFormat('dddd D'));
var_dump($modifiedImmutable->isoFormat('dddd D'));

// While $immutable is still set to now and cannot be changed and
// $modifiedImmutable is a new instance created from $immutable
// set to now + 1 day.

$mutable = CarbonImmutable::now()->toMutable();
var_dump($mutable->isMutable());
var_dump($mutable->isImmutable());

$immutable = Carbon::now()->toImmutable();
var_dump($immutable->isMutable());
var_dump($immutable->isImmutable());
```

The library also provides CarbonInterface interface extends [DateTimeInterface](https://www.php.net/manual/en/class.datetimeinterface.php) and [JsonSerializable](https://www.php.net/manual/en/class.jsonserializable.php),
[CarbonInterval](../specialized-use/carbon-interval.html) class extends [DateInterval](https://www.php.net/manual/en/class.dateinterval.php),
[CarbonTimeZone](../specialized-use/carbon-time-zone.html) class extends [DateTimeZone](https://www.php.net/manual/en/class.datetimezone.php)
and [CarbonPeriod](../specialized-use/carbon-period.html) class polyfills [DatePeriod](https://www.php.net/manual/en/class.dateperiod.php).

Carbon has all the functions inherited from the base DateTime class. This approach allows you to access the
base functionality such as
[modify](https://www.php.net/manual/en/datetime.modify.php),
[format](https://www.php.net/manual/en/datetime.format.php) or
[getTimestamp](https://www.php.net/manual/en/datetime.gettimestamp.php).

Now, let's see how cool this documentation page is. Click on the code below:

```php
$dtToronto = Carbon::create(2012, 1, 1, 0, 0, 0, 'America/Toronto');
$dtVancouver = Carbon::create(2012, 1, 1, 0, 0, 0, 'America/Vancouver');
// Try to replace the 4th number (hours) or the last argument (timezone) with
// Europe/Paris for example and see the actual result on the right hand.
// It's alive!

echo $dtVancouver->diffInHours($dtToronto);
// Now, try to double-click on "diffInHours" or "create" to open
// the References panel.
// Once the references panel is open, you can use the search field to
// filter the list or click the (<) button to close it.
```

Some examples are static snippets, some other are editable (when there is a top right hand corner expand button).
You can also click on this button to open the snippet in a
new tab. You can double-click on method names in both static and dynamic examples.
