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

namespace Tests\Carbon;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\Factory;
use Carbon\Translator;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\BadIsoCarbon;
use Tests\Carbon\Fixtures\MyCarbon;

class StringsTest extends AbstractTestCase
{
    public function testToStringCast()
    {
        $d = Carbon::now();
        $this->assertSame(Carbon::now()->toDateTimeString(), ''.$d);
    }

    public function testToString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu Dec 25 1975 14:15:16 GMT-0500', $d->toString());
    }

    public function testToISOString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T19:15:16.000000Z', $d->toISOString());
        $d = Carbon::create(21975, 12, 25, 14, 15, 16);
        $this->assertSame('+021975-12-25T19:15:16.000000Z', $d->toISOString());
        $d = Carbon::create(-75, 12, 25, 14, 15, 16);
        $this->assertStringStartsWith('-000075-', $d->toISOString());
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16.000000-05:00', $d->toISOString(true));
        $d = Carbon::create(21975, 12, 25, 14, 15, 16);
        $this->assertSame('+021975-12-25T14:15:16.000000-05:00', $d->toISOString(true));
        $d = Carbon::create(-75, 12, 25, 14, 15, 16);
        $this->assertStringStartsWith('-000075-', $d->toISOString(true));
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T19:15:16.000000Z', $d->toJSON());
        $d = Carbon::create(21975, 12, 25, 14, 15, 16);
        $this->assertSame('+021975-12-25T19:15:16.000000Z', $d->toJSON());
        $d = Carbon::create(-75, 12, 25, 14, 15, 16);
        $this->assertStringStartsWith('-000075-', $d->toJSON());
        $d = Carbon::create(0);
        $this->assertNull($d->toISOString());
    }

    public function testSetToStringFormatString()
    {
        Carbon::setToStringFormat('jS \o\f F, Y g:i:s a');
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('25th of December, 1975 2:15:16 pm', ''.$d);
    }

    public function testSetToStringFormatClosure()
    {
        Carbon::setToStringFormat(function (CarbonInterface $d) {
            $format = $d->year === 1976 ?
                'jS \o\f F g:i:s a' :
                'jS \o\f F, Y g:i:s a';

            return $d->format($format);
        });

        $d = Carbon::create(1976, 12, 25, 14, 15, 16);
        $this->assertSame('25th of December 2:15:16 pm', ''.$d);

        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('25th of December, 1975 2:15:16 pm', ''.$d);
    }

    public function testSetToStringFormatViaSettings()
    {
        $factory = new Factory([
            'toStringFormat' => function (CarbonInterface $d) {
                return $d->isoFormat('dddd');
            },
        ]);

        $d = $factory->create(1976, 12, 25, 14, 15, 16);
        $this->assertSame('Saturday', ''.$d);
    }

    public function testResetToStringFormat()
    {
        $d = Carbon::now();
        Carbon::setToStringFormat('123');
        Carbon::resetToStringFormat();
        $this->assertSame($d->toDateTimeString(), ''.$d);
    }

    public function testExtendedClassToString()
    {
        $d = MyCarbon::now();
        $this->assertSame($d->toDateTimeString(), ''.$d);
    }

    public function testToDateString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25', $d->toDateString());
    }

    public function testToDateTimeLocalString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16.615342);
        $this->assertSame('1975-12-25T14:15:16', $d->toDateTimeLocalString());
        $this->assertSame('1975-12-25T14:15', $d->toDateTimeLocalString('minute'));
        $this->assertSame('1975-12-25T14:15:16', $d->toDateTimeLocalString('second'));
        $this->assertSame('1975-12-25T14:15:16.615', $d->toDateTimeLocalString('millisecond'));
        $this->assertSame('1975-12-25T14:15:16.615342', $d->toDateTimeLocalString('µs'));

        $message = null;

        try {
            $d->toDateTimeLocalString('hour');
        } catch (InvalidArgumentException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertSame('Precision unit expected among: minute, second, millisecond and microsecond.', $message);
    }

    public function testToFormattedDateString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Dec 25, 1975', $d->toFormattedDateString());
    }

    public function testToTimeString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('14:15:16', $d->toTimeString());
    }

    public function testToDateTimeString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25 14:15:16', $d->toDateTimeString());
    }

    public function testToDateTimeStringWithPaddedZeroes()
    {
        $d = Carbon::create(2000, 5, 2, 4, 3, 4);
        $this->assertSame('2000-05-02 04:03:04', $d->toDateTimeString());
    }

    public function testToDayDateTimeString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, Dec 25, 1975 2:15 PM', $d->toDayDateTimeString());
    }

    public function testToDayDateString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, Dec 25, 1975', $d->toFormattedDayDateString());
    }

    public function testToAtomString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toAtomString());
    }

    public function testToCOOKIEString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame(
            DateTime::COOKIE === 'l, d-M-y H:i:s T'
                ? 'Thursday, 25-Dec-75 14:15:16 EST'
                : 'Thursday, 25-Dec-1975 14:15:16 EST',
            $d->toCookieString(),
        );
    }

    public function testToIso8601String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toIso8601String());
    }

    public function testToIso8601ZuluString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T19:15:16Z', $d->toIso8601ZuluString());
    }

    public function testToRC822String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 75 14:15:16 -0500', $d->toRfc822String());
    }

    public function testToRfc850String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thursday, 25-Dec-75 14:15:16 EST', $d->toRfc850String());
    }

    public function testToRfc1036String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 75 14:15:16 -0500', $d->toRfc1036String());
    }

    public function testToRfc1123String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRfc1123String());
    }

    public function testToRfc2822String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRfc2822String());
    }

    public function testToRfc3339String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toRfc3339String());

        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16.000-05:00', $d->toRfc3339String(true));
    }

    public function testToRssString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRssString());
    }

    public function testToW3cString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toW3cString());
    }

    public function testToRfc7231String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16, 'GMT');
        $this->assertSame('Thu, 25 Dec 1975 14:15:16 GMT', $d->toRfc7231String());

        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 1975 19:15:16 GMT', $d->toRfc7231String());
    }

    public function testIsoFormat()
    {
        $d = Carbon::parse('midnight');
        $this->assertSame('24', $d->isoFormat('k'));

        $d = Carbon::parse('2017-01-01');
        $this->assertSame('2017', $d->isoFormat('g'));
        $this->assertSame('2017', $d->locale('en_US')->isoFormat('g'));
        $this->assertSame('2016', $d->locale('fr')->isoFormat('g'));
        $this->assertSame('2016', $d->isoFormat('G'));
        $this->assertSame('2016', $d->locale('en_US')->isoFormat('G'));
        $this->assertSame('2016', $d->locale('fr')->isoFormat('G'));

        $d = Carbon::parse('2015-12-31');
        $this->assertSame('2016', $d->isoFormat('g'));
        $this->assertSame('2016', $d->locale('en_US')->isoFormat('g'));
        $this->assertSame('2015', $d->locale('fr')->isoFormat('g'));
        $this->assertSame('2015', $d->isoFormat('G'));
        $this->assertSame('2015', $d->locale('en_US')->isoFormat('G'));
        $this->assertSame('2015', $d->locale('fr')->isoFormat('G'));

        $d = Carbon::parse('2017-01-01 22:25:24.182937');
        $this->assertSame('1 18 182 1829 18293 182937 1829370 18293700 182937000', $d->isoFormat('S SS SSS SSSS SSSSS SSSSSS SSSSSSS SSSSSSSS SSSSSSSSS'));

        $this->assertSame('02017 +002017', $d->isoFormat('YYYYY YYYYYY'));
        $this->assertSame(-117, Carbon::create(-117, 1, 1)->year);
        $this->assertSame('-00117 -000117', Carbon::create(-117, 1, 1)->isoFormat('YYYYY YYYYYY'));

        $this->assertSame('M01', $d->isoFormat('\\MMM'));

        $this->assertSame('Jan', $d->isoFormat('MMM'));
        $this->assertSame('janv.', $d->locale('fr')->isoFormat('MMM'));
        $this->assertSame('ene.', $d->locale('es')->isoFormat('MMM'));
        $this->assertSame('1 de enero de 2017', $d->locale('es')->isoFormat('LL'));
        $this->assertSame('1 de ene. de 2017', $d->locale('es')->isoFormat('ll'));

        $this->assertSame('1st', Carbon::parse('2018-06-01')->isoFormat('Do'));
        $this->assertSame('11th', Carbon::parse('2018-06-11')->isoFormat('Do'));
        $this->assertSame('21st', Carbon::parse('2018-06-21')->isoFormat('Do'));
        $this->assertSame('15th', Carbon::parse('2018-06-15')->isoFormat('Do'));
    }

    public function testBadIsoFormat()
    {
        $d = BadIsoCarbon::parse('midnight');

        $this->assertSame('', $d->isoFormat('MMM'));
    }

    public function testIsoFormatEras()
    {
        $th = Carbon::parse('2026-09-30')->locale('th');

        $this->assertSame('30 กันยายน พ.ศ. 2569', $th->isoFormat('D MMMM N y'));
        $this->assertSame('พ.ศ. พ.ศ. พ.ศ. พุทธศักราช พ.ศ.', $th->isoFormat('N NN NNN NNNN NNNNN'));
        $this->assertSame('2569 2569 2569 2569 2569', $th->isoFormat('y yy yyy yyyy yo'));
        $this->assertSame('พ.ศ.', $th->eraAbbr());
        $this->assertSame('พุทธศักราช', $th->eraName());
        $this->assertSame('พ.ศ.', $th->eraNarrow());
        $this->assertSame(2569, $th->eraYear());
        $this->assertSame('29/02/2567', Carbon::parse('2024-02-29')->locale('th_TH')->isoFormat('DD/MM/y'));
        $this->assertSame('544 0544', Carbon::parse('0001-01-01')->locale('th')->isoFormat('y yyyy'));

        // Before the first day of the Buddhist Era, no era applies
        $this->assertSame('| -600', Carbon::create(-600)->locale('th')->isoFormat('N| y'));

        $en = Carbon::parse('2026-09-30')->locale('en');

        // yy..yyyy zero-pad the era year to a minimum length, unlike YY they never truncate it
        $this->assertSame('AD Anno Domini AD 2026 2026 2026th', $en->isoFormat('N NNNN NNNNN y yy yo'));
        $this->assertSame('AD 1', Carbon::create(1, 1, 1)->locale('en')->isoFormat('N y'));
        $this->assertSame('AD', $en->eraAbbr());
        $this->assertSame('Anno Domini', $en->eraName());
        $this->assertSame('AD', $en->eraNarrow());
        $this->assertSame('BC 1 01 001 0001 1st', Carbon::create(0, 12, 31)->locale('en')->isoFormat('N y yy yyy yyyy yo'));
        $this->assertSame('BC 100', Carbon::create(-99, 6, 1)->locale('en')->isoFormat('N y'));

        // Locales without eras use AD/BC like in moment.js
        $this->assertSame('AD 2026', $en->locale('fr')->isoFormat('N y'));

        // Escaped era tokens stay as-is
        $this->assertSame('N y Ny', $th->isoFormat('[N y] \N\y'));

        // Defaults are unchanged, the Buddhist Era can be opted in by overriding the locale formats
        $this->assertSame('30/09/2026', $th->isoFormat('L'));
        $translator = Translator::get('th');
        $translator->setTranslations([
            'formats' => [
                'L' => 'D MMMM N y',
            ],
        ]);
        $this->assertSame('30 กันยายน พ.ศ. 2569', $th->isoFormat('L'));
        $translator->resetMessages();

        $en = Carbon::parse('2026-09-30')->setLocalTranslator(
            $this->createStub(TranslatorInterface::class),
        );
        $this->assertSame('AD Anno Domini AD 2026 2026 2026', $en->isoFormat('N NNNN NNNNN y yy yo'));
        $this->assertSame('AD 1', Carbon::create(1, 1, 1)->locale('en')->isoFormat('N y'));
        $this->assertSame('AD', $en->eraAbbr());
        $this->assertSame('Anno Domini', $en->eraName());
        $this->assertSame('AD', $en->eraNarrow());
        $this->assertSame('BC 1 01 001 0001 1st', Carbon::create(0, 12, 31)->locale('en')->isoFormat('N y yy yyy yyyy yo'));
        $this->assertSame('BC 100', Carbon::create(-99, 6, 1)->locale('en')->isoFormat('N y'));
    }

    public function testIsoFormatCustomEras()
    {
        $translator = Translator::get('en_Eras');
        $translator->setTranslations([
            'formats' => [
                'L' => 'N y',
            ],
            'eras' => [
                [
                    'since' => '2019-05-01',
                    'until' => INF,
                    'offset' => 1,
                    'name' => 'Reiwa',
                    'narrow' => 'R',
                    'abbr' => 'R.',
                ],
                [
                    'since' => '1989-01-08',
                    'until' => '2019-04-30',
                    'offset' => 1,
                    'name' => 'Heisei',
                    'abbr' => 'H.',
                ],
            ],
        ]);

        $this->assertSame('H. 31', Carbon::parse('2019-04-30 23:59')->locale('en_Eras')->isoFormat('L'));
        $this->assertSame('R. 1', Carbon::parse('2019-05-01')->locale('en_Eras')->isoFormat('L'));
        $this->assertSame('Reiwa R 8', Carbon::parse('2026-09-30')->locale('en_Eras')->isoFormat('NNNN NNNNN y'));
        // Missing narrow name stays empty
        $this->assertSame('Heisei | 1', Carbon::parse('1989-01-08')->locale('en_Eras')->isoFormat('NNNN |NNNNN y'));
        // Outside of all eras: no name, calendar year
        $this->assertSame('|1988', Carbon::parse('1988-12-31')->locale('en_Eras')->isoFormat('N|y'));

        $translator->resetMessages();
    }

    public function testErasAreNotMixedWithFallbackLocale()
    {
        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setLocale('de');
        $translator->setTranslations([
            'eras' => [
                ['since' => '2010-01-01', 'until' => INF, 'offset' => 1, 'abbr' => 'Y'],
                ['since' => '1000-01-01', 'until' => '1999-12-31', 'offset' => 1, 'abbr' => 'Z'],
            ],
        ]);
        $translator->setLocale('fr');
        $translator->setTranslations([
            'eras' => [
                ['since' => '2000-01-01', 'until' => INF, 'offset' => 1, 'abbr' => 'X'],
            ],
        ]);
        $translator->setFallbackLocales(['de']);

        // Key by key, the fallback would provide a second era
        $this->assertSame('Z', Carbon::parse('1500-01-01')->getTranslationMessage('eras.1.abbr'));

        $this->assertSame('X 27', Carbon::parse('2026-09-30')->isoFormat('N y'));
        // But eras are taken as a whole from fr, so 1500 is in no era
        $this->assertSame('|1500', Carbon::parse('1500-01-01')->isoFormat('N|y'));
    }

    public function testInvalidEraDate()
    {
        $translator = Translator::get('en_BadEra');
        $translator->setTranslations([
            'eras' => [
                ['since' => '2019/05/01', 'until' => INF, 'offset' => 1, 'abbr' => 'X'],
            ],
        ]);

        try {
            $this->expectExceptionObject(new InvalidArgumentException("Invalid era date '2019/05/01', expected YYYY-MM-DD."));

            Carbon::parse('2026-09-30')->locale('en_BadEra')->eraAbbr();
        } finally {
            $translator->resetMessages();
        }
    }

    public function testIsoFormatMacroStartingWithLiteral()
    {
        $d = Carbon::parse('2026-09-30 14:05');

        $this->assertSame('วันพุธที่ 30 กันยายน 2026 เวลา 14:05', $d->locale('th')->isoFormat('LLLL'));
        $this->assertSame('วันพุธที่ 30 ก.ย. 2026 เวลา 14:05', $d->locale('th')->isoFormat('llll'));
        $this->assertSame('พุธ วันพุธที่ 30 กันยายน 2026 เวลา 14:05', $d->locale('th')->isoFormat('dddd LLLL'));
        $this->assertSame('ວັນພຸດ 30 ກັນຍາ 2026 14:05', $d->locale('lo')->isoFormat('LLLL'));
        $this->assertSame('པསྱི་ལོ26ཟལ09ཚེས30', $d->locale('dz')->isoFormat('L'));
        $this->assertSame('د 2026 د سېپتمبر 30 14:05', $d->locale('ps')->isoFormat('LLL'));

        $translator = Translator::get('en_Macro');
        $translator->setTranslations([
            'formats' => [
                'LT' => 'H:mm',
                'L' => '[Day] D',
                'LL' => '\\DD',
                'LLL' => 'L [at] LT',
            ],
        ]);
        $d = $d->locale('en_Macro');

        $this->assertSame('Day 30', $d->isoFormat('L'));
        $this->assertSame('Day 30', $d->isoFormat('l'));
        $this->assertSame('D30', $d->isoFormat('LL'));
        $this->assertSame('Day 30 at 14:05', $d->isoFormat('LLL'));
        $this->assertSame('x Day 30', $d->isoFormat('[x] L'));

        $translator->resetMessages();

        $translator = Translator::get('en_SelfMacro');
        $translator->setTranslations([
            'formats' => [
                'L' => 'L',
            ],
        ]);

        // A macro expanding to itself is output as-is instead of looping forever
        $this->assertSame('L', $d->locale('en_SelfMacro')->isoFormat('L'));

        $translator->resetMessages();
    }

    public function testTranslatedFormat()
    {
        $this->assertSame('1st', Carbon::parse('01-01-01')->translatedFormat('jS'));
        $this->assertSame('1er', Carbon::parse('01-01-01')->locale('fr')->translatedFormat('jS'));
        $this->assertSame('31 мая', Carbon::parse('2019-05-15')->locale('ru')->translatedFormat('t F'));
        $this->assertSame('5 май', Carbon::parse('2019-05-15')->locale('ru')->translatedFormat('n F'));
    }

    public function testTranslatedFormatMatchesRawFormatForUntranslatableCharacters()
    {
        $zone = 'America/New_York';
        $date = Carbon::parse('2024-03-15 14:30:45.123456', $zone)->locale('en');
        $native = new DateTimeImmutable('2024-03-15 14:30:45.123456', new DateTimeZone($zone));

        // Every character documented for date() must produce the same output as
        // date() itself when nothing in it can be translated.
        foreach (str_split('dDjlNSwzWFmMntLoXxYyaABgGhHisuveIOPpTZcrU') as $character) {
            $this->assertSame(
                $native->format($character),
                $date->translatedFormat($character),
                "translatedFormat('$character') should match format('$character')",
            );
        }

        $this->assertSame('America/New_York', $date->translatedFormat('e'));
        $this->assertSame('-04:00', $date->translatedFormat('p'));
        $this->assertSame('Z', Carbon::parse('2024-03-15 14:30:45', 'UTC')->translatedFormat('p'));
    }
}
