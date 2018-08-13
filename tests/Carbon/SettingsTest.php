<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class SettingsTest extends AbstractTestCase
{
    public function testSettings()
    {
        $paris = Carbon::parse('2018-01-31')->settings([
            'timezone' => 'Europe/Paris',
            'locale' => 'fr_FR',
            'monthOverflow' => true,
            'yearOverflow' => true,
        ]);
        $chicago = Carbon::parse('2018-01-31')->settings([
            'timezone' => 'America/Sao_Paulo',
            'locale' => 'pt',
            'monthOverflow' => false,
            'yearOverflow' => false,
        ]);

        $this->assertSame('un jour 19 heures avant', $paris->addMonth()->from(Carbon::parse('2018-03-05', 'UTC'), null, false, 3));
        $this->assertSame('4 dias 18 horas antes', $chicago->addMonth()->from(Carbon::parse('2018-03-05', 'UTC'), null, false, 3));
    }
}
