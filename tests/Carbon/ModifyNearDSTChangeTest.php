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

namespace Tests\Carbon;

use Carbon\Carbon;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use Tests\AbstractTestCase;

class ModifyNearDSTChangeTest extends AbstractTestCase
{
    /**
     * Tests transition through DST change hour in non default timezone.
     */
    #[Group('dst')]
    #[DataProvider('dataForTransitionTests')]
    public function testTransitionInNonDefaultTimezone(string $dateString, int $addHours, string $expected)
    {
        date_default_timezone_set('Europe/london');
        $date = Carbon::parse($dateString, 'America/New_York');
        $date->addHours($addHours);
        $this->assertSame($expected, $date->format('c'));
    }

    /**
     * Tests transition through DST change hour in default timezone.
     */
    #[Group('dst')]
    #[DataProvider('dataForTransitionTests')]
    public function testTransitionInDefaultTimezone(string $dateString, int $addHours, string $expected)
    {
        date_default_timezone_set('America/New_York');
        $date = Carbon::parse($dateString, 'America/New_York');
        $date->addHours($addHours);
        $this->assertSame($expected, $date->format('c'));
    }

    public static function dataForTransitionTests(): Generator
    {
        // arguments:
        // - Date string to Carbon::parse in America/New_York.
        // - Hours to add
        // - Resulting string in 'c' format

        // testForwardTransition
        // When standard time was about to reach 2010-03-14T02:00:00-05:00 clocks were turned forward 1 hour to
        // 2010-03-14T03:00:00-04:00 local daylight time instead
        yield [
            '2010-03-14T00:00:00',
            24,
            '2010-03-15T01:00:00-04:00',
        ];

        // testBackwardTransition
        // When local daylight time was about to reach 2010-11-07T02:00:00-04:00 clocks were turned backward 1 hour
        // to 2010-11-07T01:00:00-05:00 local standard time instead
        yield ['2010-11-07T00:00:00', 24, '2010-11-07T23:00:00-05:00'];
    }
}
