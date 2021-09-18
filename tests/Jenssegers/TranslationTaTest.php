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

namespace Tests\Jenssegers;

class TranslationTaTest extends TestCaseBase
{
    public const LOCALE = 'ta';

    public function testItTranslatesMonth()
    {
        $jan = JenssegersDate::createFromFormat('m-d', '01-01');
        $feb = JenssegersDate::createFromFormat('m-d', '02-01');
        $mar = JenssegersDate::createFromFormat('m-d', '03-01');
        $apr = JenssegersDate::createFromFormat('m-d', '04-01');
        $may = JenssegersDate::createFromFormat('m-d', '05-01');
        $jun = JenssegersDate::createFromFormat('m-d', '06-01');
        $jul = JenssegersDate::createFromFormat('m-d', '07-01');
        $aug = JenssegersDate::createFromFormat('m-d', '08-01');
        $sep = JenssegersDate::createFromFormat('m-d', '09-01');
        $oct = JenssegersDate::createFromFormat('m-d', '10-01');
        $nov = JenssegersDate::createFromFormat('m-d', '11-01');
        $dec = JenssegersDate::createFromFormat('m-d', '12-01');

        $this->assertSame('ஜனவரி', $jan->format('F'));
        $this->assertSame('பிப்ரவரி', $feb->format('F'));
        $this->assertSame('மார்ச்', $mar->format('F'));
        $this->assertSame('ஏப்ரல்', $apr->format('F'));
        $this->assertSame('மே', $may->format('F'));
        $this->assertSame('ஜூன்', $jun->format('F'));
        $this->assertSame('ஜூலை', $jul->format('F'));
        $this->assertSame('ஆகஸ்ட்', $aug->format('F'));
        $this->assertSame('செப்டெம்பர்', $sep->format('F'));
        $this->assertSame('அக்டோபர்', $oct->format('F'));
        $this->assertSame('நவம்பர்', $nov->format('F'));
        $this->assertSame('டிசம்பர்', $dec->format('F'));
    }

    public function testItTranslatesWeekdays()
    {
        $mon = JenssegersDate::parse('next monday');
        $tue = JenssegersDate::parse('next tuesday');
        $wed = JenssegersDate::parse('next wednesday');
        $thu = JenssegersDate::parse('next thursday');
        $fri = JenssegersDate::parse('next friday');
        $sat = JenssegersDate::parse('next saturday');
        $sun = JenssegersDate::parse('next sunday');

        $this->assertSame('திங்கட்கிழமை', $mon->format('l'));
        $this->assertSame('செவ்வாய்கிழமை', $tue->format('l'));
        $this->assertSame('புதன்கிழமை', $wed->format('l'));
        $this->assertSame('வியாழக்கிழமை', $thu->format('l'));
        $this->assertSame('வெள்ளிக்கிழமை', $fri->format('l'));
        $this->assertSame('சனிக்கிழமை', $sat->format('l'));
        $this->assertSame('ஞாயிற்றுக்கிழமை', $sun->format('l'));
    }

    public function testItTranslatesWeekdaysShortform()
    {
        $mon = JenssegersDate::parse('next monday');
        $tue = JenssegersDate::parse('next tuesday');
        $wed = JenssegersDate::parse('next wednesday');
        $thu = JenssegersDate::parse('next thursday');
        $fri = JenssegersDate::parse('next friday');
        $sat = JenssegersDate::parse('next saturday');
        $sun = JenssegersDate::parse('next sunday');

        $this->assertSame('திங்கள்', $mon->format('D'));
        $this->assertSame('செவ்வாய்', $tue->format('D'));
        $this->assertSame('புதன்', $wed->format('D'));
        $this->assertSame('வியாழன்', $thu->format('D'));
        $this->assertSame('வெள்ளி', $fri->format('D'));
        $this->assertSame('சனி', $sat->format('D'));
        $this->assertSame('ஞாயிறு', $sun->format('D'));
    }

    public function testItTranslatesAgo()
    {
        JenssegersDate::setTestNow('2019-03-27');

        $oneAgo = JenssegersDate::parse('-1 second');
        $fiveAgo = JenssegersDate::parse('-5 seconds');

        $this->assertSame('1 சில விநாடிகள் முன்', $oneAgo->ago());
        $this->assertSame('5 விநாடிகள் முன்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('-1 minute');
        $fiveAgo = JenssegersDate::parse('-5 minutes');

        $this->assertSame('1 நிமிடம் முன்', $oneAgo->ago());
        $this->assertSame('5 நிமிடங்கள் முன்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('-1 hour');
        $fiveAgo = JenssegersDate::parse('-5 hours');

        $this->assertSame('1 மணி நேரம் முன்', $oneAgo->ago());
        $this->assertSame('5 மணி நேரம் முன்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('-1 day');
        $fiveAgo = JenssegersDate::parse('-5 days');

        $this->assertSame('1 நாள் முன்', $oneAgo->ago());
        $this->assertSame('5 நாட்கள் முன்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('-1 week');
        $fiveAgo = JenssegersDate::parse('-3 weeks');

        $this->assertSame('1 வாரம் முன்', $oneAgo->ago());
        $this->assertSame('3 வாரங்கள் முன்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::now()->subMonthNoOverflow();
        $threeAgo = JenssegersDate::now()->subMonthsNoOverflow(3);

        $this->assertSame('1 மாதம் முன்', $oneAgo->ago());
        $this->assertSame('3 மாதங்கள் முன்', $threeAgo->ago());

        $oneAgo = JenssegersDate::parse('-1 year');
        $fiveAgo = JenssegersDate::parse('-3 years');

        $this->assertSame('1 வருடம் முன்', $oneAgo->ago());
        $this->assertSame('3 ஆண்டுகள் முன்', $fiveAgo->ago());
    }

    public function testItTranslatesFromNow()
    {
        $oneAgo = JenssegersDate::parse('1 second');
        $fiveAgo = JenssegersDate::parse('5 seconds');

        $this->assertSame('1 சில விநாடிகள் இல்', $oneAgo->ago());
        $this->assertSame('5 விநாடிகள் இல்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('1 minute');
        $fiveAgo = JenssegersDate::parse('5 minutes');

        $this->assertSame('1 நிமிடம் இல்', $oneAgo->ago());
        $this->assertSame('5 நிமிடங்கள் இல்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('1 hour');
        $fiveAgo = JenssegersDate::parse('5 hours');

        $this->assertSame('1 மணி நேரம் இல்', $oneAgo->ago());
        $this->assertSame('5 மணி நேரம் இல்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('1 day');
        $fiveAgo = JenssegersDate::parse('5 days');

        $this->assertSame('1 நாள் இல்', $oneAgo->ago());
        $this->assertSame('5 நாட்கள் இல்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('1 week');
        $fiveAgo = JenssegersDate::parse('3 weeks');

        $this->assertSame('1 வாரம் இல்', $oneAgo->ago());
        $this->assertSame('3 வாரங்கள் இல்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('1 month');
        $fiveAgo = JenssegersDate::parse('3 months');

        $this->assertSame('1 மாதம் இல்', $oneAgo->ago());
        $this->assertSame('3 மாதங்கள் இல்', $fiveAgo->ago());

        $oneAgo = JenssegersDate::parse('1 year');
        $fiveAgo = JenssegersDate::parse('3 years');

        $this->assertSame('1 வருடம் இல்', $oneAgo->ago());
        $this->assertSame('3 ஆண்டுகள் இல்', $fiveAgo->ago());
    }
}
