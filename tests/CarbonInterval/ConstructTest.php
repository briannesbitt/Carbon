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

use BadMethodCallException;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Exceptions\OutOfRangeException;
use Carbon\Unit;
use DateInterval;
use Exception;
use Tests\AbstractTestCase;

class ConstructTest extends AbstractTestCase
{
    public function testInheritedConstruct()
    {
        /** @phpstan-var CarbonInterval $ci */
        $ci = CarbonInterval::createFromDateString('1 hour');
        $this->assertSame('PT1H', $ci->spec());
        $ci = new CarbonInterval('PT0S');
        $this->assertInstanceOf(CarbonInterval::class, $ci);
        $this->assertInstanceOf(DateInterval::class, $ci);
        $this->assertSame('PT0S', $ci->spec());
        $ci = new CarbonInterval('P1Y2M3D');
        $this->assertSame('P1Y2M3D', $ci->spec());
        $ci = CarbonInterval::create('PT0S');
        $this->assertSame('PT0S', $ci->spec());
        $ci = CarbonInterval::create('P1Y2M3D');
        $this->assertSame('P1Y2M3D', $ci->spec());
        $ci = CarbonInterval::create('P1Y2M3.0D');
        $this->assertSame('P1Y2M3D', $ci->spec());
        $ci = CarbonInterval::create('PT9.5H+85M');
        $this->assertSame('PT9H115M', $ci->spec());
        $ci = CarbonInterval::create('PT9H+85M');
        $this->assertSame('PT9H85M', $ci->spec());
        $ci = CarbonInterval::create('PT1999999999999.5H+85M');
        $this->assertSame('PT1999999999999H115M', $ci->spec());
    }

    public function testConstructWithDateInterval()
    {
        $ci = new CarbonInterval(new DateInterval('P1Y2M3D'));
        $this->assertSame('P1Y2M3D', $ci->spec());
        $interval = new DateInterval('P1Y2M3D');
        $interval->m = -6;
        $interval->invert = 1;
        $ci = new CarbonInterval($interval);
        $this->assertSame(1, $ci->y);
        $this->assertSame(-6, $ci->m);
        $this->assertSame(3, $ci->d);
        $this->assertSame(1, $ci->invert);
    }

    public function testDefaults()
    {
        $ci = new CarbonInterval();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testNulls()
    {
        $ci = new CarbonInterval(null, null, null, null, null, null);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
        $ci = CarbonInterval::days(null);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testZeroes()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::days(0);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testZeroesChained()
    {
        $ci = CarbonInterval::days(0)->week(0)->minutes(0);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testYears()
    {
        $ci = new CarbonInterval(1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 1, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::years(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 2, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::year();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 1, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::year(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 3, 0, 0, 0, 0, 0);
    }

    public function testMonths()
    {
        $ci = new CarbonInterval(0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 1, 0, 0, 0, 0);

        $ci = CarbonInterval::months(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 2, 0, 0, 0, 0);

        $ci = CarbonInterval::month();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 1, 0, 0, 0, 0);

        $ci = CarbonInterval::month(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 3, 0, 0, 0, 0);
    }

    public function testWeeks()
    {
        $ci = new CarbonInterval(0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 7, 0, 0, 0);

        $ci = CarbonInterval::weeks(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 14, 0, 0, 0);

        $ci = CarbonInterval::week();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 7, 0, 0, 0);

        $ci = CarbonInterval::week(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 21, 0, 0, 0);
    }

    public function testDays()
    {
        $ci = new CarbonInterval(0, 0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 1, 0, 0, 0);

        $ci = CarbonInterval::days(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 2, 0, 0, 0);

        $ci = CarbonInterval::dayz(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 2, 0, 0, 0);

        $ci = CarbonInterval::day();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 1, 0, 0, 0);

        $ci = CarbonInterval::day(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 3, 0, 0, 0);
    }

    public function testHours()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 1, 0, 0);

        $ci = CarbonInterval::hours(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 2, 0, 0);

        $ci = CarbonInterval::hour();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 1, 0, 0);

