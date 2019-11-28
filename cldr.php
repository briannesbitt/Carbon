<?php

use Carbon\Carbon;
use Carbon\Translator;

include __DIR__ . '/vendor/autoload.php';
Carbon::setTestNow('now');

$cldr = [];

function calendarContainsWord(Carbon $date, string $word): bool {
    return in_array($word, explode(' ', mb_strtolower($date->calendar())));
}

$input = json_decode(file_get_contents('cldr.json'), true);

$count = count($input);
$success = 0;

foreach (json_decode(file_get_contents('cldr.json'), true) as $key => $value) {
    $locale = preg_replace('/^RelativeDateTimeSymbols_/', '', $key);
    echo "$locale: ";
    Carbon::setLocale($locale);
    [
        '-1' => $yesterday,
        '0' => $today,
        '1' => $tomorrow,
    ] = $value['DAY']['LONG']['R'];
    $yesterday = mb_strtolower($yesterday);
    $tomorrow = mb_strtolower($tomorrow);

    $valid = (mb_strtolower(Carbon::translateWith(Translator::get($locale), 'diff_yesterday')) === $yesterday || calendarContainsWord(Carbon::yesterday(), $yesterday)) &&
        (mb_strtolower(Carbon::translateWith(Translator::get($locale), 'diff_tomorrow')) === $tomorrow || calendarContainsWord(Carbon::tomorrow(), $tomorrow));

    if ($valid) {
        $success++;
    }

    echo $valid
        ? 'ok'
        : 'error';

    if ($locale === 'zh_HK') {
        echo "\n".mb_strtolower(Carbon::translateWith(Translator::get($locale), 'diff_yesterday'))."\n$yesterday";
    }

    echo "\n";
}

echo "$success / $count";
