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
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 segundo atrás', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 segundos atrás', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 minuto atrás', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minutos atrás', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 hora atrás', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 horas atrás', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 dia atrás', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dias atrás', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 semana atrás', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 semanas atrás', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 mês atrás', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 meses atrás', $d->diffForHumans());

            $d = Carbon::now()->subYear();
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

    public function testDiffForHumansLocalizedInPortugueseBrazil()
    {
        Carbon::setLocale('pt-BR');
        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('há 1 segundo', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('há 2 segundos', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('há 1 minuto', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('há 2 minutos', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('há 1 hora', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('há 2 horas', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('há 1 dia', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('há 2 dias', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('há 1 semana', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('há 2 semanas', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('há 1 mês', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('há 2 meses', $d->diffForHumans());

            $d = Carbon::now()->subYear();
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

    public function testDiffForHumansLocalizedInPortugueseBrazilBC()
    {
        Carbon::setLocale('pt_BR');
        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('há 1 segundo', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('há 2 segundos', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('há 1 minuto', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('há 2 minutos', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('há 1 hora', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('há 2 horas', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('há 1 dia', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('há 2 dias', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('há 1 semana', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('há 2 semanas', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('há 1 mês', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('há 2 meses', $d->diffForHumans());

            $d = Carbon::now()->subYear();
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
