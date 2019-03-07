<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Authors:
 * - http://www.uyip.org/ Pablo Saratxaga pablo@mandrakesoft.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['יאַנואַר', 'פֿעברואַר', 'מערץ', 'אַפּריל', 'מיי', 'יוני', 'יולי', 'אויגוסט', 'סעפּטעמבער', 'אקטאבער', 'נאוועמבער', 'דעצעמבער'],
    'months_short' => ['יאַנ', 'פֿעב', 'מאַר', 'אַפּר', 'מײַ ', 'יונ', 'יול', 'אױג', 'סעפּ', 'אָקט', 'נאָװ', 'דעצ'],
    'weekdays' => ['זונטיק', 'מאָנטיק', 'דינסטיק', 'מיטװאָך', 'דאָנערשטיק', 'פֿרײַטיק', 'שבת'],
    'weekdays_short' => ['זונ\'', 'מאָנ\'', 'דינ\'', 'מיט\'', 'דאָנ\'', 'פֿרײַ\'', 'שבת'],
    'weekdays_min' => ['זונ\'', 'מאָנ\'', 'דינ\'', 'מיט\'', 'דאָנ\'', 'פֿרײַ\'', 'שבת'],
    'day_of_first_week_of_year' => 1,

    'year' => ':count יאר',
    'y' => ':count יאר',
    'a_year' => ':count יאר',

    'month' => ':count חודש',
    'm' => ':count חודש',
    'a_month' => ':count חודש',

    'week' => ':count וואָך',
    'w' => ':count וואָך',
    'a_week' => ':count וואָך',

    'day' => ':count טאָג',
    'd' => ':count טאָג',
    'a_day' => ':count טאָג',

    'hour' => ':count שעה',
    'h' => ':count שעה',
    'a_hour' => ':count שעה',

    'minute' => ':count מינוט',
    'min' => ':count מינוט',
    'a_minute' => ':count מינוט',

    'second' => ':count סעקונדע',
    's' => ':count סעקונדע',
    'a_second' => ':count סעקונדע',
]);
