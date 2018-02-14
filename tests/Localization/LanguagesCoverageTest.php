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

use Tests\AbstractTestCase;

class LanguagesCoverageTest extends AbstractTestCase
{
    public function testAllLanguagesAreTested()
    {
        $languages = glob(__DIR__.'/../../src/Carbon/Lang/*.php');
        $tests = array_map(function ($file) {
            return strtolower(substr(basename($file), 0, -8));
        }, glob(__DIR__.'/*Test.php'));
        $missingLanguages = count(array_filter($languages, function ($language) use ($tests) {
            return !in_array(
                str_replace(array('_', '-'), '', strtolower(substr(basename($language), 0, -4))),
                $tests
            );
        }));

        $this->assertSame(0, $missingLanguages);
    }
}
