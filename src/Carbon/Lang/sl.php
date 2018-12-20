<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'year' => ':count leto|:count leti|:count leta|:count let',
    'y' => ':count leto|:count leti|:count leta|:count let',
    'month' => ':count mesec|:count meseca|:count mesece|:count mesecev',
    'm' => ':count mesec|:count meseca|:count mesece|:count mesecev',
    'week' => ':count teden|:count tedna|:count tedne|:count tednov',
    'w' => ':count teden|:count tedna|:count tedne|:count tednov',
    'day' => ':count dan|:count dni|:count dni|:count dni',
    'd' => ':count dan|:count dni|:count dni|:count dni',
    'hour' => ':count uro|:count uri|:count ure|:count ur',
    'h' => ':count uro|:count uri|:count ure|:count ur',
    'minute' => ':count minuto|:count minuti|:count minute|:count minut',
    'min' => ':count minuto|:count minuti|:count minute|:count minut',
    'second' => ':count sekundo|:count sekundi|:count sekunde|:count sekund',
    's' => ':count sekundo|:count sekundi|:count sekunde|:count sekund',
    'year_ago' => ':count letom|:count leti|:count leti|:count leti',
    'month_ago' => ':count mesecem|:count meseci|:count meseci|:count meseci',
    'week_ago' => ':count tednom|:count tednoma|:count tedni|:count tedni',
    'day_ago' => ':count dnem|:count dnevoma|:count dnevi|:count dnevi',
    'hour_ago' => ':count uro|:count urama|:count urami|:count urami',
    'minute_ago' => ':count minuto|:count minutama|:count minutami|:count minutami',
    'second_ago' => ':count sekundo|:count sekundama|:count sekundami|:count sekundami',
    'ago' => 'pred :time',
    'from_now' => 'čez :time',
    'after' => 'čez :time',
    'before' => 'pred :time',
    'diff_now' => 'ravnokar',
    'diff_yesterday' => 'včeraj',
    'diff_tomorrow' => 'jutri',
    'diff_before_yesterday' => 'predvčerajšnjim',
    'diff_after_tomorrow' => 'pojutrišnjem',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'period_start_date' => 'od :date',
    'period_end_date' => 'do :date',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY H:mm',
        'LLLL' => 'dddd, D. MMMM YYYY H:mm',
    ],
    'calendar' => [
        'sameDay' => '[danes ob] LT',
        'nextDay' => '[jutri ob] LT',
        'nextWeek' => 'dddd [ob] LT',
        'lastDay' => '[včeraj ob] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[preteklo] [nedeljo] [ob] LT';
                case 1:
                    return '[pretekli] [ponedeljek] [ob] LT';
                case 2:
                    return '[pretekli] [torek] [ob] LT';
                case 3:
                    return '[preteklo] [sredo] [ob] LT';
                case 4:
                    return '[pretekli] [četrtek] [ob] LT';
                case 5:
                    return '[pretekli] [petek] [ob] LT';
                case 6:
                    return '[preteklo] [soboto] [ob] LT';
            }
        },
        'sameElse' => 'L',
    ],
    'months' => ['Januar', 'Februar', 'Marec', 'April', 'Maj', 'Junij', 'Julij', 'Avgust', 'September', 'Oktober', 'November', 'December'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec'],
    'weekdays' => ['Nedelja', 'Ponedeljek', 'Torek', 'Sreda', 'Četrtek', 'Petek', 'Sobota'],
    'weekdays_short' => ['Ned', 'Pon', 'Tor', 'Sre', 'Čet', 'Pet', 'Sob'],
    'weekdays_min' => ['Ne', 'Po', 'To', 'Sr', 'Če', 'Pe', 'So'],
    'list' => [', ', ' in '],
];
