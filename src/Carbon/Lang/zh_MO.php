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
 * - tarunvelli
 * - Eddie
 * - KID
 * - shankesgk2
 */
return array_replace_recursive(require __DIR__.'/zh_Hant.php', [
    'week' => ':count周',
    'w' => ':count周',
    'second' => ':count 秒',
    'a_second' => '{1}幾秒|]1,Inf[:count 秒',
    's' => ':count秒',
    'from_now' => ':time內',
    'after' => ':time后',
]);
