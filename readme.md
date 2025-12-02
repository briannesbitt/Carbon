# Carbon

[![Latest Stable Version](https://img.shields.io/packagist/v/nesbot/carbon.svg?style=flat-square)](https://packagist.org/packages/nesbot/carbon)
[![Total Downloads](https://img.shields.io/packagist/dt/nesbot/carbon.svg?style=flat-square)](https://packagist.org/packages/nesbot/carbon)
[![GitHub Actions](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Factions-badge.atrox.dev%2FCarbonPHP%2Fcarbon%2Fbadge&style=flat-square&label=Build&logo=none)](https://github.com/CarbonPHP/carbon/actions)
[![codecov.io](https://img.shields.io/codecov/c/github/CarbonPHP/carbon.svg?style=flat-square)](https://codecov.io/github/CarbonPHP/carbon/actions?branch=master)

An international PHP extension for DateTime. [https://carbon.nesbot.com](https://carbon.nesbot.com)

> [!NOTE]  
> We're migrating the repository from [briannesbitt/Carbon](https://github.com/briannesbitt/Carbon) to [CarbonPHP/carbon](https://github.com/CarbonPHP/carbon),
> which means if you're looking specific issues/pull-requests, you may have to search both. No other impact as code on both will be kept up to date. 

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

Why are you not using [composer](https://getcomposer.org/)? Download the Carbon [latest release](https://github.com/CarbonPHP/carbon/releases) and put the contents of the ZIP archive into a directory in your project. Then require the file `autoload.php` to get all classes and dependencies loaded on need.

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

<a href="https://github.com/CarbonPHP/carbon/graphs/contributors" target="_blank"><img src="https://opencollective.com/Carbon/contributors.svg?width=890&button=false" /></a>

### Translators

[Thanks to people helping us to translate Carbon in so many languages](https://carbon.nesbot.com/contribute/translators/)

### Sponsors

Support this project by becoming a sponsor. Your logo will show up here with a link to your website.

<!-- <open-collective-sponsors> -->
<a title="Нова українська букмекерська контора" href="https://betking.com.ua/sports-book/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Ставки на спорт" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/c56d2fe2-f9fb-4d63-947c-77575f4b15c6/stavki.jpg" width="96" height="96"></a>
<a title="Онлайн казино 777 Україна" href="https://777.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн казино 777" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/7e572d50-1ce8-4d69-ae12-86cc80371373/ok-ua-777.png" width="96" height="96"></a>
<a title="Best non Gamstop sites in the UK" href="https://www.pieria.co.uk/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Best non Gamstop sites in the UK" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/34e340b8-e1de-4932-8a76-1b3ce2ec7ee8/logo_white%20bg%20(8).png" width="96" height="96"></a>
<a title="Non GamStop Bookies UK" href="https://netto.co.uk/betting-sites-not-on-gamstop/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Non GamStop Bookies UK" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/51bfaa05-02b3-4cd9-b1a4-9d0d8f34cbae/%D0%97%D0%BD%D1%96%D0%BC%D0%BE%D0%BA%20%D0%B5%D0%BA%D1%80%D0%B0%D0%BD%D0%B0%202025-07-04%20%D0%BE%2015.21.16%20(1)%20(1)%20(1).jpg" width="126" height="96"></a>
<a title="Trusted last mile route planning and route optimization" href="https://route4me.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Route4Me Route Planner" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/237386c3-48a2-47c6-97ac-5f888cdb4cda/Route4MeIconLogo.png" width="96" height="96"></a>
<a title="gaia-wines.gr" href="https://www.gaia-wines.gr/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="gaia-wines.gr" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/a9b971ee-db5f-4400-8c4b-76cf9bc35015/IMAGE%202024-06-14%2013%3A54%3A14.jpg" width="96" height="96"></a>
<a title="Bei Releaf erhalten Sie schnell und diskret Ihr Cannabis Rezept online. Unsere Ärzte prüfen Ihre Angaben und stellen bei Eignung das Rezept aus. Anschließend können Sie legal und sicher medizinisches Cannabis über unsere Partnerapotheken kaufen." href="https://releaf.com/de?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Releaf – Medizinischer Cannabis Shop" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/b686d646-5029-4b4c-8cab-9645ab2679de/9da596d1-f48a-41ec-947d-a64dd8e7529c.png" width="96" height="96"></a>
<a title="Find the best Interac online casinos in Canada with secure payments, exclusive bonuses, and fast withdrawals." href="https://interac-casino.com/en-ca/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Interac-casino.com - Canada" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/865d9613-74db-45b6-9f33-3ba992682259/2025-09-10%2019.33.08.jpg" width="96" height="96"></a>
<a title="iDealeCasinos" href="https://idealecasinos.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="iDealeCasinos" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/907841d3-435e-44b4-9684-c33fd8635ece/ideale-casinos-square-white-logo-300.png" width="96" height="96"></a>
<a title="Casino Zonder Registratie" href="https://nl.trustpilot.com/review/casinozonderregistratie.vip?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Casino Zonder Registratie" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/0a2cd300-0080-491e-b293-8e59271abb68/1529a0d3-b219-43e3-ae94-defdca668d55.png" width="96" height="96"></a>
<a title="Porównanie kasyn online w Polsce. Darmowe automaty online." href="https://onlinekasyno-polis.pl/" target="_blank"><img alt="Online Kasyno Polis" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/12fe53d4-b2e4-4601-b9ea-7b652c414a38/274px%20274px-2.png" width="96" height="96"></a>
<a title="#1 Guide To Online Gambling In Canada" href="https://casinohex.org/canada/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="CasinoHex Canada" src="https://opencollective-production.s3.us-west-1.amazonaws.com/79fdbcc0-a997-11eb-abbc-25e48b63c6dc.jpg" width="127.5" height="96"></a>
<a title="Real Money Pokies" href="https://onlinecasinoskiwi.co.nz/real-money-pokies/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Real Money Pokies" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/d0f7382e-32ea-4425-a8c4-3019f9ed501c/NZ_logo%20(6)%20(2).jpg" width="96" height="96"></a><details><summary>See more</summary>
<a title="OnlineCasinosSpelen" href="https://onlinecasinosspelen.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="OnlineCasinosSpelen" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/47e87426-6a55-4f69-9fb5-4e5032dc35a8/5d10dd22-320e-47d4-84e6-d144874f1f5f.png" width="64" height="64"></a>
<a title="Betwinner is an online bookmaker offering sports betting, casino games, and more." href="https://guidebook.betwinner.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Guidebook.BetWinner" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/82cab29a-7002-4924-83bf-2eecb03d07c4/0x0.png" width="64" height="64"></a>
<a title="Онлайн казино casino.ua" href="https://casino.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн казино casino.ua" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/32790ee6-245b-45bd-acf7-7a661fe2cf9f/logo.png" width="64" height="64"></a>
<a title="Playfortune.net.br" href="https://playfortune.net.br/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Playfortune.net.br" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/bf7ba31d-648c-470f-bf7e-2293c5ca0509/62a0353e-3858-41f1-bbb3-597449949e66.png" width="64" height="64"></a>
<a title="https://play-fortune.pl/kasyno/z-minimalnym-depozytem/" href="https://play-fortune.pl/kasyno/z-minimalnym-depozytem/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="https://play-fortune.pl/kasyno/z-minimalnym-depozytem/" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/cbeea308-5148-4f6c-ac6e-dbfa029aadd1/PL.png" width="64" height="64"></a>
<a title="We specialize in the online gambling industry, helping players access reliable and verified information about the best online casinos and pokies in Australia. Our team tests casinos and games, collects user reviews from Trustpilot, and organizes them in o" href="https://au.trustpilot.com/review/bestpayidpokies.net?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="PayID Pokies" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/985a0ae7-54c3-4680-8816-bc8d656f7562/payidpokies.png" width="64" height="64"></a>
<a title="BetPokies NZ features top fast payout casinos where winnings are processed within hours. The speed depends on the casino and payment method, with the platform highlighting the best options for smooth, reliable play." href="https://betpokies.co.nz/casinos/fast-payout?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Fastest Payout Online Casino" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/37cba042-a941-4bfd-87c4-b4f4c1a98641/7912b3ee-3c62-4ebd-b435-6a9a88b2228b.png" width="64" height="64"></a>
<a title="Best POLi Casino Sites 2025" href="https://betpokies.co.nz/casinos/poli?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="POLi Pay Casinos" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/58e70d61-5927-4496-acd4-66dc2f924fbc/polipay.png" width="128" height="64"></a>
<a title="non Gamstop casinos" href="https://www.jostrust.org.uk/gambling/casinos-not-on-gamstop/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="non Gamstop casinos" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/49c5bb80-e713-458a-aa10-bc465843ddde/%D0%97%D0%BD%D1%96%D0%BC%D0%BE%D0%BA%20%D0%B5%D0%BA%D1%80%D0%B0%D0%BD%D0%B0%202025-08-05%20%D0%BE%2016.10.06%20(2).jpg" width="64" height="64"></a>
<a title="Best Casinos not on Gamstop in the UK 2025" href="https://www.vso.org.uk/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="best non Gamstop casinos" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/3f48874e-f2f6-4062-a2a2-1500677ee3d9/125%D1%85125%20(1).jpg" width="64" height="64"></a>
<a title="Best PayID Pokies in Australia" href="https://ausgambler.net/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="AusGambler" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/b120ff74-a4cc-4e25-a96f-2b040d60de14/payidgambler.png" width="64" height="64"></a>
<a title="Best-betting.net is an Indian website where you can always find interesting, useful, and up-to-date information about cricket and other sports. Additionally, on our portal, you can explore predictions and betting opportunities for the most exciting sports" href="https://best-betting.net/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Best Betting" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/4b437e94-747c-4cf5-be67-d11bf8472d76/bestbetting-logo-cover.png" width="64" height="64"></a>
<a title="Offshore bookmakers review site." href="https://www.sportsbookreviewsonline.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Sportsbook Reviews Online" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/6d499f24-d669-4fc6-bb5f-b87184aa7963/sportsbookreviewsonline_com.png" width="64" height="64"></a>
<a title="Ставки на спорт Favbet" href="https://www.favbet.ua/uk/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Ставки на спорт Favbet" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/d86d313e-7b17-42fa-8b76-3f17fbf681a2/favbet-logo.jpg" width="64" height="64"></a>
<a title="Uudet Nettikasinot" href="https://fi.parhaatuudetkasinot.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="parhaatuudetkasinot.com" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/09e109d6-8ad2-4ade-ab24-4427028c8e38/260bfa9d-6a5c-494d-9ec0-a624327429ae.png" width="64" height="64"></a>
<a title="Get professional support for Carbon" href="https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&amp;utm_medium=referral&amp;utm_campaign=docs" target="_blank"><img alt="Tidelift" src="https://carbon.nesbot.com/docs/sponsors/tidelift-brand.png" width="84" height="42"></a>
<a title="Онлайн казино та БК (ставки на спорт) в Україні" href="https://betking.com.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="betking онлайн казино" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/08587758-582c-4136-aba5-2519230960d3/betking.jpg" width="42" height="42"></a>
<a title="Legal-casino.net – незалежний інтернет-портал, присвячений ліцензійним онлайн казино України та азартним іграм в інтернеті. На якому не проводяться ігри на реальні чи віртуальні гроші." href="https://legal-casino.net/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Legal Casino" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/79978436-a1cb-42f1-8269-d495b232934a/legal-casino.jpg" width="42" height="42"></a>
<a title="Casino-portugal.pt" href="https://casino-portugal.pt/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Casino-portugal.pt" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/870b4bd0-b6aa-4129-9827-e8ac02cfde56/167bdc1d-0a19-414d-a288-cfc3278b388f.png" width="42" height="42"></a>
<a title="Znajdź najlepsze zakłady bukmacherskie w Polsce w 2023 roku. Probukmacher.pl to Twoje kompendium wiedzy na temat bukmacherów!" href="https://www.probukmacher.pl?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Probukmacher" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/caf50271-4560-4ffe-a434-ea15239168db/Screenshot_1.png" width="58" height="42"></a>
<a title="WestNews –  проект Александра Победы о гемблинге и онлайн-казино в Украине, предлагающий новости, обзоры, рейтинги и гиды по игорным заведениям." href="https://westnews.com.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="WestNews онлайн казино Украины" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/7fae83dd-0d53-42f7-b63c-d7062a86ccb1/3502ab17-a150-40e1-8f01-c26ff60c4cf8.png" width="42" height="42"></a>
<a title="inkedin" href="https://inkedin.com?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="inkedin" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/6cb31863-b725-49c5-820c-2c2be7d54adf/cc930e12-04de-4574-9cca-171e07d277c3.png" width="42" height="42"></a>
<a title="Актуальний та повносправний рейтинг онлайн казино України, ґрунтований на відгуках реальних гравців." href="https://uk.onlinecasino.in.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Онлайн казино України" src="https://opencollective-production.s3.us-west-1.amazonaws.com/c0b4b090-eef8-11ec-9cb7-0527a205b226.png" width="42" height="42"></a>
<a title="Slots City® ➢ Лучшее лицензионно казино онлайн и оффлайн на гривны в Украине. 【 Более1500 игровых автоматов и слотов】✅ Официально и Безопасно" href="https://slotscity.ua/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Slots City" src="https://opencollective-production.s3.us-west-1.amazonaws.com/d7e298c0-7abe-11ed-8553-230872f5e54d.png" width="59" height="42"></a>
<a title="Casinos not on Gamstop" href="https://lgcnews.com/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Non Gamstop Casinos" src="https://opencollective.com/static/images/default-guest-logo.svg" width="42" height="42"></a>
<a title="Are you looking for the latest online casino sites to play in the UK? How about ones that actually deliver on their promises? Every year new online casinos pops up, but are they worth your time? Check out https://helpdirect.org.uk" href="https://helpdirect.org.uk/?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="New Casino Sites UK (2025) Help Direct" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/d5e8c98f-7df3-40e8-bfe1-3c1583222eab/help-direct-logo-white-trans.png" width="42" height="42"></a>
<a title="Basswin Casino entered the market in 2024 and quickly gained attention for its wide selection of games, strong promotions, and fast payouts" href="https://www.trustpilot.com/review/basswincasinoreview.co.uk?utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon" target="_blank"><img alt="Basswin Casino" src="https://opencollective-production.s3.us-west-1.amazonaws.com/account-avatar/cd55d169-d6ee-4a62-848b-efbf6ee51e19/basswin-app.png" width="42" height="42"></a>
<a title="ssddanbrown" href="https://github.com/ssddanbrown" target="_blank"><img alt="ssddanbrown" src="https://avatars.githubusercontent.com/u/8343178?s=128&v=4" width="42" height="42"></a></details><!-- </open-collective-sponsors> -->

[[See all](https://carbon.nesbot.com/#sponsors)]

[[Become a sponsor via OpenCollective*](https://opencollective.com/Carbon#sponsor)]

[[Become a sponsor via GitHub*](https://github.com/sponsors/kylekatarnls)]

<small>* This is a donation. No goods or services are expected in return. Any requests for refunds for those purposes will be rejected.</small>

### Backers

Thank you to all our backers! 🙏

<a href="https://opencollective.com/Carbon#backers" target="_blank"><img src="https://opencollective.com/Carbon/backers.svg?width=890&version=2023-06-08-07-12"></a>

[[Become a backer](https://opencollective.com/Carbon#backer)]

## Carbon for enterprise

Available as part of the Tidelift Subscription.

The maintainers of ``Carbon`` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
