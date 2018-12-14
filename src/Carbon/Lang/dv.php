<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

\Symfony\Component\Translation\PluralizationRules::set(function ($number) {
    return $number === 1 ? 0 : 1;
}, 'dv');

$months = [
    'ޖެނުއަރީ',
    'ފެބްރުއަރީ',
    'މާރިޗު',
    'އޭޕްރީލު',
    'މޭ',
    'ޖޫން',
    'ޖުލައި',
    'އޯގަސްޓު',
    'ސެޕްޓެމްބަރު',
    'އޮކްޓޯބަރު',
    'ނޮވެމްބަރު',
    'ޑިސެމްބަރު',
];

$weekdays = [
    'އާދިއްތަ',
    'ހޯމަ',
    'އަންގާރަ',
    'ބުދަ',
    'ބުރާސްފަތި',
    'ހުކުރު',
    'ހޮނިހިރު',
];

return [
    'year' => 'އަހަރެއް|އަހަރު :count',
    'month' => 'މަހެއް|މަސް :count',
    'week' => 'ހަފްތާ :count',
    'day' => 'ދުވަހެއް|ދުވަސް :count',
    'hour' => 'ގަޑިއިރެއް|ގަޑިއިރު :count',
    'minute' => 'މިނިޓެއް|މިނިޓު :count',
    'second' => 'ސިކުންތުކޮޅެއް|d% ސިކުންތު',
    'ago' => 'ކުރިން :time',
    'from_now' => 'ތެރޭގައި :time',
    'after' => ':time ފަހުން',
    'before' => ':time ކުރި',
    'diff_yesterday' => 'އިއްޔެ',
    'diff_tomorrow' => 'މާދަމާ',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[މިއަދު] LT',
        'nextDay' => '[މާދަމާ] LT',
        'nextWeek' => 'dddd LT',
        'lastDay' => '[އިއްޔެ] LT',
        'lastWeek' => '[ފާއިތުވި] dddd LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour, $minute, $isLower) {
        return $hour < 12 ? 'މކ' : 'މފ';
    },
    'months' => $months,
    'months_short' => $months,
    'weekdays' => $weekdays,
    'weekdays_short' => $weekdays,
    'weekdays_min' => ['އާދި', 'ހޯމަ', 'އަން', 'ބުދަ', 'ބުރާ', 'ހުކު', 'ހޮނި'],
];
