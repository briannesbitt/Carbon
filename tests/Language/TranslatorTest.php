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

namespace Tests\Language;

use Carbon\AbstractTranslator;
use Carbon\Carbon;
use Carbon\Exceptions\ImmutableException;
use Carbon\Exceptions\NotLocaleAwareException;
use Carbon\Translator;
use Carbon\TranslatorImmutable;
use ReflectionMethod;
use Tests\AbstractTestCase;

class TranslatorTest extends AbstractTestCase
{
    public function testSetLocale()
    {
        $currentLocale = setlocale(LC_TIME, '0');
        $currentLocaleAll = setlocale(LC_ALL, '0');

        $translator = new Translator('en_FooBar');
        $translator->setLocale('auto');

        $this->assertSame('en', $translator->getLocale());

        $translator = new Translator('en');
        $translator->setLocale('en_iso');

        $this->assertSame('en_ISO', $translator->getLocale());

        $translator = new Translator('fr');
        if (setlocale(LC_ALL, 'en_US.UTF-8', 'en_US.utf8', 'en_US', 'en_GB', 'en') === false ||
            setlocale(LC_TIME, 'en_US.UTF-8', 'en_US.utf8', 'en_US', 'en_GB', 'en') === false) {
            $this->markTestSkipped('testSetLocale test need en_US.UTF-8.');
        }
        $translator->setLocale('auto');

        $this->assertStringStartsWith('en', $translator->getLocale());

        setlocale(LC_ALL, $currentLocaleAll);
        setlocale(LC_TIME, $currentLocale);
    }

    public function testMethodsPriorities()
    {
        Carbon::setLocale('nl');
        $text = Carbon::parse('2019-08-06')->locale('en')->isoFormat('dddd D MMMM');

        $this->assertSame('Tuesday 6 August', $text);
    }

    public function testCompareChunkLists()
    {
        $method = new ReflectionMethod(AbstractTranslator::class, 'compareChunkLists');
        $this->assertSame(20, $method->invoke(null, ['a', 'b'], ['a', 'b']));
        $this->assertSame(10, $method->invoke(null, ['a', 'b'], ['a', 'c']));
        $this->assertSame(10, $method->invoke(null, ['a'], ['a', 'c']));
        $this->assertSame(11, $method->invoke(null, ['a', 'b'], ['a']));
        $this->assertSame(10, $method->invoke(null, ['a'], ['a']));
    }

    public function testNotLocaleAwareException()
    {
        $exception = new NotLocaleAwareException('foobar');
        $this->assertSame(
            'string does neither implements Symfony\Contracts\Translation\LocaleAwareInterface nor getLocale() method.',
            $exception->getMessage(),
        );
    }

    public function testTranslatorImmutable()
    {
        $this->expectExceptionObject(
            new ImmutableException('setTranslations not allowed on '.TranslatorImmutable::class)
        );
        TranslatorImmutable::get('en')->setTranslations([]);
    }

    public function testSerializationKeepLocale()
    {
        $translator = TranslatorImmutable::get('de');

        $this->assertEquals('de', unserialize(serialize($translator))->getLocale());

        $past = new Carbon('-3 Days');
        $today = new Carbon('today');
        $interval = $today->diffAsCarbonInterval($past);
        $translator = $interval->getLocalTranslator();

        $this->assertEquals('en', unserialize(serialize($translator))->getLocale());

        $past = new Carbon('-3 Days');
        $today = new Carbon('today');
        $interval = $today->locale('zh')->diffAsCarbonInterval($past);
        $translator = $interval->getLocalTranslator();

        $this->assertEquals('zh', unserialize(serialize($translator))->getLocale());
    }

    public function testUnserializeV2Object()
    {
        $interval = unserialize(<<<'EOS'
            O:21:"Carbon\CarbonInterval":22:{s:1:"y";i:0;s:1:"m";i:2;s:1:"d";i:0;s:1:"h";i:0;s:1:"i";i:0;s:1:"s";i:0;s:1:"f";d:5.4E-5;s:6:"invert";i:0;s:4:"days";b:0;s:11:"from_string";b:0;s:9:" * tzName";N;s:7:" * step";N;s:22:" * localMonthsOverflow";N;s:21:" * localYearsOverflow";N;s:25:" * localStrictModeEnabled";N;s:24:" * localHumanDiffOptions";N;s:22:" * localToStringFormat";N;s:18:" * localSerializer";N;s:14:" * localMacros";N;s:21:" * localGenericMacros";N;s:22:" * localFormatFunction";N;s:18:" * localTranslator";N;}
            EOS);

        $this->assertCarbonInterval($interval, 0, 2, 0, 0, 0, 0, 54);
    }
}
