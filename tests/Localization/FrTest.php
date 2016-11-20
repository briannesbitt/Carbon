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

class FrTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInFrench()
    {
        Carbon::setLocale('fr');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('il y a 1 seconde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('il y a 2 secondes', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('il y a 1 minute', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('il y a 2 minutes', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('il y a 1 heure', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('il y a 2 heures', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('il y a 1 jour', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('il y a 2 jours', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('il y a 1 semaine', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('il y a 2 semaines', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('il y a 1 mois', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('il y a 2 mois', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('il y a 1 an', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('il y a 2 ans', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('dans 1 seconde', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 seconde après', $d->diffForHumans($d2));
            $scope->assertSame('1 seconde avant', $d2->diffForHumans($d));

            $scope->assertSame('1 seconde', $d->diffForHumans($d2, true));
            $scope->assertSame('2 secondes', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
