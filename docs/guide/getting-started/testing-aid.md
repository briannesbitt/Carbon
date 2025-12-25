---
order: 4
---

# Testing Aids

The testing methods allow you to set a Carbon instance (real or mock) to be returned when a "now" instance is created. The provided instance will be used when retrieving any relative time from Carbon (now, today, yesterday, next month, etc.)

```php
$knownDate = Carbon::create(2001, 5, 21, 12); // create testing date
Carbon::setTestNow($knownDate); // set the mock (of course this could be a real mock object)
echo Carbon::getTestNow();
echo Carbon::now();
echo new Carbon();
echo new Carbon('now');
echo Carbon::parse('now');
echo Carbon::create(2001, 4, 21, 12)->diffForHumans();

// This will trigger an actual sleep(3) in prod, but when time is mocked,
// This will set the test-now to 3 seconds later:
Carbon::sleep(3);
echo Carbon::now();

var_dump(Carbon::hasTestNow());
Carbon::setTestNow(); // clear the mock
var_dump(Carbon::hasTestNow());
echo Carbon::now();
// Instead of mock and clear mock, you also can use withTestNow():

Carbon::withTestNow('2010-09-15', static function () {
    echo Carbon::now();
});

```

A more meaning full example:

```php

class SeasonalProduct
{
    protected $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function getPrice() {
        $multiplier = 1;
        if (Carbon::now()->month == 12) {
            $multiplier = 2;
        }

        return $this->price * $multiplier;
    }
}

$product = new SeasonalProduct(100);

Carbon::setTestNow(Carbon::parse('first day of March 2000'));
echo $product->getPrice();
Carbon::setTestNow(Carbon::parse('first day of December 2000'));
echo $product->getPrice();
Carbon::setTestNow(Carbon::parse('first day of May 2000'));
echo $product->getPrice();
Carbon::setTestNow();

```

Relative phrases are also mocked according to the given "now" instance.

```php
$knownDate = Carbon::create(2001, 5, 21, 12); // create testing date
Carbon::setTestNow($knownDate); // set the mock
echo new Carbon('tomorrow');  // ... notice the time !
echo new Carbon('yesterday');
echo new Carbon('next wednesday');
echo new Carbon('last friday');
echo new Carbon('this thursday');
Carbon::setTestNow(); // always clear it !

```

Since Carbon 2.56.0, `setTestNow()` no longer impact the timezone of the `Carbon::now()` instance you'll get. This was done because in real life, `Carbon::now()` returns a date with the timezone from `date_default_timezone_get()`. And tests should reflect this.

You can use `setTestNowAndTimezone()` to mock the time and change the default timezone using `date_default_timezone_set()`:

```php
Carbon::setTestNowAndTimezone(Carbon::parse('2022-01-24 10:45 America/Toronto'));
// or
Carbon::setTestNowAndTimezone('2022-01-24 10:45', 'America/Toronto');
echo Carbon::now()->format('Y-m-d e');
Carbon::setTestNow(); // clear time mock
date_default_timezone_set('UTC'); // restore default timezone

```

The list of words that are considered to be relative modifiers are:

*  \+
*   \-
*   ago
*   first
*   next
*   last
*   this
*   today
*   tomorrow
*   yesterday

Be aware that similar to the next(), previous() and modify() methods some of these relative modifiers will set the time to 00:00:00.

`Carbon::parse($time, $tz)` and `new Carbon($time, $tz)` both can take a timezone as second argument.

```php
echo Carbon::parse('2012-9-5 23:26:11.223', 'Europe/Paris')->timezone->getName();

```

[See Carbonite for more advanced Carbon testing features.](https://github.com/kylekatarnls/carbonite)

Carbonite is an additional package you can easily install using composer: `composer require --dev kylekatarnls/carbonite` then use to travel times in your unit tests as you would tell a story:

Add `use Carbon\Carbonite;` import at the top of the file.

```php
$holidays = CarbonPeriod::create('2019-12-23', '2020-01-06', CarbonPeriod::EXCLUDE_END_DATE);

Carbonite::freeze('2019-12-22'); // Freeze the time to a given date

var_dump($holidays->isStarted());

// Then go to anytime:
Carbonite::elapse('1 day');

var_dump($holidays->isInProgress());

Carbonite::jumpTo('2020-01-05 22:00');

var_dump($holidays->isEnded());

Carbonite::elapse('2 hours');

var_dump($holidays->isEnded());

Carbonite::rewind('1 microsecond');

var_dump($holidays->isEnded());

Carbonite::release(); // Release time after each test

```
