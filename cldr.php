<?php

use Carbon\CarbonImmutable;

require __DIR__.'/vendor/autoload.php';

CarbonImmutable::setTestNow(CarbonImmutable::now());
$scores = [];
$avaiable = CarbonImmutable::getAvailableLocales();

foreach ($avaiable as $locale) {
    if (!file_exists(__DIR__.'/cldr/common/main/'.$locale.'.xml')) {
        continue;
    }

    $stat = [];
    $now = CarbonImmutable::now()->locale($locale);
    $cldr = simplexml_load_file(__DIR__.'/cldr/common/main/'.$locale.'.xml');

    if (!$cldr) {
        continue;
    }

    $dates = ($cldr->xpath('dates') ?: [])[0] ?? null;

    if (!$dates) {
        continue;
    }

    $elements = [];

    foreach ($cldr->xpath('dates')[0]->xpath('fields/field') as $field) {
        $values = get_object_vars($field);
        $elements[$values['@attributes']['type']] = $values;
    }

    foreach (['year', 'month', 'week', 'day', 'hour', 'minute', 'second'] as $unit) {
        $times = [];

        if (!isset($elements[$unit]['relativeTime'])) {
            continue;
        }

        foreach ($elements[$unit]['relativeTime'] as $time) {
            $values = get_object_vars($time);

            if (!isset($values['@attributes']['type'])) {
                continue;
            }

            $type = $values['@attributes']['type'];
            $plurialization = [];

            foreach ($time->relativeTimePattern as $pattern) {
                $values = get_object_vars($pattern);
                $plurialization[$values['@attributes']['count']] = "$pattern[0]";
            }

            $times[$type] = $plurialization;
        }

        if (isset($times['future']['other'])) {
            $text = str_replace('{0}', '99', $times['future']['other']);
            $stat[] = $text === $now->addUnit($unit, 99)->diffForHumans() ? 1 : 0;
        }

        if (isset($times['past']['other'])) {
            $text = str_replace('{0}', '99', $times['past']['other']);
            $stat[] = $text === $now->subUnit($unit,99)->diffForHumans() ? 1 : 0;
        }
    }

    if ($count = count($stat)) {
        $scores[$locale] = array_sum($stat) * 100 / $count;
    }

    echo '.';
}

echo "\n\n";

arsort($scores);

foreach ($scores as $locale => $score) {
    echo str_pad($locale, 12, ' ', STR_PAD_RIGHT).round($score, 1)."\n";
}
