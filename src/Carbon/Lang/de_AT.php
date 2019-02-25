<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Authors:
 * - sheriffmarley
 * - Timo
 * - Michael Hohl
 */
return array_replace_recursive(require __DIR__.'/de.php', [
    'months' => ['Jänuar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
    'months_short' => ['Jän.', 'Feb.', 'März', 'Apr.', 'Mai', 'Juni', 'Juli', 'Aug.', 'Sep.', 'Okt.', 'Nov.', 'Dez.'],
    'weekdays_short' => ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
]);
