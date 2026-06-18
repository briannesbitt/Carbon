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

namespace Tests\CarbonPeriod;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class QuarterlyTest extends AbstractTestCase
{
    public function testQuarterly()
    {
        Carbon::setTestNow(Carbon::parse('2019-05-31 09:52:46.321654'));
        $period = CarbonPeriod::quarterly();

        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2019-05-31 09:52:46.321654',
            '2019-08-31 09:52:46.321654',
            '2019-11-30 09:52:46.321654',
            '2020-02-29 09:52:46.321654',
            '2020-05-31 09:52:46.321654',
            '2020-08-31 09:52:46.321654',
            '2020-11-30 09:52:46.321654',
            '2021-02-28 09:52:46.321654',
            '2021-05-31 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));

        $period->invert()->since('2021-05-31 09:52:46.321654');

        $this->assertSame([
            '2021-05-31 09:52:46.321654',
            '2021-02-28 09:52:46.321654',
            '2020-11-30 09:52:46.321654',
            '2020-08-31 09:52:46.321654',
            '2020-05-31 09:52:46.321654',
            '2020-02-29 09:52:46.321654',
            '2019-11-30 09:52:46.321654',
            '2019-08-31 09:52:46.321654',
            '2019-05-31 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    private function getDates(
        CarbonPeriod $period,
        int $limit = 10,
        ?string $expectedDateClass = null,
    ): array {
        $dates = [];

        foreach ($period as $date) {
            if (--$limit === 0) {
                break;
            }

            if ($expectedDateClass !== null) {
                $this->assertInstanceOf($expectedDateClass, $date);
            }

            $dates[] = $date->format('Y-m-d H:i:s.u');
        }

        return $dates;
    }
}
