<?php

use Carbon\Carbon;
use Carbon\Translator;

include __DIR__.'/vendor/autoload.php';
Carbon::setTestNow('now');
$now = Carbon::now();

$cldr = [];

function calendarContainsWord(Carbon $date, string $word): bool
{
    $word = mb_strtolower($word);
    $calendar =  mb_strtolower($date->calendar());

    return preg_match('/(?<!\w)'.preg_quote($word).'(?!\w)/', $calendar) ||
        in_array($word, preg_split('/[\s,.;-]+/', $calendar));
}

$input = json_decode(file_get_contents('cldr.json'), true);

$count = count($input);

$stats = [];

foreach (json_decode(file_get_contents('cldr.json'), true) as $key => $value) {
    $note = 0;
    $results = 0;
    $locale = preg_replace('/^RelativeDateTimeSymbols_/', '', $key);
    $file = fopen('log/'.$locale.'.md', 'w');

    fwrite($file, '# '.$locale."\n\n| M | Key | CLDR | Carbon |\n|---|---|---|---|\n");

    $addResult = function ($key, $cldr, $carbon, $value = 1) use (&$note, &$results, &$file) {
        $results += $value;
        $success = mb_strtolower($cldr) === mb_strtolower($carbon);
        $check = $success ? '✓' : '❌';

        fwrite($file, "| $check | $key | $cldr | $carbon |\n");

        if ($success) {
            $note += $value;
        }
    };

    Carbon::setLocale($locale);
    [
        '-1' => $yesterday,
        '0' => $today,
        '1' => $tomorrow,
    ] = $value['DAY']['LONG']['R'];

    $addResult('now', $value['SECOND']['LONG']['R']['0'], mb_strtolower(Carbon::translateWith(Translator::get($locale), 'diff_now')));

    $addResult('cal_yes', 'yc', calendarContainsWord(Carbon::yesterday(), $yesterday) ? 'yc' : 'KO');
    $addResult('yesterday', $yesterday, Carbon::translateWith(Translator::get($locale), 'diff_yesterday'));

    $addResult('cal_tom', 'tc', calendarContainsWord(Carbon::tomorrow(), $tomorrow) ? 'tc' : 'KO');
    $addResult('tomorrow', $tomorrow, Carbon::translateWith(Translator::get($locale), 'diff_tomorrow'));

    foreach (['day', 'hour', 'minute', 'month', 'second', 'week', 'year'] as $unit) {
        $uUnit = strtoupper($unit);
        $other = explode('other{', $value[$uUnit]['LONG']['P']);
        $other = str_replace('#', 99, rtrim(end($other), '}'));

        $addResult("ago_$unit", $other, $now->translate('ago', [
                ':time' => $now->translate($unit, [':count' => 99], 99),
            ]));

        $other = explode('other{', $value[$uUnit]['LONG']['F']);
        $other = str_replace('#', 99, rtrim(end($other), '}'));

        $addResult("in_$unit", $other, $now->translate('from_now', [
                ':time' => $now->translate($unit, [':count' => 99], 99),
            ]));
    }

    fclose($file);

    $ratio = $note / $results;
    $stats[$locale] = $ratio;
}

arsort($stats, SORT_NUMERIC);

foreach ($stats as $locale => $ratio) {
    echo "$locale: ";
    echo number_format($ratio * 100, 1, '.', ' ') . '%';
    echo "\n";
}

echo number_format(array_sum($stats) * 100 / $count, 1, '.', ' ').'%';
