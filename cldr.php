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

function standardize($word) {
    $word = mb_strtolower($word);
    $synonyms = [
        "à l'instant" => 'maintenant',
        'just now' => 'now',
        'proprio ora' => 'ora',
        'upravo sada' => 'sada',
    ];

    return $synonyms[$word] ?? $word;
}

$workList = include 'worklist.php';
$cldrData = json_decode(file_get_contents('cldr.json'), true);

foreach ($workList as $locale) {
    $note = 0;
    $results = 0;
    $value = $cldrData['RelativeDateTimeSymbols_'.$locale];

    $fileContent = '# '.$locale."\n\n| M | Key | CLDR | Carbon |\n|---|---|---|---|\n";

    $addResult = function ($key, $cldr, $carbon, $value = 1) use (&$note, &$results, &$fileContent) {
        $results += $value;
        $success = standardize($cldr) === standardize($carbon);
        $check = $success ? '✓' : '❌';

        $fileContent .= "| $check | $key | $cldr | $carbon |\n";

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

    $carbonFile = __DIR__.'/src/Carbon/Lang/'.$locale.'.php';

    if (file_exists($carbonFile)) {
        $carbonData = include $carbonFile;
        if (!isset($carbonData['diff_now'], $carbonData['diff_yesterday'], $carbonData['diff_tomorrow'])) {
            $contents = file_get_contents($carbonFile);
            $glue = '\'diff_yesterday\' => [';
            $chunks = explode($glue, $contents, 2);

            if (count($chunks) !== 2) {
                $glue = '\'formats\' => [';
                $chunks = explode($glue, $contents, 2);
            }

            if (count($chunks) !== 2) {
                $glue = "\n];";
                $chunks = explode($glue, $contents, 2);
            }

            if (count($chunks) === 2) {
                if (!isset($carbonData['diff_now'])) {
                    $chunks[0] .= "'diff_now' => ".var_export($value['SECOND']['LONG']['R']['0'], true).",\n    ";
                }
                if (!isset($carbonData['diff_yesterday'])) {
                    $chunks[0] .= "'diff_yesterday' => ".var_export($yesterday, true).",\n    ";
                }
                if (!isset($carbonData['diff_tomorrow'])) {
                    $chunks[0] .= "'diff_tomorrow' => ".var_export($tomorrow, true).",\n    ";
                }

                file_put_contents($carbonFile, implode($glue, $chunks));
            } else {
                echo "$locale cannot be autofixed.";
            }
        }
    }

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

    $ratio = $note / $results;
    $stats[$locale] = $ratio;

    if ($ratio < 1) {
        file_put_contents('log/'.$locale.'.md', $fileContent);
        break;
    }
}

arsort($stats, SORT_NUMERIC);

foreach ($stats as $locale => $ratio) {
    if ($ratio < 1) {
        echo "$locale: ";
        echo number_format($ratio * 100, 1, '.', ' ') . '%';
        echo "\n";
    }
}

echo number_format(array_sum($stats) * 100 / $count, 1, '.', ' ').'%';
