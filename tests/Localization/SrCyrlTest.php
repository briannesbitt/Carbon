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

class SrCyrlTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInCyrillicSerbian()
    {
        Carbon::setLocale('sr_Cyrl');
        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('пре 1 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('пре 2 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(3);
            $scope->assertSame('пре 3 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(4);
            $scope->assertSame('пре 4 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(5);
            $scope->assertSame('пре 5 секунди', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('пре 21 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(22);
            $scope->assertSame('пре 22 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(23);
            $scope->assertSame('пре 23 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(24);
            $scope->assertSame('пре 24 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(31);
            $scope->assertSame('пре 31 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(32);
            $scope->assertSame('пре 32 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(33);
            $scope->assertSame('пре 33 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(34);
            $scope->assertSame('пре 34 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(41);
            $scope->assertSame('пре 41 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(42);
            $scope->assertSame('пре 42 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(43);
            $scope->assertSame('пре 43 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(44);
            $scope->assertSame('пре 44 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(51);
            $scope->assertSame('пре 51 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(52);
            $scope->assertSame('пре 52 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(53);
            $scope->assertSame('пре 53 секунде', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(54);
            $scope->assertSame('пре 54 секунде', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('пре 1 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('пре 2 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(3);
            $scope->assertSame('пре 3 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(4);
            $scope->assertSame('пре 4 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(5);
            $scope->assertSame('пре 5 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(21);
            $scope->assertSame('пре 21 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(22);
            $scope->assertSame('пре 22 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(23);
            $scope->assertSame('пре 23 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(24);
            $scope->assertSame('пре 24 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(31);
            $scope->assertSame('пре 31 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(32);
            $scope->assertSame('пре 32 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(33);
            $scope->assertSame('пре 33 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(34);
            $scope->assertSame('пре 34 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(41);
            $scope->assertSame('пре 41 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(42);
            $scope->assertSame('пре 42 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(43);
            $scope->assertSame('пре 43 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(44);
            $scope->assertSame('пре 44 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(51);
            $scope->assertSame('пре 51 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(52);
            $scope->assertSame('пре 52 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(53);
            $scope->assertSame('пре 53 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(54);
            $scope->assertSame('пре 54 минута', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('пре 1 сат', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('пре 2 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(3);
            $scope->assertSame('пре 3 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(4);
            $scope->assertSame('пре 4 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(5);
            $scope->assertSame('пре 5 сати', $d->diffForHumans());

            $d = Carbon::now()->subHours(21);
            $scope->assertSame('пре 21 сат', $d->diffForHumans());

            $d = Carbon::now()->subHours(22);
            $scope->assertSame('пре 22 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(23);
            $scope->assertSame('пре 23 сата', $d->diffForHumans());

            $d = Carbon::now()->subHours(24);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(31);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(32);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(33);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(34);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(41);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(42);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(43);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(44);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subHours(51);
            $scope->assertSame('пре 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subHours(52);
            $scope->assertSame('пре 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subHours(53);
            $scope->assertSame('пре 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subHours(54);
            $scope->assertSame('пре 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('пре 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('пре 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(3);
            $scope->assertSame('пре 3 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(4);
            $scope->assertSame('пре 4 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(5);
            $scope->assertSame('пре 5 дана', $d->diffForHumans());

            $d = Carbon::now()->subDays(21);
            $scope->assertSame('пре 3 недеље', $d->diffForHumans());

            $d = Carbon::now()->subDays(22);
            $scope->assertSame('пре 3 недеље', $d->diffForHumans());

            $d = Carbon::now()->subDays(23);
            $scope->assertSame('пре 3 недеље', $d->diffForHumans());

            $d = Carbon::now()->subDays(24);
            $scope->assertSame('пре 3 недеље', $d->diffForHumans());

            $d = Carbon::now()->subDays(31);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(32);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(33);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(34);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(41);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(42);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(43);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(44);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(51);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(52);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(53);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subDays(54);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('пре 1 недељу', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('пре 2 недеље', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(3);
            $scope->assertSame('пре 3 недеље', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(4);
            $scope->assertSame('пре 4 недеље', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(5);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(21);
            $scope->assertSame('пре 4 месеца', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(22);
            $scope->assertSame('пре 5 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(23);
            $scope->assertSame('пре 5 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(24);
            $scope->assertSame('пре 5 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(31);
            $scope->assertSame('пре 7 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(32);
            $scope->assertSame('пре 7 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(33);
            $scope->assertSame('пре 7 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(34);
            $scope->assertSame('пре 7 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(41);
            $scope->assertSame('пре 9 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(42);
            $scope->assertSame('пре 9 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(43);
            $scope->assertSame('пре 9 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(44);
            $scope->assertSame('пре 10 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(51);
            $scope->assertSame('пре 11 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(52);
            $scope->assertSame('пре 11 месеци', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(53);
            $scope->assertSame('пре 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(54);
            $scope->assertSame('пре 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('пре 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('пре 2 месеца', $d->diffForHumans());

            $d = Carbon::now()->subMonths(3);
            $scope->assertSame('пре 3 месеца', $d->diffForHumans());

            $d = Carbon::now()->subMonths(4);
            $scope->assertSame('пре 4 месеца', $d->diffForHumans());

            $d = Carbon::now()->subMonths(5);
            $scope->assertSame('пре 5 месеци', $d->diffForHumans());

            $d = Carbon::now()->subMonths(21);
            $scope->assertSame('пре 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subMonths(22);
            $scope->assertSame('пре 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subMonths(23);
            $scope->assertSame('пре 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subMonths(24);
            $scope->assertSame('пре 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(31);
            $scope->assertSame('пре 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(32);
            $scope->assertSame('пре 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(33);
            $scope->assertSame('пре 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(34);
            $scope->assertSame('пре 2 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(41);
            $scope->assertSame('пре 3 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(42);
            $scope->assertSame('пре 3 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(43);
            $scope->assertSame('пре 3 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(44);
            $scope->assertSame('пре 3 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(51);
            $scope->assertSame('пре 4 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(52);
            $scope->assertSame('пре 4 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(53);
            $scope->assertSame('пре 4 године', $d->diffForHumans());

            $d = Carbon::now()->subMonths(54);
            $scope->assertSame('пре 4 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('пре 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('пре 2 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(3);
            $scope->assertSame('пре 3 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(4);
            $scope->assertSame('пре 4 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(5);
            $scope->assertSame('пре 5 година', $d->diffForHumans());

            $d = Carbon::now()->subYears(21);
            $scope->assertSame('пре 21 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(22);
            $scope->assertSame('пре 22 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(23);
            $scope->assertSame('пре 23 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(24);
            $scope->assertSame('пре 24 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(31);
            $scope->assertSame('пре 31 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(32);
            $scope->assertSame('пре 32 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(33);
            $scope->assertSame('пре 33 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(34);
            $scope->assertSame('пре 34 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(41);
            $scope->assertSame('пре 41 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(42);
            $scope->assertSame('пре 42 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(43);
            $scope->assertSame('пре 43 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(44);
            $scope->assertSame('пре 44 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(51);
            $scope->assertSame('пре 51 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(52);
            $scope->assertSame('пре 52 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(53);
            $scope->assertSame('пре 53 године', $d->diffForHumans());

            $d = Carbon::now()->subYears(54);
            $scope->assertSame('пре 54 године', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('за 1 секунд', $d->diffForHumans());
            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 секунд након', $d->diffForHumans($d2));
            $scope->assertSame('1 секунд пре', $d2->diffForHumans($d));
            $scope->assertSame('1 секунд', $d->diffForHumans($d2, true));
            $scope->assertSame('2 секунде', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
