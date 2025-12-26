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

You can also change the locale of the string using `$date->locale('fr')` before the diffForHumans() call. See the [localization](../getting-started/localization.html) section for more detail.

<div id="diff-for-humans-options"><!-- Link anchor --></div>

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

<table>
	<tbody>
		<tr>
			<td><code>'altNumbers'</code></td>
			<td>
				<p>
					Use alternative numbers if available (from the current language if <code>true</code> is passed, from the given language(s) if array or string is passed)<br>
					e.g.<br>
				</p>
				<ul>
					<li>"100 days" in Japanese is "100日". With <code>altNumbers</code> it becomes "百日". <b>百</b> is the Japanese alternate symbol for 100.</li>
					<li>"1 day" in Japanese is "1日". With <code>altNumbers</code> it becomes "一日". <b>一</b> is the Japanese alternate symbol for 100.</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td><code>'aUnit'</code></td>
			<td>
				<p>
					When <code>true</code> "1 year" becomes "a year", "1 month" becomes "a month", "1 hour" becomes "an hour" and so on.<br>
					Note: "1 second" becomes "a few seconds"
				</p>
			</td>
		</tr>
		<tr>
			<td><code>'join'</code></td>
			<td>
				<p>
					Determines how to join multiple parts of the string
				</p>
				<ul>
					<li>
						if <code>join</code> is a string, it's used as a joiner glue<br>
						e.g. <code>'join' => ', '</code> shows "23 hours, 56 minutes, 58 seconds"
					</li>
					<li>if <code>join</code> is a callable/closure, it get the list of string and should return a string</li>
					<li>
						if <code>join</code> is an array, the first item will be the default glue, and the second item will be used instead of the glue for the last item<br>
						e.g. <code>'join' => [', ', ' and ']</code> shows "1 day, 23 hours, 52 minutes and 42 seconds"
					</li>
					<li>if <code>join</code> is true, it will be guessed from the locale ('list' translation file entry)</li>
					<li>if <code>join</code> is missing, a space will be used as glue</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td><code>'locale'</code></td>
			<td>
				<p>
					Language in which the diff should be output (has no effect if 'translator' key is set)
				</p>
			</td>
		</tr>
		<tr>
			<td><code>'minimumUnit'</code></td>
			<td>
				<p>
					Determines the smallest unit of time to display. Default value: 's'.<br>
					Note: value can be in the short or long (singular) form of the units, for example both 'h' and 'hour' are valid values.<br>
					e.g.
				</p>
				<ul>
					<li><code>['minimumUnit' => 'microsecond'])</code> shows "2 months 1 week 2 days 21 hours 32 minutes 29 seconds 114 milliseconds 757 microseconds"</li>
					<li><code>['minimumUnit' => 'second'])</code> shows "2 months 1 week 2 days 21 hours 32 minutes 29 seconds"</li>
					<li><code>['minimumUnit' => 'hour'])</code> shows "2 months 1 week 2 days 21 hours"</li>
					<li><code>['minimumUnit' => 'month'])</code> shows "2 months"</li>
					<li><code>['minimumUnit' => 'year'])</code> shows "0 years"</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td><code>'options'</code></td>
			<td>
				<p>
					If the <code>options</code> argument is omitted or set to <code>null</code>, only <code>Carbon::NO_ZERO_DIFF</code> is enabled.<br>
				</p>
				<p>
					Note: use the pipe operator to enable/disable multiple option at once:<br>
					e.g. <code>Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS</code>
				</p>
				<p>Available options are:</p>
				<ul id="diff-for-humans-flag-options">
					<li><code>Carbon::ROUND</code> / <code>Carbon::CEIL</code> / <code>Carbon::FLOOR</code> (none by default):
						only one of the 3 can be used at a time (other are ignored) and it requires <code>'parts'</code> to be set.
						By default, once the diff has as parts as <code>'parts'</code> setting requested and omit all remaining
						units.
						<ul>
							<li>If <code>Carbon::ROUND</code> is enabled, the remaining units are summed and if they are
								<strong>&gt;= 0.5</strong> of the last unit of the diff, this unit will be rounded to the
								upper value.</li>
							<li>If <code>Carbon::CEIL</code> is enabled, the remaining units are summed and if they are
								<strong>&gt; 0</strong> of the last unit of the diff, this unit will be rounded to the
								upper value.</li>
							<li>If <code>Carbon::FLOOR</code> is enabled, the last diff unit is rounded down. It makes no
								difference from the default behavior for <code>diffForHumans()</code> as the interval
								can't have overflow, but this option may be needed when used with
								<code>CarbonInterval::forHumans()</code> (and unchecked intervals that may have 60 minutes or more,
								24 hours or more, etc.). For example:
								<code>CarbonInterval::make('1 hour and 67 minutes')->forHumans(['parts' => 1])</code> returns
								<code>"1 hour"</code> while
								<code>CarbonInterval::make('1 hour and 67 minutes')->forHumans(['parts' => 1, 'options' => Carbon::FLOOR])</code>
								returns <code>"2 hours"</code>.</li>
						</ul>
					</li>
					<li><code>Carbon::NO_ZERO_DIFF</code> (enabled by default): turns empty diff into 1 second</li>
					<li><code>Carbon::JUST_NOW</code> disabled by default): turns diff from now to now into "just now"</li>
					<li><code>Carbon::ONE_DAY_WORDS</code> (disabled by default): turns "1 day from now/ago" to "yesterday/tomorrow"
					</li>
					<li><code>Carbon::TWO_DAY_WORDS</code> (disabled by default): turns "2 days from now/ago" to "before
						yesterday/after
					</li>
					<li><code>Carbon::SEQUENTIAL_PARTS_ONLY</code> (disabled by default): will keep only the first sequence of
						units of the interval, for example if the diff would have been "2 weeks 1 day 34 minutes 12 seconds"
						as day and minute are not consecutive units, you will get: "2 weeks 1 day".
					</li>
				</ul>
				<p>You also can use <code>Carbon::enableHumanDiffOption($option)</code>,
					<code>Carbon::disableHumanDiffOption($option)</code>, <code>Carbon::setHumanDiffOptions($options)</code> to
					change the default options and <code>Carbon::getHumanDiffOptions()</code>
					to get default options but you should avoid using it as being static it may conflict with calls
					from other code parts/third-party libraries.</p>
			</td>
		</tr>
		<tr>
			<td><code>'other'</code></td>
			<td>
				<p>
					Date and Time Comparison reference:
				</p>
				<ul>
					<li>if null passed, <b>now</b> time will be used as comparison reference</li>
					<li>if any other type, it will be converted to date and used as reference</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td><code>'parts'</code></td>
			<td>
				<p>
					Maximum number of parts to display (default value: <code>1</code>, no limit: <code>-1</code>).<br>
					e.g.
				</p>
				<ul>
					<li><code>1</code> shows "2 months"</li>
					<li><code>2</code> shows "2 months 1 week"</li>
					<li><code>3</code> shows "2 months 1 week 2 days"</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td><code>'short'</code></td>
			<td>
				<p>
					If <code>true</code>, displays short format of time units.<br>
					e.g. "2 months 1 week 2 days 23 hours 52 minutes 4 seconds" becomes "2mos 1w 2d 23h 52m 4s"
				</p>
			</td>
		</tr>
		<tr>
			<td><code>'skip'</code></td>
			<td>
				<p>
					List of units to skip (array of strings or a single string). It can be the unit name (singular or plural) or its shortcut (y, m, w, d, h, min, s, ms, µs).<br>
					e.g. with <code>['skip' => ['weeks']]</code>, "2 months 1 week 2 days 23 hours 52 minutes 4 seconds" becomes "2 months 9 days 23 hours 52 minutes 4 seconds"
				</p>
			</td>
		</tr>
		<tr>
			<td><code>'syntax'</code></td>
			<td>
				<p>
					Text modifiers appended to the period representation like "from now", "ago", "before" etc. Possible values:
				</p>
				<ul>
					<li>
					<code>CarbonInterface::DIFF_ABSOLUTE</code> adds no modifiers<br>
					e.g. "5 days"
					</li>
					<li>
					<code>CarbonInterface::DIFF_RELATIVE_TO_NOW</code> adds ago/from now modifier<br>
					e.g. "5 days from now"
					</li>
					<li>
					<code>CarbonInterface::DIFF_RELATIVE_TO_OTHER</code> adds before/after modifier<br>
					e.g. "5 days after"
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td><code>'translator'</code></td>
			<td>
				<p>
					A custom translator to use to translate the output.<br>
					Note: translator must implement <code>\Symfony\Contracts\Translation\TranslatorInterface</code>
				</p>
			</td>
		</tr>
	</tbody>
