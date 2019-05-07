<?php
declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Factory;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\Factory;
use Carbon\FactoryImmutable;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\MyCarbon;

class FactoryTest extends AbstractTestCase
{
    public function testFactory()
    {
        $factory = new Factory();

        $this->assertInstanceOf(Carbon::class, $factory->parse('2018-01-01'));
        $this->assertSame('01/01/2018', $factory->parse('2018-01-01')->format('d/m/Y'));

        $factory = new Factory([
            'locale' => 'fr',
        ]);

        $this->assertSame('fr', $factory->parse('2018-01-01')->locale);

        $factory = new Factory([
            'locale' => 'fr',
        ], MyCarbon::class);

        $this->assertInstanceOf(MyCarbon::class, $factory->parse('2018-01-01'));
        $this->assertSame('01/01/2018', $factory->parse('2018-01-01')->format('d/m/Y'));

        $factory = new FactoryImmutable([
            'locale' => 'fr',
        ]);

        $this->assertInstanceOf(CarbonImmutable::class, $factory->parse('2018-01-01'));
        $this->assertSame('01/01/2018', $factory->parse('2018-01-01')->format('d/m/Y'));
    }

    public function testFactoryModification()
    {
        $factory = new Factory();

        $this->assertSame(Carbon::class, $factory->className());
        $this->assertSame($factory, $factory->className(MyCarbon::class));
        $this->assertSame(MyCarbon::class, $factory->className());

        $this->assertSame([], $factory->settings());
        $this->assertSame($factory, $factory->settings([
            'locale' => 'fr',
        ]));
        $this->assertSame([
            'locale' => 'fr',
        ], $factory->settings());

        $this->assertSame($factory, $factory->mergeSettings([
            'timezone' => 'Europe/Paris',
        ]));
        $this->assertSame([
            'locale' => 'fr',
            'timezone' => 'Europe/Paris',
        ], $factory->settings());

        $this->assertSame($factory, $factory->settings([
            'timezone' => 'Europe/Paris',
        ]));
        $this->assertSame([
            'timezone' => 'Europe/Paris',
        ], $factory->settings());
    }
}
