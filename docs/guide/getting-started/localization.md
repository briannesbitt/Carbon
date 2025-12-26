---
order: 3
---

# Localization

You can customize translations:

```php

// we recommend to use custom language name/variant
// rather than overriding an existing language
// to avoid conflict such as "en_Boring" in the example below:
$boringLanguage = 'en_Boring';
$translator = \Carbon\Translator::get($boringLanguage);
$translator->setTranslations([
	'day' => ':count boring day|:count boring days',
]);
// as this language starts with "en_" it will inherit from the locale "en"

$date1 = Carbon::create(2018, 1, 1, 0, 0, 0);
$date2 = Carbon::create(2018, 1, 4, 4, 0, 0);


echo $date1->locale($boringLanguage)->diffForHumans($date2);


$translator->setTranslations([
	'before' => function ($time) {
		return '['.strtoupper($time).']';
	},
]);


echo $date1->locale($boringLanguage)->diffForHumans($date2);

```

You can use fallback locales by passing in order multiple ones to `locale()`:

```php

\Carbon\Translator::get('xx')->setTranslations([
	'day' => ':count Xday',
]);
\Carbon\Translator::get('xy')->setTranslations([
	'day' => ':count Yday',
	'hour' => ':count Yhour',
]);

$date = Carbon::now()->locale('xx', 'xy', 'es')->sub('3 days 6 hours 40 minutes');


echo $date->ago(['parts' => 3]);

```

In the example above, it will try to find translations in "xx" in priority, then in "xy" if missing, then in "es", so here, you get "Xday" from "xx", "Yhour" from "xy", and "hace" and "minutos" from "es".

