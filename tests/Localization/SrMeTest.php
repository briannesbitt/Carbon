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

class SrMeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInMontenegrinLatin()
    {
        Carbon::setLocale('sr-ME');
        $this->diffForHumansLocalizedInMontenegrinLatin();

        Carbon::setLocale('sr-Latn-ME');
        $this->diffForHumansLocalizedInMontenegrinLatin();
    }

    protected function DiffForHumansLocalizedInMontenegrinLatin()
    {
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

    public function testDiffForHumansLocalizedInMontenegrinCyrilic()
    {
        Carbon::setLocale('sr-Cyrl-ME');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {

            /*
             * Year
             */
            $d = Carbon::now()->addYear();
            $scope->assertSame('за 1 годину', $d->diffForHumans());
            $scope->assertSame('1 година', $d->diffForHumans(null, true));
            $scope->assertSame('за 1 г.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 г.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('за 2 године', $d->diffForHumans());
            $scope->assertSame('2 године', $d->diffForHumans(null, true));
            $scope->assertSame('за 2 г.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 г.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addYears(5);
            $scope->assertSame('за 5 година', $d->diffForHumans());
            $scope->assertSame('5 година', $d->diffForHumans(null, true));
            $scope->assertSame('за 5 г.', $d->diffForHumans(null, false, true));
            $scope->assertSame('5 г.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 година након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 године након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYears(5);
            $scope->assertSame('5 година након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYear();
            $scope->assertSame('1 година прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('2 године прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYears(5);
            $scope->assertSame('5 година прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYear();
            $scope->assertSame('прије 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('прије 2 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(5);
            $scope->assertSame('прије 5 година', $d->diffForHumans());

            /*
             * Month
             */
            $d = Carbon::now()->addMonth();
            $scope->assertSame('за 1 мјесец', $d->diffForHumans());
            $scope->assertSame('1 мјесец', $d->diffForHumans(null, true));
            $scope->assertSame('за 1 мј.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 мј.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMonths(2);
            $scope->assertSame('за 2 мјесеца', $d->diffForHumans());
            $scope->assertSame('2 мјесеца', $d->diffForHumans(null, true));
            $scope->assertSame('за 2 мј.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 мј.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMonths(5);
            $scope->assertSame('за 5 мјесеци', $d->diffForHumans());
            $scope->assertSame('5 мјесеци', $d->diffForHumans(null, true));
            $scope->assertSame('за 5 мј.', $d->diffForHumans(null, false, true));
            $scope->assertSame('5 мј.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 мјесец након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 мјесеца након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMonths(5);
            $scope->assertSame('5 мјесеци након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMonth();
            $scope->assertSame('1 мјесец прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMonths(2);
            $scope->assertSame('2 мјесеца прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMonths(5);
            $scope->assertSame('5 мјесеци прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMonth();
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('прије 2 мјесеца', $d->diffForHumans());

            $d = Carbon::now()->subMonths(5);
            $scope->assertSame('прије 5 мјесеци', $d->diffForHumans());

            /*
             * Week
             */
            $d = Carbon::now()->addWeek();
            $scope->assertSame('за 1 недјељу', $d->diffForHumans());
            $scope->assertSame('1 недјеља', $d->diffForHumans(null, true));
            $scope->assertSame('за 1 нед.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 нед.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addWeeks(2);
            $scope->assertSame('за 2 недјеље', $d->diffForHumans());
            $scope->assertSame('2 недјеље', $d->diffForHumans(null, true));
            $scope->assertSame('за 2 нед.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 нед.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 недјеља након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 недјеље након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addWeek();
            $scope->assertSame('1 недјеља прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addWeeks(2);
            $scope->assertSame('2 недјеље прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subWeek();
            $scope->assertSame('прије 1 недјељу', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('прије 2 недјеље', $d->diffForHumans());

            /*
            * Day
            */
            $d = Carbon::now()->addDay();
            $scope->assertSame('за 1 дан', $d->diffForHumans());
            $scope->assertSame('1 дан', $d->diffForHumans(null, true));
            $scope->assertSame('за 1 д.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 д.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addDays(2);
            $scope->assertSame('за 2 дана', $d->diffForHumans());
            $scope->assertSame('2 дана', $d->diffForHumans(null, true));
            $scope->assertSame('за 2 д.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 д.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 дан након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 дана након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addDay();
            $scope->assertSame('1 дан прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addDays(2);
            $scope->assertSame('2 дана прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subDay();
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('прије 2 дана', $d->diffForHumans());

            /*
            * Hour
            */
            $d = Carbon::now()->addHour();
            $scope->assertSame('за 1 сат', $d->diffForHumans());
            $scope->assertSame('1 сат', $d->diffForHumans(null, true));
            $scope->assertSame('за 1 ч.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 ч.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(2);
            $scope->assertSame('за 2 сата', $d->diffForHumans());
            $scope->assertSame('2 сата', $d->diffForHumans(null, true));
            $scope->assertSame('за 2 ч.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 ч.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(5);
            $scope->assertSame('за 5 сати', $d->diffForHumans());
            $scope->assertSame('5 сати', $d->diffForHumans(null, true));
            $scope->assertSame('за 5 ч.', $d->diffForHumans(null, false, true));
            $scope->assertSame('5 ч.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(19);
            $scope->assertSame('за 19 сати', $d->diffForHumans());
            $scope->assertSame('19 сати', $d->diffForHumans(null, true));
            $scope->assertSame('за 19 ч.', $d->diffForHumans(null, false, true));
            $scope->assertSame('19 ч.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(20);
            $scope->assertSame('за 20 сати', $d->diffForHumans());
            $scope->assertSame('20 сати', $d->diffForHumans(null, true));
            $scope->assertSame('за 20 ч.', $d->diffForHumans(null, false, true));
            $scope->assertSame('20 ч.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(21);
            $scope->assertSame('за 21 сат', $d->diffForHumans());
            $scope->assertSame('21 сат', $d->diffForHumans(null, true));
            $scope->assertSame('за 21 ч.', $d->diffForHumans(null, false, true));
            $scope->assertSame('21 ч.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(22);
            $scope->assertSame('за 22 сата', $d->diffForHumans());
            $scope->assertSame('22 сата', $d->diffForHumans(null, true));
            $scope->assertSame('за 22 ч.', $d->diffForHumans(null, false, true));
            $scope->assertSame('22 ч.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addHours(23);
            $scope->assertSame('за 23 сата', $d->diffForHumans());
            $scope->assertSame('23 сата', $d->diffForHumans(null, true));
            $scope->assertSame('за 23 ч.', $d->diffForHumans(null, false, true));
            $scope->assertSame('23 ч.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 сат након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 сата након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(5);
            $scope->assertSame('5 сати након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(19);
            $scope->assertSame('19 сати након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(20);
            $scope->assertSame('20 сати након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(21);
            $scope->assertSame('21 сат након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(22);
            $scope->assertSame('22 сата након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHours(23);
            $scope->assertSame('23 сата након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHour();
            $scope->assertSame('1 сат прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(2);
            $scope->assertSame('2 сата прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(5);
            $scope->assertSame('5 сати прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(19);
            $scope->assertSame('19 сати прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(20);
            $scope->assertSame('20 сати прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(21);
            $scope->assertSame('21 сат прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(22);
            $scope->assertSame('22 сата прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addHours(23);
            $scope->assertSame('23 сата прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subHour();
            $scope->assertSame('прије 1 сат', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('прије 2 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(5);
            $scope->assertSame('прије 5 сати', $d->diffForHumans());

            $d = Carbon::now()->subHours(19);
            $scope->assertSame('прије 19 сати', $d->diffForHumans());

            $d = Carbon::now()->subHours(20);
            $scope->assertSame('прије 20 сати', $d->diffForHumans());

            $d = Carbon::now()->subHours(21);
            $scope->assertSame('прије 21 сат', $d->diffForHumans());

            $d = Carbon::now()->subHours(22);
            $scope->assertSame('прије 22 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(23);
            $scope->assertSame('прије 23 сата', $d->diffForHumans());

            /*
            * Minute
            */
            $d = Carbon::now()->addMinute();
            $scope->assertSame('за 1 минут', $d->diffForHumans());
            $scope->assertSame('1 минут', $d->diffForHumans(null, true));
            $scope->assertSame('за 1 мин.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 мин.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(2);
            $scope->assertSame('за 2 минута', $d->diffForHumans());
            $scope->assertSame('2 минута', $d->diffForHumans(null, true));
            $scope->assertSame('за 2 мин.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 мин.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(21);
            $scope->assertSame('за 21 минут', $d->diffForHumans());
            $scope->assertSame('21 минут', $d->diffForHumans(null, true));
            $scope->assertSame('за 21 мин.', $d->diffForHumans(null, false, true));
            $scope->assertSame('21 мин.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(31);
            $scope->assertSame('за 31 минут', $d->diffForHumans());
            $scope->assertSame('31 минут', $d->diffForHumans(null, true));
            $scope->assertSame('за 31 мин.', $d->diffForHumans(null, false, true));
            $scope->assertSame('31 мин.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(41);
            $scope->assertSame('за 41 минут', $d->diffForHumans());
            $scope->assertSame('41 минут', $d->diffForHumans(null, true));
            $scope->assertSame('за 41 мин.', $d->diffForHumans(null, false, true));
            $scope->assertSame('41 мин.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addMinutes(51);
            $scope->assertSame('за 51 минут', $d->diffForHumans());
            $scope->assertSame('51 минут', $d->diffForHumans(null, true));
            $scope->assertSame('за 51 мин.', $d->diffForHumans(null, false, true));
            $scope->assertSame('51 мин.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 минут након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 минута након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(21);
            $scope->assertSame('21 минут након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(31);
            $scope->assertSame('31 минут након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(41);
            $scope->assertSame('41 минут након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinutes(51);
            $scope->assertSame('51 минут након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinute();
            $scope->assertSame('1 минут прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(2);
            $scope->assertSame('2 минута прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(21);
            $scope->assertSame('21 минут прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(31);
            $scope->assertSame('31 минут прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(41);
            $scope->assertSame('41 минут прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addMinutes(51);
            $scope->assertSame('51 минут прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subMinute();
            $scope->assertSame('прије 1 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('прије 2 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(21);
            $scope->assertSame('прије 21 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(31);
            $scope->assertSame('прије 31 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(41);
            $scope->assertSame('прије 41 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(51);
            $scope->assertSame('прије 51 минут', $d->diffForHumans());

            /*
            * Second
            */
            $d = Carbon::now()->addSecond();
            $scope->assertSame('за 1 секунд', $d->diffForHumans());
            $scope->assertSame('1 секунд', $d->diffForHumans(null, true));
            $scope->assertSame('за 1 сек.', $d->diffForHumans(null, false, true));
            $scope->assertSame('1 сек.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(2);
            $scope->assertSame('за 2 секунде', $d->diffForHumans());
            $scope->assertSame('2 секунде', $d->diffForHumans(null, true));
            $scope->assertSame('за 2 сек.', $d->diffForHumans(null, false, true));
            $scope->assertSame('2 сек.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(21);
            $scope->assertSame('за 21 секунд', $d->diffForHumans());
            $scope->assertSame('21 секунд', $d->diffForHumans(null, true));
            $scope->assertSame('за 21 сек.', $d->diffForHumans(null, false, true));
            $scope->assertSame('21 сек.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(31);
            $scope->assertSame('за 31 секунд', $d->diffForHumans());
            $scope->assertSame('31 секунд', $d->diffForHumans(null, true));
            $scope->assertSame('за 31 сек.', $d->diffForHumans(null, false, true));
            $scope->assertSame('31 сек.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(41);
            $scope->assertSame('за 41 секунд', $d->diffForHumans());
            $scope->assertSame('41 секунд', $d->diffForHumans(null, true));
            $scope->assertSame('за 41 сек.', $d->diffForHumans(null, false, true));
            $scope->assertSame('41 сек.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addSeconds(51);
            $scope->assertSame('за 51 секунд', $d->diffForHumans());
            $scope->assertSame('51 секунд', $d->diffForHumans(null, true));
            $scope->assertSame('за 51 сек.', $d->diffForHumans(null, false, true));
            $scope->assertSame('51 сек.', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 секунд након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 секунде након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('21 секунд након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(31);
            $scope->assertSame('31 секунд након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(41);
            $scope->assertSame('41 секунд након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSeconds(51);
            $scope->assertSame('51 секунд након', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 секунд прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(2);
            $scope->assertSame('2 секунде прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(21);
            $scope->assertSame('21 секунд прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(31);
            $scope->assertSame('31 секунд прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(41);
            $scope->assertSame('41 секунд прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addSeconds(51);
            $scope->assertSame('51 секунд прије', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subSecond();
            $scope->assertSame('прије 1 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('прије 2 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('прије 21 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(31);
            $scope->assertSame('прије 31 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(41);
            $scope->assertSame('прије 41 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(51);
            $scope->assertSame('прије 51 секунд', $d->diffForHumans());
        });
    }
}