</table>

<div id="api-humandiff-aliases"><!-- Link anchor --></div>

Aliases and reverse methods are provided for semantic purpose:

*   `from($other = null, $syntax = null, $short = false, $parts = 1, $options = null)` (alias of diffForHumans)
*   `since($other = null, $syntax = null, $short = false, $parts = 1, $options = null)` (alias of diffForHumans)
*   `to($other = null, $syntax = null, $short = false, $parts = 1, $options = null)` (inverse result, swap before and future diff)
*   `until($other = null, $syntax = null, $short = false, $parts = 1, $options = null)` (alias of to)
*   `fromNow($syntax = null, $short = false, $parts = 1, $options = null)` (alias of from with first argument omitted unless the first argument is a `DateTimeInterface`, now used instead), for semantic usage: produce an "3 hours from now"-like string with dates in the future
*   `ago($syntax = null, $short = false, $parts = 1, $options = null)` (alias of fromNow), for semantic usage: produce an "3 hours ago"-like string with dates in the past
*   `toNow($syntax = null, $short = false, $parts = 1, $options = null)` (alias of to with first argument omitted, now used instead)
*   `timespan($other = null, $timezone = null)` calls diffForHumans with options `join = ', '` (coma-separated), `syntax = CarbonInterface::DIFF_ABSOLUTE` (no "ago"/"from now"/"before"/"after" wording), `options = CarbonInterface::NO_ZERO_DIFF` (no "just now"/"yesterday"/"tomorrow" wording), `parts = -1` (no limits) In this mode, you can't change options but you can pass an optional date to compare with or a string + timezone to parse to get this date.
