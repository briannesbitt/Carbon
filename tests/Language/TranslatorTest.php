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

use Carbon\Translator;
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
        setlocale(LC_ALL, 'en_US', 'en_GB', 'en');
        setlocale(LC_TIME, 'en_US', 'en_GB', 'en');
        $translator->setLocale('auto');

        $this->assertStringStartsWith('en_US', $translator->getLocale());

        setlocale(LC_ALL, $currentLocaleAll);
        setlocale(LC_TIME, $currentLocale);
    }
}
