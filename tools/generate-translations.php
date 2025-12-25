<?php
declare(strict_types=1);
use Carbon\Carbon;
use Carbon\Language;
require __DIR__ . '/../vendor/autoload.php';
$destination_base = __DIR__ . '/../docs/public/data';

// Create translations directory if not exists
if (!is_dir("{$destination_base}/translations")) {
	mkdir("{$destination_base}/translations", 0777, true);
}

$translations = array(
	array('CarbonInterval::years(2)', '->forHumans()'),
	array('CarbonInterval::years(2)', '->forHumans(["short" => true])'),
	array('CarbonInterval::year()', '->forHumans()'),
	array('CarbonInterval::year()', '->forHumans(["aUnit" => true])'),
	array('CarbonInterval::months(2)', '->forHumans()'),
	array('CarbonInterval::months(2)', '->forHumans(["short" => true])'),
	array('CarbonInterval::month()', '->forHumans()'),
	array('CarbonInterval::month()', '->forHumans(["aUnit" => true])'),
	array('CarbonInterval::weeks(2)', '->forHumans()'),
	array('CarbonInterval::weeks(2)', '->forHumans(["short" => true])'),
	array('CarbonInterval::week()', '->forHumans()'),
	array('CarbonInterval::week()', '->forHumans(["aUnit" => true])'),
	array('CarbonInterval::days(2)', '->forHumans()'),
	array('CarbonInterval::days(2)', '->forHumans(["short" => true])'),
	array('CarbonInterval::day()', '->forHumans()'),
	array('CarbonInterval::day()', '->forHumans(["aUnit" => true])'),
	array('CarbonInterval::hours(2)', '->forHumans()'),
	array('CarbonInterval::hours(2)', '->forHumans(["short" => true])'),
	array('CarbonInterval::hour()', '->forHumans()'),
	array('CarbonInterval::hour()', '->forHumans(["aUnit" => true])'),
	array('CarbonInterval::minutes(2)', '->forHumans()'),
	array('CarbonInterval::minutes(2)', '->forHumans(["short" => true])'),
	array('CarbonInterval::minute()', '->forHumans()'),
	array('CarbonInterval::minute()', '->forHumans(["aUnit" => true])'),
	array('CarbonInterval::seconds(2)', '->forHumans()'),
	array('CarbonInterval::seconds(2)', '->forHumans(["short" => true])'),
	array('CarbonInterval::second()', '->forHumans()'),
	array('CarbonInterval::second()', '->forHumans(["aUnit" => true])'),
	array('Carbon::parse("monday")', '->dayName'),
	array('Carbon::parse("monday")', '->shortDayName'),
	array('Carbon::parse("monday")', '->minDayName'),
	array('Carbon::parse("tuesday")', '->dayName'),
	array('Carbon::parse("tuesday")', '->shortDayName'),
	array('Carbon::parse("tuesday")', '->minDayName'),
	array('Carbon::parse("wednesday")', '->dayName'),
	array('Carbon::parse("wednesday")', '->shortDayName'),
	array('Carbon::parse("wednesday")', '->minDayName'),
	array('Carbon::parse("thursday")', '->dayName'),
	array('Carbon::parse("thursday")', '->shortDayName'),
	array('Carbon::parse("thursday")', '->minDayName'),
	array('Carbon::parse("friday")', '->dayName'),
	array('Carbon::parse("friday")', '->shortDayName'),
	array('Carbon::parse("friday")', '->minDayName'),
	array('Carbon::parse("saturday")', '->dayName'),
	array('Carbon::parse("saturday")', '->shortDayName'),
	array('Carbon::parse("saturday")', '->minDayName'),
	array('Carbon::parse("sunday")', '->dayName'),
	array('Carbon::parse("sunday")', '->shortDayName'),
	array('Carbon::parse("sunday")', '->minDayName'),
	array('Carbon::parse("january 2023")', '->monthName'),
	array('Carbon::parse("january 2023")', '->shortMonthName'),
	array('Carbon::parse("february 2023")', '->monthName'),
	array('Carbon::parse("february 2023")', '->shortMonthName'),
	array('Carbon::parse("march 2023")', '->monthName'),
	array('Carbon::parse("march 2023")', '->shortMonthName'),
	array('Carbon::parse("april 2023")', '->monthName'),
	array('Carbon::parse("april 2023")', '->shortMonthName'),
	array('Carbon::parse("may 2023")', '->monthName'),
	array('Carbon::parse("may 2023")', '->shortMonthName'),
	array('Carbon::parse("june 2023")', '->monthName'),
	array('Carbon::parse("june 2023")', '->shortMonthName'),
	array('Carbon::parse("july 2023")', '->monthName'),
	array('Carbon::parse("july 2023")', '->shortMonthName'),
	array('Carbon::parse("august 2023")', '->monthName'),
	array('Carbon::parse("august 2023")', '->shortMonthName'),
	array('Carbon::parse("september 2023")', '->monthName'),
	array('Carbon::parse("september 2023")', '->shortMonthName'),
	array('Carbon::parse("october 2023")', '->monthName'),
	array('Carbon::parse("october 2023")', '->shortMonthName'),
	array('Carbon::parse("november 2023")', '->monthName'),
	array('Carbon::parse("november 2023")', '->shortMonthName'),
	array('Carbon::parse("december 2023")', '->monthName'),
	array('Carbon::parse("december 2023")', '->shortMonthName'),
	array('Carbon::now()->subHours(2)', '->diffForHumans()'),
	array('Carbon::now()->addHours(2)->addMinute()', '->diffForHumans(["part" => 1])'),
	array('($d = Carbon::now())->copy()->subHours(2)', '->diffForHumans($d)'),
	array('($d = Carbon::now())->copy()->addHours(2)->addMinute()', '->diffForHumans($d)'),
);

function get_languages(): array
{
	return array_map(
		function($code) {
			$lang = new Language($code);

			return array_merge($lang->getNames(), array(
					'id' => $lang->getId(),
					'code' => $lang->getCode(),
					'region' => $lang->getRegion(),
					'regionName' => $lang->getRegionName(),
					'variant' => $lang->getVariantName(),
				));
		},
		Carbon::getAvailableLocales()
	);
}

function get_translations()
{
	global $translations, $destination_base;

	$languages = get_languages();

	foreach ($languages as $language) {
		$locale = $language['id'];
		$output = array();

		foreach ($translations as [$start, $end]) {
			$output[] = array(
				'code' => "{$start}{$end}",
				'result' => eval("use Carbon\Carbon; use Carbon\CarbonInterval; return {$start}->locale('{$locale}'){$end};"),
			);
		}

		file_put_contents($destination_base . "/translations/{$locale}.json", json_encode($output, JSON_UNESCAPED_SLASHES));
	}
}

file_put_contents("{$destination_base}/languages.json", json_encode(get_languages(), JSON_UNESCAPED_SLASHES));
get_translations();