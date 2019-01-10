<?php

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
    public function testAll()
    {
        $all = Language::all();
        $this->assertTrue(is_array($all));
        $this->assertArrayHasKey('en', $all);
        $this->assertTrue(is_array($all['en']));
        $this->assertArrayHasKey('isoName', $all['en']);
        $this->assertSame('English', $all['en']['isoName']);
    }

    public function testRegions()
    {
        $regions = Language::regions();
        $this->assertTrue(is_array($regions));
        $this->assertArrayHasKey('US', $regions);
        $this->assertSame('United States of America', $regions['US']);
    }

    public function testGetNames()
    {
        $ar = new Language('ar');
        $this->assertSame([
            'isoName' => 'Arabic',
            'nativeName' => 'العربية',
        ], $ar->getNames());
    }

    public function testGetId()
    {
        $ar = new Language('ar');
        $this->assertSame('ar', $ar->getId());
        $ar = new Language('ar_DZ');
        $this->assertSame('ar_DZ', $ar->getId());
        $ar = new Language('ar_Shakl');
        $this->assertSame('ar_Shakl', $ar->getId());
    }

    public function testGetCode()
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

    public function testGetVariant()
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

    public function testGetRegion()
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

    public function testGetRegionName()
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

    public function testGetFullIsoName()
    {
        $ar = new Language('ca');
        $this->assertSame('Catalan, Valencian', $ar->getFullIsoName());
        $this->assertSame('Catalan, Valencian', $ar->getFullIsoName());
        $ar = new Language('ar_DZ');
        $this->assertSame('Arabic', $ar->getFullIsoName());
        $gom = new Language('gom_Latn');
        $this->assertSame('gom', $gom->getFullIsoName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Serbian', $sr->getFullIsoName());
    }

    public function testGetFullNativeName()
    {
        $ar = new Language('ca');
        $this->assertSame('català, valencià', $ar->getFullNativeName());
        $this->assertSame('català, valencià', $ar->getFullNativeName());
        $ar = new Language('ar_DZ');
        $this->assertSame('العربية', $ar->getFullNativeName());
        $gom = new Language('gom_Latn');
        $this->assertSame('gom', $gom->getFullNativeName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('српски језик', $sr->getFullNativeName());
    }

    public function testGetIsoName()
    {
        $ar = new Language('ca');
        $this->assertSame('Catalan', $ar->getIsoName());
        $this->assertSame('Catalan', $ar->getIsoName());
        $ar = new Language('ar_DZ');
        $this->assertSame('Arabic', $ar->getIsoName());
        $gom = new Language('gom_Latn');
        $this->assertSame('gom', $gom->getIsoName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Serbian', $sr->getIsoName());
    }

    public function testGetNativeName()
    {
        $ar = new Language('ca');
        $this->assertSame('català', $ar->getNativeName());
        $this->assertSame('català', $ar->getNativeName());
        $ar = new Language('ar_DZ');
        $this->assertSame('العربية', $ar->getNativeName());
        $gom = new Language('gom_Latn');
        $this->assertSame('gom', $gom->getNativeName());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('српски језик', $sr->getNativeName());
    }

    public function testGetIsoDescription()
    {
        $ar = new Language('ca');
        $this->assertSame('Catalan', $ar->getIsoDescription());
        $this->assertSame('Catalan', $ar->getIsoDescription());
        $ar = new Language('ar_DZ');
        $this->assertSame('Arabic (Algeria)', $ar->getIsoDescription());
        $gom = new Language('gom_Latn');
        $this->assertSame('gom (Latin)', $gom->getIsoDescription());
        $gom->setNativeName('Konkani');
        $this->assertSame('gom (Latin)', $gom->getIsoDescription());
        $gom->setIsoName('Konkani, Goan');
        $this->assertSame('Konkani (Latin)', $gom->getIsoDescription());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Serbian (Montenegro) (Cyrillic)', $sr->getIsoDescription());
    }

    public function testGetNativeDescription()
    {
        $ar = new Language('ca');
        $this->assertSame('català', $ar->getNativeDescription());
        $this->assertSame('català', $ar->getNativeDescription());
        $ar = new Language('ar_DZ');
        $this->assertSame('العربية (Algeria)', $ar->getNativeDescription());
        $gom = new Language('gom_Latn');
        $this->assertSame('gom (Latin)', $gom->getNativeDescription());
        $gom->setIsoName('Konkani, Goan');
        $this->assertSame('gom (Latin)', $gom->getNativeDescription());
        $gom->setNativeName('Konkani');
        $this->assertSame('Konkani (Latin)', $gom->getNativeDescription());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('српски језик (Montenegro) (Cyrillic)', $sr->getNativeDescription());
    }

    public function testGetFullIsoDescription()
    {
        $ar = new Language('ca');
        $this->assertSame('Catalan, Valencian', $ar->getFullIsoDescription());
        $this->assertSame('Catalan, Valencian', $ar->getFullIsoDescription());
        $ar = new Language('ar_DZ');
        $this->assertSame('Arabic (Algeria)', $ar->getFullIsoDescription());
        $gom = new Language('gom_Latn');
        $this->assertSame('gom (Latin)', $gom->getFullIsoDescription());
        $gom->setNativeName('Konkani');
        $this->assertSame('gom (Latin)', $gom->getFullIsoDescription());
        $gom->setIsoName('Konkani, Goan');
        $this->assertSame('Konkani, Goan (Latin)', $gom->getFullIsoDescription());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('Serbian (Montenegro) (Cyrillic)', $sr->getFullIsoDescription());
    }

    public function testGetFullNativeDescription()
    {
        $ar = new Language('ca');
        $this->assertSame('català, valencià', $ar->getFullNativeDescription());
        $this->assertSame('català, valencià', $ar->getFullNativeDescription());
        $ar = new Language('ar_DZ');
        $this->assertSame('العربية (Algeria)', $ar->getFullNativeDescription());
        $gom = new Language('gom_Latn');
        $this->assertSame('gom (Latin)', $gom->getFullNativeDescription());
        $gom->setIsoName('Konkani, Goan');
        $this->assertSame('gom (Latin)', $gom->getFullNativeDescription());
        $gom->setNativeName('Konkani, Goan');
        $this->assertSame('Konkani, Goan (Latin)', $gom->getFullNativeDescription());
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('српски језик (Montenegro) (Cyrillic)', $sr->getFullNativeDescription());
    }

    public function testToString()
    {
        $ar = new Language('ar');
        $this->assertSame('ar', strval($ar));
        $ar = new Language('ar_DZ');
        $this->assertSame('ar_DZ', strval($ar));
        $ar = new Language('ar_Shakl');
        $this->assertSame('ar_Shakl', strval($ar));
    }

    public function testToJson()
    {
        $ar = new Language('ca');
        $this->assertSame('"Catalan"', json_encode($ar));
        $this->assertSame('"Catalan"', json_encode($ar));
        $ar = new Language('ar_DZ');
        $this->assertSame('"Arabic (Algeria)"', json_encode($ar));
        $gom = new Language('gom_Latn');
        $this->assertSame('"gom (Latin)"', json_encode($gom));
        $gom->setNativeName('Konkani');
        $this->assertSame('"gom (Latin)"', json_encode($gom));
        $gom->setIsoName('Konkani, Goan');
        $this->assertSame('"Konkani (Latin)"', json_encode($gom));
        $sr = new Language('sr_Cyrl_ME');
        $this->assertSame('"Serbian (Montenegro) (Cyrillic)"', json_encode($sr));
    }
}
