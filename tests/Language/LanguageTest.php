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
        $this->assertIsArray($all);
        $this->assertArrayHasKey('en', $all);
        $this->assertIsArray($all['en']);
        $this->assertArrayHasKey('isoName', $all['en']);
        $this->assertSame('English', $all['en']['isoName']);
    }

    public function testRegions()
    {
        $regions = Language::regions();
        $this->assertIsArray($regions);
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
}
