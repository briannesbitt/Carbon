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

class EsTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInSpanish()
    {
        Carbon::setLocale('es');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('hace 1 segundo', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(3);
            $scope->assertSame('hace 3 segundos', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('hace 1 minuto', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('hace 2 minutos', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('hace 1 hora', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('hace 2 horas', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('hace 1 día', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('hace 2 días', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('hace 1 semana', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('hace 2 semanas', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('hace 1 mes', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('hace 2 meses', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('hace 1 año', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('hace 2 años', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('dentro de 1 segundo', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 segundo después', $d->diffForHumans($d2));
            $scope->assertSame('1 segundo antes', $d2->diffForHumans($d));

            $scope->assertSame('1 segundo', $d->diffForHumans($d2, true));
            $scope->assertSame('2 segundos', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
