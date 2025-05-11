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

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class SerializationTest extends AbstractTestCase
{
    public function testSerializationFromV2(): void
    {
        $data = "O:19:\"Carbon\CarbonPeriod\":24:{s:12:\"\0*\0dateClass\";s:13:\"Carbon\Carbon\";s:15:\"\0*\0dateInterval\";O:21:\"Carbon\CarbonInterval\":22:{s:1:\"y\";i:0;s:1:\"m\";i:0;s:1:\"d\";i:3;s:1:\"h\";i:0;s:1:\"i\";i:0;s:1:\"s\";i:0;s:1:\"f\";d:0;s:6:\"invert\";i:0;s:4:\"days\";b:0;s:11:\"from_string\";b:0;s:9:\"\0*\0tzName\";N;s:7:\"\0*\0step\";N;s:22:\"\0*\0localMonthsOverflow\";N;s:21:\"\0*\0localYearsOverflow\";N;s:25:\"\0*\0localStrictModeEnabled\";N;s:24:\"\0*\0localHumanDiffOptions\";N;s:22:\"\0*\0localToStringFormat\";N;s:18:\"\0*\0localSerializer\";N;s:14:\"\0*\0localMacros\";N;s:21:\"\0*\0localGenericMacros\";N;s:22:\"\0*\0localFormatFunction\";N;s:18:\"\0*\0localTranslator\";N;}s:14:\"\0*\0constructed\";b:1;s:20:\"\0*\0isDefaultInterval\";b:0;s:10:\"\0*\0filters\";a:1:{i:0;a:2:{i:0;a:2:{i:0;s:19:\"Carbon\CarbonPeriod\";i:1;s:13:\"filterEndDate\";}i:1;N;}}s:12:\"\0*\0startDate\";O:13:\"Carbon\Carbon\":3:{s:4:\"date\";s:26:\"2018-04-21 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:10:\"\0*\0endDate\";O:13:\"Carbon\Carbon\":3:{s:4:\"date\";s:26:\"2018-04-27 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:14:\"\0*\0recurrences\";N;s:10:\"\0*\0options\";i:0;s:6:\"\0*\0key\";N;s:10:\"\0*\0current\";N;s:11:\"\0*\0timezone\";N;s:19:\"\0*\0validationResult\";N;s:9:\"\0*\0tzName\";N;s:22:\"\0*\0localMonthsOverflow\";N;s:21:\"\0*\0localYearsOverflow\";N;s:25:\"\0*\0localStrictModeEnabled\";N;s:24:\"\0*\0localHumanDiffOptions\";N;s:22:\"\0*\0localToStringFormat\";N;s:18:\"\0*\0localSerializer\";N;s:14:\"\0*\0localMacros\";N;s:21:\"\0*\0localGenericMacros\";N;s:22:\"\0*\0localFormatFunction\";N;s:18:\"\0*\0localTranslator\";N;}";

        $period = unserialize($data);
        /** @var CarbonPeriod $period */
        $period = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertSame(Carbon::class, $period->getDateClass());
        $this->assertNull($period->getRecurrences());
        $this->assertDate('2018-04-21', $period->getStartDate());
        $this->assertDate('2018-04-27', $period->getEndDate());
        $this->assertIntervalDuration('3 days', $period->getDateInterval());
    }

    public function testSerialization(): void
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $periodCopy = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertEquals($period, $periodCopy);
    }

    public function testSerializationWithRecurrences(): void
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::createFromISO8601String('R4/2023-07-01T00:00:00Z/P7D');
        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertDate('2023-07-01', $period->getStartDate());
        $this->assertNull($period->getEndDate());
        $this->assertSame(4, $period->getRecurrences());
        $this->assertIntervalDuration('1 week', $period->getDateInterval());

        $periodCopy = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $periodCopy);
        $this->assertEquals($period, $periodCopy);
        $this->assertDate('2023-07-01', $periodCopy->getStartDate());
        $this->assertNull($periodCopy->getEndDate());
        $this->assertSame(4, $periodCopy->getRecurrences());
        $this->assertIntervalDuration('1 week', $periodCopy->getDateInterval());
    }

    private function assertIntervalDuration(string $duration, mixed $interval): void
    {
        $this->assertInstanceOf(CarbonInterval::class, $interval);
        $this->assertSame($duration, $interval->forHumans());
    }

    private function assertDate(string $date, mixed $value, string $class = Carbon::class): void
    {
        if (\strlen($date) === 10) {
            $date .= 'T00:00:00';
        }

        if (\strlen($date) === 19) {
            $date .= '+00:00';
        }

        $this->assertInstanceOf($class, $value);
        $this->assertSame($date, $value->toIso8601String());
    }
}
