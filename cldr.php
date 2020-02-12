<?php

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;

require __DIR__.'/vendor/autoload.php';

$scores = [];
$available = CarbonImmutable::getAvailableLocales();
$available = ['he', 'da'];
$debug = count($available) < 5;

class NoWeekInterval extends CarbonInterval
{
    public function __get($name)
    {
        switch ($name) {
            case 'weeks':
                return 0;
            case 'daysExcludeWeeks':
                return $this->totalDays;
            default:
                return parent::__get($name);
        }
    }
}

function handleDiff(array &$stat, string $locale, string $time, string $unit, string $cldrExpected, CarbonInterval $carbonActual) {
    global $debug;
    $carbonActual = $carbonActual->locale($locale)->forHumans(CarbonInterface::DIFF_RELATIVE_TO_NOW);
    $stat[] = $cldrExpected === $carbonActual ? 1 : 0;

    if ($debug && $cldrExpected !== $carbonActual) {
        echo "\n$locale $time $unit\ncldr:   $cldrExpected\ncarbon: $carbonActual\n";
    }
}

function getInterval(string $unit): CarbonInterval {
    if ($unit === 'day') {
        return NoWeekInterval::$unit(99);
    }

    return CarbonInterval::$unit(99);
}

$colors = [
    'black'        => '0;30',
    'dark_gray'    => '1;30',
    'blue'         => '0;34',
    'light_blue'   => '1;34',
    'green'        => '0;32',
    'light_green'  => '1;32',
    'cyan'         => '0;36',
    'light_cyan'   => '1;36',
    'red'          => '0;31',
    'light_red'    => '1;31',
    'purple'       => '0;35',
    'light_purple' => '1;35',
    'brown'        => '0;33',
    'yellow'       => '1;33',
    'light_gray'   => '0;37',
    'white'        => '1;37',
];

function color($color, $text) {
    global $colors;

    return "\033[{$colors[$color]}m{$text}\033[0m";
}

foreach ($available as $locale) {
    if (!file_exists(__DIR__.'/cldr/common/main/'.$locale.'.xml')) {
        continue;
    }

    $stat = [];
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

    $units = in_array($locale, ['zh', 'hy', 'hi', 'sq'])
        ? []
        : ['year', 'month', 'week', 'day', 'hour', 'minute', 'second'];

    foreach ($units as $unit) {
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
            handleDiff(
                $stat,
                $locale,
                'future',
                $unit,
                str_replace('{0}', '99', $times['future']['other']),
                getInterval($unit)->invert()
            );
        }

        if (isset($times['past']['other'])) {
            handleDiff(
                $stat,
                $locale,
                'past',
                $unit,
                str_replace('{0}', '99', $times['past']['other']),
                getInterval($unit)
            );
        }
    }

    if ($count = count($stat)) {
        $scores[$locale] = array_sum($stat) * 100 / $count;
    }

    if (!$debug) {
        echo '.';
    }
}

echo "\n\n";

arsort($scores);

foreach ($scores as $locale => $score) {
    echo color($score === 100 ? 'light_green' : 'light_red', str_pad($locale, 12, ' ', STR_PAD_RIGHT).round($score, 1)."\n");
}
