<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$files = [
    __DIR__.'/../src/Carbon/Traits/Date.php',
    __DIR__.'/../src/Carbon/Traits/Units.php',
    __DIR__.'/../src/Carbon/Lang/fr.php',
];

$comments = [
    '// @--property',
    '// @property',
    '// @call ',
    '// Words with feminine grammatical gender: semaine',
];

foreach ($files as $file) {
    $contents = str_replace("\r", '', file_get_contents($file));
    $newContents = implode("\n", array_filter(explode("\n", $contents), static function ($line) use ($comments) {
        $code = trim($line);

        foreach ($comments as $comment) {
            if (str_starts_with($code, $comment)) {
                return false;
            }
        }

        return true;
    }));

    if ($newContents !== $contents) {
        file_put_contents($file, $newContents);
    }
}
