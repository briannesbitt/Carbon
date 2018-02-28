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

class PtTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInPortuguese()
    {
        Carbon::setLocale('pt');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 segundo atrás', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 segundos atrás', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minuto atrás', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minutos atrás', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 hora atrás', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 horas atrás', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 dia atrás', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dias atrás', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 semana atrás', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 semanas atrás', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 mês atrás', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 meses atrás', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 ano atrás', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 anos atrás', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('em 1 segundo', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 segundo depois', $d->diffForHumans($d2));
            $scope->assertSame('1 segundo antes', $d2->diffForHumans($d));

            $scope->assertSame('1 segundo', $d->diffForHumans($d2, true));
            $scope->assertSame('2 segundos', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
