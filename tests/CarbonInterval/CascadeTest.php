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

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\AbstractTestCase;

class CascadeTest extends AbstractTestCase
{
    protected function assertIntervalSpec(CarbonInterval $interval, string $spec, bool|int $inverted = false): void
    {
        $this->assertSame(
            ($inverted ? '- ' : '+ ').$spec,
            ($interval->invert ? '- ' : '+ ').$interval->spec(),
        );
    }

    #[TestWith(['3600s', 'PT1H'])]
    #[TestWith(['10000s', 'PT2H46M40S'])]
    #[TestWith(['1276d', 'P3Y9M16D'])]
    #[TestWith(['47d 14h', 'P1M19DT14H'])]
    #[TestWith(['2y 123mo 5w 6d 47h 160m 217s', 'P12Y4M15DT1H43M37S'])]
    public function testCascadesOverflowedValues($spec, $expected)
    {
        $interval = CarbonInterval::fromString($spec)->cascade();
        $this->assertIntervalSpec($interval, $expected);

        $interval = CarbonInterval::fromString($spec)->invert()->cascade();
        $this->assertIntervalSpec($interval, $expected, true);
    }

    #[DataProvider('dataForMixedSignsIntervalSpecs')]
    public function testMixedSignsCascadesOverflowedValues($units, $expected, $expectingInversion)
    {
        $interval = new CarbonInterval(0);
        foreach ($units as $unit => $value) {
            $interval->$unit($value);
        }
        $interval->cascade();
        $this->assertIntervalSpec($interval, $expected, $expectingInversion);

        $interval = new CarbonInterval(0);
        foreach ($units as $unit => $value) {
            $interval->$unit($value);
        }
        $interval->invert()->cascade();
        $this->assertIntervalSpec($interval, $expected, 1 - $expectingInversion);
    }

    public static function dataForMixedSignsIntervalSpecs(): Generator
    {
        yield [
            [
                'hours' => 1,
                'minutes' => -30,
            ],
            'PT30M',
            0,
        ];
        yield [
            [
                'hours' => 1,
                'minutes' => -90,
            ],
            'PT30M',
            1,
        ];
        yield [
            [
                'hours' => 1,
                'minutes' => -90,
                'seconds' => 3660,
            ],
            'PT31M',
            0,
        ];
        yield [
            [
                'hours' => 1,
                'minutes' => -90,
                'seconds' => 3540,
            ],
            'PT29M',
            0,
        ];
        yield [
            [
                'hours' => 1,
                'minutes' => 90,
                'seconds' => -3540,
            ],
            'PT1H31M',
            0,
        ];
        yield [
            [
                'hours' => 1,
                'minutes' => 90,
                'seconds' => -3660,
            ],
            'PT1H29M',
            0,
        ];
        yield [
            [
                'hours' => -1,
                'minutes' => 90,
                'seconds' => -3660,
            ],
            'PT31M',
            1,
        ];
        yield [
            [
                'hours' => -1,
                'minutes' => 61,
                'seconds' => -120,
            ],
            'PT1M',
            1,
        ];
        yield [
            [
                'days' => 48,
                'hours' => -8,
            ],
            'P1M19DT16H',
            0,
        ];
        yield [
            [
                'days' => 48,
                'hours' => -28,
            ],
            'P1M18DT20H',
            0,
        ];
        yield [
            [
                'hours' => 1,
                'seconds' => -3615,
            ],
            'PT15S',
            1,
        ];
        yield [
            [
                'hours' => -1,
                'seconds' => 3615,
            ],
            'PT15S',
            0,
        ];
        yield [
            [
                'hours' => 1,
                'seconds' => -59,
            ],
            'PT59M1S',
            0,
        ];
        yield [
            [
                'hours' => -1,
                'seconds' => 59,
            ],
            'PT59M1S',
            1,
        ];
        yield [
            [
                'years' => 94,
                'months' => 11,
                'days' => 24,
                'hours' => 3848,
                'microseconds' => 7991,
            ],
            'P95Y5M16DT8H',
            0,
        ];
    }

    public function testCascadesWithMicroseconds()
    {
        $interval = CarbonInterval::fromString('1040ms 3012µs')->cascade();

        $this->assertSame('PT1S', $interval->spec());
        $this->assertSame(43, $interval->milliseconds);
        $this->assertSame(43012, $interval->microseconds);
    }

