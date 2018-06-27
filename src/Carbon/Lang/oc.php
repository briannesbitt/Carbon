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
    return $number == 1 ? 0 : 1;
}, 'oc');

return array(
    'year' => ':count an|:count ans',
    'y' => ':count an|:count ans',
    'month' => ':count mes|:count meses',
    'm' => ':count mes|:count meses',
    'week' => ':count setmana|:count setmanas',
    'w' => ':count setmana|:count setmanas',
    'day' => ':count jorn|:count jorns',
    'd' => ':count jorn|:count jorns',
    'hour' => ':count ora|:count oras',
    'h' => ':count ora|:count oras',
    'minute' => ':count minuta|:count minutas',
    'min' => ':count minuta|:count minutas',
    'second' => ':count segonda|:count segondas',
    's' => ':count segonda|:count segondas',
    'ago' => 'fa :time',
    'from_now' => 'dins :time',
    'after' => ':time aprèp',
    'before' => ':time abans',
    'diff_now' => 'ara meteis',
    'diff_yesterday' => 'ièr',
    'diff_tomorrow' => 'deman',
    'diff_before_yesterday' => 'ièr delà',
    'diff_after_tomorrow' => 'deman passat',
    'period_recurrences' => ':count còp|:count còps',
    'period_interval' => 'cada :interval',
    'period_start_date' => 'de :date',
    'period_end_date' => 'fins a :date',
);
