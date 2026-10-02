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

namespace Tests\Language;

use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AbstractTestCase;

class LocaleFormatsTest extends AbstractTestCase
{
    public function testFormatsHaveNoCldrOnlyLetters()
    {
        $invalid = [];

        foreach (glob(__DIR__.'/../../src/Carbon/Lang/*.php') as $file) {
            $locale = basename($file, '.php');
            $date = Carbon::parse('2026-09-30 14:05')->locale($locale);

            if ($date->locale !== $locale) {
                continue;
            }

            $formats = $date->getIsoFormats();

            foreach ($date->getCalendarFormats() as $key => $format) {
                $formats["calendar.$key"] = $format;
            }

            foreach (array_filter($formats, 'is_string') as $key => $format) {
                // Letters inside [...] or after \ are literal text
                $tokens = preg_replace('/\[[^\]]*]|\\\\./u', '', $format);

                // y and N are CLDR pattern letters (year, era) and isoFormat() era tokens:
                // they are left out of locale defaults, which stay in the calendar year
                if (preg_match('/[yN]/', $tokens)) {
                    $invalid[] = "$locale $key: $format";
                }
            }
        }

        $this->assertSame([], $invalid);
    }

    public static function dataForCldrFormats(): array
    {
        return [
            ['es_PH', 'L', '30/9/26'],
            ['fo_DK', 'L', '30.09.26'],
            ['hr_BA', 'L', '30. 9. 26.'],
            ['ms_BN', 'L', '30/09/26'],
            ['ms_SG', 'L', '30/09/26'],
            ['ne_IN', 'L', '26/9/30'],
            ['nnh', 'L', '30/09/26'],
            ['pa_Guru', 'L', '30/9/26'],
            ['sr_Cyrl_BA', 'L', '30.9.26.'],
            ['sr_Cyrl_XK', 'L', '30.9.26.'],
            ['sr_Latn_BA', 'L', '30.9.26.'],
            ['sr_Latn_XK', 'L', '30.9.26.'],
            ['ta_MY', 'L', '30/9/26'],
            ['ta_SG', 'L', '30/9/26'],
            ['uz_Cyrl', 'L', '30/09/26'],
            ['fur', 'LL', '30 di setembar dal 2026'],
            ['fur_IT', 'LLL', '30 di set 14:05'],
            ['fur_IT', 'LLLL', '30 di setembar dal 2026 14:05'],
            ['ps', 'L', '2026/9/30'],
            ['ps_AF', 'L', '2026/9/30'],
            ['seh', 'LL', '30 de Set de 2026'],
            ['seh', 'LLLL', 'Chitatu, 30 de Setembro de 2026 14:05'],
        ];
    }

    #[DataProvider('dataForCldrFormats')]
    public function testCldrFormatsUseIsoTokens(string $locale, string $format, string $expected)
    {
        $this->assertSame($expected, Carbon::parse('2026-09-30 14:05')->locale($locale)->isoFormat($format));
    }
}
