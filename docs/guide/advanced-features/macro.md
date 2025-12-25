# Macro

You may be familiar with the macro concept if you are used to working with Laravel and objects such as [response](https://laravel.com/docs/responses#response-macros) or [collections](https://laravel.com/docs/collections#extending-collections). Carbon macros works just like the Laravel `Macroable` Trait.

Call the `Carbon::macro()` method with the name of your macro as the first argument and a closure as the second argument. This will make the closure action available on all Carbon instances.

```php

Carbon::macro('diffFromYear', static function ($year, $absolute = false, $short = false, $parts = 1) {
	return self::this()->diffForHumans(Carbon::create($year, 1, 1, 0, 0, 0), $absolute, $short, $parts);
});


// Can be called on Carbon instances:
//    self::context() = current instance ($this) or null when called statically
//    self::this() = current instance ($this) or Carbon::now() when called statically
echo Carbon::parse('2020-01-12 12:00:00')->diffFromYear(2019);
echo "\n";
echo Carbon::parse('2020-01-12 12:00:00')->diffFromYear(2019, true);
echo "\n";
echo Carbon::parse('2020-01-12 12:00:00')->diffFromYear(2019, true, true);
echo "\n";
echo Carbon::parse('2020-01-12 12:00:00')->diffFromYear(2019, true, true, 5);

// Can also be called statically, in this case self::this() = Carbon::now()
echo "\n";
echo Carbon::diffFromYear(2017);

```

Note that the closure is preceded by `static` and uses `self::this()` (available since version 2.25.0) instead of `$this`. This is the standard way to create Carbon macros, and this also applies to macros on other classes (`CarbonImmutable`, `CarbonInterval` and `CarbonPeriod`).

By following this pattern you ensure other developers of you team (and future you) can rely safely on the assertion: `Carbon::anyMacro()` is equivalent to `Carbon::now()->anyMacro()`. This makes the usage of macros consistent and predictable and ensures developers that any macro can be called safely either statically or dynamically.

The sad part is IDE will not natively your macro method (no auto-completion for the method `diffFromYear` in the example above). But it's no longer a problem thanks to our CLI tool: [carbon-cli](https://github.com/kylekatarnls/carbon-cli) that allows you to generate IDE helper files for your mixins and macros.

Macros are the perfect tool to output dates with some settings or user preferences.

```php

// Let assume you get user settings from the browser or preferences stored in a database
$userTimezone = 'Europe/Paris';
$userLanguage = 'fr_FR';

Carbon::macro('formatForUser', static function () use ($userTimezone, $userLanguage) {
	$date = self::this()->copy()->tz($userTimezone)->locale($userLanguage);

	return $date->calendar(); // or ->isoFormat($customFormat), ->diffForHumans(), etc.
});

// Then let assume you store all your dates/times in UTC (because you definitely should)
$dateString = '2010-01-23 10:00:00'; // Get this from your database or any input


// Then now you can easily display any date in a page/e-mail using those user settings and the chosen format
echo Carbon::parse($dateString, 'UTC')->formatForUser();
echo "\n";
echo Carbon::tomorrow()->formatForUser();
echo "\n";
echo Carbon::now()->subDays(3)->formatForUser();

```

Macros can also be grouped in classes and be applied with `mixin()`

```php

class BeerDayCarbonMixin
{
	public function nextBeerDay()
	{
		return static function () {
			return self::this()->modify('next wednesday');
		};
	}

	public function previousBeerDay()
	{
		return static function () {
			return self::this()->modify('previous wednesday');
		};
	}
}

Carbon::mixin(new BeerDayCarbonMixin());

$date = Carbon::parse('First saturday of December 2018');


echo $date->previousBeerDay();
echo "\n";
echo $date->nextBeerDay();

```

Since Carbon 2.23.0, it's also possible to shorten the mixin syntax using traits:

```php

trait BeerDayCarbonTrait
{
	public function nextBeerDay()
	{
		return $this->modify('next wednesday');
	}

	public function previousBeerDay()
	{
		return $this->modify('previous wednesday');
	}
}

Carbon::mixin(BeerDayCarbonTrait::class);

$date = Carbon::parse('First saturday of December 2018');


echo $date->previousBeerDay();
echo "\n";
echo $date->nextBeerDay();

```

You can check if a macro (mixin included) is available with `hasMacro()` and retrieve the macro closure with `getMacro()`

```php
var_dump(Carbon::hasMacro('previousBeerDay'));
var_dump(Carbon::hasMacro('diffFromYear'));
echo "\n";
var_dump(Carbon::hasMacro('dontKnowWhat'));

```

A macro starting with `get` followed by an uppercase letter will automatically provide a dynamic getter whilst a macro starting with `set` and followed by an uppercase letter will provide a dynamic setter:

```php
// Let's say a school year starts 5 months before the start of the year, so the school year of 2018 actually begins in August 2017 and ends in July 2018,
// Then you can create get/set method this way:
Carbon::macro('setSchoolYear', static function ($schoolYear) {
	$date = self::this();
	$date->year = $schoolYear;

	if ($date->month > 7) {
		$date->year--;
	}
});
Carbon::macro('getSchoolYear', static function () {
	$date = self::this();
	$schoolYear = $date->year;

	if ($date->month > 7) {
		$schoolYear++;
	}

	return $schoolYear;
});
// This will make getSchoolYear/setSchoolYear as usual, but get/set prefix will also enable
// the getter and setter methods for the ->schoolYear property.

$date = Carbon::parse('2016-06-01');


var_dump($date->schoolYear);
$date->addMonths(3);
var_dump($date->schoolYear);
$date->schoolYear++;
var_dump($date->format('Y-m-d'));
$date->schoolYear = 2020;
var_dump($date->format('Y-m-d'));

```

You can also intercept any other call with generic macro:

```php

Carbon::genericMacro(static function ($method) {
	// As an example we will convert firstMondayOfDecember into first Monday Of December to get strings that
	// DateTime can parse.
	$time = preg_replace('/[A-Z]/', ' $0', $method);

	try {
		return self::this()->modify($time);
	} catch (\Throwable $exception) {
		if (stripos($exception->getMessage(), 'Failed to parse') !== false) {
			// When throwing BadMethodCallException from inside a generic macro will go to next generic macro
			// if there are other registered.
			throw new \BadMethodCallException('Try next macro', 0, $exception);
		}

		// Other exceptions thrown will not be caught
		throw $exception;
	}
}, 1 /* you can optionally pass a priority as a second argument, 0 by default, can be negative, higher priority ran first */);
// Generic macro get the asked method name as first argument, and method arguments as others.
// They can return any value.
// They can be added via "genericMacros" setting and this setting has precedence over statically declared generic macros.

$date = Carbon::parse('2016-06-01');


echo $date->nextSunday();
echo "\n";
echo $date->lastMondayOfPreviousMonth();
Carbon::resetMacros(); // resetMacros remove all macros and generic macro declared statically

```

And guess what? all macro methods are also available on [`CarbonInterval`](#api-interval) and [`CarbonPeriod`](#api-period) classes.

```php

CarbonInterval::macro('twice', static function () {
	return self::this()->times(2);
});

echo CarbonInterval::day()->twice()->forHumans();
$interval = CarbonInterval::hours(2)->addMinutes(15)->twice();
echo $interval->forHumans(['short' => true]);

```

```php

CarbonPeriod::macro('countWeekdays', static function () {
	return self::this()->filter('isWeekday')->count();
});

echo CarbonPeriod::create('2017-11-01', '2017-11-30')->countWeekdays();
echo CarbonPeriod::create('2017-12-01', '2017-12-31')->countWeekdays();

```

We provide a PHPStan extension out of the box you can include in your **phpstan.neon**:

```yaml
includes:
	- vendor/nesbot/carbon/extension.neon
parameters:
	bootstrapFiles:
		# You will also need to add here the file
		# that enable your macros and mixins:
		- config/bootstrap.php
```

If you're using Laravel, you can consider using [larastan](https://github.com/nunomaduro/larastan) which provides a complete support of Laravel features in PHPStan (including Carbon macros). Alternatively to include the neon file, you can install **phpstan/extension-installer**:

```
composer require --dev phpstan/phpstan phpstan/extension-installer
```

Then add the file where your Carbon macros and mixins are defined in the **bootstrapFiles** entry:

```yaml
parameters:
	bootstrapFiles:
		- config/bootstrap.php
```

**📦 Carbon extension libraries**

Check [cmixin/business-time](https://github.com/kylekatarnls/business-time) (that includes [cmixin/business-day](https://github.com/kylekatarnls/business-day)) to handle both holidays and business opening hours with a lot of advanced features.

Check [cmixin/season](https://github.com/kylekatarnls/season) to check if date is in a given season, which season of the year is a date, or when season starts and ends.

Check [cmixin/enhanced-period](https://github.com/kylekatarnls/enhanced-period) for more period features: \`touchesWith()\`, \`overlapsWith()\`, \`duration()\`, \`diff()\`, \`diffAny()\`, etc.

Check [Carbonite](https://github.com/kylekatarnls/carbonite) for more advanced Carbon testing features.

**🙌 More macros and mixins below shared by users**

```php

class CurrentDaysCarbonMixin
{
	/**
	 * Get the all dates of week
	 *
	 * @return array
	 */
	public static function getCurrentWeekDays()
	{
		return static function () {
			$startOfWeek = self::this()->startOfWeek()->subDay();
			$weekDays = [];

			for ($i = 0; $i < static::DAYS_PER_WEEK; $i++) {
				$weekDays[] = $startOfWeek->addDay()->startOfDay()->copy();
			}

			return $weekDays;
		};
	}

	/**
	 * Get the all dates of month
	 *
	 * @return array
	 */
	public static function getCurrentMonthDays()
	{
		return static function () {
			$date = self::this();
			$startOfMonth = $date->copy()->startOfMonth()->subDay();
			$endOfMonth = $date->copy()->endOfMonth()->format('d');
			$monthDays = [];

			for ($i = 0; $i < $endOfMonth; $i++)
			{
				$monthDays[] = $startOfMonth->addDay()->startOfDay()->copy();
			}

			return $monthDays;
		};
	}
}

Carbon::mixin(new CurrentDaysCarbonMixin());

function dumpDateList($dates) {
	echo substr(implode(', ', $dates), 0, 100).'...';
}


dumpDateList(Carbon::getCurrentWeekDays());
dumpDateList(Carbon::getCurrentMonthDays());
dumpDateList(Carbon::now()->subMonth()->getCurrentWeekDays());
dumpDateList(Carbon::now()->subMonth()->getCurrentMonthDays());

```

_Credit: [meteguerlek](https://github.com/meteguerlek) ([#1191](https://github.com/briannesbitt/Carbon/pull/1191))._

```php

Carbon::macro('toAtomStringWithNoTimezone', static function () {
	return self::this()->format('Y-m-d\TH:i:s');
});

echo Carbon::parse('2021-06-16 20:08:34')->toAtomStringWithNoTimezone();

```

_Credit: [afrojuju1](https://github.com/afrojuju1) ([#1063](https://github.com/briannesbitt/Carbon/pull/1063))._

```php

Carbon::macro('easterDate', static function ($year) {
	return Carbon::createMidnightDate($year, 3, 21)->addDays(easter_days($year));
});

echo Carbon::easterDate(2015)->format('d/m');
echo Carbon::easterDate(2016)->format('d/m');
echo Carbon::easterDate(2017)->format('d/m');
echo Carbon::easterDate(2018)->format('d/m');
echo Carbon::easterDate(2019)->format('d/m');

```

_Credit: [andreisena](https://github.com/andreisena), [36864](https://github.com/36864) ([#1052](https://github.com/briannesbitt/Carbon/pull/1052))._

Check [cmixin/business-day](https://github.com/kylekatarnls/business-day) for a more complete holidays handler.

```php

Carbon::macro('datePeriod', static function ($startDate, $endDate) {
	return new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);
});

foreach (Carbon::datePeriod(Carbon::createMidnightDate(2019, 3, 28), Carbon::createMidnightDate(2019, 4, 3)) as $date) {
	echo $date->format('Y-m-d') . "\n";
}
```

_Credit: [reinink](https://github.com/reinink) ([#132](https://github.com/briannesbitt/Carbon/pull/132))._

```php

Carbon::macro('formatBuddhist', static function (string $format): string {
	$self = self::this();

	$format = strtr($format, [
		'o' => '[{1}]',
		'Y' => '[{2}]',
		'y' => '[{3}]',
	]);

	$function = $self->localFormatFunction ?: static::$formatFunction;

	if (!$function) {
		$format = $self->rawFormat($format);
	} else if (\is_string($function) && method_exists($self, $function)) {
		$format = [$self, $function];
		$format = $function(...\func_get_args());
	}

	$buddhistYear = $self->year + 543;

	return strtr($format, [
		'[{1}]' => $self->format('o') + 543,
		'[{2}]' => $buddhistYear,
		'[{3}]' => str_pad($buddhistYear % 100, 2, '0', STR_PAD_LEFT),
	]);
});

echo Carbon::parse('2024-02-29 10.55.32')->formatBuddhist('Y-m-d H:i:s');
echo Carbon::parse('2024-02-29 10.55.32')->formatBuddhist('d/m/y');

```

_From on original idea of: [mean-cj](https://github.com/mean-cj) ([#2954](https://github.com/briannesbitt/Carbon/issues/2954))._

```php

class UserTimezoneCarbonMixin
{
	public $userTimeZone;

	/**
	 * Set user timezone, will be used before format function to apply current user timezone
	 *
	 * @param $timezone
	 */
	public function setUserTimezone()
	{
		$mixin = $this;

		return static function ($timezone) use ($mixin) {
			$mixin->userTimeZone = $timezone;
		};
	}

	/**
	 * Returns date formatted according to given format.
	 *
	 * @param string $format
	 *
	 * @return string
	 *
	 * @link https://www.php.net/manual/en/datetime.format.php
	 */
	public function tzFormat()
	{
		$mixin = $this;

		return static function ($format) use ($mixin) {
			$date = self::this();

			if (!is_null($mixin->userTimeZone)) {
				$date->timezone($mixin->userTimeZone);
			}

			return $date->format($format);
		};
	}
}

Carbon::mixin(new UserTimezoneCarbonMixin());

Carbon::setUserTimezone('Europe/Berlin');

echo Carbon::createFromTime(12, 0, 0, 'UTC')->tzFormat('H:i');
echo Carbon::createFromTime(15, 0, 0, 'UTC')->tzFormat('H:i');

Carbon::setUserTimezone('America/Toronto');

echo Carbon::createFromTime(12, 0, 0, 'UTC')->tzFormat('H:i');
echo Carbon::createFromTime(15, 0, 0, 'UTC')->tzFormat('H:i');

```

_Credit: [thiagocordeiro](https://github.com/thiagocordeiro) ([#927](https://github.com/briannesbitt/Carbon/pull/927))._

Whilst using a macro is the recommended way to add new methods or behaviour to Carbon, you can go further and extend the class itself which allows some alternative ways to override the primary methods; parse, format and createFromFormat.

```php

class MyDateClass extends Carbon
{
	protected static $formatFunction = 'translatedFormat';

	protected static $createFromFormatFunction = 'createFromLocaleFormat';

	protected static $parseFunction = 'myCustomParse';

	public static function myCustomParse($string)
	{
		return static::rawCreateFromFormat('d m Y', $string);
	}
}

$date = MyDateClass::parse('20 12 2001')->locale('de');


echo $date->format('jS F y');
echo "\n";

$date = MyDateClass::createFromFormat('j F Y', 'pt', '20 fevereiro 2001')->locale('pt');

echo $date->format('d/m/Y');
echo "\n";

// Note than you can still access native methods using rawParse, rawFormat and rawCreateFromFormat:
$date = MyDateClass::rawCreateFromFormat('j F Y', '20 February 2001', 'UTC')->locale('pt');

echo $date->rawFormat('jS F y');
echo "\n";

$date = MyDateClass::rawParse('2001-02-01', 'UTC')->locale('pt');

echo $date->format('jS F y');
echo "\n";

```

The following macro allow you to choose a timezone using only the city name (omitting continent). Perfect to make your unit tests more fluent:

```php
Carbon::macro('goTo', function (string $city) {
	static $cities = null;

	if ($cities === null) {
		foreach (\DateTimeZone::listIdentifiers() as $identifier) {
			$chunks = explode('/', $identifier);

			if (isset($chunks[1])) {
				$id = strtolower(end($chunks));
				$cities[$id] = $identifier;
			}
		}
	}

	$city = str_replace(' ', '_', strtolower($city));

	if (!isset($cities[$city])) {
		throw new \InvalidArgumentException("$city not found.");
	}

	return $this->tz($cities[$city]);
});

echo Carbon::now()->goTo('Chicago')->tzName;
echo "\n";
echo Carbon::now()->goTo('Buenos Aires')->tzName;

```
