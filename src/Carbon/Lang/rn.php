<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array_replace_recursive(require __DIR__.'/en.php', [
    'meridiem' => ['Z.MU.', 'Z.MW.'],
    'weekdays' => ['Ku w’indwi', 'Ku wa mbere', 'Ku wa kabiri', 'Ku wa gatatu', 'Ku wa kane', 'Ku wa gatanu', 'Ku wa gatandatu'],
    'weekdays_short' => ['cu.', 'mbe.', 'kab.', 'gtu.', 'kan.', 'gnu.', 'gnd.'],
    'weekdays_min' => ['cu.', 'mbe.', 'kab.', 'gtu.', 'kan.', 'gnu.', 'gnd.'],
    'months' => ['Nzero', 'Ruhuhuma', 'Ntwarante', 'Ndamukiza', 'Rusama', 'Ruheshi', 'Mukakaro', 'Nyandagaro', 'Nyakanga', 'Gitugutu', 'Munyonyo', 'Kigarama'],
    'months_short' => ['Mut.', 'Gas.', 'Wer.', 'Mat.', 'Gic.', 'Kam.', 'Nya.', 'Kan.', 'Nze.', 'Ukw.', 'Ugu.', 'Uku.'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],

    'year' => ':count izuba', // less reliable
    'y' => ':count izuba', // less reliable
    'a_year' => ':count izuba', // less reliable

    'week' => ':count wagatanu', // less reliable
    'w' => ':count wagatanu', // less reliable
    'a_week' => ':count wagatanu', // less reliable

    'day' => ':count izuba', // less reliable
    'd' => ':count izuba', // less reliable
    'a_day' => ':count izuba', // less reliable

    'hour' => ':count isaha', // less reliable
    'h' => ':count isaha', // less reliable
    'a_hour' => ':count isaha', // less reliable

    'minute' => ':count isaha', // less reliable
    'min' => ':count isaha', // less reliable
    'a_minute' => ':count isaha', // less reliable

    'second' => ':count wambwere', // less reliable
    's' => ':count wambwere', // less reliable
    'a_second' => ':count wambwere', // less reliable

    'month' => ':count Ukwezi',
    'm' => ':count Ukwezi',
    'a_month' => ':count Ukwezi',
]);
