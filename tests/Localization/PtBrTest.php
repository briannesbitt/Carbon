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

class PtBrTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInPtBr()
    {
        Carbon::setLocale('pt_BR');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('há 1 segundo', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('há 2 segundos', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('há 1 minuto', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('há 2 minutos', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('há 1 hora', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('há 2 horas', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('há 1 dia', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('há 2 dias', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('há 1 semana', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('há 2 semanas', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('há 1 mês', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('há 2 meses', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('há 1 ano', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('há 2 anos', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('em 1 segundo', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('após 1 segundo', $d->diffForHumans($d2));
            $scope->assertSame('1 segundo atrás', $d2->diffForHumans($d));

            $scope->assertSame('1 segundo', $d->diffForHumans($d2, true));
            $scope->assertSame('2 segundos', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
