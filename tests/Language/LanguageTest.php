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

use Carbon\Language;
use Tests\AbstractTestCase;

class LanguageTest extends AbstractTestCase
{
    public function testAll(): void
    {
        $all = Language::all();
        $this->assertIsArray($all);
        $this->assertArrayHasKey('en', $all);
        $this->assertIsArray($all['en']);
        $this->assertArrayHasKey('isoName', $all['en']);
        $this->assertSame('English', $all['en']['isoName']);
    }

    public function testRegions(): void
    {
        $regions = Language::regions();
        $this->assertIsArray($regions);
        $this->assertArrayHasKey('US', $regions);
        $this->assertSame('United States of America', $regions['US']);
    }

    public function testGetNames(): void
    {
        $ar = new Language('ar');
        $this->assertSame([
            'isoName' => 'Arabic',
            'nativeName' => 'العربية',
        ], $ar->getNames());
    }

    public function testGetId(): void
    {
        $ar = new Language('ar');
        $this->assertSame('ar', $ar->getId());
        $ar = new Language('ar_DZ');
        $this->assertSame('ar_DZ', $ar->getId());
        $ar = new Language('ar_Shakl');
        $this->assertSame('ar_Shakl', $ar->getId());
    }

    public function testGetCode(): void
    {
        $ar = new Language('ar');
        $this->assertSame('ar', $ar->getCode());
        $ar = new Language('ar_DZ');
        $this->assertSame('ar', $ar->getCode());
        $ar = new Language('ar_Shakl');
        $this->assertSame('ar', $ar->getCode());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('sr', $sr->getCode());
    }

    public function testGetVariant(): void
    {
        $ar = new Language('ar');
        $this->assertNull($ar->getVariant());
        $ar = new Language('ar_DZ');
        $this->assertNull($ar->getVariant());
        $ar = new Language('ar_Shakl');
        $this->assertSame('Shakl', $ar->getVariant());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Cyrl', $sr->getVariant());
    }

    public function testGetRegion(): void
    {
        $ar = new Language('ar');
        $this->assertNull($ar->getRegion());
        $ar = new Language('ar_DZ');
        $this->assertSame('DZ', $ar->getRegion());
        $ar = new Language('ar_Shakl');
        $this->assertNull($ar->getRegion());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('ME', $sr->getRegion());
    }

