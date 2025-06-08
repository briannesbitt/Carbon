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
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use PHPUnit\Framework\Attributes\DataProvider;
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
        $this->assertSame(0, $period->getOptions());
        $this->assertNull($period->getRecurrences());
        $this->assertDate('2018-04-21', $period->getStartDate());
        $this->assertDate('2018-04-27', $period->getEndDate());
        $this->assertIntervalDuration('3 days', $period->getDateInterval());
        $this->assertSame('UTC', $period->current()->tzName);
    }

    public function testSerializationFromV2WithImmutableStart(): void
    {
        $data = "O:19:\"Carbon\CarbonPeriod\":24:{s:12:\"\0*\0dateClass\";s:13:\"Carbon\Carbon\";s:15:\"\0*\0dateInterval\";O:21:\"Carbon\CarbonInterval\":22:{s:1:\"y\";i:0;s:1:\"m\";i:0;s:1:\"d\";i:3;s:1:\"h\";i:0;s:1:\"i\";i:0;s:1:\"s\";i:0;s:1:\"f\";d:0;s:6:\"invert\";i:0;s:4:\"days\";b:0;s:11:\"from_string\";b:0;s:9:\"\0*\0tzName\";N;s:7:\"\0*\0step\";N;s:22:\"\0*\0localMonthsOverflow\";N;s:21:\"\0*\0localYearsOverflow\";N;s:25:\"\0*\0localStrictModeEnabled\";N;s:24:\"\0*\0localHumanDiffOptions\";N;s:22:\"\0*\0localToStringFormat\";N;s:18:\"\0*\0localSerializer\";N;s:14:\"\0*\0localMacros\";N;s:21:\"\0*\0localGenericMacros\";N;s:22:\"\0*\0localFormatFunction\";N;s:18:\"\0*\0localTranslator\";N;}s:14:\"\0*\0constructed\";b:1;s:20:\"\0*\0isDefaultInterval\";b:0;s:10:\"\0*\0filters\";a:1:{i:0;a:2:{i:0;a:2:{i:0;s:19:\"Carbon\CarbonPeriod\";i:1;s:13:\"filterEndDate\";}i:1;N;}}s:12:\"\0*\0startDate\";O:22:\"Carbon\CarbonImmutable\":3:{s:4:\"date\";s:26:\"2018-04-21 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:10:\"\0*\0endDate\";O:13:\"Carbon\Carbon\":3:{s:4:\"date\";s:26:\"2018-04-27 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:14:\"\0*\0recurrences\";N;s:10:\"\0*\0options\";i:0;s:6:\"\0*\0key\";N;s:10:\"\0*\0current\";N;s:11:\"\0*\0timezone\";N;s:19:\"\0*\0validationResult\";N;s:9:\"\0*\0tzName\";N;s:22:\"\0*\0localMonthsOverflow\";N;s:21:\"\0*\0localYearsOverflow\";N;s:25:\"\0*\0localStrictModeEnabled\";N;s:24:\"\0*\0localHumanDiffOptions\";N;s:22:\"\0*\0localToStringFormat\";N;s:18:\"\0*\0localSerializer\";N;s:14:\"\0*\0localMacros\";N;s:21:\"\0*\0localGenericMacros\";N;s:22:\"\0*\0localFormatFunction\";N;s:18:\"\0*\0localTranslator\";N;}";

        $period = unserialize($data);
        /** @var CarbonPeriod $period */
        $period = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertSame(Carbon::class, $period->getDateClass());
        $this->assertSame(0, $period->getOptions());
        $this->assertNull($period->getRecurrences());
        $this->assertDate('2018-04-21', $period->getStartDate(), CarbonImmutable::class);
        $this->assertDate('2018-04-27', $period->getEndDate());
        $this->assertIntervalDuration('3 days', $period->getDateInterval());
        $this->assertSame('UTC', $period->current()->tzName);
    }

    public function testSerializationFromV2WithRecurrences(): void
    {
        $data = 'O:19:"Carbon\\CarbonPeriod":24:{s:12:"'."\0".'*'."\0".'dateClass";s:13:"Carbon\\Carbon";s:15:"'."\0".'*'."\0".'dateInterval";O:21:"Carbon\\CarbonInterval":22:{s:1:"y";i:0;s:1:"m";i:0;s:1:"d";i:0;s:1:"h";i:1;s:1:"i";i:0;s:1:"s";i:0;s:1:"f";d:0;s:6:"invert";i:0;s:4:"days";b:0;s:11:"from_string";b:0;s:9:"'."\0".'*'."\0".'tzName";N;s:7:"'."\0".'*'."\0".'step";N;s:22:"'."\0".'*'."\0".'localMonthsOverflow";N;s:21:"'."\0".'*'."\0".'localYearsOverflow";N;s:25:"'."\0".'*'."\0".'localStrictModeEnabled";N;s:24:"'."\0".'*'."\0".'localHumanDiffOptions";N;s:22:"'."\0".'*'."\0".'localToStringFormat";N;s:18:"'."\0".'*'."\0".'localSerializer";N;s:14:"'."\0".'*'."\0".'localMacros";N;s:21:"'."\0".'*'."\0".'localGenericMacros";N;s:22:"'."\0".'*'."\0".'localFormatFunction";N;s:18:"'."\0".'*'."\0".'localTranslator";N;}s:14:"'."\0".'*'."\0".'constructed";b:1;s:20:"'."\0".'*'."\0".'isDefaultInterval";b:0;s:10:"'."\0".'*'."\0".'filters";a:1:{i:0;a:2:{i:0;a:2:{i:0;s:19:"Carbon\\CarbonPeriod";i:1;s:17:"filterRecurrences";}i:1;N;}}s:12:"'."\0".'*'."\0".'startDate";O:13:"Carbon\\Carbon":3:{s:4:"date";s:26:"2018-05-13 10:30:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:11:"Europe/Kyiv";}s:10:"'."\0".'*'."\0".'endDate";N;s:14:"'."\0".'*'."\0".'recurrences";i:3;s:10:"'."\0".'*'."\0".'options";i:3;s:6:"'."\0".'*'."\0".'key";N;s:10:"'."\0".'*'."\0".'current";N;s:11:"'."\0".'*'."\0".'timezone";s:11:"Europe/Kyiv";s:19:"'."\0".'*'."\0".'validationResult";N;s:9:"'."\0".'*'."\0".'tzName";s:11:"Europe/Kyiv";s:22:"'."\0".'*'."\0".'localMonthsOverflow";N;s:21:"'."\0".'*'."\0".'localYearsOverflow";N;s:25:"'."\0".'*'."\0".'localStrictModeEnabled";N;s:24:"'."\0".'*'."\0".'localHumanDiffOptions";N;s:22:"'."\0".'*'."\0".'localToStringFormat";N;s:18:"'."\0".'*'."\0".'localSerializer";N;s:14:"'."\0".'*'."\0".'localMacros";N;s:21:"'."\0".'*'."\0".'localGenericMacros";N;s:22:"'."\0".'*'."\0".'localFormatFunction";N;s:18:"'."\0".'*'."\0".'localTranslator";N;}';

        $period = unserialize($data);
        /** @var CarbonPeriod $period */
        $period = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertSame(Carbon::class, $period->getDateClass());
        $this->assertSame(3, $period->getOptions());
        $this->assertSame(3, $period->getRecurrences());
        $this->assertDate('2018-05-13T10:30:00+03:00', $period->getStartDate());
        $this->assertNull($period->getEndDate());
        $this->assertIntervalDuration('1 hour', $period->getDateInterval());
        $this->assertSame('Europe/Kyiv', $period->current()->tzName);
    }

    public function testSerializationFromV2WithTimezone(): void
    {
        $data = 'O:19:"Carbon\\CarbonPeriod":24:{s:12:"'."\0".'*'."\0".'dateClass";s:13:"Carbon\\Carbon";s:15:"'."\0".'*'."\0".'dateInterval";O:21:"Carbon\\CarbonInterval":22:{s:1:"y";i:0;s:1:"m";i:0;s:1:"d";i:0;s:1:"h";i:1;s:1:"i";i:0;s:1:"s";i:0;s:1:"f";d:0;s:6:"invert";i:0;s:4:"days";b:0;s:11:"from_string";b:0;s:9:"'."\0".'*'."\0".'tzName";N;s:7:"'."\0".'*'."\0".'step";N;s:22:"'."\0".'*'."\0".'localMonthsOverflow";N;s:21:"'."\0".'*'."\0".'localYearsOverflow";N;s:25:"'."\0".'*'."\0".'localStrictModeEnabled";N;s:24:"'."\0".'*'."\0".'localHumanDiffOptions";N;s:22:"'."\0".'*'."\0".'localToStringFormat";N;s:18:"'."\0".'*'."\0".'localSerializer";N;s:14:"'."\0".'*'."\0".'localMacros";N;s:21:"'."\0".'*'."\0".'localGenericMacros";N;s:22:"'."\0".'*'."\0".'localFormatFunction";N;s:18:"'."\0".'*'."\0".'localTranslator";N;}s:14:"'."\0".'*'."\0".'constructed";b:1;s:20:"'."\0".'*'."\0".'isDefaultInterval";b:0;s:10:"'."\0".'*'."\0".'filters";a:1:{i:0;a:2:{i:0;a:2:{i:0;s:19:"Carbon\\CarbonPeriod";i:1;s:17:"filterRecurrences";}i:1;N;}}s:12:"'."\0".'*'."\0".'startDate";O:13:"Carbon\\Carbon":3:{s:4:"date";s:26:"2018-05-13 10:30:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:11:"Europe/Kyiv";}s:10:"'."\0".'*'."\0".'endDate";N;s:14:"'."\0".'*'."\0".'recurrences";i:8;s:10:"'."\0".'*'."\0".'options";i:3;s:6:"'."\0".'*'."\0".'key";i:1;s:10:"'."\0".'*'."\0".'current";O:13:"Carbon\\Carbon":3:{s:4:"date";s:26:"2018-05-13 09:30:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:3:"UTC";}s:11:"'."\0".'*'."\0".'timezone";O:21:"Carbon\\CarbonTimeZone":2:{s:13:"timezone_type";i:3;s:8:"timezone";s:11:"Europe/Kyiv";}s:19:"'."\0".'*'."\0".'validationResult";b:1;s:9:"'."\0".'*'."\0".'tzName";s:11:"Europe/Kyiv";s:22:"'."\0".'*'."\0".'localMonthsOverflow";N;s:21:"'."\0".'*'."\0".'localYearsOverflow";N;s:25:"'."\0".'*'."\0".'localStrictModeEnabled";N;s:24:"'."\0".'*'."\0".'localHumanDiffOptions";N;s:22:"'."\0".'*'."\0".'localToStringFormat";N;s:18:"'."\0".'*'."\0".'localSerializer";N;s:14:"'."\0".'*'."\0".'localMacros";N;s:21:"'."\0".'*'."\0".'localGenericMacros";N;s:22:"'."\0".'*'."\0".'localFormatFunction";N;s:18:"'."\0".'*'."\0".'localTranslator";N;}';

        $period = unserialize($data);
        /** @var CarbonPeriod $period */
        $period = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertSame(Carbon::class, $period->getDateClass());
        $this->assertSame(3, $period->getOptions());
        $this->assertSame(8, $period->getRecurrences());
        $this->assertDate('2018-05-13T10:30:00+03:00', $period->getStartDate());
        $this->assertNull($period->getEndDate());
        $this->assertIntervalDuration('1 hour', $period->getDateInterval());
        $this->assertSame('Europe/Kyiv', $period->current()->tzName);
    }

    public function testSerializationFromV2WithCurrent(): void
    {
        $data = 'O:19:"Carbon\\CarbonPeriod":24:{s:12:"'."\0".'*'."\0".'dateClass";s:22:"Carbon\\CarbonImmutable";s:15:"'."\0".'*'."\0".'dateInterval";O:21:"Carbon\\CarbonInterval":22:{s:1:"y";i:0;s:1:"m";i:0;s:1:"d";i:1;s:1:"h";i:0;s:1:"i";i:0;s:1:"s";i:0;s:1:"f";d:0;s:6:"invert";i:0;s:4:"days";b:0;s:11:"from_string";b:0;s:9:"'."\0".'*'."\0".'tzName";N;s:7:"'."\0".'*'."\0".'step";N;s:22:"'."\0".'*'."\0".'localMonthsOverflow";N;s:21:"'."\0".'*'."\0".'localYearsOverflow";N;s:25:"'."\0".'*'."\0".'localStrictModeEnabled";N;s:24:"'."\0".'*'."\0".'localHumanDiffOptions";N;s:22:"'."\0".'*'."\0".'localToStringFormat";N;s:18:"'."\0".'*'."\0".'localSerializer";N;s:14:"'."\0".'*'."\0".'localMacros";N;s:21:"'."\0".'*'."\0".'localGenericMacros";N;s:22:"'."\0".'*'."\0".'localFormatFunction";N;s:18:"'."\0".'*'."\0".'localTranslator";N;}s:14:"'."\0".'*'."\0".'constructed";b:1;s:20:"'."\0".'*'."\0".'isDefaultInterval";b:0;s:10:"'."\0".'*'."\0".'filters";a:1:{i:0;a:2:{i:0;a:2:{i:0;s:19:"Carbon\\CarbonPeriod";i:1;s:13:"filterEndDate";}i:1;N;}}s:12:"'."\0".'*'."\0".'startDate";O:13:"Carbon\\Carbon":3:{s:4:"date";s:26:"2030-01-02 00:00:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}s:10:"'."\0".'*'."\0".'endDate";O:13:"Carbon\\Carbon":3:{s:4:"date";s:26:"2030-01-21 00:00:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}s:14:"'."\0".'*'."\0".'recurrences";N;s:10:"'."\0".'*'."\0".'options";i:4;s:6:"'."\0".'*'."\0".'key";N;s:10:"'."\0".'*'."\0".'current";N;s:11:"'."\0".'*'."\0".'timezone";N;s:19:"'."\0".'*'."\0".'validationResult";N;s:9:"'."\0".'*'."\0".'tzName";N;s:22:"'."\0".'*'."\0".'localMonthsOverflow";N;s:21:"'."\0".'*'."\0".'localYearsOverflow";N;s:25:"'."\0".'*'."\0".'localStrictModeEnabled";N;s:24:"'."\0".'*'."\0".'localHumanDiffOptions";N;s:22:"'."\0".'*'."\0".'localToStringFormat";N;s:18:"'."\0".'*'."\0".'localSerializer";N;s:14:"'."\0".'*'."\0".'localMacros";N;s:21:"'."\0".'*'."\0".'localGenericMacros";N;s:22:"'."\0".'*'."\0".'localFormatFunction";N;s:18:"'."\0".'*'."\0".'localTranslator";N;}';

        $period = unserialize($data);
        /** @var CarbonPeriod $period */
        $period = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertSame(CarbonImmutable::class, $period->getDateClass());
        $this->assertNull($period->getRecurrences());
        $this->assertDate('2030-01-02T00:00:00-05:00', $period->getStartDate());
        $this->assertDate('2030-01-21T00:00:00-05:00', $period->getEndDate());
        $this->assertIntervalDuration('1 day', $period->getDateInterval());
        $this->assertSame('America/Toronto', $period->current()->tzName);
    }

    public function testSerializationFromV2WithDateTimeObject(): void
    {
        $data = 'O:19:"Carbon\\CarbonPeriod":7:{s:5:"start";O:8:"DateTime":3:{s:4:"date";s:26:"2030-01-02 00:00:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}s:7:"current";N;s:3:"end";O:8:"DateTime":3:{s:4:"date";s:26:"2030-01-21 00:00:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}s:8:"interval";O:12:"DateInterval":10:{s:1:"y";i:0;s:1:"m";i:0;s:1:"d";i:1;s:1:"h";i:0;s:1:"i";i:0;s:1:"s";i:0;s:1:"f";d:0;s:6:"invert";i:0;s:4:"days";b:0;s:11:"from_string";b:0;}s:11:"recurrences";i:1;s:18:"include_start_date";b:1;s:16:"include_end_date";b:0;}';

        $period = unserialize($data);
        /** @var CarbonPeriod $period */
        $period = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertSame(Carbon::class, $period->getDateClass());
        $this->assertNull($period->getRecurrences());
        $this->assertDate('2030-01-02T00:00:00-05:00', $period->getStartDate());
        $this->assertDate('2030-01-21T00:00:00-05:00', $period->getEndDate());
        $this->assertIntervalDuration('1 day', $period->getDateInterval());
        $this->assertNull($period->current());
    }

    public function testSerializationFromV2WithDateTimeImmutableObject(): void
    {
        $data = 'O:19:"Carbon\\CarbonPeriod":7:{s:5:"start";O:17:"DateTimeImmutable":3:{s:4:"date";s:26:"2030-01-02 00:00:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}s:7:"current";N;s:3:"end";O:17:"DateTimeImmutable":3:{s:4:"date";s:26:"2030-01-21 00:00:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}s:8:"interval";O:12:"DateInterval":10:{s:1:"y";i:0;s:1:"m";i:0;s:1:"d";i:1;s:1:"h";i:0;s:1:"i";i:0;s:1:"s";i:0;s:1:"f";d:0;s:6:"invert";i:0;s:4:"days";b:0;s:11:"from_string";b:0;}s:11:"recurrences";i:1;s:18:"include_start_date";b:1;s:16:"include_end_date";b:0;}';

        $period = unserialize($data);
        /** @var CarbonPeriod $period */
        $period = unserialize(serialize($period));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertNull($period->getRecurrences());
        $this->assertDate('2030-01-02T00:00:00-05:00', $period->getStartDate(), CarbonImmutable::class);
        $this->assertDate('2030-01-21T00:00:00-05:00', $period->getEndDate(), CarbonImmutable::class);
        $this->assertIntervalDuration('1 day', $period->getDateInterval());
        $this->assertNull($period->current());
    }

    #[DataProvider('getCarbonPeriods')]
    public function testSerialization(CarbonPeriod $period): void
    {
        $this->assertSerializationWorks($period);
    }

    /**
     * @SuppressWarnings(MissingImport)
     */
    public function testUnserializeError(): void
    {
        $this->expectExceptionMessage(
            PHP_VERSION_ID < 8_02_00
                ? 'Disallowed'
                : 'Invalid serialization data for DatePeriod object',
        );

        if (!class_exists('CarbonDisallowingToDateTime')) {
            eval('
                class CarbonDisallowingToDateTime extends \Carbon\Carbon
                {
                    public function toDateTime(): DateTime
                    {
                        throw new LogicException("Disallowed");
                    }
                }
            ');
        }

        $periodClass = static::$periodClass;
        /** @var CarbonPeriod $period */
        $period = new $periodClass();

        $period->__unserialize([
            /* @phpstan-ignore-next-line */
            'start' => new CarbonDisallowingToDateTime('2030-01-02 UTC'),
            /* @phpstan-ignore-next-line */
            'end' => new CarbonDisallowingToDateTime('2030-01-10 UTC'),
            'interval' => new DateInterval('PT12H'),
        ]);
    }

    public static function getCarbonPeriods(): array
    {
        $periodClass = static::$periodClass;

        return [
            'new' => [new $periodClass()],
            'range string' => [$periodClass::createFromIso('2023-07-01T00:00:00Z/P7D/2023-11-01T00:00:00Z')],
            'include start and end' => [$periodClass::options(0)],
            'exclude start and end' => [$periodClass::options($periodClass::EXCLUDE_START_DATE | $periodClass::EXCLUDE_END_DATE)],
            'with timezone' => [
                $periodClass::createFromIso('2023-07-01T00:00:00Z/P7D/2023-11-01T00:00:00Z')
                    ->setTimezone('Europe/Kyiv'),
            ],
        ];
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

        $this->assertEquivalentPeriods($period, $periodCopy);
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

    private function assertSerializationWorks(CarbonPeriod $period): void
    {
        $periodCopy = unserialize(serialize($period));

        $this->assertEquivalentPeriods($period, $periodCopy);
    }

    private function assertEquivalentPeriods(mixed $a, mixed $b): void
    {
        $this->assertInstanceOf(CarbonPeriod::class, $b);
        $this->assertSame($a::class, $b::class);

        if (PHP_VERSION_ID >= 8_02_00) {
            $this->assertEquals($a, $b);

            return;
        }

        $this->assertEquals($a->getStartDate(), $b->getStartDate());
        $this->assertEquals($a->getDateInterval(), $b->getDateInterval());
        $this->assertEquals($a->getEndDate(), $b->getEndDate());
        $this->assertEquals($a->getRecurrences(), $b->getRecurrences());
        $this->assertEquals($a->getOptions(), $b->getOptions());
    }
}
