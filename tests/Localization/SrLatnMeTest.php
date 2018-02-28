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
use Tests\AbstractTestCase;

class SrLatnMeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInLatinSerbianMe()
    {
        Carbon::setLocale('sr_Latn_ME');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('prije 1 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('prije 2 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(3);
            $scope->assertSame('prije 3 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(4);
            $scope->assertSame('prije 4 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(5);
            $scope->assertSame('prije 5 sekundi', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('prije 21 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(22);
            $scope->assertSame('prije 22 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(23);
            $scope->assertSame('prije 23 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(24);
            $scope->assertSame('prije 24 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(31);
            $scope->assertSame('prije 31 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(32);
            $scope->assertSame('prije 32 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(33);
            $scope->assertSame('prije 33 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(34);
            $scope->assertSame('prije 34 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(41);
            $scope->assertSame('prije 41 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(42);
            $scope->assertSame('prije 42 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(43);
            $scope->assertSame('prije 43 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(44);
            $scope->assertSame('prije 44 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(51);
            $scope->assertSame('prije 51 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(52);
            $scope->assertSame('prije 52 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(53);
            $scope->assertSame('prije 53 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(54);
            $scope->assertSame('prije 54 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('prije 1 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('prije 2 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(3);
            $scope->assertSame('prije 3 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(4);
            $scope->assertSame('prije 4 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(5);
            $scope->assertSame('prije 5 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(21);
            $scope->assertSame('prije 21 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(22);
            $scope->assertSame('prije 22 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(23);
            $scope->assertSame('prije 23 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(24);
            $scope->assertSame('prije 24 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(31);
            $scope->assertSame('prije 31 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(32);
            $scope->assertSame('prije 32 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(33);
            $scope->assertSame('prije 33 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(34);
            $scope->assertSame('prije 34 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(41);
            $scope->assertSame('prije 41 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(42);
            $scope->assertSame('prije 42 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(43);
            $scope->assertSame('prije 43 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(44);
            $scope->assertSame('prije 44 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(51);
            $scope->assertSame('prije 51 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(52);
            $scope->assertSame('prije 52 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(53);
            $scope->assertSame('prije 53 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(54);
            $scope->assertSame('prije 54 minuta', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('prije 1 sat', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('prije 2 sata', $d->diffForHumans());

            $d = Carbon::now()->subHours(3);
            $scope->assertSame('prije 3 sata', $d->diffForHumans());

            $d = Carbon::now()->subHours(4);
            $scope->assertSame('prije 4 sata', $d->diffForHumans());

            $d = Carbon::now()->subHours(5);
            $scope->assertSame('prije 5 sati', $d->diffForHumans());

            $d = Carbon::now()->subHours(21);
            $scope->assertSame('prije 21 sat', $d->diffForHumans());

            $d = Carbon::now()->subHours(22);
            $scope->assertSame('prije 22 sata', $d->diffForHumans());

            $d = Carbon::now()->subHours(23);
            $scope->assertSame('prije 23 sata', $d->diffForHumans());

            $d = Carbon::now()->subHours(24);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(31);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(32);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(33);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(34);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(41);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(42);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(43);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(44);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subHours(51);
            $scope->assertSame('prije 2 dana', $d->diffForHumans());

            $d = Carbon::now()->subHours(52);
            $scope->assertSame('prije 2 dana', $d->diffForHumans());

            $d = Carbon::now()->subHours(53);
            $scope->assertSame('prije 2 dana', $d->diffForHumans());

            $d = Carbon::now()->subHours(54);
            $scope->assertSame('prije 2 dana', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('prije 2 dana', $d->diffForHumans());

            $d = Carbon::now()->subDays(3);
            $scope->assertSame('prije 3 dana', $d->diffForHumans());

            $d = Carbon::now()->subDays(4);
            $scope->assertSame('prije 4 dana', $d->diffForHumans());

            $d = Carbon::now()->subDays(5);
            $scope->assertSame('prije 5 dana', $d->diffForHumans());

            $d = Carbon::now()->subDays(21);
            $scope->assertSame('prije 3 nedjelje', $d->diffForHumans());

            $d = Carbon::now()->subDays(22);
            $scope->assertSame('prije 3 nedjelje', $d->diffForHumans());

            $d = Carbon::now()->subDays(23);
            $scope->assertSame('prije 3 nedjelje', $d->diffForHumans());

            $d = Carbon::now()->subDays(24);
            $scope->assertSame('prije 3 nedjelje', $d->diffForHumans());

            $d = Carbon::now()->subDays(31);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(32);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(33);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(34);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(41);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(42);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(43);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(44);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(51);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(52);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(53);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subDays(54);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('prije 1 nedjelju', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('prije 2 nedjelje', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(3);
            $scope->assertSame('prije 3 nedjelje', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(4);
            $scope->assertSame('prije 4 nedjelje', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(5);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(21);
            $scope->assertSame('prije 4 mjeseca', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(22);
            $scope->assertSame('prije 5 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(23);
            $scope->assertSame('prije 5 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(24);
            $scope->assertSame('prije 5 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(31);
            $scope->assertSame('prije 7 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(32);
            $scope->assertSame('prije 7 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(33);
            $scope->assertSame('prije 7 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(34);
            $scope->assertSame('prije 7 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(41);
            $scope->assertSame('prije 9 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(42);
            $scope->assertSame('prije 9 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(43);
            $scope->assertSame('prije 9 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(44);
            $scope->assertSame('prije 10 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(51);
            $scope->assertSame('prije 11 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(52);
            $scope->assertSame('prije 11 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(53);
            $scope->assertSame('prije 1 godinu', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(54);
            $scope->assertSame('prije 1 godinu', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('prije 2 mjeseca', $d->diffForHumans());

            $d = Carbon::now()->subMonths(3);
            $scope->assertSame('prije 3 mjeseca', $d->diffForHumans());

            $d = Carbon::now()->subMonths(4);
            $scope->assertSame('prije 4 mjeseca', $d->diffForHumans());

            $d = Carbon::now()->subMonths(5);
            $scope->assertSame('prije 5 mjeseci', $d->diffForHumans());

            $d = Carbon::now()->subMonths(21);
            $scope->assertSame('prije 1 godinu', $d->diffForHumans());

            $d = Carbon::now()->subMonths(22);
            $scope->assertSame('prije 1 godinu', $d->diffForHumans());

            $d = Carbon::now()->subMonths(23);
            $scope->assertSame('prije 1 godinu', $d->diffForHumans());

            $d = Carbon::now()->subMonths(24);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(31);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(32);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(33);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(34);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(41);
            $scope->assertSame('prije 3 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(42);
            $scope->assertSame('prije 3 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(43);
            $scope->assertSame('prije 3 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(44);
            $scope->assertSame('prije 3 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(51);
            $scope->assertSame('prije 4 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(52);
            $scope->assertSame('prije 4 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(53);
            $scope->assertSame('prije 4 godine', $d->diffForHumans());

            $d = Carbon::now()->subMonths(54);
            $scope->assertSame('prije 4 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('prije 1 godinu', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(3);
            $scope->assertSame('prije 3 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(4);
            $scope->assertSame('prije 4 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(5);
            $scope->assertSame('prije 5 godina', $d->diffForHumans());

            $d = Carbon::now()->subYears(21);
            $scope->assertSame('prije 21 godinu', $d->diffForHumans());

            $d = Carbon::now()->subYears(22);
            $scope->assertSame('prije 22 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(23);
            $scope->assertSame('prije 23 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(24);
            $scope->assertSame('prije 24 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(31);
            $scope->assertSame('prije 31 godinu', $d->diffForHumans());

            $d = Carbon::now()->subYears(32);
            $scope->assertSame('prije 32 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(33);
            $scope->assertSame('prije 33 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(34);
            $scope->assertSame('prije 34 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(41);
            $scope->assertSame('prije 41 godinu', $d->diffForHumans());

            $d = Carbon::now()->subYears(42);
            $scope->assertSame('prije 42 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(43);
            $scope->assertSame('prije 43 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(44);
            $scope->assertSame('prije 44 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(51);
            $scope->assertSame('prije 51 godinu', $d->diffForHumans());

            $d = Carbon::now()->subYears(52);
            $scope->assertSame('prije 52 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(53);
            $scope->assertSame('prije 53 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(54);
            $scope->assertSame('prije 54 godine', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('za 1 sekund', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekund nakon', $d->diffForHumans($d2));
            $scope->assertSame('1 sekund prije', $d2->diffForHumans($d));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekunde', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
