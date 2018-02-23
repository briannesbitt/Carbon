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

class SrCyrlMeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInCyrillicSerbianMe()
    {
        Carbon::setLocale('sr_Cyrl_ME');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('прије 1 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('прије 2 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(3);
            $scope->assertSame('прије 3 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(4);
            $scope->assertSame('прије 4 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(5);
            $scope->assertSame('прије 5 секунди', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('прије 21 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(22);
            $scope->assertSame('прије 22 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(23);
            $scope->assertSame('прије 23 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(24);
            $scope->assertSame('прије 24 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(31);
            $scope->assertSame('прије 31 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(32);
            $scope->assertSame('прије 32 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(33);
            $scope->assertSame('прије 33 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(34);
            $scope->assertSame('прије 34 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(41);
            $scope->assertSame('прије 41 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(42);
            $scope->assertSame('прије 42 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(43);
            $scope->assertSame('прије 43 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(44);
            $scope->assertSame('прије 44 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(51);
            $scope->assertSame('прије 51 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(52);
            $scope->assertSame('прије 52 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(53);
            $scope->assertSame('прије 53 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(54);
            $scope->assertSame('прије 54 секунде', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('прије 1 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('прије 2 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(3);
            $scope->assertSame('прије 3 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(4);
            $scope->assertSame('прије 4 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(5);
            $scope->assertSame('прије 5 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(21);
            $scope->assertSame('прије 21 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(22);
            $scope->assertSame('прије 22 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(23);
            $scope->assertSame('прије 23 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(24);
            $scope->assertSame('прије 24 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(31);
            $scope->assertSame('прије 31 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(32);
            $scope->assertSame('прије 32 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(33);
            $scope->assertSame('прије 33 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(34);
            $scope->assertSame('прије 34 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(41);
            $scope->assertSame('прије 41 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(42);
            $scope->assertSame('прије 42 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(43);
            $scope->assertSame('прије 43 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(44);
            $scope->assertSame('прије 44 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(51);
            $scope->assertSame('прије 51 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(52);
            $scope->assertSame('прије 52 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(53);
            $scope->assertSame('прије 53 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(54);
            $scope->assertSame('прије 54 минута', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('прије 1 сат', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('прије 2 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(3);
            $scope->assertSame('прије 3 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(4);
            $scope->assertSame('прије 4 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(5);
            $scope->assertSame('прије 5 сати', $d->diffForHumans());

            $d = Carbon::now()->subHours(21);
            $scope->assertSame('прије 21 сат', $d->diffForHumans());

            $d = Carbon::now()->subHours(22);
            $scope->assertSame('прије 22 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(23);
            $scope->assertSame('прије 23 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(24);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(31);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(32);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(33);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(34);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(41);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(42);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(43);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(44);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(51);
            $scope->assertSame('прије 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subHours(52);
            $scope->assertSame('прије 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subHours(53);
            $scope->assertSame('прије 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subHours(54);
            $scope->assertSame('прије 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('прије 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(3);
            $scope->assertSame('прије 3 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(4);
            $scope->assertSame('прије 4 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(5);
            $scope->assertSame('прије 5 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(21);
            $scope->assertSame('прије 3 недјеље', $d->diffForHumans());

            $d = Carbon::now()->subDays(22);
            $scope->assertSame('прије 3 недјеље', $d->diffForHumans());

            $d = Carbon::now()->subDays(23);
            $scope->assertSame('прије 3 недјеље', $d->diffForHumans());

            $d = Carbon::now()->subDays(24);
            $scope->assertSame('прије 3 недјеље', $d->diffForHumans());

            $d = Carbon::now()->subDays(31);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(32);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(33);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(34);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(41);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(42);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(43);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(44);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(51);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(52);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(53);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subDays(54);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('прије 1 недјељу', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('прије 2 недјеље', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(3);
            $scope->assertSame('прије 3 недјеље', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(4);
            $scope->assertSame('прије 4 недјеље', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(5);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(21);
            $scope->assertSame('прије 4 мјесеца', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(22);
            $scope->assertSame('прије 5 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(23);
            $scope->assertSame('прије 5 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(24);
            $scope->assertSame('прије 5 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(31);
            $scope->assertSame('прије 7 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(32);
            $scope->assertSame('прије 7 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(33);
            $scope->assertSame('прије 7 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(34);
            $scope->assertSame('прије 7 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(41);
            $scope->assertSame('прије 9 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(42);
            $scope->assertSame('прије 9 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(43);
            $scope->assertSame('прије 9 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(44);
            $scope->assertSame('прије 10 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(51);
            $scope->assertSame('прије 11 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(52);
            $scope->assertSame('прије 11 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(53);
            $scope->assertSame('прије 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(54);
            $scope->assertSame('прије 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('прије 2 мјесеца', $d->diffForHumans());

            $d = Carbon::now()->subMonths(3);
            $scope->assertSame('прије 3 мјесеца', $d->diffForHumans());

            $d = Carbon::now()->subMonths(4);
            $scope->assertSame('прије 4 мјесеца', $d->diffForHumans());

            $d = Carbon::now()->subMonths(5);
            $scope->assertSame('прије 5 мјесеци', $d->diffForHumans());

            $d = Carbon::now()->subMonths(21);
            $scope->assertSame('прије 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subMonths(22);
            $scope->assertSame('прије 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subMonths(23);
            $scope->assertSame('прије 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subMonths(24);
            $scope->assertSame('прије 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(31);
            $scope->assertSame('прије 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(32);
            $scope->assertSame('прије 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(33);
            $scope->assertSame('прије 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(34);
            $scope->assertSame('прије 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(41);
            $scope->assertSame('прије 3 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(42);
            $scope->assertSame('прије 3 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(43);
            $scope->assertSame('прије 3 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(44);
            $scope->assertSame('прије 3 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(51);
            $scope->assertSame('прије 4 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(52);
            $scope->assertSame('прије 4 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(53);
            $scope->assertSame('прије 4 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(54);
            $scope->assertSame('прије 4 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('прије 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('прије 2 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(3);
            $scope->assertSame('прије 3 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(4);
            $scope->assertSame('прије 4 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(5);
            $scope->assertSame('прије 5 година', $d->diffForHumans());

            $d = Carbon::now()->subYears(21);
            $scope->assertSame('прије 21 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(22);
            $scope->assertSame('прије 22 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(23);
            $scope->assertSame('прије 23 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(24);
            $scope->assertSame('прије 24 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(31);
            $scope->assertSame('прије 31 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(32);
            $scope->assertSame('прије 32 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(33);
            $scope->assertSame('прије 33 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(34);
            $scope->assertSame('прије 34 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(41);
            $scope->assertSame('прије 41 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(42);
            $scope->assertSame('прије 42 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(43);
            $scope->assertSame('прије 43 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(44);
            $scope->assertSame('прије 44 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(51);
            $scope->assertSame('прије 51 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(52);
            $scope->assertSame('прије 52 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(53);
            $scope->assertSame('прије 53 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(54);
            $scope->assertSame('прије 54 године', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('за 1 секунд', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 секунд након', $d->diffForHumans($d2));
            $scope->assertSame('1 секунд прије', $d2->diffForHumans($d));

            $scope->assertSame('1 секунд', $d->diffForHumans($d2, true));
            $scope->assertSame('2 секунде', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
