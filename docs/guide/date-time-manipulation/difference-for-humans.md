# Difference for Humans

It is easier for humans to read `1 month ago` compared to 30 days ago. This is a common function seen in most date libraries so I thought I would add it here as well. The lone argument for the function is the other Carbon instance to diff against, and of course it defaults to `now()` if not specified.

This method will add a phrase after the difference value relative to the instance and the passed in instance. There are 4 possibilities:

*   When comparing a value in the past to default now:
	*   1 hour ago
	*   5 months ago
*   When comparing a value in the future to default now:
	*   1 hour from now
	*   5 months from now
*   When comparing a value in the past to another value:
	*   1 hour before
	*   5 months before
*   When comparing a value in the future to another value:
	*   1 hour after
	*   5 months after

You may also pass `CarbonInterface::DIFF_ABSOLUTE` as a 2nd parameter to remove the modifiers _ago_, _from now_, etc : `diffForHumans($other, CarbonInterface::DIFF_ABSOLUTE)`, `CarbonInterface::DIFF_RELATIVE_TO_NOW` to get modifiers _ago_ or _from now_, `CarbonInterface::DIFF_RELATIVE_TO_OTHER` to get the modifiers _before_ or _after_ or `CarbonInterface::DIFF_RELATIVE_AUTO` (default mode) to get the modifiers either _ago_/_from now_ if the 2 second argument is null or _before_/_after_ if not.

You may pass `true` as a 3rd parameter to use short syntax if available in the locale used : `diffForHumans($other, CarbonInterface::DIFF_RELATIVE_AUTO, true)`.

You may pass a number between 1 and 6 as a 4th parameter to get the difference in multiple parts (more precise diff) : `diffForHumans($other, CarbonInterface::DIFF_RELATIVE_AUTO, false, 4)`.

The `$other` instance can be a DateTime, a Carbon instance or any object that implement DateTimeInterface, if a string is passed it will be parsed to get a Carbon instance and if `null` is passed, `Carbon::now()` will be used instead.

To avoid having too much argument and mix the order, you can use the verbose methods:

*   `shortAbsoluteDiffForHumans(DateTimeInterface | null $other = null, int $parts = 1)`
*   `longAbsoluteDiffForHumans(DateTimeInterface | null $other = null, int $parts = 1)`
*   `shortRelativeDiffForHumans(DateTimeInterface | null $other = null, int $parts = 1)`
*   `longRelativeDiffForHumans(DateTimeInterface | null $other = null, int $parts = 1)`
*   `shortRelativeToNowDiffForHumans(DateTimeInterface | null $other = null, int $parts = 1)`
*   `longRelativeToNowDiffForHumans(DateTimeInterface | null $other = null, int $parts = 1)`
*   `shortRelativeToOtherDiffForHumans(DateTimeInterface | null $other = null, int $parts = 1)`
*   `longRelativeToOtherDiffForHumans(DateTimeInterface | null $other = null, int $parts = 1)`

PS: `$other` and `$parts` arguments can be swapped as need.

```php
// The most typical usage is for comments
// The instance is the date the comment was created and its being compared to default now()
echo Carbon::now()->subDays(5)->diffForHumans();

echo Carbon::now()->diffForHumans(Carbon::now()->subYear());

$dt = Carbon::createFromDate(2011, 8, 1);

echo $dt->diffForHumans($dt->copy()->addMonth());
echo $dt->diffForHumans($dt->copy()->subMonth());

echo Carbon::now()->addSeconds(5)->diffForHumans();

echo Carbon::now()->subDays(24)->diffForHumans();
echo Carbon::now()->subDays(24)->longAbsoluteDiffForHumans();

echo Carbon::parse('2019-08-03')->diffForHumans('2019-08-13');
echo Carbon::parse('2000-01-01 00:50:32')->diffForHumans('@946684800');

echo Carbon::create(2018, 2, 26, 4, 29, 43)->longRelativeDiffForHumans(Carbon::create(2016, 6, 21, 0, 0, 0), 6);

```

