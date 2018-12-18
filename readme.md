# Carbon

[![Latest Stable Version](https://img.shields.io/packagist/v/nesbot/carbon.svg?style=flat-square)](https://packagist.org/packages/nesbot/carbon)
[![Total Downloads](https://img.shields.io/packagist/dt/nesbot/carbon.svg?style=flat-square)](https://packagist.org/packages/nesbot/carbon)
[![Build Status](https://img.shields.io/travis/briannesbitt/Carbon.svg?style=flat-square)](https://travis-ci.org/briannesbitt/Carbon)
[![StyleCI](https://styleci.io/repos/5724990/shield?style=flat-square)](https://styleci.io/repos/5724990)
[![codecov.io](https://img.shields.io/codecov/c/github/briannesbitt/Carbon.svg?style=flat-square)](https://codecov.io/github/briannesbitt/Carbon?branch=master)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-44CC11.svg?longCache=true&style=flat-square)](https://github.com/phpstan/phpstan)
[![Tidelift](https://tidelift.com/badges/github/briannesbitt/Carbon)](https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=readme)

A simple PHP API extension for DateTime. [http://carbon.nesbot.com](http://carbon.nesbot.com)

```php
use Carbon\Carbon;

printf("Right now is %s", Carbon::now()->toDateTimeString());
printf("Right now in Vancouver is %s", Carbon::now('America/Vancouver'));  //implicit __toString()
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();
$nextSummerOlympics = Carbon::createFromDate(2016)->addYears(4);

$officialDate = Carbon::now()->toRfc2822String();

$howOldAmI = Carbon::createFromDate(1975, 5, 21)->age;

$noonTodayLondonTime = Carbon::createFromTime(12, 0, 0, 'Europe/London');

$internetWillBlowUpOn = Carbon::create(2038, 01, 19, 3, 14, 7, 'GMT');

// Don't really want this to happen so mock now
Carbon::setTestNow(Carbon::createFromDate(2000, 1, 1));

// comparisons are always done in UTC
if (Carbon::now()->gte($internetWillBlowUpOn)) {
    die();
}

// Phew! Return to normal behaviour
Carbon::setTestNow();

if (Carbon::now()->isWeekend()) {
    echo 'Party!';
}
echo Carbon::now()->subMinutes(2)->diffForHumans(); // '2 minutes ago'

// ... but also does 'from now', 'after' and 'before'
// rolling up to seconds, minutes, hours, days, months, years

$daysSinceEpoch = Carbon::createFromTimestamp(0)->diffInDays();
```

[Get supported nesbot/carbon with the Tidelift Subscription](https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=readme)

## Installation

### With Composer

```
$ composer require nesbot/carbon
```

```json
{
    "require": {
        "nesbot/carbon": "^1.33"
    }
}
```

```php
<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

printf("Now: %s", Carbon::now());
```

<a name="install-nocomposer"/>

### Without Composer

Why are you not using [composer](http://getcomposer.org/)? Download the Carbon [latest release](https://github.com/briannesbitt/Carbon/releases) and put the contents of the ZIP archive into a directory in your project. Then require the file `autoload.php` to get all classes and dependencies loaded on need.

```php
<?php
require 'path-to-Carbon-directory/autoload.php';

use Carbon\Carbon;

printf("Now: %s", Carbon::now());
```

## Docs

[http://carbon.nesbot.com/docs](http://carbon.nesbot.com/docs)

## Security contact information

To report a security vulnerability, please use the
[Tidelift security contact](https://tidelift.com/security).
Tidelift will coordinate the fix and disclosure.
