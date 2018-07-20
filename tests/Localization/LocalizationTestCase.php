<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Tests\AbstractTestCase;

abstract class LocalizationTestCase extends AbstractTestCase
{
    const LOCALE = 'en';
    const TESTS = [
        '{class}::parse(\'2018-01-02 00:00:00\')->addDays(2)->calendar()',
        '{class}::now()->subSeconds(1)->diffForHumans()',
        '{class}::now()->subSeconds(1)->diffForHumans(null, false, true)',
        '{class}::now()->subSeconds(2)->diffForHumans()',
        '{class}::now()->subSeconds(2)->diffForHumans(null, false, true)',
        '{class}::now()->subMinutes(1)->diffForHumans()',
        '{class}::now()->subMinutes(1)->diffForHumans(null, false, true)',
        '{class}::now()->subMinutes(2)->diffForHumans()',
        '{class}::now()->subMinutes(2)->diffForHumans(null, false, true)',
        '{class}::now()->subHours(1)->diffForHumans()',
        '{class}::now()->subHours(1)->diffForHumans(null, false, true)',
        '{class}::now()->subHours(2)->diffForHumans()',
        '{class}::now()->subHours(2)->diffForHumans(null, false, true)',
        '{class}::now()->subDays(1)->diffForHumans()',
        '{class}::now()->subDays(1)->diffForHumans(null, false, true)',
        '{class}::now()->subDays(2)->diffForHumans()',
        '{class}::now()->subDays(2)->diffForHumans(null, false, true)',
        '{class}::now()->subWeeks(1)->diffForHumans()',
        '{class}::now()->subWeeks(1)->diffForHumans(null, false, true)',
        '{class}::now()->subWeeks(2)->diffForHumans()',
        '{class}::now()->subWeeks(2)->diffForHumans(null, false, true)',
        '{class}::now()->subMonths(1)->diffForHumans()',
        '{class}::now()->subMonths(1)->diffForHumans(null, false, true)',
        '{class}::now()->subMonths(2)->diffForHumans()',
        '{class}::now()->subMonths(2)->diffForHumans(null, false, true)',
        '{class}::now()->subYears(1)->diffForHumans()',
        '{class}::now()->subYears(1)->diffForHumans(null, false, true)',
        '{class}::now()->subYears(2)->diffForHumans()',
        '{class}::now()->subYears(2)->diffForHumans(null, false, true)',
        '{class}::now()->addSecond()->diffForHumans()',
        '{class}::now()->addSecond()->diffForHumans(null, false, true)',
        '{class}::now()->addSecond()->diffForHumans(Carbon::now())',
        '{class}::now()->addSecond()->diffForHumans(Carbon::now(), false, true)',
        '{class}::now()->diffForHumans(Carbon::now()->addSecond())',
        '{class}::now()->diffForHumans(Carbon::now()->addSecond(), false, true)',
        '{class}::now()->addSecond()->diffForHumans(Carbon::now(), true)',
        '{class}::now()->addSecond()->diffForHumans(Carbon::now(), true, true)',
        '{class}::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)',
        '{class}::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)',
        '{class}::now()->addSecond()->diffForHumans(null, false, true, 1)',
        '{class}::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)',
        '{class}::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)',
        '{class}::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)',
        '{class}::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)',
        '{class}::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)',
        '{class}::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)',
    ];
    const CASES = [];

    protected function setUp()
    {
        parent::setUp();
        Carbon::setLocale(static::LOCALE);
    }

    /**
     * @group i
     */
    public function testLanguage()
    {
        $this->wrapWithNonDstDate(function () {
            foreach (static::TESTS as $index => $test) {
                foreach ([Carbon::class, CarbonImmutable::class] as $class) {
                    $test = str_replace('{class}', $class, $test);
                    $result = eval("return $test;");
                    $expected = static::CASES[$index];

                    $this->assertSame($expected, $result, 'In '.static::LOCALE.', '.$test.' should return '.$expected);
                }
            }
        });
    }
}