Note that you can also use an other translator with `Carbon::setTranslator($custom)` as long as the given translator implements [`Symfony\Component\Translation\TranslatorInterface`](https://symfony.com/doc/current/translation.html). And you can get the global default translator using `Carbon::getTranslator()` (and `Carbon::setFallbackLocale($custom)` and `Carbon::getFallbackLocale()` for the fallback locale, setFallbackLocale can be called multiple times to get multiple fallback locales) but as those method will change the behavior globally (including third-party libraries you may have in your app), it might cause unexpected results. You should rather customize translation using custom locales as in the example above.

Carbon embed a default translator that extends `Symfony\\Component\\Translation\\Translator` You can [check here the methods we added to it](#symfony-translator-details).

You can check what's supported with the following methods:

```php
echo implode(', ', array_slice(Carbon::getAvailableLocales(), 0, 3)).'...';

// Support diff syntax (before, after, from now, ago)
var_dump(Carbon::localeHasDiffSyntax('en'));
var_dump(Carbon::localeHasDiffSyntax('zh_TW'));
// Support 1-day diff words (just now, yesterday, tomorrow)
var_dump(Carbon::localeHasDiffOneDayWords('en'));
var_dump(Carbon::localeHasDiffOneDayWords('zh_TW'));
// Support 2-days diff words (before yesterday, after tomorrow)
var_dump(Carbon::localeHasDiffTwoDayWords('en'));
var_dump(Carbon::localeHasDiffTwoDayWords('zh_TW'));
// Support short units (1y = 1 year, 1mo = 1 month, etc.)
var_dump(Carbon::localeHasShortUnits('en'));
var_dump(Carbon::localeHasShortUnits('zh_TW'));
// Support period syntax (X times, every X, from X, to X)
var_dump(Carbon::localeHasPeriodSyntax('en'));
var_dump(Carbon::localeHasPeriodSyntax('zh_TW'));

```

So, here is the new recommended way to handle internationalization with Carbon.

```php
$date = Carbon::now()->locale('fr_FR');

echo $date->locale();
echo "\n";
echo $date->diffForHumans();
echo "\n";
echo $date->monthName;
echo "\n";
echo $date->isoFormat('LLLL');

```

The `->locale()` method only change the language for the current instance and has precedence over global settings. We recommend you this approach so you can't have conflict with other places or third-party libraries that could use Carbon. Nevertheless, to avoid calling `->locale()` each time, you can use factories.

```php
// Let say Martin from Paris and John from Chicago play chess
$martinDateFactory = new Factory([
	'locale' => 'fr_FR',
	'timezone' => 'Europe/Paris',
]);
$johnDateFactory = new Factory([
	'locale' => 'en_US',
	'timezone' => 'America/Chicago',
]);
// Each one will see date in his own language and timezone

// When Martin moves, we display things in French, but we notify John in English:
$gameStart = Carbon::parse('2018-06-15 12:34:00', 'UTC');
$move = Carbon::now('UTC');
$toDisplay = $martinDateFactory->make($gameStart)->isoFormat('lll')."\n".
$martinDateFactory->make($move)->calendar()."\n";
$notificationForJohn = $johnDateFactory->make($gameStart)->isoFormat('lll')."\n".
$johnDateFactory->make($move)->calendar()."\n";
echo $toDisplay;

echo $notificationForJohn;

```

You can call any static Carbon method on a factory (make, now, yesterday, tomorrow, parse, create, etc.) Factory (and FactoryImmutable that generates CarbonImmutable instances) are the best way to keep things organized and isolated. As often as possible we recommend you to work with UTC dates, then apply locally (or with a factory) the timezone and the language before displaying dates to the user.

What factory actually do is using the method name as static constructor then call `settings()` method which is a way to group in one call settings of locale, timezone, months/year overflow, etc. ([See references for complete list.](../../develop/reference.html#carbon-settings))

```php
$factory = new Factory([
	'locale' => 'fr_FR',
	'timezone' => 'Europe/Paris',
]);
$factory->now(); // You can recall $factory as needed to generate new instances with same settings
// is equivalent to:
Carbon::now()->settings([
	'locale' => 'fr_FR',
	'timezone' => 'Europe/Paris',
]);
// Important note: timezone setting calls ->shiftTimezone() and not ->setTimezone(),
// It means it does not just set the timezone, but shift the time too:

echo Carbon::today()->setTimezone('Asia/Tokyo')->format('d/m G\h e');
echo "\n";
echo Carbon::today()->shiftTimezone('Asia/Tokyo')->format('d/m G\h e');

// You can find back which factory created a given object:
$a = $factory->now();
$b = Carbon::now();

var_dump($a->getClock()->unwrap() === $factory);
var_dump($b->getClock());

```

`settings()` also allow to pass local macros:

```php
$date = Carbon::parse('Today 12:34:56')->settings([
	'macros' => [
		'lastSecondDigit' => fn () => self::this()->second % 10,
	],
]);

echo $date->lastSecondDigit();
var_dump($date->hasLocalMacro('lastSecondDigit'));
// You can also retrieve the macro closure using ->getLocalMacro('lastSecondDigit')

```

Factory settings can be changed afterward with `setSettings(array $settings)` or to merge new settings with existing ones `mergeSettings(array $settings)` and the class to generate can be initialized as the second argument of the construct then changed later with `setClassName(string $className)`.

```php
$factory = new Factory(['locale' => 'ja'], CarbonImmutable::class);

var_dump($factory->now()->locale);
var_dump(get_class($factory->now()));

class MyCustomCarbonSubClass extends Carbon { /* ... */ }
$factory
	->setSettings(['locale' => 'zh_CN'])
	->setClassName(MyCustomCarbonSubClass::class);

var_dump($factory->now()->locale);
var_dump(get_class($factory->now()));

```

Previously there was `Carbon::setLocale` that set globally the locale. But as for our other static setters, we highly discourage you to use it. It breaks the principle of isolation because the configuration will apply for every class that uses Carbon.

`->isoFormat(string $format): string` use ISO format rather than PHP-specific format and use inner translations rather than language packages you need to install on every machine where you deploy your application. `isoFormat` method is compatible with [momentjs format method](https://momentjs.com/), it means you can use same format strings as you may have used in moment from front-end or node.js. Here are some examples:

```php
$date = Carbon::parse('2018-06-15 17:34:15.984512', 'UTC');
echo $date->isoFormat('MMMM Do YYYY, h:mm:ss a');
echo "\n";
echo $date->isoFormat('dddd');
echo "\n";
echo $date->isoFormat('MMM Do YY');
echo "\n";
echo $date->isoFormat('YYYY [escaped] YYYY');

```

You can also create date from ISO formatted strings:

```php
$date = Carbon::createFromIsoFormat('!YYYY-MMMM-D h:mm:ss a', '2019-January-3 6:33:24 pm', 'UTC');
echo $date->isoFormat('M/D/YY HH:mm');

```

`->isoFormat` use contextualized methods for day names and month names as they can have multiple forms in some languages, see the following examples:

```php
$date = Carbon::parse('2018-03-16')->locale('uk');
echo $date->getTranslatedDayName('[в] dddd');
// By providing a context, we're saying translate day name like in a format such as [в] dddd
// So the context itself has to be translated first consistently.
echo "\n";
echo $date->getTranslatedDayName('[наступної] dddd');
echo "\n";
echo $date->getTranslatedDayName('dddd, MMM');
echo "\n";
// The same goes for short/minified variants:
echo $date->getTranslatedShortDayName('[наступної] dd');
echo "\n";
echo $date->getTranslatedMinDayName('[наступної] ddd');
echo "\n";

// And the same goes for months
$date->locale('ru');
echo $date->getTranslatedMonthName('Do MMMM');
echo "\n";
echo $date->getTranslatedMonthName('MMMM YYYY');
echo "\n";
// Short variant
echo $date->getTranslatedShortMonthName('Do MMM');
echo "\n";
echo $date->getTranslatedShortMonthName('MMM YYYY');
echo "\n";

// And so you can force a different context to get those variants:
echo $date->isoFormat('Do MMMM');
echo "\n";
echo $date->isoFormat('MMMM YYYY');
echo "\n";
echo $date->isoFormat('Do MMMM', 'MMMM YYYY');
echo "\n";
echo $date->isoFormat('MMMM YYYY', 'Do MMMM');
echo "\n";

```

Here is the complete list of available replacements (examples given with `$date = Carbon::parse('2017-01-05 17:04:05.084512');`):
<!--@include: @/parts/localization/replacements.md-->

Some macro-formats are also available. Here are examples of each in some languages:
<!--@include: @/parts/localization/macro-format.md-->


When you use macro-formats with `createFromIsoFormat` you can specify a locale to select which language the macro-format should be searched in.

```php
$date = Carbon::createFromIsoFormat('LLLL', 'Monday 11 March 2019 16:28', null, 'fr');
echo $date->isoFormat('M/D/YY HH:mm');

```

Another usefull translated method is `calendar($referenceTime = null, array $formats = []): string`:

```php
$date = CarbonImmutable::now();
echo $date->calendar();
echo "\n";
echo $date->sub('1 day 3 hours')->calendar();
echo "\n";
echo $date->sub('3 days 10 hours 23 minutes')->calendar();
echo "\n";
echo $date->sub('8 days')->calendar();
echo "\n";
echo $date->add('1 day 3 hours')->calendar();
echo "\n";
echo $date->add('3 days 10 hours 23 minutes')->calendar();
echo "\n";
echo $date->add('8 days')->calendar();
echo "\n";
echo $date->locale('fr')->calendar();

```

If you know momentjs, then it works the same way. You can pass a reference date as second argument, else now is used. And you can customize one or more formats using the second argument (formats to pass as array keys are: sameDay, nextDay, nextWeek, lastDay, lastWeek and sameElse):

```php
$date1 = CarbonImmutable::parse('2018-01-01 12:00:00');
$date2 = CarbonImmutable::parse('2018-01-02 8:00:00');

echo $date1->calendar($date2, [
	'lastDay' => '[Previous day at] LT',
]);


```

[Click here](#supported-locales) to get an overview of the `echo count(Carbon::getAvailableMacroLocales());`{render} locales (and `echo count(Carbon::getAvailableLocales());`{render} regional variants) supported by the last Carbon version.


If you can add missing translations or missing languages, [please go to translation tool](/develop/translations/available-translations), your help is welcome.

Note that if you use Laravel, the locale will be automatically set according to current last `App:setLocale` execution. So `diffForHumans`, `isoFormat`, `translatedFormat` and localized properties such as `->dayName` or `->monthName` will be localized transparently.

All Carbon, CarbonImmutable, CarbonInterval or CarbonPeriod instances are linked by default to a `Carbon\Translator` instance handled by `FactoryImmutable::getDefaultInstance()` (The one changing when calling the static method `::setLocale()` on one of those classes). You can get and/or change it using `getLocalTranslator()`/`setLocalTranslator(Translator $translator)`.

If you prefer the [`date()` pattern](https://php.net/manual/en/function.date.php), you can use `translatedFormat()` which works like [`format()`](https://php.net/manual/en/datetime.format.php) but translate the string using the current locale.

```php
$date = Carbon::parse('2018-03-16 15:45')->locale('uk');

echo $date->translatedFormat('g:i a l jS F Y');

```

Be warned that some letters like `W` are not supported because they are not safely translatable and `translatedFormat` offers shorter syntax but less possibilities than `isoFormat()`.

You can customize the behavior of the `format()` method to use any other method or a custom one instead of the native method from the PHP DateTime class:

```php
$date = Carbon::parse('2018-03-16 15:45')->locale('ja');

echo $date->format('g:i a l jS F Y');
echo "\n";

$date->settings(['formatFunction' => 'translatedFormat']);

echo $date->format('g:i a l jS F Y');
echo "\n";

$date->settings(['formatFunction' => 'isoFormat']);

echo $date->format('LL');
echo "\n";

// When you set a custom format() method you still can access the native method using rawFormat()
echo $date->rawFormat('D');

```

You can translate a string from a language to another using dates translations available in Carbon:

```php
echo Carbon::translateTimeString('mercredi 8 juillet', 'fr', 'nl');

echo "\n";

// You can select translations to use among available constants:
// - CarbonInterface::TRANSLATE_MONTHS
// - CarbonInterface::TRANSLATE_DAYS
// - CarbonInterface::TRANSLATE_UNITS
// - CarbonInterface::TRANSLATE_MERIDIEM
// - CarbonInterface::TRANSLATE_ALL (all above)
// You can combine them with pipes: like below (translate units and days but not months and meridiem):
echo Carbon::translateTimeString('mercredi 8 juillet + 3 jours', 'fr', 'nl', CarbonInterface::TRANSLATE_DAYS | CarbonInterface::TRANSLATE_UNITS);


```

If input locale is not specified, `Carbon::getLocale()` is used instead. If output locale is not specified, `"en"` is used instead. You also can translate using the locale of the instance with:

```php
echo Carbon::now()->locale('fr')->translateTimeStringTo('mercredi 8 juillet + 3 jours', 'nl');


```

You can use strings in any language directly to create a date object with `parseFromLocale`:

```php
$date = Carbon::parseFromLocale('mercredi 6 mars 2019 + 3 jours', 'fr', 'UTC'); // timezone is optional
// 'fr' stands for French but can be replaced with any locale code.
// if you don't pass the locale parameter, Carbon::getLocale() (current global locale) is used.

echo $date->isoFormat('LLLL');

```

You can also use "today", "today at 8:00", "yesterday", "after tomorrow", etc. equivalents in the given language.

Or with custom format using `createFromLocaleFormat` (use the [`date()` pattern](https://php.net/manual/en/function.date.php) for replacements):

```php
$date = Carbon::createFromLocaleFormat('!d/F/y', 'fr', '25/Août/19', 'Europe/Paris'); // timezone is optional

echo $date->isoFormat('LLLL');

```

The equivalent method using ISO format is `createFromLocaleIsoFormat`:

```php
$date = Carbon::createFromLocaleIsoFormat('!DD/MMMM/YY', 'fr', '25/Août/19', 'Europe/Paris'); // timezone is optional

echo $date->isoFormat('LLLL');

```

To get some interesting info about languages (such as complete ISO name or native name, region (for example to be displayed in a languages selector), you can use `getAvailableLocalesInfo`.

```php
$zhTwInfo = Carbon::getAvailableLocalesInfo()['zh_TW'];
$srCyrlInfo = Carbon::getAvailableLocalesInfo()['sr_Cyrl'];
$caInfo = Carbon::getAvailableLocalesInfo()['ca'];

var_dump($zhTwInfo->getId());
var_dump($zhTwInfo->getNames());
var_dump($zhTwInfo->getCode());
var_dump($zhTwInfo->getVariant());
var_dump($srCyrlInfo->getVariant());
var_dump($zhTwInfo->getVariantName());
var_dump($srCyrlInfo->getVariantName());
var_dump($zhTwInfo->getRegion());
var_dump($srCyrlInfo->getRegion());
var_dump($zhTwInfo->getRegionName());
var_dump($srCyrlInfo->getRegionName());
var_dump($zhTwInfo->getFullIsoName());
var_dump($caInfo->getFullIsoName());
var_dump($zhTwInfo->getFullNativeName());
var_dump($caInfo->getFullNativeName());
var_dump($zhTwInfo->getIsoName());
var_dump($caInfo->getIsoName());
var_dump($zhTwInfo->getNativeName());
var_dump($caInfo->getNativeName());
var_dump($zhTwInfo->getIsoDescription());
var_dump($srCyrlInfo->getIsoDescription());
var_dump($caInfo->getIsoDescription());
var_dump($zhTwInfo->getNativeDescription());
var_dump($srCyrlInfo->getNativeDescription());
var_dump($caInfo->getNativeDescription());
var_dump($zhTwInfo->getFullIsoDescription());
var_dump($srCyrlInfo->getFullIsoDescription());
var_dump($caInfo->getFullIsoDescription());
var_dump($zhTwInfo->getFullNativeDescription());
var_dump($srCyrlInfo->getFullNativeDescription());
var_dump($caInfo->getFullNativeDescription());

$srCyrlInfo->setIsoName('foo, bar')->setNativeName('biz, baz');
var_dump($srCyrlInfo->getIsoName());
var_dump($srCyrlInfo->getFullIsoName());
var_dump($srCyrlInfo->getFullIsoDescription());
var_dump($srCyrlInfo->getNativeName());
var_dump($srCyrlInfo->getFullNativeName());
var_dump($srCyrlInfo->getFullNativeDescription());

// You can also access directly regions/languages lists:
var_dump(\Carbon\Language::all()['zh']);
var_dump(\Carbon\Language::regions()['TW']);

```

If ever you have to change globally the locale for a particular process, you should use `executeWithLocale` to encapsulate this process. This way, even if an exception is thrown the global locale with be set back to its previous value.

```php

Carbon::executeWithLocale('fr', function () {
	echo CarbonInterval::create(2, 1)->forHumans() . "\n";
	echo Carbon::parse('-2 hours')->diffForHumans();
});

```
### Symfony Translator details

The Carbon translator will use internal directory `src/Carbon/Lang` to find translations files in it by default but you can change/add/remove directory.

```php{no-render}
$translator = Translator::get('en');
$directories = $translator->getDirectories();
var_dump($directories); // Check actual directory

// Change the whole list
$translator->setDirectories([
	'corporate/translations',
	'users/translations',
]);
// Add one directory to the list
$translator->addDirectory('external/translations/directory');
// Remove one directory from the list
$translator->removeDirectory('users/translations');

// After such a settings change, you could need to clear the cache with `resetMessages`
$translator->resetMessages();

// To restore the initial settings simply recall setDirectories with the original list:
$translator->setDirectories($directories);


```

Then you can find all language files across those directories.

```php{no-render}
$translator = Translator::get();
var_dump($translator->getLocalesFiles()); // /path/to/af.php, /path/to/ar.php, etc.
var_dump($translator->getAvailableLocales()); // af, ar, etc.

// You can also filter files/locales starting with a given prefix:
echo implode(', ', array_map('basename', $translator->getLocalesFiles('fr')));
echo implode(', ', $translator->getAvailableLocales('fr'));

```

You can access some dynamic properties translated by calling following methods with the name of the base property.

```php

$date = Carbon::parse('2018-02-25 14:00');

echo $date->locale('af_ZA')->meridiem();
echo "\n";
echo $date->locale('af_ZA')->meridiem(true);
echo "\n";
// Some languages has alternative numbers available:
echo $date->locale('ja_JP')->translateNumber(45);
echo "\n";
// You can also choose a key linked to a numeric value to translate:
echo $date->locale('ja_JP')->getAltNumber('day');
// Note: translations methods like translateNumber and getAltNumber are available
// on CarbonInterval and CarbonPeriod too.
echo "\n";
echo $date->locale('en_SG')->ordinal('day');
echo "\n";
// As ordinal can be gender specific or have context dependency, you can pass the period format as second argument:

$date = Carbon::parse('2018-01-01 14:00');

echo $date->locale('fr_CH')->ordinal('isoWeek', 'w');
echo "\n";
echo $date->locale('fr_CH')->ordinal('day', 'd');
echo "\n";

```

Finally, you can get and set messages from the internal cache:

```php

$translator = Translator::get('en');

echo Carbon::now()->addSeconds(312)->setLocalTranslator($translator)->diffForHumans();
echo "\n";

// Below, setMessages will load the english file(s) if available and if not yet loaded in cache, then will change the
// 'from_now' translation
$translator->setMessages('en', [
	'from_now' => 'in :time',
]);

echo Carbon::now()->addSeconds(312)->setLocalTranslator($translator)->diffForHumans();
echo "\n";
echo $translator->getMessages('en')['from_now'];

```

`setMessages` is equivalent to `setTranslations` but you can omit the locale as it will use the current one, so we recommend to use it when you can as in [this previous example](#localization).

### Supported Locales
<!--@include: @/parts/localization/supported-locales.md-->

Please let me close this section by thanking some projects that helped us a lot to support more locales, and internationalization features:

*   [jenssegers/date](https://github.com/jenssegers/date): many features were in this project that extends Carbon before being in Carbon itself.
*   [momentjs](https://momentjs.com): many features are inspired by momentjs and made to be compatible with this front-side pair project.
*   [glibc](https://www.gnu.org/software/libc/) was a strong base for adding and checking languages.
*   [svenfuchs/rails-i18n](https://github.com/svenfuchs/rails-i18n) also helped to add and check languages.
*   We used [glosbe.com](https://glosbe.com/) a lot to check translations and fill blanks.