You can also change the locale of the string using `$date->locale('fr')` before the diffForHumans() call. See the [localization](#api-localization) section for more detail.

Since 2.9.0 diffForHumans() parameters can be passed as an array:

```php

echo Carbon::now()->diffForHumans(['options' => 0]);
echo "\n";
// default options:
echo Carbon::now()->diffForHumans(['options' => Carbon::NO_ZERO_DIFF]);
echo "\n";
echo Carbon::now()->diffForHumans(['options' => Carbon::JUST_NOW]);
echo "\n";
echo Carbon::now()->subDay()->diffForHumans(['options' => 0]);
echo "\n";
echo Carbon::now()->subDay()->diffForHumans(['options' => Carbon::ONE_DAY_WORDS]);
echo "\n";
echo Carbon::now()->subDays(2)->diffForHumans(['options' => 0]);
echo "\n";
echo Carbon::now()->subDays(2)->diffForHumans(['options' => Carbon::TWO_DAY_WORDS]);
echo "\n";

// Options can be combined with pipes
$now = Carbon::now();


echo $now->diffForHumans(['options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS]);
echo "\n";

// Reference date for differences is `now` but you can use any other date (string, DateTime or Carbon instance):
$yesterday = $now->copy()->subDay();
echo $now->diffForHumans($yesterday);
echo "\n";
// By default differences methods produce "ago"/"from now" syntax using default reference (now),
// and "after"/"before" with other references
// But you can customize the syntax:
echo $now->diffForHumans($yesterday, ['syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW]);
echo "\n";
echo $now->diffForHumans($yesterday, ['syntax' => 0]);
echo "\n";
echo $yesterday->diffForHumans(['syntax' => CarbonInterface::DIFF_ABSOLUTE]);
echo "\n";
// Combined with options:
echo $now->diffForHumans($yesterday, [
	'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
	'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS,
]);
echo "\n";

// Other parameters:
echo $now->copy()->subHours(5)->subMinutes(30)->subSeconds(10)->diffForHumans([
	'parts' => 2,
]);
echo "\n";
echo $now->copy()->subHours(5)->subMinutes(30)->subSeconds(10)->diffForHumans([
	'parts' => 3, // Use -1 or INF for no limit
]);
echo "\n";
echo $now->copy()->subHours(5)->subMinutes(30)->subSeconds(10)->diffForHumans([
	'parts' => 3,
	'join' => ', ', // join with commas
]);
echo "\n";
echo $now->copy()->subHours(5)->subMinutes(30)->subSeconds(10)->diffForHumans([
	'parts' => 3,
	'join' => true, // join with natural syntax as per current locale
]);
echo "\n";
echo $now->copy()->subHours(5)->subMinutes(30)->subSeconds(10)->locale('fr')->diffForHumans([
	'parts' => 3,
	'join' => true, // join with natural syntax as per current locale
]);
echo "\n";
echo $now->copy()->subHours(5)->subMinutes(30)->subSeconds(10)->diffForHumans([
	'parts' => 3,
	'short' => true, // short syntax as per current locale
]);
// 'aUnit' option added in 2.13.0 allows you to prefer "a day", "an hour", etc. over "1 day", "1 hour"
// for singular values when it's available in the current locale
echo $now->copy()->subHour()->diffForHumans([
	'aUnit' => true,
]);

// Before 2.9.0, you need to pass parameters as ordered parameters:
// ->diffForHumans($other, $syntax, $short, $parts, $options)
// and 'join' was not supported

```

If the argument is omitted or set to `null`, only `Carbon::NO_ZERO_DIFF` is enabled. Available options are:

*   `Carbon::ROUND` / `Carbon::CEIL` / `Carbon::FLOOR` (none by default): only one of the 3 can be used at a time (other are ignored) and it requires `'parts'` to be set. By default, once the diff has as parts as `'parts'` setting requested and omit all remaining units.
	*   If `Carbon::ROUND` is enabled, the remaining units are summed and if they are **\>= 0.5** of the last unit of the diff, this unit will be rounded to the upper value.
	*   If `Carbon::CEIL` is enabled, the remaining units are summed and if they are **\> 0** of the last unit of the diff, this unit will be rounded to the upper value.
	*   If `Carbon::FLOOR` is enabled, the last diff unit is rounded down. It makes no difference from the default behavior for `diffForHumans()` as the interval can't have overflow, but this option may be needed when used with `CarbonInterval::forHumans()` (and unchecked intervals that may have 60 minutes or more, 24 hours or more, etc.). For example: `CarbonInterval::make('1 hour and 67 minutes')->forHumans(['parts' => 1])` returns `"1 hour"` while `CarbonInterval::make('1 hour and 67 minutes')->forHumans(['parts' => 1, 'options' => Carbon::FLOOR])` returns `"2 hours"`.
*   `Carbon::NO_ZERO_DIFF` (enabled by default): turns empty diff into 1 second
*   `Carbon::JUST_NOW` disabled by default): turns diff from now to now into "just now"
*   `Carbon::ONE_DAY_WORDS` (disabled by default): turns "1 day from now/ago" to "yesterday/tomorrow"
*   `Carbon::TWO_DAY_WORDS` (disabled by default): turns "2 days from now/ago" to "before yesterday/after
*   `Carbon::SEQUENTIAL_PARTS_ONLY` (disabled by default): will keep only the first sequence of units of the interval, for example if the diff would have been "2 weeks 1 day 34 minutes 12 seconds" as day and minute are not consecutive units, you will get: "2 weeks 1 day".

Use the pipe operator to enable/disable multiple option at once, example: `Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS`

You also can use `Carbon::enableHumanDiffOption($option)`, `Carbon::disableHumanDiffOption($option)`, `Carbon::setHumanDiffOptions($options)` to change the default options and `Carbon::getHumanDiffOptions()` to get default options but you should avoid using it as being static it may conflict with calls from other code parts/third-party libraries.

Aliases and reverse methods are provided for semantic purpose:

*   `from($other = null, $syntax = null, $short = false, $parts = 1, $options = null)` (alias of diffForHumans)
*   `since($other = null, $syntax = null, $short = false, $parts = 1, $options = null)` (alias of diffForHumans)
*   `to($other = null, $syntax = null, $short = false, $parts = 1, $options = null)` (inverse result, swap before and future diff)
*   `until($other = null, $syntax = null, $short = false, $parts = 1, $options = null)` (alias of to)
*   `fromNow($syntax = null, $short = false, $parts = 1, $options = null)` (alias of from with first argument omitted unless the first argument is a `DateTimeInterface`, now used instead), for semantic usage: produce an "3 hours from now"-like string with dates in the future
*   `ago($syntax = null, $short = false, $parts = 1, $options = null)` (alias of fromNow), for semantic usage: produce an "3 hours ago"-like string with dates in the past
*   `toNow($syntax = null, $short = false, $parts = 1, $options = null)` (alias of to with first argument omitted, now used instead)
*   `timespan($other = null, $timezone = null)` calls diffForHumans with options `join = ', '` (coma-separated), `syntax = CarbonInterface::DIFF_ABSOLUTE` (no "ago"/"from now"/"before"/"after" wording), `options = CarbonInterface::NO_ZERO_DIFF` (no "just now"/"yesterday"/"tomorrow" wording), `parts = -1` (no limits) In this mode, you can't change options but you can pass an optional date to compare with or a string + timezone to parse to get this date.
