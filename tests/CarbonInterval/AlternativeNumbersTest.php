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

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class AlternativeNumbersTest extends AbstractTestCase
{
    public function testAlternativesNumbers()
    {
        $this->assertSame(
            '۵۲ ساعت',
            CarbonInterval::hours(52)->locale('fa')->forHumans(['altNumbers' => true]),
        );

        $this->assertSame(
            '۰۱ ساعت',
            CarbonInterval::hour()->locale('fa')->forHumans(['altNumbers' => 'fa']),
        );

        $this->assertSame(
            '1時間',
            CarbonInterval::hour()->locale('ja')->forHumans(['altNumbers' => 'fa']),
        );

        $this->assertSame(
            '۰۱ ساعت',
            CarbonInterval::hour()->locale('fa')->forHumans(['altNumbers' => ['fa', 'ja']]),
        );

        $this->assertSame(
            '52 ساعت',
            CarbonInterval::hours(52)->locale('fa')->forHumans(['altNumbers' => 'ja']),
        );

        $this->assertSame(
            '52 ساعت',
            CarbonInterval::hours(52)->locale('fa')->forHumans(['altNumbers' => ['lzh', 'ja']]),
        );

        $this->assertSame(
            '五十二時間',
            CarbonInterval::hours(52)->locale('ja')->forHumans(['altNumbers' => ['lzh', 'ja']]),
        );

        $this->assertSame(
            '-6',
            CarbonInterval::hours(-6)->locale('fa')->translateNumber(-6),
        );
    }
}