    #[TestWith(['3600s', '1h'])]
    #[TestWith(['10000s', '2h 46m 40s'])]
    #[TestWith(['1276d', '255w 1d'])]
    #[TestWith(['47d 14h', '9w 3d 6h'])]
    #[TestWith(['2y 123mo 5w 6d 47h 160m 217s', '2yrs 123mos 7w 2d 1h 43m 37s'])]
    public function testCustomCascadesOverflowedValues($spec, $expected)
    {
        $cascades = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'minutes' => [Carbon::SECONDS_PER_MINUTE, 'seconds'],
            'hours' => [Carbon::MINUTES_PER_HOUR, 'minutes'],
            'dayz' => [8, 'hours'],
            'weeks' => [5, 'dayz'],
        ]);
        $actual = CarbonInterval::fromString($spec)->cascade()->forHumans(true);
        CarbonInterval::setCascadeFactors($cascades);

        $this->assertSame($expected, $actual);
    }

    #[TestWith(['3600s', '1 hour'])]
    #[TestWith(['10000s', '2 hours 46 minutes 40 seconds'])]
    #[TestWith(['1276d', '255 weeks 1 day'])]
    #[TestWith(['47d 14h', '9 weeks 3 days 6 hours'])]
    #[TestWith(['2y 123mo 5w 6d 47h 160m 217s', '2 years 123 months 7 weeks 2 days 1 hour 43 minutes 37 seconds'])]
    public function testCustomCascadesOverflowedValuesLongFormat($spec, $expected)
    {
        $cascades = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'minutes' => [Carbon::SECONDS_PER_MINUTE, 'seconds'],
            'hours' => [Carbon::MINUTES_PER_HOUR, 'minutes'],
            'dayz' => [8, 'hours'],
            'weeks' => [5, 'dayz'],
        ]);
        $actual = CarbonInterval::fromString($spec)->cascade()->forHumans(false);
        CarbonInterval::setCascadeFactors($cascades);

        $this->assertSame($expected, $actual);
    }

    public function testMultipleAdd()
    {
        $cascades = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'minutes' => [Carbon::SECONDS_PER_MINUTE, 'seconds'],
            'hours' => [Carbon::MINUTES_PER_HOUR, 'minutes'],
            'days' => [8, 'hours'],
            'weeks' => [5, 'days'],
        ]);
        $actual = CarbonInterval::fromString('3d')
            ->add(CarbonInterval::fromString('1d 5h'))
            ->add(CarbonInterval::fromString('7h'))
            ->cascade()
            ->forHumans(true);
        CarbonInterval::setCascadeFactors($cascades);
        $this->assertSame('1w 4h', $actual);
    }

    public function testFactorsGroups()
    {
        $cascades = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'hours' => [Carbon::MINUTES_PER_HOUR, 'minutes'],
            'weeks' => [5, 'days'],
        ]);
        $actual = CarbonInterval::fromString('3d 50m')
            ->add(CarbonInterval::fromString('1d 5h 30m'))
            ->add(CarbonInterval::fromString('7h 45m'))
            ->add(CarbonInterval::fromString('1w 15m'))
            ->cascade()
            ->forHumans(true);
        CarbonInterval::setCascadeFactors($cascades);
        $this->assertSame('1w 4d 14h 20m', $actual);
    }

    public function testGetFactor()
    {
        $this->assertSame(28, CarbonInterval::getFactor('day', 'months'));
        $this->assertSame(28, CarbonInterval::getFactor('day', 'month'));
        $this->assertSame(28, CarbonInterval::getFactor('days', 'month'));
        $this->assertSame(28, CarbonInterval::getFactor('day', 'month'));
        $this->assertSame(28, CarbonInterval::getFactor('dayz', 'months'));
    }

    public function testComplexInterval()
    {
        $interval = CarbonInterval::create(0);
        $this->assertFalse($interval->hasNegativeValues());
        $this->assertFalse($interval->hasPositiveValues());
        $interval->days = -6;
        $this->assertTrue($interval->hasNegativeValues());
        $this->assertFalse($interval->hasPositiveValues());
        $interval->days = 6;
        $this->assertFalse($interval->hasNegativeValues());
        $this->assertTrue($interval->hasPositiveValues());
        $interval->hours = -40;
        $this->assertTrue($interval->hasNegativeValues());
        $this->assertTrue($interval->hasPositiveValues());

        $interval = CarbonInterval::create()
            ->years(-714)->months(-101)->days(-737)
            ->seconds(442)->microseconds(-19)
            ->cascade();

        $this->assertFalse($interval->hasNegativeValues());
        $this->assertTrue($interval->hasPositiveValues());

        $interval = CarbonInterval::create(0)->hours(-7024)->cascade();

        $this->assertLessThan(0, $interval->totalDays);
    }
}
