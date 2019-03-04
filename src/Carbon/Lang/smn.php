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
    'meridiem' => ['ip.', 'ep.'],
    'weekdays' => ['pasepeeivi', 'vuossaargâ', 'majebaargâ', 'koskoho', 'tuorâstuv', 'vástuppeeivi', 'lávurduv'],
    'weekdays_short' => ['pas', 'vuo', 'maj', 'kos', 'tuo', 'vás', 'láv'],
    'weekdays_min' => ['pa', 'vu', 'ma', 'ko', 'tu', 'vá', 'lá'],
    'weekdays_standalone' => ['pasepeivi', 'vuossargâ', 'majebargâ', 'koskokko', 'tuorâstâh', 'vástuppeivi', 'lávurdâh'],
    'months' => ['uđđâivemáánu', 'kuovâmáánu', 'njuhčâmáánu', 'cuáŋuimáánu', 'vyesimáánu', 'kesimáánu', 'syeinimáánu', 'porgemáánu', 'čohčâmáánu', 'roovvâdmáánu', 'skammâmáánu', 'juovlâmáánu'],
    'months_short' => ['uđiv', 'kuovâ', 'njuhčâ', 'cuáŋui', 'vyesi', 'kesi', 'syeini', 'porge', 'čohčâ', 'roovvâd', 'skammâ', 'juovlâ'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'H.mm',
        'LTS' => 'H.mm.ss',
        'L' => 'D.M.YYYY',
        'LL' => 'MMM D. YYYY',
        'LLL' => 'MMMM D. YYYY H.mm',
        'LLLL' => 'dddd, MMMM D. YYYY H.mm',
    ],
]);
