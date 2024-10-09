# Carbon

[![Latest Stable Version](https://img.shields.io/packagist/v/nesbot/carbon.svg?style=flat-square)](https://packagist.org/packages/nesbot/carbon)
[![Total Downloads](https://img.shields.io/packagist/dt/nesbot/carbon.svg?style=flat-square)](https://packagist.org/packages/nesbot/carbon)
[![GitHub Actions](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Factions-badge.atrox.dev%2Fbriannesbitt%2FCarbon%2Fbadge&style=flat-square&label=Build&logo=none)](https://github.com/briannesbitt/Carbon/actions)
[![codecov.io](https://img.shields.io/codecov/c/github/briannesbitt/Carbon.svg?style=flat-square)](https://codecov.io/github/briannesbitt/Carbon?branch=master)

An international PHP extension for DateTime. [https://carbon.nesbot.com](https://carbon.nesbot.com)

```php
<?php

use Carbon\Carbon;

printf("Right now is %s", Carbon::now()->toDateTimeString());
printf("Right now in Vancouver is %s", Carbon::now('America/Vancouver'));  //implicit __toString()
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();

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

$daysSinceEpoch = Carbon::createFromTimestamp(0)->diffInDays(); // something such as:
                                                                // 19817.6771
$daysUntilInternetBlowUp = $internetWillBlowUpOn->diffInDays(); // Negative value since it's in the future:
                                                                // -5037.4560

// Without parameter, difference is calculated from now, but doing $a->diff($b)
// it will count time from $a to $b.
Carbon::createFromTimestamp(0)->diffInDays($internetWillBlowUpOn); // 24855.1348
```

## Installation

### With Composer

```
$ composer require nesbot/carbon
```

```json
{
    "require": {
        "nesbot/carbon": "^3"
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

## Documentation

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

<!-- <open-collective-sponsors> -->
<a title="Онлайн казино 777 Україна" href="https://777.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн казино 777" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/7e572d50-1ce8-4d69-ae12-86cc80371373/ok-ua-777.png" width="96" height="96"></a>
<a title="Best non Gamstop sites in the UK" href="https://uk.nongamstopcasinos.net/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Best non Gamstop sites in the UK" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/34e340b8-e1de-4932-8a76-1b3ce2ec7ee8/logo_white%20bg%20(8).png" width="96" height="96"></a>
<a title="Non GamStop Bookies UK" href="https://nongamstopbookiesuk.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Non GamStop Bookies UK" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/43c5561c-8907-4ef7-a4ee-c6da054788b8/logo-site%20(3).jpg" width="96" height="96"></a>
<a title="Real Money Pokies" href="https://onlinecasinoskiwi.co.nz/real-money-pokies/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Real Money Pokies" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/7cee8fec-8c4d-44ac-8419-1d6b8d5a736e/NZ_logo%20(6)%20(2).jpg" width="96" height="96"></a>
<a title="#1 Guide To Online Gambling In Canada" href="https://casinohex.org/canada/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="CasinoHex Canada" src="https://opencollective-production.s3.us-west-1.amazonaws.com/79fdbcc0-a997-11eb-abbc-25e48b63c6dc.jpg" width="127.5" height="96"></a>
<a title="Bookmakers review site." href="https://www.sportsbookreviewsonline.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Sportsbook Reviews Online" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/6d499f24-d669-4fc6-bb5f-b87184aa7963/sportsbookreviewsonline_com.png" width="96" height="96"></a>
<a title="Trusted last mile route planning and route optimization" href="https://route4me.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Route4Me Route Planner" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/237386c3-48a2-47c6-97ac-5f888cdb4cda/Route4MeIconLogo.png" width="96" height="96"></a>
<a title="Znajdź najlepsze zakłady bukmacherskie w Polsce w 2023 roku. Probukmacher.pl to Twoje kompendium wiedzy na temat bukmacherów!" href="https://www.probukmacher.pl?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Probukmacher" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/caf50271-4560-4ffe-a434-ea15239168db/Screenshot_1.png" width="133.5" height="96"></a>
<a title="Casino-portugal.pt" href="https://casino-portugal.pt/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Casino-portugal.pt" src="https://logo.clearbit.com/casino-portugal.pt" width="96" height="96"></a>
<a title="inkedin" href="https://inkedin.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="inkedin" src="https://logo.clearbit.com/inkedin.com" width="64" height="64"></a>
<a title="Актуальний та повносправний рейтинг онлайн казино України, ґрунтований на відгуках реальних гравців." href="https://uk.onlinecasino.in.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн казино України" src="https://opencollective-production.s3.us-west-1.amazonaws.com/c0b4b090-eef8-11ec-9cb7-0527a205b226.png" width="64" height="64"></a>
<a title="OnlineCasinosSpelen" href="https://onlinecasinosspelen.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="OnlineCasinosSpelen" src="https://logo.clearbit.com/onlinecasinosspelen.com" width="64" height="64"></a>
<a title="casinorevisor.com" href="https://casinorevisor.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="casinorevisor.com" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/a69e1789-9f2f-4b24-8b85-c1d4fcecde2f/200x200_white_bg%201.png" width="64" height="64"></a>
<a title="Betwinner is an online bookmaker offering sports betting, casino games, and more." href="https://guidebook.betwinner.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Guidebook.BetWinner" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/82cab29a-7002-4924-83bf-2eecb03d07c4/0x0.png" width="64" height="64"></a>
<a title="Актуальний топ-рейтинг українських онлайн казино на гривні! Щоденне оновлення топу та унікальна система ранжування, основана на відгуках гравців!" href="https://onlinecasino.in.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн Казино Украины" src="https://opencollective-production.s3.us-west-1.amazonaws.com/8fdd8aa0-e273-11ec-a95e-d38fd331cabf.png" width="64" height="64"></a>
<a title="Entertainment" href="https://www.nongamstopbets.com/casinos-not-on-gamstop/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Non-GamStop Bets UK" src="https://logo.clearbit.com/nongamstopbets.com" width="64" height="64"></a>
<a title="Porównanie kasyn online w Polsce. Darmowe automaty online." href="https://onlinekasyno-polis.pl/" target="_blank"><img alt="Online Kasyno Polis" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/12fe53d4-b2e4-4601-b9ea-7b652c414a38/274px%20274px-2.png" width="64" height="64"></a>
<a title="Slots City® ➢ Лучшее лицензионно казино онлайн и оффлайн на гривны в Украине. 【 Более1500 игровых автоматов и слотов】✅ Официально и Безопасно" href="https://slotscity.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Slots City" src="https://opencollective-production.s3.us-west-1.amazonaws.com/d7e298c0-7abe-11ed-8553-230872f5e54d.png" width="59" height="42"></a>
<a title="Get professional support for Carbon" href="https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&amp;utm_medium=referral&amp;utm_campaign=docs" target="_blank"><img alt="Tidelift" src="https://carbon.nesbot.com/tidelift-brand.png" width="84" height="42"></a>
<a title="Gives a fun for our users" href="https://slotoking.ua/games/all-slots/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Ігрові автомати" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/94601d07-3205-4c60-9c2d-9b8194dbefb7/skg-blue.png" width="42" height="42"></a>
<a title="Fortune Tiger" href="https://fortune-tiger-br.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Fortune Tiger" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/88904f4a-f997-49e8-8fd4-5068acc85a98/fortune-tiger-slot-281-img-2.webp" width="42" height="42"></a>
<a title="Per tutte le ultime notizie sul gioco d&#039;azzardo Non AAMS, le recensioni e i bonus di iscrizione." href="https://casinononaams.online?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="casino non aams" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/c60b92d1-590c-48a5-9527-fb0909431a86/casino%20non%20aams%20icon.jpg" width="42" height="42"></a>
<a title="Ausmalbilder zum Ausdrucken" href="https://www.on7g.de/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="ON7G" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/cc2443c3-5799-4070-92a0-734607f1c625/onyedi.jpg" width="56" height="42"></a>
<a title="Credit Zaim" href="https://creditzaim.com.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Credit Zaim" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/a856ed4e-651d-47c9-aa7a-98059423b3a6/creditzaim_logo.png" width="42" height="42"></a>
<a title="TopRating.casino ➢ Путеводитель по онлайн-казино в Украине" href="https://toprating.casino/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Top Rating casino" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/fec14fc4-85b1-4fdc-971e-e8aabfc60926/toprating%20logo.jpg" width="42" height="42"></a><!-- </open-collective-sponsors> -->

[[See all](https://carbon.nesbot.com/#sponsors)]
[[Become a sponsor via OpenCollective](https://opencollective.com/Carbon#sponsor)]

<a href="https://github.com/getsentry" target="_blank"><img src="https://avatars.githubusercontent.com/u/1396951?s=128&v=4" width="42" height="42"></a>
<a href="https://github.com/codecov" target="_blank"><img src="https://avatars.githubusercontent.com/u/8226205?s=128&v=4" width="42" height="42"></a>

[[Become a sponsor via GitHub](https://github.com/sponsors/kylekatarnls)]

### Backers

Thank you to all our backers! 🙏

<a href="https://opencollective.com/Carbon#backers" target="_blank"><img src="https://opencollective.com/Carbon/backers.svg?width=890&version=2023-06-08-07-12"></a>

[[Become a backer](https://opencollective.com/Carbon#backer)]

## Carbon for enterprise

Available as part of the Tidelift Subscription.

The maintainers of ``Carbon`` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