    public function testGetRegionName(): void
    {
        $ar = new Language('ar');
        $this->assertNull($ar->getRegionName());
        $ar = new Language('ar_DZ');
        $this->assertSame('Algeria', $ar->getRegionName());
        $ar = new Language('ar_Shakl');
        $this->assertNull($ar->getRegionName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Montenegro', $sr->getRegionName());
    }

    public function testGetFullIsoName(): void
    {
        $ar = new Language('ca');
        $this->assertSame('Catalan, Valencian', $ar->getFullIsoName());
        $this->assertSame('Catalan, Valencian', $ar->getFullIsoName());
        $ar = new Language('ar_DZ');
        $this->assertSame('Arabic', $ar->getFullIsoName());
        $gom = new Language('gom_Latn');
        $this->assertSame('Konkani, Goan', $gom->getFullIsoName());
        $foo = new Language('foo_Latn');
        $this->assertSame('foo', $foo->getFullIsoName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Serbian', $sr->getFullIsoName());
    }

    public function testGetFullNativeName(): void
    {
        $ar = new Language('ca');
        $this->assertSame('català, valencià', $ar->getFullNativeName());
        $this->assertSame('català, valencià', $ar->getFullNativeName());
        $ar = new Language('ar_DZ');
        $this->assertSame('العربية', $ar->getFullNativeName());
        $gom = new Language('gom_Latn');
        $this->assertSame('ಕೊಂಕಣಿ', $gom->getFullNativeName());
        $foo = new Language('foo_Latn');
        $this->assertSame('foo', $foo->getFullNativeName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('српски језик', $sr->getFullNativeName());
    }

    public function testGetIsoName(): void
    {
        $ar = new Language('ca');
        $this->assertSame('Catalan', $ar->getIsoName());
        $this->assertSame('Catalan', $ar->getIsoName());
        $ar = new Language('ar_DZ');
        $this->assertSame('Arabic', $ar->getIsoName());
        $gom = new Language('gom_Latn');
        $this->assertSame('Konkani', $gom->getIsoName());
        $foo = new Language('foo_Latn');
        $this->assertSame('foo', $foo->getIsoName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Serbian', $sr->getIsoName());
    }

    public function testGetNativeName(): void
    {
        $ar = new Language('ca');
        $this->assertSame('català', $ar->getNativeName());
        $this->assertSame('català', $ar->getNativeName());
        $ar = new Language('ar_DZ');
        $this->assertSame('العربية', $ar->getNativeName());
        $gom = new Language('gom_Latn');
        $this->assertSame('ಕೊಂಕಣಿ', $gom->getNativeName());
        $foo = new Language('foo_Latn');
        $this->assertSame('foo', $foo->getNativeName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('српски језик', $sr->getNativeName());
    }

    public function testGetIsoDescription(): void
    {
        $ar = new Language('ca');
        $this->assertSame('Catalan', $ar->getIsoDescription());
        $this->assertSame('Catalan', $ar->getIsoDescription());
        $ar = new Language('ar_DZ');
        $this->assertSame('Arabic (Algeria)', $ar->getIsoDescription());
        $gom = new Language('gom_Latn');
        $this->assertSame('Konkani (Latin)', $gom->getIsoDescription());
        $foo = new Language('foo_Latn');
        $this->assertSame('foo (Latin)', $foo->getIsoDescription());
        $foo->setNativeName('Foobar, Barbiz');
        $this->assertSame('foo (Latin)', $foo->getIsoDescription());
        $foo->setIsoName('Foobar, Barbiz');
        $this->assertSame('Foobar (Latin)', $foo->getIsoDescription());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Serbian (Montenegro) (Cyrillic)', $sr->getIsoDescription());
    }

    public function testGetNativeDescription(): void
    {
        $ar = new Language('ca');
        $this->assertSame('català', $ar->getNativeDescription());
        $this->assertSame('català', $ar->getNativeDescription());
        $ar = new Language('ar_DZ');
        $this->assertSame('العربية (Algeria)', $ar->getNativeDescription());
        $gom = new Language('gom_Latn');
        $this->assertSame('ಕೊಂಕಣಿ (Latin)', $gom->getNativeDescription());
        $foo = new Language('foo_Latn');
        $this->assertSame('foo (Latin)', $foo->getNativeDescription());
        $foo->setIsoName('Foobar, Barbiz');
        $this->assertSame('foo (Latin)', $foo->getNativeDescription());
        $foo->setNativeName('Foobar, Barbiz');
        $this->assertSame('Foobar (Latin)', $foo->getNativeDescription());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('српски језик (Montenegro) (Cyrillic)', $sr->getNativeDescription());
    }

    public function testGetFullIsoDescription(): void
    {
        $ar = new Language('ca');
        $this->assertSame('Catalan, Valencian', $ar->getFullIsoDescription());
        $this->assertSame('Catalan, Valencian', $ar->getFullIsoDescription());
        $ar = new Language('ar_DZ');
        $this->assertSame('Arabic (Algeria)', $ar->getFullIsoDescription());
        $gom = new Language('gom_Latn');
        $this->assertSame('Konkani, Goan (Latin)', $gom->getFullIsoDescription());
        $foo = new Language('foo_Latn');
        $this->assertSame('foo (Latin)', $foo->getFullIsoDescription());
        $foo->setNativeName('Foobar, Barbiz');
        $this->assertSame('foo (Latin)', $foo->getFullIsoDescription());
        $foo->setIsoName('Foobar, Barbiz');
        $this->assertSame('Foobar, Barbiz (Latin)', $foo->getFullIsoDescription());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Serbian (Montenegro) (Cyrillic)', $sr->getFullIsoDescription());
    }

    public function testGetFullNativeDescription(): void
    {
        $ar = new Language('ca');
        $this->assertSame('català, valencià', $ar->getFullNativeDescription());
        $this->assertSame('català, valencià', $ar->getFullNativeDescription());
        $ar = new Language('ar_DZ');
        $this->assertSame('العربية (Algeria)', $ar->getFullNativeDescription());
        $gom = new Language('gom_Latn');
        $this->assertSame('ಕೊಂಕಣಿ (Latin)', $gom->getFullNativeDescription());
        $foo = new Language('foo_Latn');
        $this->assertSame('foo (Latin)', $foo->getFullNativeDescription());
        $foo->setIsoName('Foobar, Barbiz');
        $this->assertSame('foo (Latin)', $foo->getFullNativeDescription());
        $foo->setNativeName('Foobar, Barbiz');
        $this->assertSame('Foobar, Barbiz (Latin)', $foo->getFullNativeDescription());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('српски језик (Montenegro) (Cyrillic)', $sr->getFullNativeDescription());
    }

    public function testToString(): void
    {
        $ar = new Language('ar');
        $this->assertSame('ar', (string) $ar);
        $ar = new Language('ar_DZ');
        $this->assertSame('ar_DZ', (string) $ar);
        $ar = new Language('ar_Shakl');
        $this->assertSame('ar_Shakl', (string) $ar);
    }

    public function testToJson(): void
    {
        $ar = new Language('ca');
        $this->assertSame('"Catalan"', json_encode($ar));
        $this->assertSame('"Catalan"', json_encode($ar));
        $ar = new Language('ar_DZ');
        $this->assertSame('"Arabic (Algeria)"', json_encode($ar));
        $gom = new Language('gom_Latn');
        $this->assertSame('"Konkani (Latin)"', json_encode($gom));
        $foo = new Language('foo_Latn');
        $this->assertSame('"foo (Latin)"', json_encode($foo));
        $foo->setNativeName('Foobar, Barbiz');
        $this->assertSame('"foo (Latin)"', json_encode($foo));
        $foo->setIsoName('Foobar, Barbiz');
        $this->assertSame('"Foobar (Latin)"', json_encode($foo));
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('"Serbian (Montenegro) (Cyrillic)"', json_encode($sr));
    }
}
