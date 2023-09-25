# Carbon

[![Latest Stable Version](https://img.shields.io/packagist/v/nesbot/carbon.svg?style=flat-square)](https://packagist.org/packages/nesbot/carbon)
[![Total Downloads](https://img.shields.io/packagist/dt/nesbot/carbon.svg?style=flat-square)](https://packagist.org/packages/nesbot/carbon)
[![GitHub Actions](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Factions-badge.atrox.dev%2Fbriannesbitt%2FCarbon%2Fbadge&style=flat-square&label=Build&logo=none)](https://github.com/briannesbitt/Carbon/actions)
[![codecov.io](https://img.shields.io/codecov/c/github/briannesbitt/Carbon.svg?style=flat-square)](https://codecov.io/github/briannesbitt/Carbon?branch=master)
[![Tidelift](https://tidelift.com/badges/github/briannesbitt/Carbon)](https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=readme)

An international PHP extension for DateTime. [https://carbon.nesbot.com](https://carbon.nesbot.com)

```php
<?php

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
// Over 200 languages (and over 500 regional variants) supported:
echo Carbon::now()->subMinutes(2)->diffForHumans(); // '2 minutes ago'
echo Carbon::now()->subMinutes(2)->locale('zh_CN')->diffForHumans(); // '2分钟前'
echo Carbon::parse('2019-07-23 14:51')->isoFormat('LLLL'); // 'Tuesday, July 23, 2019 2:51 PM'
echo Carbon::parse('2019-07-23 14:51')->locale('fr_FR')->isoFormat('LLLL'); // 'mardi 23 juillet 2019 14:51'

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
        "nesbot/carbon": "^2.16"
    }
}
```

```php
<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

printf("Now: %s", Carbon::now());
```

### Without Composer

Why are you not using [composer](https://getcomposer.org/)? Download the Carbon [latest release](https://github.com/briannesbitt/Carbon/releases) and put the contents of the ZIP archive into a directory in your project. Then require the file `autoload.php` to get all classes and dependencies loaded on need.

```php
<?php
require 'path-to-Carbon-directory/autoload.php';

use Carbon\Carbon;

printf("Now: %s", Carbon::now());
```

## Docs

[https://carbon.nesbot.com/docs](https://carbon.nesbot.com/docs)

## Security contact information

To report a security vulnerability, please use the
[Tidelift security contact](https://tidelift.com/security).
Tidelift will coordinate the fix and disclosure.

## Credits

### Contributors

This project exists thanks to all the people who contribute. 

<a href="https://github.com/briannesbitt/Carbon/graphs/contributors" target="_blank"><img src="https://opencollective.com/Carbon/contributors.svg?width=890&button=false" /></a>

### Translators

[Thanks to people helping us to translate Carbon in so many languages](https://carbon.nesbot.com/contribute/translators/)

### Sponsors

Support this project by becoming a sponsor. Your logo will show up here with a link to your website.

<a href="https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=readme" target="_blank"><img src="https://carbon.nesbot.com/tidelift-brand.png" width="256" height="64"></a><!-- <open-collective-sponsors> -->
<a title="#1 Guide To Online Gambling In Canada" href="https://casinohex.org/canada/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="CasinoHex Canada" src="https://opencollective-production.s3.us-west-1.amazonaws.com/79fdbcc0-a997-11eb-abbc-25e48b63c6dc.jpg" width="85" height="64"></a>
<a title="Casino-portugal.pt" href="https://casino-portugal.pt/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="Casino-portugal.pt" src="https://logo.clearbit.com/casino-portugal.pt" width="64" height="64"></a>
<a title="Slots City® ➢ Лучшее лицензионно казино онлайн и оффлайн на гривны в Украине. 【 Более1500 игровых автоматов и слотов】✅ Официально и Безопасно" href="https://slotscity.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="Slots City" src="https://opencollective-production.s3.us-west-1.amazonaws.com/d7e298c0-7abe-11ed-8553-230872f5e54d.png" width="90" height="64"></a>
<a title="Znajdź najlepsze zakłady bukmacherskie w Polsce w 2023 roku. Probukmacher.pl to Twoje kompendium wiedzy na temat bukmacherów!" href="https://www.probukmacher.pl?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="Probukmacher" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/caf50271-4560-4ffe-a434-ea15239168db/Screenshot_1.png" width="89" height="64"></a>
<a title="Gives a fun for our users" href="https://slotoking.ua/games/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="Игровые автоматы" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/94601d07-3205-4c60-9c2d-9b8194dbefb7/skg-blue.png" width="64" height="64"></a>
<a title="inkedin" href="https://inkedin.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="inkedin" src="https://logo.clearbit.com/inkedin.com" width="64" height="64"></a>
<a title="Актуальний та повносправний рейтинг онлайн казино України, ґрунтований на відгуках реальних гравців." href="https://uk.onlinecasino.kyiv.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="Онлайн казино України" src="https://opencollective-production.s3.us-west-1.amazonaws.com/c0b4b090-eef8-11ec-9cb7-0527a205b226.png" width="64" height="64"></a>
<a title="Chudovo - international software development company with representative offices in Kyiv, Cologne, New York, Tallinn and London. It has been working on the market since 2006. Company has domain expertise in video security, logistics, medicine, finance and" href="https://chudovo.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="Chudovo" src="https://opencollective-production.s3.us-west-1.amazonaws.com/326c19a0-2e87-11eb-a13a-c99a2a201d11.png" width="424" height="64"></a>
<a title="A self-hosted web radio management suite, including turnkey installer tools and an easy-to-use web app to manage your stations. " href="https://azuracast.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="AzuraCast" src="https://opencollective-production.s3.us-west-1.amazonaws.com/3c12ea10-cdfb-11eb-9cf4-3760b386b76d.png" width="64" height="64"></a>
<a title="Triplebyte is the first software engineering job platform that is on the developer&#039;s side. Take our coding quiz!" href="https://triplebyte.com/os/opencollective?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="Triplebyte" src="https://opencollective-production.s3.us-west-1.amazonaws.com/43e4f9d0-30cd-11ea-9c6b-e1142996e8b2.png" width="64" height="64"></a>
<a title="Connect your Collective to GitHub Sponsors: https://docs.opencollective.com/help/collectives/github-sponsors" href="https://github.com/sponsors/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="GitHub Sponsors" src="https://opencollective-production.s3.us-west-1.amazonaws.com/87b1d240-f617-11ea-9960-fd7e8ab20fe4.png" width="73" height="64"></a>
<a title="Salesforce" href="https://engineering.salesforce.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank" rel="sponsored"><img alt="Salesforce" src="https://opencollective-production.s3.us-west-1.amazonaws.com/24d34880-df8d-11e9-949c-6bc2037b6bd5.png" width="64" height="64"></a>
<!-- </open-collective-sponsors> -->

[[Become a sponsor via OpenCollective](https://opencollective.com/Carbon#sponsor)]

<a href="https://github.com/taylorotwell" target="_blank"><img src="https://avatars.githubusercontent.com/u/463230?s=128&v=4" width="64" height="64"></a>
<a href="https://github.com/usefathom" target="_blank"><img src="https://avatars.githubusercontent.com/u/38684088?s=128&v=4" width="64" height="64"></a>

[[Become a sponsor via GitHub](https://github.com/sponsors/kylekatarnls)]

### Backers

Thank you to all our backers! 🙏

<a href="https://opencollective.com/Carbon#backers" target="_blank"><img src="https://opencollective.com/Carbon/backers.svg?width=890&version=2023-06-08-07-12"></a>

[[Become a backer](https://opencollective.com/Carbon#backer)]

## Carbon for enterprise

Available as part of the Tidelift Subscription.

The maintainers of ``Carbon`` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
