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

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use Carbon\Month;
use Carbon\OverflowMode;
use Tests\AbstractTestCase;

class FluidSettersTest extends AbstractTestCase
{
    public function testFluidYearSetter()
    {
        $d = Carbon::now();
        $d2 = $d->year(1995);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->year, $d->year);
        $this->assertSame(1995, $d2->year);
    }

    public function testFluidMonthSetter()
    {
        $d = Carbon::now();
        $d2 = $d->month(3);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->month, $d->month);
        $this->assertSame(3, $d2->month);
    }

    public function testFluidMonthSetterWithWrap()
    {
        $d = Carbon::createFromDate(2012, 8, 21);
        $d2 = $d->month(13);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame(8, $d->month);
        $this->assertSame(1, $d2->month);
    }

    public function testFluidDaySetter()
    {
        $d = Carbon::now();
        $d2 = $d->day(2);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->day, $d->day);
        $this->assertSame(2, $d2->day);
    }

    public function testFluidDaySetterWithWrap()
    {
        $d = Carbon::createFromDate(2000, 1, 3);
        $d2 = $d->day(32);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame(3, $d->day);
        $this->assertSame(1, $d2->day);
    }

    public function testFluidSetDate()
    {
        $d = Carbon::createFromDate(2000, 1, 1);
        $d2 = $d->setDate(1995, 13, 32);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertCarbon($d, 2000, 1, 1);
        $this->assertCarbon($d2, 1996, 2, 1);
    }

    public function testFluidHourSetter()
    {
        $d = Carbon::now();
        $d2 = $d->hour(2);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->hour, $d->hour);
        $this->assertSame(2, $d2->hour);
    }

    public function testFluidHourSetterWithWrap()
    {
        $d = Carbon::now();
        $d2 = $d->hour(25);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->hour, $d->hour);
        $this->assertSame(1, $d2->hour);
    }

    public function testFluidMinuteSetter()
    {
        $d = Carbon::now();
        $d2 = $d->minute(2);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->minute, $d->minute);
        $this->assertSame(2, $d2->minute);
    }

    public function testFluidMinuteSetterWithWrap()
    {
        $d = Carbon::now();
        $d2 = $d->minute(61);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->minute, $d->minute);
        $this->assertSame(1, $d2->minute);
    }

    public function testFluidSecondSetter()
    {
        $d = Carbon::now();
        $d2 = $d->second(2);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->second, $d->second);
        $this->assertSame(2, $d2->second);
    }

    public function testFluidSecondSetterWithWrap()
    {
        $d = Carbon::now();
        $d2 = $d->second(62);
        $this->assertInstanceOfCarbon($d2);
        $this->assertInstanceOf(Carbon::class, $d2);
        $this->assertSame($this->immutableNow->second, $d->second);
        $this->assertSame(2, $d2->second);
    }

    public function testFluidSetTime()
    {
        $d = Carbon::createFromDate(2000, 1, 1);
        $this->assertInstanceOfCarbon($d2 = $d->setTime(25, 61, 61));
        $this->assertCarbon($d2, 2000, 1, 2, 2, 2, 1);
    }

    public function testFluidTimestampSetter()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d2 = $d->timestamp(10));
        $this->assertSame(10, $d2->timestamp);

        $this->assertInstanceOfCarbon($d2 = $d->timestamp(1600887164.88952298));
        $this->assertSame('2020-09-23 14:52:44.889523', $d2->format('Y-m-d H:i:s.u'));

        $this->assertInstanceOfCarbon($d2 = $d->timestamp('0.88951247 1600887164'));
        $this->assertSame('2020-09-23 14:52:44.889512', $d2->format('Y-m-d H:i:s.u'));

        $this->assertInstanceOfCarbon($d2 = $d->timestamp('0.88951247/1600887164/12.56'));
        $this->assertSame('2020-09-23 14:52:57.449512', $d2->format('Y-m-d H:i:s.u'));
    }

    public function testMonthOverflow()
    {
        Carbon::resetMonthsOverflow();

        foreach ([4, Month::April] as $value) {
            $this->assertSame(
                '2021-05-01 23:00',
                Carbon::parse('2021-03-31 23:00:00')->month($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-05-01 23:00',
                Carbon::parse('2021-03-31 23:00:00')->setMonth($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-05-01 23:00',
                Carbon::parse('2021-03-31 23:00:00')->months($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-05-01 23:00',
                Carbon::parse('2021-03-31 23:00:00')->setMonths($value)->format('Y-m-d H:i'),
            );
        }

        foreach ([4, Month::April] as $value) {
            $this->assertSame(
                '2021-04-30 23:00',
                Carbon::parse('2021-03-31 23:00:00')
                    ->settings(['monthOverflow' => false])
                    ->month($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-04-30 23:00',
                Carbon::parse('2021-03-31 23:00:00')
                    ->settings(['monthOverflow' => false])
                    ->setMonth($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-04-30 23:00',
                Carbon::parse('2021-03-31 23:00:00')
                    ->settings(['monthOverflow' => false])
                    ->months($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-04-30 23:00',
                Carbon::parse('2021-03-31 23:00:00')
                    ->settings(['monthOverflow' => false])
                    ->setMonths($value)->format('Y-m-d H:i'),
            );
        }

        Carbon::useMonthsOverflow(false);

        foreach ([4, Month::April] as $value) {
            $this->assertSame(
                '2021-04-30 23:00',
                Carbon::parse('2021-03-31 23:00:00')->month($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-04-30 23:00',
                Carbon::parse('2021-03-31 23:00:00')->setMonth($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-04-30 23:00',
                Carbon::parse('2021-03-31 23:00:00')->months($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-04-30 23:00',
                Carbon::parse('2021-03-31 23:00:00')->setMonths($value)->format('Y-m-d H:i'),
            );
        }

        foreach ([4, Month::April] as $value) {
            $this->assertSame(
                '2021-05-01 23:00',
                Carbon::parse('2021-03-31 23:00:00')
                    ->settings(['monthOverflow' => true])
                    ->month($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-05-01 23:00',
                Carbon::parse('2021-03-31 23:00:00')
                    ->settings(['monthOverflow' => true])
                    ->setMonth($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-05-01 23:00',
                Carbon::parse('2021-03-31 23:00:00')
                    ->settings(['monthOverflow' => true])
                    ->months($value)->format('Y-m-d H:i'),
            );
            $this->assertSame(
                '2021-05-01 23:00',
                Carbon::parse('2021-03-31 23:00:00')
                    ->settings(['monthOverflow' => true])
                    ->setMonths($value)->format('Y-m-d H:i'),
            );
        }

        Carbon::resetMonthsOverflow();

        foreach ([false, OverflowMode::NoOverflow, OverflowMode::AnchorDay] as $overflow) {
            foreach ([4, Month::April] as $value) {
                $this->assertSame(
                    '2021-04-30 23:00',
                    Carbon::parse('2021-03-31 23:00:00')->month($value, overflow: $overflow)->format('Y-m-d H:i'),
                );
                $this->assertSame(
                    '2021-04-30 23:00',
                    Carbon::parse('2021-03-31 23:00:00')->setMonth($value, overflow: $overflow)->format('Y-m-d H:i'),
                );
                $this->assertSame(
                    '2021-04-30 23:00',
                    Carbon::parse('2021-03-31 23:00:00')->months($value, overflow: $overflow)->format('Y-m-d H:i'),
                );
                $this->assertSame(
                    '2021-04-30 23:00',
                    Carbon::parse('2021-03-31 23:00:00')->setMonths($value, overflow: $overflow)->format('Y-m-d H:i'),
                );
            }
        }

        $this->assertSame(
            '2021-06-30 23:00',
            Carbon::parse('2021-02-28 23:00:00')->month(Month::June, anchorDay: 31)->format('Y-m-d H:i'),
        );
        $this->assertSame(
            '2021-06-30 23:00',
            Carbon::parse('2021-02-28 23:00:00')->setMonth(Month::June, anchorDay: 31)->format('Y-m-d H:i'),
        );
        $this->assertSame(
            '2021-06-30 23:00',
            Carbon::parse('2021-02-28 23:00:00')->months(Month::June, anchorDay: 31)->format('Y-m-d H:i'),
        );
        $this->assertSame(
            '2021-06-30 23:00',
            Carbon::parse('2021-02-28 23:00:00')->setMonths(Month::June, anchorDay: 31)->format('Y-m-d H:i'),
        );

        $this->assertSame(
            '2021-07-31 23:00',
            Carbon::parse('2021-02-28 23:00:00')->month(Month::July, anchorDay: 31)->format('Y-m-d H:i'),
        );
        $this->assertSame(
            '2021-07-31 23:00',
            Carbon::parse('2021-02-28 23:00:00')->setMonth(Month::July, anchorDay: 31)->format('Y-m-d H:i'),
        );
        $this->assertSame(
            '2021-07-31 23:00',
            Carbon::parse('2021-02-28 23:00:00')->months(Month::July, anchorDay: 31)->format('Y-m-d H:i'),
        );
        $this->assertSame(
            '2021-07-31 23:00',
            Carbon::parse('2021-02-28 23:00:00')->setMonths(Month::July, anchorDay: 31)->format('Y-m-d H:i'),
        );
    }
}
