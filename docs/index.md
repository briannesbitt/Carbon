---
# https://vitepress.dev/reference/default-theme-home-page
layout: home

hero:
  name: "Carbon"
  text: "PHP DateTime API Extension"
  tagline: A simple PHP API extension for DateTime.
  image:
    src: /carbon-logo-large.png
    alt: Carbon
  actions:
    - theme: brand
      text: Guide
      link: /guide/getting-started/introduction
    - theme: alt
      text: Reference
      link: /develop/reference
features:
  - title: Human-Readable Date Formats
    details: Easily display dates in a user-friendly format, like "2 days ago" or "next Friday."
  - title: Immutable Dates
    details: Carbon uses immutable dates, ensuring that operations return new instances, avoiding side effects.
  - title: Date Arithmetic
    details: Quickly add or subtract time intervals like days, weeks, or months with simple methods.
  - title: Time Zone Handling
    details: Effortlessly convert between different time zones for accurate date and time representation.
  - title: Localization Support
    details: Display dates in multiple languages and regional formats to support global users.
  - title: Date Comparisons
    details: Easily compare dates to check if one is before, after, or equal to another
---

```php{no-render}{no-sandbox}
printf("Right now is %s", Carbon::now()->toDateTimeString());
printf("Right now in Vancouver is %s", Carbon::now('America/Vancouver')); // automatically converted to string
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();

// Carbon embed 823 languages:
echo $tomorrow->locale('fr')->isoFormat('dddd, MMMM Do YYYY, h:mm');
echo $tomorrow->locale('ar')->isoFormat('dddd, MMMM Do YYYY, h:mm');

$officialDate = Carbon::now()->toRfc2822String();

$howOldAmI = Carbon::createFromDate(1975, 5, 21)->age;

$noonTodayLondonTime = Carbon::createFromTime(12, 0, 0, 'Europe/London');

$internetWillBlowUpOn = Carbon::create(2038, 01, 19, 3, 14, 7, 'GMT');

if (Carbon::now()->isWeekend()) {
    echo 'Party!';
}
echo Carbon::now()->subMinutes(2)->diffForHumans(); // '2 minutes ago'

```

### Sponsors
Our sponsors make our engagement stronger and sustain the development and maintenance, a big thank you to them. 🙏
Support this project by becoming a sponsor. Your logo will show up here with a link to your website. [Become a sponsor](https://opencollective.com/Carbon#sponsor)*

\* This is a donation. No goods or services are expected in return. Any requests for refunds for those purposes will be rejected.

<Sponsors status="sponsor"/>

### Backers
Thank you to all our backers! 🙏 [Become a backer](https://opencollective.com/Carbon#backer)
<Sponsors status="backerPlus"/>
<Sponsors status="backer"/>

### Authors

Created by [Brian Nesbitt](https://x.com/NesbittBrian),
maintained by [kylekatarnls](https://github.com/kylekatarnls),
and improved by [hundreds of contributors](https://github.com/CarbonPHP/carbon/graphs/contributors) 👥👥