        $ci = CarbonInterval::hour(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 3, 0, 0);
    }

    public function testMinutes()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 1, 0);

        $ci = CarbonInterval::minutes(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 2, 0);

        $ci = CarbonInterval::minute();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 1, 0);

        $ci = CarbonInterval::minute(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 3, 0);
    }

    public function testSeconds()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 1);

        $ci = CarbonInterval::seconds(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 2);

        $ci = CarbonInterval::second();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 1);

        $ci = CarbonInterval::second(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 3);
    }

    public function testMilliseconds()
    {
        $ci = CarbonInterval::milliseconds(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
        $this->assertSame(2, $ci->milliseconds);

        $ci = CarbonInterval::millisecond();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
        $this->assertSame(1, $ci->milliseconds);
    }

    public function testMicroseconds()
    {
        $ci = CarbonInterval::microseconds(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
        $this->assertSame(2, $ci->microseconds);

        $ci = CarbonInterval::microsecond();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
        $this->assertSame(1, $ci->microseconds);
    }

    public function testYearsAndHours()
    {
        $ci = new CarbonInterval(5, 0, 0, 0, 3, 0, 0);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 5, 0, 0, 3, 0, 0);
    }

    public function testAll()
    {
        $ci = new CarbonInterval(5, 6, 2, 5, 9, 10, 11);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 5, 6, 19, 9, 10, 11);
    }

    public function testAllWithCreate()
    {
        $ci = CarbonInterval::create(5, 6, 2, 5, 9, 10, 11);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 5, 6, 19, 9, 10, 11);
    }

    public function testInstance()
    {
        $ci = CarbonInterval::instance(new DateInterval('P2Y1M5DT22H33M44S'));
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 2, 1, 5, 22, 33, 44);
        $this->assertFalse($ci->days);
    }

    public function testInstanceWithSkipCopy()
    {
        $ci = CarbonInterval::instance(new DateInterval('P2Y1M5DT22H33M44S'));
        $copy = CarbonInterval::instance($ci, [], true);
        $this->assertSame($ci, $copy);
    }

    public function testInstanceWithNegativeDateInterval()
    {
        $di = new DateInterval('P2Y1M5DT22H33M44S');
        $di->invert = 1;
        $ci = CarbonInterval::instance($di);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 2, 1, 5, 22, 33, 44);
        $this->assertFalse($ci->days);
        $this->assertSame(1, $ci->invert);
    }

    public function testInstanceWithDays()
    {
        $ci = CarbonInterval::instance(Carbon::now()->diff(Carbon::now()->addWeeks(3)));
        $this->assertCarbonInterval($ci, 0, 0, 21, 0, 0, 0);
    }

    public function testCopy()
    {
        $one = CarbonInterval::days(10);
        $two = $one->hours(6)->copy()->hours(3);
        $this->assertCarbonInterval($one, 0, 0, 10, 6, 0, 0);
        $this->assertCarbonInterval($two, 0, 0, 10, 3, 0, 0);
    }

    public function testMake()
    {
        $this->assertCarbonInterval(CarbonInterval::make(3, 'hours'), 0, 0, 0, 3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::make('3 hours 30 m'), 0, 0, 0, 3, 30, 0);
        $this->assertCarbonInterval(CarbonInterval::make('PT5H'), 0, 0, 0, 5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::make('PT13.516837S'), 0, 0, 0, 0, 0, 13, 516_837);
        $this->assertCarbonInterval(CarbonInterval::make('PT13.000001S'), 0, 0, 0, 0, 0, 13, 1);
        $this->assertCarbonInterval(CarbonInterval::make('PT13.001S'), 0, 0, 0, 0, 0, 13, 1_000);
        $this->assertCarbonInterval(CarbonInterval::make(new DateInterval('P1D')), 0, 0, 1, 0, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::make(new CarbonInterval('P2M')), 0, 2, 0, 0, 0, 0);
        $this->assertNull(CarbonInterval::make(3));

        $this->assertSame(3.0, CarbonInterval::make('3 milliseconds')->totalMilliseconds);
        $this->assertSame(3.0, CarbonInterval::make('3 microseconds')->totalMicroseconds);
        $this->assertSame(21.0, CarbonInterval::make('3 weeks')->totalDays);
        $this->assertSame(9.0, CarbonInterval::make('3 quarters')->totalMonths);
        $this->assertSame(30.0, CarbonInterval::make('3 decades')->totalYears);
        $this->assertSame(300.0, CarbonInterval::make('3 centuries')->totalYears);
        $this->assertSame(3000.0, CarbonInterval::make('3 millennia')->totalYears);
    }

    public function testBadFormats()
    {
        $this->expectExceptionObject(new Exception('PT1999999999999.5.5H+85M'));

        CarbonInterval::create('PT1999999999999.5.5H+85M');
    }

    public function testOutOfRange()
    {
        $this->expectExceptionObject(new OutOfRangeException(
            'hour',
            -0x7fffffffffffffff,
            0x7fffffffffffffff,
            999999999999999999999999
        ));

        CarbonInterval::create('PT999999999999999999999999H');
    }

    public function testCallInvalidStaticMethod()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Unknown fluent constructor \'anything\'',
        ));

        CarbonInterval::anything();
    }

    public function testOriginal()
    {
        $this->assertSame('3 hours', CarbonInterval::make(3, 'hours')->original());
        $this->assertSame('3 hours 30 m', CarbonInterval::make('3 hours 30 m')->original());
        $this->assertSame('PT5H', CarbonInterval::make('PT5H')->original());
        $interval = new DateInterval('P1D');
        $this->assertSame($interval, CarbonInterval::make($interval)->original());
        $interval = new CarbonInterval('P2M');
        $this->assertSame($interval, CarbonInterval::make($interval)->original());
    }

    public function testCreateFromDateString()
    {
        $this->assertCarbonInterval(CarbonInterval::createFromDateString('3 hours'), 0, 0, 0, 3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::createFromDateString('46 days, 43 hours and 57 minutes'), 0, 0, 46, 43, 57, 0);
    }

    public function testCreateFromDateIncorrectString()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('foo bar', true),
        ));

        CarbonInterval::createFromDateString('foo bar');
    }

    public function testCreateFromDateIncorrectStringWithErrorAsException()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('foo bar', true),
        ));

        $this->withErrorAsException(function () {
            CarbonInterval::createFromDateString('foo bar');
        });
    }

    public function testMakeFromDateIncorrectString()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('foo bar', true),
        ));

        CarbonInterval::make('foo bar');
    }

    public function testMakeFromDateIncorrectStringWithErrorAsException()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('foo bar', true),
        ));

        $this->withErrorAsException(function () {
            CarbonInterval::make('foo bar');
        });
    }

    public function testEnums()
    {
        $this->assertCarbonInterval(CarbonInterval::make(3, Unit::Hour), 0, 0, 0, 3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::make(Unit::Week), 0, 0, 7, 0, 0, 0);
    }

    public function testFromSerialization()
    {
        $past = new Carbon('-3 Days');
        $today = new Carbon('today');
        $interval = $today->diffAsCarbonInterval($past);
        /** @var CarbonInterval $copy */
        $copy = unserialize(serialize($interval));

        $this->assertInstanceOf(CarbonInterval::class, $copy);

        $this->assertSame('2 days', $interval->forHumans(parts: 1));
        $this->assertSame('2 days', $copy->forHumans(parts: 1));

        $this->assertSame(['en'], array_keys($interval->getLocalTranslator()->getMessages()) ?: ['en']);
        $this->assertSame(['en'], array_keys($copy->getLocalTranslator()->getMessages()) ?: ['en']);
        $this->assertSame($interval->locale, $copy->locale);

        // Ignore translator for the English comparison
        $copy->setLocalTranslator($interval->getLocalTranslator());

        $this->assertSameIntervals($interval, $copy, 1);

        $interval = $today->locale('ja')->diffAsCarbonInterval($past);
        /** @var CarbonInterval $copy */
        $copy = unserialize(serialize($interval));

        $this->assertInstanceOf(CarbonInterval::class, $copy);

        $this->assertSame('二日', $interval->forHumans(['altNumbers' => true, 'parts' => 1]));
        $this->assertSame('二日', $copy->forHumans(['altNumbers' => true, 'parts' => 1]));

        $this->assertSame(['ja'], array_keys($interval->getLocalTranslator()->getMessages()));
        $this->assertSame(['ja'], array_keys($copy->getLocalTranslator()->getMessages()));

        $this->assertSameIntervals($interval, $copy, 1);
    }

    /** @group i */
    public function testFromSerializationConst()
    {
        $past = new Carbon('2024-01-01 00:00:00');
        $today = new Carbon('2024-01-03 06:39:47.065034');
        $interval = $today->diffAsCarbonInterval($past);
        /** @var CarbonInterval $copy */
        $copy = unserialize(serialize($interval));

        $this->assertInstanceOf(CarbonInterval::class, $copy);

        $this->assertSame('2 days', $interval->forHumans(parts: 1));
        $this->assertSame('2 days', $copy->forHumans(parts: 1));

        $this->assertSame(['en'], array_keys($interval->getLocalTranslator()->getMessages()) ?: ['en']);
        $this->assertSame(['en'], array_keys($copy->getLocalTranslator()->getMessages()) ?: ['en']);
        $this->assertSame($interval->locale, $copy->locale);

        // Ignore translator for the English comparison
        $copy->setLocalTranslator($interval->getLocalTranslator());

        $this->assertSameIntervals($interval, $copy, 1);

        $interval = $today->locale('ja')->diffAsCarbonInterval($past);
        /** @var CarbonInterval $copy */
        $copy = unserialize(serialize($interval));

        $this->assertInstanceOf(CarbonInterval::class, $copy);

        $this->assertSame('二日', $interval->forHumans(['altNumbers' => true, 'parts' => 1]));
        $this->assertSame('二日', $copy->forHumans(['altNumbers' => true, 'parts' => 1]));

        $this->assertSame(['ja'], array_keys($interval->getLocalTranslator()->getMessages()));
        $this->assertSame(['ja'], array_keys($copy->getLocalTranslator()->getMessages()));

        $this->assertSameIntervals($interval, $copy, 1);
    }

    public function testFromV2SerializedInterval()
    {
        $serializedData = trim(file_get_contents(__DIR__.'/../Fixtures/serialized-interval-from-v2.txt'));
        $interval = unserialize($serializedData);

        $this->assertInstanceOf(CarbonInterval::class, $interval);
        $this->assertSame(2, $interval->m);
        $this->assertSame(5.4e-5, $interval->f);
    }

    private function assertSameIntervals(CarbonInterval $expected, CarbonInterval $actual, int $microsecondApproximation = 0): void
    {
        if (
            $expected->microseconds !== $actual->microseconds
            && $microsecondApproximation > 0
            && $actual->microseconds >= $expected->microseconds - $microsecondApproximation
            && $actual->microseconds <= $expected->microseconds + $microsecondApproximation
        ) {
            $actual->optimize();
            $expected->optimize();
            $expected->microseconds = $actual->microseconds;
        }

        if (PHP_VERSION >= 8.3) {
            $this->assertEquals($expected, $actual);

            return;
        }

        $expectedProperties = (array) $expected;
        unset($expectedProperties['days']);
        $actualProperties = (array) $actual;
        unset($actualProperties['days']);

        if (
            isset($expectedProperties["\0*\0rawInterval"], $actualProperties["\0*\0rawInterval"])
            && $expectedProperties["\0*\0rawInterval"]->f !== $actualProperties["\0*\0rawInterval"]->f
            && $microsecondApproximation > 0
            && $actualProperties["\0*\0rawInterval"]->f >= $expectedProperties["\0*\0rawInterval"]->f - $microsecondApproximation
            && $actualProperties["\0*\0rawInterval"]->f <= $expectedProperties["\0*\0rawInterval"]->f + $microsecondApproximation
        ) {
            unset($expectedProperties["\0*\0rawInterval"]);
            unset($expectedProperties["\0*\0originalInput"]);
            unset($actualProperties["\0*\0rawInterval"]);
            unset($actualProperties["\0*\0originalInput"]);
        }

        $this->assertEquals($expectedProperties, $actualProperties);
    }
}
