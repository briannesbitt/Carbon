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
    'year' => 'שנה|{2}שנתיים|:count שנים',
    'y' => 'שנה|{2}שנתיים|:count שנים',
    'month' => 'חודש|{2}חודשיים|:count חודשים',
    'm' => 'חודש|{2}חודשיים|:count חודשים',
    'week' => 'שבוע|{2}שבועיים|:count שבועות',
    'w' => 'שבוע|{2}שבועיים|:count שבועות',
    'day' => 'יום|{2}יומיים|:count ימים',
    'd' => 'יום|{2}יומיים|:count ימים',
    'hour' => 'שעה|{2}שעתיים|:count שעות',
    'h' => 'שעה|{2}שעתיים|:count שעות',
    'minute' => 'דקה|{2}דקותיים|:count דקות',
    'min' => 'דקה|{2}דקותיים|:count דקות',
    'second' => 'שניה|:count שניות',
    's' => 'שניה|:count שניות',
    'ago' => 'לפני :time',
    'from_now' => 'בעוד :time',
    'after' => 'אחרי :time',
    'before' => 'לפני :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D [ב]MMMM YYYY',
        'LLL' => 'D [ב]MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D [ב]MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[היום ב־]LT',
        'nextDay' => '[מחר ב־]LT',
        'nextWeek' => 'dddd [בשעה] LT',
        'lastDay' => '[אתמול ב־]LT',
        'lastWeek' => '[ביום] dddd [האחרון בשעה] LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour, $minute, $isLower) {
        if ($hour < 5) {
            return 'לפנות בוקר';
        }
        if ($hour < 10) {
            return 'בבוקר';
        }
        if ($hour < 12) {
            return $isLower ? 'לפנה"צ' : 'לפני הצהריים';
        }
        if ($hour < 18) {
            return $isLower ? 'אחה"צ' : 'אחרי הצהריים';
        }

        return 'בערב';
    },
    'months' => ['ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'],
    'months_short' => ['ינו׳', 'פבר׳', 'מרץ', 'אפר׳', 'מאי', 'יוני', 'יולי', 'אוג׳', 'ספט׳', 'אוק׳', 'נוב׳', 'דצמ׳'],
    'weekdays' => ['ראשון', 'שני', 'שלישי', 'רביעי', 'חמישי', 'שישי', 'שבת'],
    'weekdays_short' => ['א׳', 'ב׳', 'ג׳', 'ד׳', 'ה׳', 'ו׳', 'ש׳'],
    'weekdays_min' => ['א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ש'],
];
