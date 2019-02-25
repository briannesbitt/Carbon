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
 * - Arnas Udovičius bug-glibc-locales@gnu.org
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'YYYY.MM.DD',
    ],
    'months' => ['sausė', 'vasarė', 'kuova', 'balondė', 'gegožės', 'bėrželė', 'lëpas', 'rogpjūtė', 'siejės', 'spalė', 'lapkrėstė', 'grůdė'],
    'months_short' => ['Sau', 'Vas', 'Kuo', 'Bal', 'Geg', 'Bėr', 'Lëp', 'Rgp', 'Sie', 'Spa', 'Lap', 'Grd'],
    'weekdays' => ['nedielės dëna', 'panedielis', 'oterninks', 'sereda', 'četvergs', 'petnīčė', 'sobata'],
    'weekdays_short' => ['Nd', 'Pn', 'Ot', 'Sr', 'Čt', 'Pt', 'Sb'],
    'weekdays_min' => ['Nd', 'Pn', 'Ot', 'Sr', 'Čt', 'Pt', 'Sb'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
]);
