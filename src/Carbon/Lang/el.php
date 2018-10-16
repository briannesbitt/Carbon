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
    'year' => 'ένας χρόνος|:count χρόνια',
    'y' => ':count χρόνος|:count χρόνια',
    'month' => 'ένας μήνας|:count μήνες',
    'm' => ':count μήνας|:count μήνες',
    'week' => ':count εβδομάδα|:count εβδομάδες',
    'w' => ':count εβδομάδα|:count εβδομάδες',
    'day' => 'μία μέρα|:count μέρες',
    'd' => ':count μέρα|:count μέρες',
    'hour' => 'μία ώρα|:count ώρες',
    'h' => ':count ώρα|:count ώρες',
    'minute' => 'ένα λεπτό|:count λεπτά',
    'min' => ':count λεπτό|:count λεπτά',
    'second' => 'λίγα δευτερόλεπτα|:count δευτερόλεπτα',
    's' => ':count δευτερόλεπτο|:count δευτερόλεπτα',
    'ago' => ':time πριν',
    'from_now' => 'σε :time',
    'after' => ':time μετά',
    'before' => ':time πριν',
    'formats' => [
        'LT' => 'h:mm A',
        'LTS' => 'h:mm:ss A',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY h:mm A',
        'LLLL' => 'dddd, D MMMM YYYY h:mm A',
    ],
    'calendar' => [
        'sameDay' => '[Σήμερα {}] LT',
        'nextDay' => '[Αύριο {}] LT',
        'nextWeek' => 'dddd [{}] LT',
        'lastDay' => '[Χθες {}] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $current) {
            switch ($current->dayOfWeek) {
                case 6:
                    return '[το προηγούμενο] dddd [{}] LT';
                default:
                    return '[την προηγούμενη] dddd [{}] LT';
            }
        },
        'sameElse' => 'L',
    ],
    'ordinal' => ':numberη',
    'meridiem' => function ($hour, $minute, $isLower) {
        return $isLower
            ? ($hour > 11 ? 'μμ' : 'πμ')
            : ($hour > 11 ? 'ΜΜ' : 'ΠΜ');
    },
    'months' => ['Ιανουαρίου', 'Φεβρουαρίου', 'Μαρτίου', 'Απριλίου', 'Μαΐου', 'Ιουνίου', 'Ιουλίου', 'Αυγούστου', 'Σεπτεμβρίου', 'Οκτωβρίου', 'Νοεμβρίου', 'Δεκεμβρίου'],
    'months_standalone' => ['Ιανουάριος', 'Φεβρουάριος', 'Μάρτιος', 'Απρίλιος', 'Μάιος', 'Ιούνιος', 'Ιούλιος', 'Αύγουστος', 'Σεπτέμβριος', 'Οκτώβριος', 'Νοέμβριος', 'Δεκέμβριος'],
    'months_regexp' => '/D[oD]?[\s,]+MMMM/',
    'months_short' => ['Ιαν', 'Φεβ', 'Μαρ', 'Απρ', 'Μαϊ', 'Ιουν', 'Ιουλ', 'Αυγ', 'Σεπ', 'Οκτ', 'Νοε', 'Δεκ'],
    'weekdays' => ['Κυριακή', 'Δευτέρα', 'Τρίτη', 'Τετάρτη', 'Πέμπτη', 'Παρασκευή', 'Σάββατο'],
    'weekdays_short' => ['Κυρ', 'Δευ', 'Τρι', 'Τετ', 'Πεμ', 'Παρ', 'Σαβ'],
    'weekdays_min' => ['Κυ', 'Δε', 'Τρ', 'Τε', 'Πε', 'Πα', 'Σα'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
