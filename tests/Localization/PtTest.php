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
        });
    }

    public function testDiffForHumansLocalizedInPortugueseBrazil()
    {
        Carbon::setLocale('pt-BR');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('há 1 segundo', $d->diffForHumans());
        });
    }

    public function testDiffForHumansLocalizedInPortugueseBrazilBC()
    {
        Carbon::setLocale('pt_BR');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('há 1 segundo', $d->diffForHumans());
        });
    }
}
