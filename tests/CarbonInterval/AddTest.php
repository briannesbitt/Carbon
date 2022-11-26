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
use DateInterval;
use DateTime;
use DateTimeImmutable;
use Generator;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class AddTest extends AbstractTestCase
{
    public function testAdd()
    {
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add(new DateInterval('P2Y1M5DT22H33M44S'));
        $this->assertCarbonInterval($ci, 6, 4, 54, 30, 43, 55);
    }

    public function testNamedParameters()
    {
        if (version_compare(PHP_VERSION, '8.0.0-dev', '<')) {
            $this->markTestSkipped('This tests needs PHP 8 named arguments syntax.');
        }

        $ci = eval("return \Carbon\CarbonInterval::years(years: 3)->addYears(years: 4);");
        $this->assertCarbonInterval($ci, 7);

        $ci = eval("return \Carbon\CarbonInterval::months(months: 3)->addMonths(months: 4);");
        $this->assertCarbonInterval($ci, 0, 7);

        $ci = eval("return \Carbon\CarbonInterval::weeks(weeks: 3)->addWeeks(weeks: 4);");
        $this->assertCarbonInterval($ci, 0, 0, 7 * 7);

        $ci = eval("return \Carbon\CarbonInterval::days(days: 3)->addDays(days: 4);");
        $this->assertCarbonInterval($ci, 0, 0, 7);

        $ci = eval("return \Carbon\CarbonInterval::hours(hours: 3)->addHours(hours: 4);");
        $this->assertCarbonInterval($ci, 0, 0, 0, 7);

        $ci = eval("return \Carbon\CarbonInterval::minutes(minutes: 3)->addMinutes(minutes: 4);");
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 7);

        $ci = eval("return \Carbon\CarbonInterval::seconds(seconds: 3)->addSeconds(seconds: 4);");
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 7);

        $ci = eval("return \Carbon\CarbonInterval::milliseconds(milliseconds: 3)->addMilliseconds(milliseconds: 4);");
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0, 7000);

        $ci = eval("return \Carbon\CarbonInterval::microseconds(microseconds: 3)->addMicroseconds(microseconds: 4);");
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0, 7);
    }

    public function testAddWithDiffDateInterval()
    {
        $diff = Carbon::now()->diff(Carbon::now()->addWeeks(3));
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add($diff);
        $this->assertCarbonInterval($ci, 4, 3, 70, 8, 10, 11);
    }

    public function testAddWithNegativeDiffDateInterval()
    {
        $diff = Carbon::now()->diff(Carbon::now()->subWeeks(3));
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add($diff);
        $this->assertCarbonInterval($ci, 4, 3, 28, 8, 10, 11);
    }

    public function testAddMicroseconds()
    {
        $diff = Carbon::now()->diff(Carbon::now()->addDays(3)->addMicroseconds(111222));
        $ci = CarbonInterval::create(1, 0, 0, 2, 0, 0, 0, 222333)->add($diff);
        if ($ci->seconds === 1) {
            $ci->seconds--;
            $ci->microseconds += 1000000;
        }
        $this->assertCarbonInterval($ci, 1, 0, 5, 0, 0, 0, 333555);
        $diff = Carbon::now()->diff(Carbon::now()->addDays(3));
        $ci = CarbonInterval::create(1, 0, 0, 2, 0, 0, 0, 222333)->add($diff);
        $this->assertCarbonInterval($ci, 1, 0, 5, 0, 0, 0, 222333);
        $diff = Carbon::now()->diff(Carbon::now()->addDays(3)->addMicroseconds(111222));
        $ci = CarbonInterval::create(1, 0, 0, 2, 0, 0, 0)->add($diff);
        if ($ci->seconds === 1) {
            $ci->seconds--;
            $ci->microseconds += 1000000;
        }
        $this->assertCarbonInterval($ci, 1, 0, 5, 0, 0, 0, 111222);
    }

    public function testAddWithRawDiffDateInterval()
    {
        date_default_timezone_set('UTC');

        $date = new DateTime();
        $diff = $date->diff((clone $date)->modify('3 weeks'));
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add($diff);
        $this->assertCarbonInterval($ci, 4, 3, 70, 8, 10, 11);
    }

    public function testAddWithRawNegativeDiffDateInterval()
    {
        date_default_timezone_set('UTC');

        $date = new DateTime();
        $diff = $date->diff((clone $date)->modify('-3 weeks'));
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add($diff);
        $this->assertCarbonInterval($ci, 4, 3, 28, 8, 10, 11);
    }

    public static function dataForAddsResults(): Generator
    {
        yield [5, 2, 7];
        yield [-5, -2, -7];
        yield [-5, 2, -3];
        yield [5, -2, 3];
        yield [2, 5, 7];
        yield [-2, -5, -7];
        yield [-2, 5, 3];
        yield [2, -5, -3];
    }

    /**
     * @dataProvider \Tests\CarbonInterval\AddTest::dataForAddsResults
     *
     * @param int $base
     * @param int $increment
     * @param int $expectedResult
     */
    public function testAddSign($base, $increment, $expectedResult)
    {
        $interval = new CarbonInterval();
        $interval->hours(abs($base));
        if ($base < 0) {
            $interval->invert();
        }
        $add = new CarbonInterval();
        $add->hours(abs($increment));
        if ($increment < 0) {
            $add->invert();
        }
        $interval->add($add);

        $this->assertGreaterThanOrEqual(0, $interval->hours);

        $actualResult = ($interval->invert ? -1 : 1) * $interval->hours;

        $this->assertSame($expectedResult, $actualResult);
    }

    public function testAddAndSubMultipleFormats()
    {
        $this->assertCarbonInterval(CarbonInterval::day()->add('hours', 3), 0, 0, 1, 3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->add(5, 'hours'), 0, 0, 1, 5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->add(3, '4 hours'), 0, 0, 1, 12, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->add(-5, 'hours'), 0, 0, 1, -5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->add('hour'), 0, 0, 0, 5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->add(new DateInterval('P5D')), 0, 0, 5, 4, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->add(CarbonInterval::minutes(30)), 0, 0, 0, 4, 30, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->sub('hours', 3), 0, 0, 1, -3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->subtract(5, 'hours'), 0, 0, 1, -5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->subtract(3, '4 hours'), 0, 0, 1, -12, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->subtract(-5, 'hours'), 0, 0, 1, 5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->sub('hour'), 0, 0, 0, 3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->subtract(new DateInterval('P5D')), 0, 0, -5, 4, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->sub(CarbonInterval::minutes(30)), 0, 0, 0, 4, -30, 0);
    }

    public function testAddWrongFormat()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'This type of data cannot be added/subtracted.'
        ));

        CarbonInterval::day()->add(Carbon::now());
    }

    public function testConvertDate()
    {
        $this->assertCarbon(CarbonInterval::days(3)->convertDate(new DateTime('2020-06-14')), 2020, 6, 17, 0, 0, 0);
        $this->assertCarbon(CarbonInterval::days(3)->convertDate(new DateTimeImmutable('2020-06-14')), 2020, 6, 17, 0, 0, 0);
        $this->assertCarbon(CarbonInterval::days(3)->convertDate(new DateTime('2020-06-14'), true), 2020, 6, 11, 0, 0, 0);
        $this->assertCarbon(CarbonInterval::days(3)->convertDate(new DateTimeImmutable('2020-06-14'), true), 2020, 6, 11, 0, 0, 0);
    }

    public function testMagicAddAndSubMethods()
    {
        $this->assertCarbonInterval(CarbonInterval::days(3)->addWeeks(2), 0, 0, 17, 0, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::weeks(3)->addDays(2), 0, 0, 23, 0, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::weeks(3)->subDays(2), 0, 0, 19, 0, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(2)->subMinutes(15), 0, 0, 0, 2, -15, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(2)->subMinutes(15)->cascade(), 0, 0, 0, 1, 45, 0);
    }

    public function testPlus()
    {
        $this->assertCarbonInterval(CarbonInterval::days(3)->plus(0, 0, 2, 0, 26), 0, 0, 17, 26, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::days(3)->plus(0, 0, 0.25), 0, 0, 4, 18, 0, 0);
        $interval = CarbonInterval::days(3)->plus(0, 0, 0.25)->plus(0, 0, 0.25)->cascade();
        $this->assertCarbonInterval($interval, 0, 0, 6, 12, 0, 0);
    }

    public function testPlusWithPHP8Syntax()
    {
        if (version_compare(PHP_VERSION, '8.0.0-dev', '<')) {
            $this->markTestSkipped('This tests needs PHP 8 named arguments syntax.');
        }

        $interval = eval('use Carbon\CarbonInterval;return CarbonInterval::days(3)->plus(weeks: 2, hours: 26);');

        $this->assertCarbonInterval($interval, 0, 0, 17, 26, 0, 0);
    }

    public function testMinus()
    {
        $this->assertCarbonInterval(CarbonInterval::days(3)->minus(0, 0, 2, 0, 26), 0, 0, 11, 26, 0, 0, 0, true);
    }

    public function testMinusWithPHP8Syntax()
    {
        if (version_compare(PHP_VERSION, '8.0.0-dev', '<')) {
            $this->markTestSkipped('This tests needs PHP 8 named arguments syntax.');
        }

        $interval = eval('use Carbon\CarbonInterval;return CarbonInterval::days(3)->minus(weeks: 2, hours: 26);');

        $this->assertCarbonInterval($interval, 0, 0, 11, 26, 0, 0, 0, true);
    }
}
