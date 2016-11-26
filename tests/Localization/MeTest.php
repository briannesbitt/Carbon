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

class MeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInMontenegrin()
    {
        Carbon::setLocale('me');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {

            /*
             * Year
             */
            $d = Carbon::now()->addYear();
            $scope->assertSame('za 1 godinu', $d->diffForHumans());
            $scope->assertSame('1 godina', $d->diffForHumans(null, true));
            $scope->assertSame('za 1 g.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 g.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('za 2 godine', $d->diffForHumans());
            $scope->assertSame('2 godine', $d->diffForHumans(null, true));
            $scope->assertSame('za 2 g.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 g.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addYears(5);
            $scope->assertSame('za 5 godina', $d->diffForHumans());
            $scope->assertSame('5 godina', $d->diffForHumans(null, true));
            $scope->assertSame('za 5 g.', $d->diffForHumans(null, false, true));
            $scope->assertSame('5 g.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 godina nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 godine nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYears(5);
            $scope->assertSame('5 godina nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYear();
            $scope->assertSame('1 godina prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('2 godine prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYears(5);
            $scope->assertSame('5 godina prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYear();
            $scope->assertSame('prije 1 godinu', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->subYears(5);
            $scope->assertSame('prije 5 godina', $d->diffForHumans());

            /*
             * Month
             */
            $d = Carbon::now()->addMonth();
            $scope->assertSame('za 1 mjesec', $d->diffForHumans());
            $scope->assertSame('1 mjesec', $d->diffForHumans(null, true));
            $scope->assertSame('za 1 mj.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 mj.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMonths(2);
            $scope->assertSame('za 2 mjeseca', $d->diffForHumans());
            $scope->assertSame('2 mjeseca', $d->diffForHumans(null, true));
            $scope->assertSame('za 2 mj.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 mj.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMonths(5);
            $scope->assertSame('za 5 mjeseci', $d->diffForHumans());
            $scope->assertSame('5 mjeseci', $d->diffForHumans(null, true));
            $scope->assertSame('za 5 mj.', $d->diffForHumans(null, false, true));
            $scope->assertSame('5 mj.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 mjesec nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 mjeseca nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMonths(5);
            $scope->assertSame('5 mjeseci nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMonth();
            $scope->assertSame('1 mjesec prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMonths(2);
            $scope->assertSame('2 mjeseca prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMonths(5);
            $scope->assertSame('5 mjeseci prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMonth();
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('prije 2 mjeseca', $d->diffForHumans());

            $d = Carbon::now()->subMonths(5);
            $scope->assertSame('prije 5 mjeseci', $d->diffForHumans());

            /*
             * Week
             */
            $d = Carbon::now()->addWeek();
            $scope->assertSame('za 1 nedjelju', $d->diffForHumans());
            $scope->assertSame('1 nedjelja', $d->diffForHumans(null, true));
            $scope->assertSame('za 1 ned.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 ned.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addWeeks(2);
            $scope->assertSame('za 2 nedjelje', $d->diffForHumans());
            $scope->assertSame('2 nedjelje', $d->diffForHumans(null, true));
            $scope->assertSame('za 2 ned.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 ned.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 nedjelja nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 nedjelje nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addWeek();
            $scope->assertSame('1 nedjelja prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addWeeks(2);
            $scope->assertSame('2 nedjelje prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subWeek();
            $scope->assertSame('prije 1 nedjelju', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('prije 2 nedjelje', $d->diffForHumans());

            /*
            * Day
            */
            $d = Carbon::now()->addDay();
            $scope->assertSame('za 1 dan', $d->diffForHumans());
            $scope->assertSame('1 dan', $d->diffForHumans(null, true));
            $scope->assertSame('za 1 d.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 d.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addDays(2);
            $scope->assertSame('za 2 dana', $d->diffForHumans());
            $scope->assertSame('2 dana', $d->diffForHumans(null, true));
            $scope->assertSame('za 2 d.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 d.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 dan nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dana nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addDay();
            $scope->assertSame('1 dan prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addDays(2);
            $scope->assertSame('2 dana prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subDay();
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('prije 2 dana', $d->diffForHumans());

            /*
            * Hour
            */
            $d = Carbon::now()->addHour();
            $scope->assertSame('za 1 sat', $d->diffForHumans());
            $scope->assertSame('1 sat', $d->diffForHumans(null, true));
            $scope->assertSame('za 1 č.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 č.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(2);
            $scope->assertSame('za 2 sata', $d->diffForHumans());
            $scope->assertSame('2 sata', $d->diffForHumans(null, true));
            $scope->assertSame('za 2 č.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 č.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(5);
            $scope->assertSame('za 5 sati', $d->diffForHumans());
            $scope->assertSame('5 sati', $d->diffForHumans(null, true));
            $scope->assertSame('za 5 č.', $d->diffForHumans(null, false, true));
            $scope->assertSame('5 č.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(19);
            $scope->assertSame('za 19 sati', $d->diffForHumans());
            $scope->assertSame('19 sati', $d->diffForHumans(null, true));
            $scope->assertSame('za 19 č.', $d->diffForHumans(null, false, true));
            $scope->assertSame('19 č.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(20);
            $scope->assertSame('za 20 sati', $d->diffForHumans());
            $scope->assertSame('20 sati', $d->diffForHumans(null, true));
            $scope->assertSame('za 20 č.', $d->diffForHumans(null, false, true));
            $scope->assertSame('20 č.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(21);
            $scope->assertSame('za 21 sat', $d->diffForHumans());
            $scope->assertSame('21 sat', $d->diffForHumans(null, true));
            $scope->assertSame('za 21 č.', $d->diffForHumans(null, false, true));
            $scope->assertSame('21 č.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(22);
            $scope->assertSame('za 22 sata', $d->diffForHumans());
            $scope->assertSame('22 sata', $d->diffForHumans(null, true));
            $scope->assertSame('za 22 č.', $d->diffForHumans(null, false, true));
            $scope->assertSame('22 č.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(23);
            $scope->assertSame('za 23 sata', $d->diffForHumans());
            $scope->assertSame('23 sata', $d->diffForHumans(null, true));
            $scope->assertSame('za 23 č.', $d->diffForHumans(null, false, true));
            $scope->assertSame('23 č.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 sat nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 sata nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(5);
            $scope->assertSame('5 sati nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(19);
            $scope->assertSame('19 sati nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(20);
            $scope->assertSame('20 sati nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(21);
            $scope->assertSame('21 sat nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(22);
            $scope->assertSame('22 sata nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(23);
            $scope->assertSame('23 sata nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHour();
            $scope->assertSame('1 sat prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(2);
            $scope->assertSame('2 sata prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(5);
            $scope->assertSame('5 sati prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(19);
            $scope->assertSame('19 sati prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(20);
            $scope->assertSame('20 sati prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(21);
            $scope->assertSame('21 sat prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(22);
            $scope->assertSame('22 sata prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(23);
            $scope->assertSame('23 sata prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHour();
            $scope->assertSame('prije 1 sat', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('prije 2 sata', $d->diffForHumans());

            $d = Carbon::now()->subHours(5);
            $scope->assertSame('prije 5 sati', $d->diffForHumans());

            $d = Carbon::now()->subHours(19);
            $scope->assertSame('prije 19 sati', $d->diffForHumans());

            $d = Carbon::now()->subHours(20);
            $scope->assertSame('prije 20 sati', $d->diffForHumans());

            $d = Carbon::now()->subHours(21);
            $scope->assertSame('prije 21 sat', $d->diffForHumans());

            $d = Carbon::now()->subHours(22);
            $scope->assertSame('prije 22 sata', $d->diffForHumans());

            $d = Carbon::now()->subHours(23);
            $scope->assertSame('prije 23 sata', $d->diffForHumans());

            /*
            * Minute
            */
            $d = Carbon::now()->addMinute();
            $scope->assertSame('za 1 minut', $d->diffForHumans());
            $scope->assertSame('1 minut', $d->diffForHumans(null, true));
            $scope->assertSame('za 1 min.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 min.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(2);
            $scope->assertSame('za 2 minuta', $d->diffForHumans());
            $scope->assertSame('2 minuta', $d->diffForHumans(null, true));
            $scope->assertSame('za 2 min.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 min.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(21);
            $scope->assertSame('za 21 minut', $d->diffForHumans());
            $scope->assertSame('21 minut', $d->diffForHumans(null, true));
            $scope->assertSame('za 21 min.', $d->diffForHumans(null, false, true));
            $scope->assertSame('21 min.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(31);
            $scope->assertSame('za 31 minut', $d->diffForHumans());
            $scope->assertSame('31 minut', $d->diffForHumans(null, true));
            $scope->assertSame('za 31 min.', $d->diffForHumans(null, false, true));
            $scope->assertSame('31 min.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(41);
            $scope->assertSame('za 41 minut', $d->diffForHumans());
            $scope->assertSame('41 minut', $d->diffForHumans(null, true));
            $scope->assertSame('za 41 min.', $d->diffForHumans(null, false, true));
            $scope->assertSame('41 min.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(51);
            $scope->assertSame('za 51 minut', $d->diffForHumans());
            $scope->assertSame('51 minut', $d->diffForHumans(null, true));
            $scope->assertSame('za 51 min.', $d->diffForHumans(null, false, true));
            $scope->assertSame('51 min.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 minut nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuta nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(21);
            $scope->assertSame('21 minut nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(31);
            $scope->assertSame('31 minut nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(41);
            $scope->assertSame('41 minut nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(51);
            $scope->assertSame('51 minut nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinute();
            $scope->assertSame('1 minut prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(2);
            $scope->assertSame('2 minuta prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(21);
            $scope->assertSame('21 minut prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(31);
            $scope->assertSame('31 minut prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(41);
            $scope->assertSame('41 minut prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(51);
            $scope->assertSame('51 minut prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinute();
            $scope->assertSame('prije 1 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('prije 2 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(21);
            $scope->assertSame('prije 21 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(31);
            $scope->assertSame('prije 31 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(41);
            $scope->assertSame('prije 41 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(51);
            $scope->assertSame('prije 51 minut', $d->diffForHumans());


            /*
            * Second
            */
            $d = Carbon::now()->addSecond();
            $scope->assertSame('za 1 sekund', $d->diffForHumans());
            $scope->assertSame('1 sekund', $d->diffForHumans(null, true));
            $scope->assertSame('za 1 sek.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 sek.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(2);
            $scope->assertSame('za 2 sekunde', $d->diffForHumans());
            $scope->assertSame('2 sekunde', $d->diffForHumans(null, true));
            $scope->assertSame('za 2 sek.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 sek.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(21);
            $scope->assertSame('za 21 sekund', $d->diffForHumans());
            $scope->assertSame('21 sekund', $d->diffForHumans(null, true));
            $scope->assertSame('za 21 sek.', $d->diffForHumans(null, false, true));
            $scope->assertSame('21 sek.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(31);
            $scope->assertSame('za 31 sekund', $d->diffForHumans());
            $scope->assertSame('31 sekund', $d->diffForHumans(null, true));
            $scope->assertSame('za 31 sek.', $d->diffForHumans(null, false, true));
            $scope->assertSame('31 sek.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(41);
            $scope->assertSame('za 41 sekund', $d->diffForHumans());
            $scope->assertSame('41 sekund', $d->diffForHumans(null, true));
            $scope->assertSame('za 41 sek.', $d->diffForHumans(null, false, true));
            $scope->assertSame('41 sek.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(51);
            $scope->assertSame('za 51 sekund', $d->diffForHumans());
            $scope->assertSame('51 sekund', $d->diffForHumans(null, true));
            $scope->assertSame('za 51 sek.', $d->diffForHumans(null, false, true));
            $scope->assertSame('51 sek.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 sekund nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekunde nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('21 sekund nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(31);
            $scope->assertSame('31 sekund nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(41);
            $scope->assertSame('41 sekund nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(51);
            $scope->assertSame('51 sekund nakon', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 sekund prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(2);
            $scope->assertSame('2 sekunde prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(21);
            $scope->assertSame('21 sekund prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(31);
            $scope->assertSame('31 sekund prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(41);
            $scope->assertSame('41 sekund prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(51);
            $scope->assertSame('51 sekund prije', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSecond();
            $scope->assertSame('prije 1 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('prije 2 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('prije 21 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(31);
            $scope->assertSame('prije 31 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(41);
            $scope->assertSame('prije 41 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(51);
            $scope->assertSame('prije 51 sekund', $d->diffForHumans());
        });
    }
}
