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
<a title="Онлайн казино 777 Україна" href="https://777.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн казино" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/7e572d50-1ce8-4d69-ae12-86cc80371373/ok-ua-777.png" width="64" height="64"></a>
<a title="#1 Guide To Online Gambling In Canada" href="https://casinohex.org/canada/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="CasinoHex Canada" src="https://opencollective-production.s3.us-west-1.amazonaws.com/79fdbcc0-a997-11eb-abbc-25e48b63c6dc.jpg" width="85" height="64"></a>
<a title="Znajdź najlepsze zakłady bukmacherskie w Polsce w 2023 roku. Probukmacher.pl to Twoje kompendium wiedzy na temat bukmacherów!" href="https://www.probukmacher.pl?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Probukmacher" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/caf50271-4560-4ffe-a434-ea15239168db/Screenshot_1.png" width="89" height="64"></a>
<a title="Gives a fun for our users" href="https://slotoking.ua/games/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Игровые автоматы" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/94601d07-3205-4c60-9c2d-9b8194dbefb7/skg-blue.png" width="64" height="64"></a>
<a title="Casino-portugal.pt" href="https://casino-portugal.pt/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Casino-portugal.pt" src="https://logo.clearbit.com/casino-portugal.pt" width="64" height="64"></a>
<a title="Slots City® ➢ Лучшее лицензионно казино онлайн и оффлайн на гривны в Украине. 【 Более1500 игровых автоматов и слотов】✅ Официально и Безопасно" href="https://slotscity.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Slots City" src="https://opencollective-production.s3.us-west-1.amazonaws.com/d7e298c0-7abe-11ed-8553-230872f5e54d.png" width="90" height="64"></a>
<a title="inkedin" href="https://inkedin.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="inkedin" src="https://logo.clearbit.com/inkedin.com" width="64" height="64"></a>
<a title="Актуальний та повносправний рейтинг онлайн казино України, ґрунтований на відгуках реальних гравців." href="https://uk.onlinecasino.in.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн казино України" src="https://opencollective-production.s3.us-west-1.amazonaws.com/c0b4b090-eef8-11ec-9cb7-0527a205b226.png" width="64" height="64"></a>
<a title="OnlineCasinosSpelen" href="https://onlinecasinosspelen.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="OnlineCasinosSpelen" src="https://logo.clearbit.com/onlinecasinosspelen.com" width="64" height="64"></a>
<a title="Best non Gamstop sites in the UK" href="https://nongamstopcasinos.net/gb/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Best non Gamstop sites in the UK" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/34e340b8-e1de-4932-8a76-1b3ce2ec7ee8/logo_white%20bg%20(8).png" width="64" height="64"></a>
<a title="Real Money Pokies" href="https://www.nzfirst.org.nz/real-money-pokies/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Real Money Pokies" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/30d38232-a9d6-4e95-a48c-641fdc4d96fd/NZ_logo%20(6)%20(1)%20(1).jpg" width="64" height="64"></a>
<a title="Non GamStop Bookies UK" href="https://nongamstopbookies.com/uk/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Non GamStop Bookies UK" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/43c5561c-8907-4ef7-a4ee-c6da054788b8/logo-site%20(3).jpg" width="64" height="64"></a>
<a title="Актуальний топ-рейтинг українських онлайн казино на гривні! Щоденне оновлення топу та унікальна система ранжування, основана на відгуках гравців!" href="https://onlinecasino.in.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн Казино Украины" src="https://opencollective-production.s3.us-west-1.amazonaws.com/8fdd8aa0-e273-11ec-a95e-d38fd331cabf.png" width="64" height="64"></a>
<a title="Twitter Video Downloader HD Tool allows you to store tweets on your device (mobile or PC) for free." href="https://ssstwitter.online/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="SSSTwitter" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/ba0d1daf-a894-4d98-95f7-a44d321364b3/Screenshot%202024-01-16%20at%2011.43.22.png" width="76" height="64"></a>
<a title="Entertainment" href="https://www.nongamstopbets.com/casinos-not-on-gamstop/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Non-GamStop Bets UK" src="https://logo.clearbit.com/nongamstopbets.com" width="64" height="64"></a>
<a title="Chudovo - international software development company with representative offices in Kyiv, Cologne, New York, Tallinn and London. It has been working on the market since 2006. Company has domain expertise in video security, logistics, medicine, finance and" href="https://chudovo.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Chudovo" src="https://opencollective-production.s3.us-west-1.amazonaws.com/326c19a0-2e87-11eb-a13a-c99a2a201d11.png" width="84" height="42"></a>
<a title="Entertainment" href="https://casinogap.org/uk/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="UK Casino Gap" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/143f9301-beec-4118-89d5-9a07a01345f3/casinogap-uk.png" width="42" height="42"></a>
<a title="NZ Gaming Portal" href="https://casinodeps.co.nz?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="NZ Casino Deps" src="https://logo.clearbit.com/casinodeps.co.nz" width="42" height="42"></a>
<a title="NonStop Sites" href="https://uk.nonstopcasino.org/non-gamstop-casinos/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="NonStopCasino.org" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/fd7ad905-8752-468f-ad20-582a24cca9d9/non-stop-casino.png" width="42" height="42"></a>
<a title="Siti Non AAMS" href="https://www.outlookindia.com/outlook-spotlight/migliori-siti-non-aams-siti-scommesse-senza-licenza-sicuri-news-294715?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Migliori Siti Non AAMS" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/392810da-6cb6-4938-a3cb-38bd0e1eb7de/migliori-siti-non-aams.png" width="42" height="42"></a>
<a title="List of trusted non GamStop casino reviews" href="https://nongamstopcasinos.org?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="UK NonGamStopCasinos" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/cbda0ee1-26ea-4252-9580-f1f9b317b1f7/nongamstopcasinos-uk.png" width="42" height="42"></a>
<a title="Online TikTok Video Download Tool" href="https://snaptik.pro?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="SnapTik" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/546bcd53-6615-457d-ab21-1db1c52b3af5/logo.jpg" width="42" height="42"></a>
<a title="IG Downloader is an Instagram Downloader service that offers a variety of tools to download Instagram content for free. Listed below are all the tools" href="https://indownloader.app/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="IG Downloader" src="https://logo.clearbit.com/indownloader.app" width="42" height="42"></a>
<a title="Proxidize is a mobile proxy creation and management platform that provides all needed components from hardware to cloud software and SIM cards." href="https://proxidize.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Proxidize" src="https://logo.clearbit.com/proxidize.com" width="42" height="42"></a>
<a title="Blastup offers Instagram growth services like buying likes, views, and followers, emphasizing real user engagement and instant delivery." href="https://blastup.com/buy-instagram-likes?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Blastup" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/955a0beb-9fe8-4753-ad92-fae8ef5382fc/favicon--dark.jpg" width="42" height="42"></a>
<a title="A self-hosted web radio management suite, including turnkey installer tools and an easy-to-use web app to manage your stations." href="https://azuracast.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="AzuraCast" src="https://opencollective-production.s3.us-west-1.amazonaws.com/3c12ea10-cdfb-11eb-9cf4-3760b386b76d.png" width="42" height="42"></a>
<a title="Triplebyte is the first software engineering job platform that is on the developer&#039;s side. Take our coding quiz!" href="https://triplebyte.com/os/opencollective?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Triplebyte" src="https://opencollective-production.s3.us-west-1.amazonaws.com/43e4f9d0-30cd-11ea-9c6b-e1142996e8b2.png" width="42" height="42"></a>
<a title="Connect your Collective to GitHub Sponsors: https://docs.opencollective.com/help/collectives/github-sponsors" href="https://github.com/sponsors/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="GitHub Sponsors" src="https://opencollective-production.s3.us-west-1.amazonaws.com/87b1d240-f617-11ea-9960-fd7e8ab20fe4.png" width="48" height="42"></a>
<a title="Salesforce" href="https://engineering.salesforce.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Salesforce" src="https://opencollective-production.s3.us-west-1.amazonaws.com/24d34880-df8d-11e9-949c-6bc2037b6bd5.png" width="42" height="42"></a>
<!-- </open-collective-sponsors> -->

[[Become a sponsor via OpenCollective](https://opencollective.com/Carbon#sponsor)]

<a href="https://github.com/johnrsimeone" target="_blank"><img src="https://avatars.githubusercontent.com/u/22871068?s=70&v=4" width="64" height="64"></a>
<a href="https://github.com/taylorotwell" target="_blank"><img src="https://avatars.githubusercontent.com/u/463230?s=128&v=4" width="64" height="64"></a>
<a href="https://github.com/getsentry" target="_blank"><img src="https://avatars.githubusercontent.com/u/1396951?s=128&v=4" width="64" height="64"></a>
<a href="https://github.com/codecov" target="_blank"><img src="https://avatars.githubusercontent.com/u/8226205?s=128&v=4" width="64" height="64"></a>

[[Become a sponsor via GitHub](https://github.com/sponsors/kylekatarnls)]

### Backers

Thank you to all our backers! 🙏

<a href="https://opencollective.com/Carbon#backers" target="_blank"><img src="https://opencollective.com/Carbon/backers.svg?width=890&version=2023-06-08-07-12"></a>

[[Become a backer](https://opencollective.com/Carbon#backer)]

## Carbon for enterprise

Available as part of the Tidelift Subscription.

The maintainers of ``Carbon`` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
