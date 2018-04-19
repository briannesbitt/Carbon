<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use DateTime;
use Tests\AbstractTestCase;

class FilterTest extends AbstractTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testFilter()
    {
        Carbon::setWeekendDays(array(
            Carbon::SATURDAY,
            Carbon::SUNDAY,
        ));

        $period = CarbonPeriod::create('R4/2018-04-14T00:00:00Z/P4D')->filter(function ($date) {
            return $date->isWeekday();
        });

        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d H:i:s');
        }

        self::assertEquals(array(
            '2018-04-18 00:00:00',
            '2018-04-26 00:00:00',
            '2018-04-30 00:00:00',
        ), $results);
    }

    /**
     * @throws \Exception
     */
    public function testFilterWithBaseClasses()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateInterval('P1M'), new DateTime('2018-07-15')
        );
        $period->filter(function (Carbon $date) {
            return $date->year === 2018;
        });

        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(
            '2018-04-16',
            '2018-05-16',
            '2018-06-16',
        ), $results);
        $this->assertNull($period->key());
        $period->next();
        $this->assertNull($period->key());

        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateInterval('P1M'), new DateTime('2018-07-15')
        );
        $period->filter(function (Carbon $date) {
            return $date->year === 2017;
        });

        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(), $results);
        $this->assertNull($period->key());
        $period->next();
        $this->assertNull($period->key());
    }

    /**
     * @throws \Exception
     */
    public function testFilterQuit()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateInterval('P3D'), new DateTime('2018-07-15')
        );
        $period->filter(function (Carbon $date) {
            return $date->month === 5 ? CarbonPeriod::END_ITERATION : true;
        });

        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(
            '2018-04-16',
            '2018-04-19',
            '2018-04-22',
            '2018-04-25',
            '2018-04-28',
        ), $results);
        $this->assertNull($period->key());
        $period->next();
        $this->assertNull($period->key());
    }
}
