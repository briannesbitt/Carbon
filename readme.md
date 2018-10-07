# Carbon

[![Latest Stable Version](https://poser.pugx.org/nesbot/carbon/v/stable.png)](https://packagist.org/packages/nesbot/carbon)
[![Latest Beta Version](https://img.shields.io/packagist/vpre/nesbot/carbon.svg)](https://packagist.org/packages/nesbot/carbon)
[![Total Downloads](https://poser.pugx.org/nesbot/carbon/downloads.png)](https://packagist.org/packages/nesbot/carbon)
[![Build Status](https://travis-ci.org/briannesbitt/Carbon.svg?branch=master)](https://travis-ci.org/briannesbitt/Carbon)
[![StyleCI](https://styleci.io/repos/5724990/shield?style=flat)](https://styleci.io/repos/5724990)
[![codecov.io](https://codecov.io/github/briannesbitt/Carbon/coverage.svg?branch=master)](https://codecov.io/github/briannesbitt/Carbon?branch=master)
[![PHP-Eye](https://php-eye.com/badge/nesbot/carbon/tested.svg?style=flat)](https://php-eye.com/package/nesbot/carbon)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

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
