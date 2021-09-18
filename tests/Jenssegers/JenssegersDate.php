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

use Carbon\Carbon;

class JenssegersDate extends Carbon
{
    /**
     * Function to call instead of format.
     *
     * @var string|callable|null
     */
    protected static $formatFunction = 'jngFormat';

    /**
     * Function to call instead of createFromFormat.
     *
     * @var string|callable|null
     */
    protected static $createFromFormatFunction = 'jngCreateFromFormat';

    /**
     * Function to call instead of parse.
     *
     * @var string|callable|null
     */
    protected static $parseFunction = 'jngParse';

    public static function jngParse($time = null, $tz = null)
    {
        if (\is_string($time)) {
            $time = static::translateTimeString($time, static::getLocale(), 'en');
        }

        return parent::rawParse($time, $tz);
    }

    public static function jngCreateFromFormat($format, $time = null, $tz = null)
    {
        if (\is_string($time)) {
            $time = static::translateTimeString($time, static::getLocale(), 'en');
        }

        return parent::rawCreateFromFormat($format, $time, $tz);
    }

    public function jngFormat($format)
    {
        return $this->translatedFormat($format);
    }
}
