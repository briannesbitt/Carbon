<?php
declare(strict_types=1);

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class CascadeTest extends AbstractTestCase
{
    /**
     * @param CarbonInterval $interval
     * @param string         $spec
     * @param bool|int       $inverted
     */
    protected function assertIntervalSpec(CarbonInterval $interval, string $spec, $inverted = false): void
    {
        $this->assertSame(
            ($inverted ? '- ' : '+ ').$spec,
            ($interval->invert ? '- ' : '+ ').$interval->spec()
        );
    }

    /**
     * @dataProvider provideIntervalSpecs
     */
    public function testCascadesOverflowedValues($spec, $expected): void
    {
        $interval = CarbonInterval::fromString($spec)->cascade();
        $this->assertIntervalSpec($interval, $expected);

        $interval = CarbonInterval::fromString($spec)->invert()->cascade();
        $this->assertIntervalSpec($interval, $expected, true);
    }

    public function provideIntervalSpecs(): array
    {
        return [
            ['3600s',                        'PT1H'],
            ['10000s',                       'PT2H46M40S'],
            ['1276d',                        'P3Y9M16D'],
            ['47d 14h',                      'P1M19DT14H'],
            ['2y 123mo 5w 6d 47h 160m 217s', 'P12Y4M15DT1H43M37S'],
        ];
    }

    /**
     * @dataProvider provideMixedSignsIntervalSpecs
     *
     * @throws \Exception
     */
    public function testMixedSignsCascadesOverflowedValues($units, $expected, $expectingInversion): void
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

    public function provideMixedSignsIntervalSpecs(): array
    {
        return [
            [
                [
                    'hours' => 1,
                    'minutes' => -30,
                ],
                'PT30M',
                0,
            ],
            [
                [
                    'hours' => 1,
                    'minutes' => -90,
                ],
                'PT30M',
                1,
            ],
            [
                [
                    'hours' => 1,
                    'minutes' => -90,
                    'seconds' => 3660,
                ],
                'PT31M',
                0,
            ],
            [
                [
                    'hours' => 1,
                    'minutes' => -90,
                    'seconds' => 3540,
                ],
                'PT29M',
                0,
            ],
            [
                [
                    'hours' => 1,
                    'minutes' => 90,
                    'seconds' => -3540,
                ],
                'PT1H31M',
                0,
            ],
            [
                [
                    'hours' => 1,
                    'minutes' => 90,
                    'seconds' => -3660,
                ],
                'PT1H29M',
                0,
            ],
            [
                [
                    'hours' => -1,
                    'minutes' => 90,
                    'seconds' => -3660,
                ],
                'PT31M',
                1,
            ],
            [
                [
                    'hours' => -1,
                    'minutes' => 61,
                    'seconds' => -120,
                ],
                'PT1M',
                1,
            ],
            [
                [
                    'days' => 48,
                    'hours' => -8,
                ],
                'P1M19DT16H',
                0,
            ],
            [
                [
                    'days' => 48,
                    'hours' => -28,
                ],
                'P1M18DT20H',
                0,
            ],
            [
                [
                    'hours' => 1,
                    'seconds' => -3615,
                ],
                'PT15S',
                1,
            ],
            [
                [
                    'hours' => -1,
                    'seconds' => 3615,
                ],
                'PT15S',
                0,
            ],
            [
                [
                    'hours' => 1,
                    'seconds' => -59,
                ],
                'PT59M1S',
                0,
            ],
            [
                [
                    'hours' => -1,
                    'seconds' => 59,
                ],
                'PT59M1S',
                1,
            ],
            [
                [
                    'years' => 94,
                    'months' => 11,
                    'days' => 24,
                    'hours' => 3848,
                    'microseconds' => 7991,
                ],
                'P95Y5M16DT8H',
                0,
            ],
        ];
    }

    public function testCascadesWithMicroseconds(): void
    {
        $interval = CarbonInterval::fromString('1040ms 3012µs')->cascade();

        $this->assertSame('PT1S', $interval->spec());
        $this->assertSame(43, $interval->milliseconds);
        $this->assertSame(43012, $interval->microseconds);
    }

    /**
     * @dataProvider provideCustomIntervalSpecs
     */
    public function testCustomCascadesOverflowedValues($spec, $expected): void
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

    public function provideCustomIntervalSpecs(): array
    {
        return [
            ['3600s',                        '1h'],
            ['10000s',                       '2h 46m 40s'],
            ['1276d',                        '255w 1d'],
            ['47d 14h',                      '9w 3d 6h'],
            ['2y 123mo 5w 6d 47h 160m 217s', '2yrs 123mos 7w 2d 1h 43m 37s'],
        ];
    }

    /**
     * @dataProvider provideCustomIntervalSpecsLongFormat
     */
    public function testCustomCascadesOverflowedValuesLongFormat($spec, $expected): void
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

    public function provideCustomIntervalSpecsLongFormat(): array
    {
        return [
            ['3600s',                        '1 hour'],
            ['10000s',                       '2 hours 46 minutes 40 seconds'],
            ['1276d',                        '255 weeks 1 day'],
            ['47d 14h',                      '9 weeks 3 days 6 hours'],
            ['2y 123mo 5w 6d 47h 160m 217s', '2 years 123 months 7 weeks 2 days 1 hour 43 minutes 37 seconds'],
        ];
    }

    public function testMultipleAdd(): void
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

    public function testFactorsGroups(): void
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

    public function testGetFactor(): void
    {
        $this->assertSame(28, CarbonInterval::getFactor('day', 'months'));
        $this->assertSame(28, CarbonInterval::getFactor('day', 'month'));
        $this->assertSame(28, CarbonInterval::getFactor('days', 'month'));
        $this->assertSame(28, CarbonInterval::getFactor('day', 'month'));
        $this->assertSame(28, CarbonInterval::getFactor('dayz', 'months'));
    }

    public function testComplexInterval(): void
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
