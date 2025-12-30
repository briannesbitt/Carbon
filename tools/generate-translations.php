<?php
declare(strict_types=1);
use Carbon\Carbon;
use Carbon\Language;
use Carbon\Translator;

require __DIR__.'/../vendor/autoload.php';
$destination_base = __DIR__.'/../docs/public/data';

// Create translations directory if not exists
if (!is_dir("{$destination_base}/translations")) {
    mkdir("{$destination_base}/translations", 0777, true);
}

$translations = [
    ['CarbonInterval::years(2)', '->forHumans()'],
    ['CarbonInterval::years(2)', '->forHumans(["short" => true])'],
    ['CarbonInterval::year()', '->forHumans()'],
    ['CarbonInterval::year()', '->forHumans(["aUnit" => true])'],
    ['CarbonInterval::months(2)', '->forHumans()'],
    ['CarbonInterval::months(2)', '->forHumans(["short" => true])'],
    ['CarbonInterval::month()', '->forHumans()'],
    ['CarbonInterval::month()', '->forHumans(["aUnit" => true])'],
    ['CarbonInterval::weeks(2)', '->forHumans()'],
    ['CarbonInterval::weeks(2)', '->forHumans(["short" => true])'],
    ['CarbonInterval::week()', '->forHumans()'],
    ['CarbonInterval::week()', '->forHumans(["aUnit" => true])'],
    ['CarbonInterval::days(2)', '->forHumans()'],
    ['CarbonInterval::days(2)', '->forHumans(["short" => true])'],
    ['CarbonInterval::day()', '->forHumans()'],
    ['CarbonInterval::day()', '->forHumans(["aUnit" => true])'],
    ['CarbonInterval::hours(2)', '->forHumans()'],
    ['CarbonInterval::hours(2)', '->forHumans(["short" => true])'],
    ['CarbonInterval::hour()', '->forHumans()'],
    ['CarbonInterval::hour()', '->forHumans(["aUnit" => true])'],
    ['CarbonInterval::minutes(2)', '->forHumans()'],
    ['CarbonInterval::minutes(2)', '->forHumans(["short" => true])'],
    ['CarbonInterval::minute()', '->forHumans()'],
    ['CarbonInterval::minute()', '->forHumans(["aUnit" => true])'],
    ['CarbonInterval::seconds(2)', '->forHumans()'],
    ['CarbonInterval::seconds(2)', '->forHumans(["short" => true])'],
    ['CarbonInterval::second()', '->forHumans()'],
    ['CarbonInterval::second()', '->forHumans(["aUnit" => true])'],
    ['Carbon::parse("monday")', '->dayName'],
    ['Carbon::parse("monday")', '->shortDayName'],
    ['Carbon::parse("monday")', '->minDayName'],
    ['Carbon::parse("tuesday")', '->dayName'],
    ['Carbon::parse("tuesday")', '->shortDayName'],
    ['Carbon::parse("tuesday")', '->minDayName'],
    ['Carbon::parse("wednesday")', '->dayName'],
    ['Carbon::parse("wednesday")', '->shortDayName'],
    ['Carbon::parse("wednesday")', '->minDayName'],
    ['Carbon::parse("thursday")', '->dayName'],
    ['Carbon::parse("thursday")', '->shortDayName'],
    ['Carbon::parse("thursday")', '->minDayName'],
    ['Carbon::parse("friday")', '->dayName'],
    ['Carbon::parse("friday")', '->shortDayName'],
    ['Carbon::parse("friday")', '->minDayName'],
    ['Carbon::parse("saturday")', '->dayName'],
    ['Carbon::parse("saturday")', '->shortDayName'],
    ['Carbon::parse("saturday")', '->minDayName'],
    ['Carbon::parse("sunday")', '->dayName'],
    ['Carbon::parse("sunday")', '->shortDayName'],
    ['Carbon::parse("sunday")', '->minDayName'],
    ['Carbon::parse("january 2023")', '->monthName'],
    ['Carbon::parse("january 2023")', '->shortMonthName'],
    ['Carbon::parse("february 2023")', '->monthName'],
    ['Carbon::parse("february 2023")', '->shortMonthName'],
    ['Carbon::parse("march 2023")', '->monthName'],
    ['Carbon::parse("march 2023")', '->shortMonthName'],
    ['Carbon::parse("april 2023")', '->monthName'],
    ['Carbon::parse("april 2023")', '->shortMonthName'],
    ['Carbon::parse("may 2023")', '->monthName'],
    ['Carbon::parse("may 2023")', '->shortMonthName'],
    ['Carbon::parse("june 2023")', '->monthName'],
    ['Carbon::parse("june 2023")', '->shortMonthName'],
    ['Carbon::parse("july 2023")', '->monthName'],
    ['Carbon::parse("july 2023")', '->shortMonthName'],
    ['Carbon::parse("august 2023")', '->monthName'],
    ['Carbon::parse("august 2023")', '->shortMonthName'],
    ['Carbon::parse("september 2023")', '->monthName'],
    ['Carbon::parse("september 2023")', '->shortMonthName'],
    ['Carbon::parse("october 2023")', '->monthName'],
    ['Carbon::parse("october 2023")', '->shortMonthName'],
    ['Carbon::parse("november 2023")', '->monthName'],
    ['Carbon::parse("november 2023")', '->shortMonthName'],
    ['Carbon::parse("december 2023")', '->monthName'],
    ['Carbon::parse("december 2023")', '->shortMonthName'],
    ['Carbon::now()->subHours(2)', '->diffForHumans()'],
    ['Carbon::now()->addHours(2)->addMinute()', '->diffForHumans(["part" => 1])'],
    ['($d = Carbon::now())->copy()->subHours(2)', '->diffForHumans($d)'],
    ['($d = Carbon::now())->copy()->addHours(2)->addMinute()', '->diffForHumans($d)'],
];

function get_languages(): array
{
    return array_map(
        static function (string $code): array {
            $lang = new Language($code);

            return array_merge($lang->getNames(), [
                'id' => $lang->getId(),
                'code' => $lang->getCode(),
                'region' => $lang->getRegion(),
                'regionName' => $lang->getRegionName(),
                'variant' => $lang->getVariantName(),
            ]);
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
        $output = [];

        foreach ($translations as [$start, $end]) {
            $output[] = [
                'code' => "$start$end",
                'result' => eval("use Carbon\Carbon; use Carbon\CarbonInterval; return {$start}->locale('{$locale}'){$end};"),
            ];
        }

        file_put_contents($destination_base."/translations/{$locale}.json", json_encode($output, JSON_UNESCAPED_SLASHES));
    }
}

file_put_contents("{$destination_base}/languages.json", json_encode(get_languages(), JSON_UNESCAPED_SLASHES));
get_translations();

$authors = array_keys(array_reduce(glob(Translator::get()->getDirectories()[0].'/*.php'), static function ($authors, $file) {
    if (preg_match('/\* Authors:([\s\S]+)\*\//U', file_get_contents($file), $match)) {
        foreach (explode('* -', $match[1]) as $line) {
            $line = trim($line);

            if ($line !== '') {
                $authors[$line] = true;
            }
        }
    }

    return $authors;
}, []));
sort($authors);

file_put_contents(__DIR__.'/../docs/develop/translations/translators.md', '---
outline: false
aside: false
prev: false
next: false
---
# Translators

Thanks to people helping us to translate Carbon in so many languages.

- '.implode("\n- ", $authors).'

Is someone missing? [Please tell us](https://github.com/briannesbitt/Carbon/issues/new).
');
