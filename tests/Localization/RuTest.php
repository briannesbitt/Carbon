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

class RuTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInRussian()
    {
        Carbon::setLocale('ru');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 секунду назад', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 секунды назад', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 минуту назад', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 минуты назад', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 час назад', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 часа назад', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 день назад', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 дня назад', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 неделю назад', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 недели назад', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 месяц назад', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 месяца назад', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 год назад', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 года назад', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('через 1 секунду', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 секунду после', $d->diffForHumans($d2));
            $scope->assertSame('1 секунду до', $d2->diffForHumans($d));

            $scope->assertSame('1 секунду', $d->diffForHumans($d2, true));
            $scope->assertSame('2 секунды', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
