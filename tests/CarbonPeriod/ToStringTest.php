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
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AbstractTestCase;

class ToStringTest extends AbstractTestCase
{
    #[DataProvider('dataForToString')]
    public function testToString($period, $expected)
    {
        Carbon::setLocale('en');
        Carbon::setTestNowAndTimezone(new Carbon('2015-09-01', 'America/Toronto'));

        $this->assertSame(
            $expected,
            $period->toString(),
        );
    }

    public static function dataForToString(): array
    {
        $periodClass = static::$periodClass;
        Carbon::setTestNowAndTimezone(new Carbon('2015-09-01', 'America/Toronto'));

        $set = [
            [
                $periodClass::create('R4/2012-07-01T12:00:00/P7D'),
                '4 times every 1 week from 2012-07-01 12:00:00',
            ],
            [
                $periodClass::create(
                    Carbon::parse('2015-09-30'),
                    Carbon::parse('2015-10-03'),
                ),
                'Every 1 day from 2015-09-30 to 2015-10-03',
            ],
            [
                $periodClass::create(
                    Carbon::parse('2015-09-30 12:50'),
                    CarbonInterval::days(3)->hours(5),
                    Carbon::parse('2015-10-03 19:00'),
                ),
                'Every 3 days and 5 hours from 2015-09-30 12:50:00 to 2015-10-03 19:00:00',
            ],
            [
                $periodClass::create('2015-09-30 17:30'),
                'Every 1 day from 2015-09-30 17:30:00',
            ],
            [
                $periodClass::create('P1M14D'),
                'Every 1 month and 2 weeks from 2015-09-01',
            ],
            [
                $periodClass::create('2015-09-30 13:30', 'P17D')->setRecurrences(1),
                'Once every 2 weeks and 3 days from 2015-09-30 13:30:00',
            ],
            [
                $periodClass::create('2015-10-01', '2015-10-05', 'PT30M'),
                'Every 30 minutes from 2015-10-01 to 2015-10-05',
            ],
        ];

        Carbon::setTestNowAndTimezone();

        return array_combine(
            array_column($set, 1),
            $set,
        );
    }

    public function testMagicToString()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            Carbon::parse('2015-09-30 12:50'),
            CarbonInterval::days(3)->hours(5),
            Carbon::parse('2015-10-03 19:00'),
        );

        $this->assertSame(
            'Every 3 days and 5 hours from 2015-09-30 12:50:00 to 2015-10-03 19:00:00',
            (string) $period,
        );
    }

    #[DataProvider('dataForToIso8601String')]
    public function testToIso8601String($period, $expected)
    {
        Carbon::setTestNowAndTimezone(new Carbon('2015-09-01', 'America/Toronto'));

        $this->assertSame(
            $expected,
            $period->toIso8601String(),
        );
    }

    public static function dataForToIso8601String(): array
    {
        $periodClass = static::$periodClass;
        Carbon::setTestNowAndTimezone(new Carbon('2015-09-01', 'America/Toronto'));

        $set = [
            [
                $periodClass::create('R4/2012-07-01T00:00:00-04:00/P7D'),
                'R4/2012-07-01T00:00:00-04:00/P7D',
            ],
            [
                $periodClass::create(
                    Carbon::parse('2015-09-30', 'America/Toronto'),
                    CarbonInterval::day(),
                    Carbon::parse('2015-10-03', 'America/Toronto'),
                ),
                '2015-09-30T00:00:00-04:00/P1D/2015-10-03T00:00:00-04:00',
            ],
            [
                $periodClass::createFromIso(
                    '2015-09-30T00:00:00-04:00/P1D/2015-10-03T00:00:00-04:00'
                ),
                '2015-09-30T00:00:00-04:00/P1D/2015-10-03T00:00:00-04:00',
            ],
            [
                $periodClass::createFromIso(
                    '2015-09-30T00:00:00-04:00/2015-10-03T00:00:00-04:00',
                ),
                '2015-09-30T00:00:00-04:00/2015-10-03T00:00:00-04:00',
            ],
            [
                $periodClass::create(
                    Carbon::parse('2015-09-30', 'America/Toronto'),
                    Carbon::parse('2015-10-03', 'America/Toronto'),
                ),
                '2015-09-30T00:00:00-04:00/2015-10-03T00:00:00-04:00',
            ],
            [
                $periodClass::create(
                    Carbon::parse('2015-09-30', 'America/Toronto'),
                    CarbonInterval::day(),
                    Carbon::parse('2015-10-03', 'America/Toronto'),
                )->resetDateInterval(),
                '2015-09-30T00:00:00-04:00/2015-10-03T00:00:00-04:00',
            ],
            [
                $periodClass::create(
                    Carbon::parse('2015-09-30 12:50', 'America/Toronto'),
                    CarbonInterval::days(3)->hours(5),
                    Carbon::parse('2015-10-03 19:00', 'America/Toronto'),
                ),
                '2015-09-30T12:50:00-04:00/P3DT5H/2015-10-03T19:00:00-04:00',
            ],
            [
                $periodClass::create(
                    Carbon::parse('2015-09-30 12:50', 'America/Toronto'),
                    CarbonInterval::days(3),
                ),
                '2015-09-30T12:50:00-04:00/P3D',
            ],
            [
                $periodClass::create('1 day'),
                '2015-09-01T00:00:00-04:00/P1D',
            ],
            [
                $periodClass::create(),
                '2015-09-01T00:00:00-04:00',
            ],
        ];

        Carbon::setTestNowAndTimezone();

        return array_combine(
            array_column($set, 1),
            $set,
        );
    }

    public function testSpec()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            Carbon::parse('2015-09-30'),
            CarbonInterval::days(3)->hours(5),
            Carbon::parse('2015-10-03'),
        );

        $this->assertSame(
            '2015-09-30T00:00:00-04:00/P3DT5H/2015-10-03T00:00:00-04:00',
            $period->spec(),
        );
    }

    public function testStartOfWeekForPeriod()
    {
        $periodClass = static::$periodClass;
        $sunday = CarbonImmutable::parse('2019-12-01');

        $period = $periodClass::create($sunday->startOfWeek(), '1 week', $sunday->endOfWeek())->toArray();

        $formattedSunday = $sunday->startOfWeek()->format('Y-m-d H:i:s');

        $this->assertSame(
            '2019-11-25 00:00:00',
            $formattedSunday,
        );

        $this->assertSame(
            $formattedSunday,
            $period[0]->toImmutable()->startOfWeek()->format('Y-m-d H:i:s'),
        );
    }

    public function testToStringCustomization()
    {
        $periodClass = static::$periodClass;
        $sunday = CarbonImmutable::parse('2019-12-01');

        $period = $periodClass::create($sunday->startOfWeek(), '1 week', $sunday->endOfWeek());

        $this->assertSame(
            'Every 1 week from 2019-11-25 00:00:00 to 2019-12-01 23:59:59!!',
            $period.'!!'
        );

        $periodClass::setToStringFormat('m/d');

        $this->assertSame(
            'Every 1 week from 11/25 to 12/01!!',
            $period.'!!'
        );

        $period->settings(['toStringFormat' => static function (CarbonPeriod $period) {
            return $period->toIso8601String();
        }]);

        $this->assertSame(
            '2019-11-25T00:00:00-05:00/P7D/2019-12-01T23:59:59-05:00!!',
            $period.'!!'
        );

        $periodClass::resetToStringFormat();
    }
}
