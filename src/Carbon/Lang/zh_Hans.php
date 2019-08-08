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
 * - monkeycon
 * - François B
 * - Jason Katz-Brown
 * - Konstantin Konev
 * - Chris Lam
 * - Serhan Apaydın
 * - Gary Lo
 * - JD Isaacks
 * - Chris Hemp
 * - shankesgk2
 * - Daniel Cheung (danvim)
 */
return array_replace_recursive(require __DIR__.'/zh_Hant.php', [
    'ago' => ':time前',
    'from_now' => ':time后',
    'calendar' => [
        'sameDay' => '[今天]LT',
        'nextDay' => '[明天]LT',
        'nextWeek' => '[下]ddddLT',
        'lastDay' => '[昨天]LT',
        'lastWeek' => '[上]ddddLT',
    ],
]);
