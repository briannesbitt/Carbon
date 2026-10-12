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

namespace Carbon\Traits;

use Carbon\CarbonInterface;
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Translator;
use InvalidArgumentException;
use Symfony\Component\Translation\TranslatorBagInterface;
use Symfony\Contracts\Translation\LocaleAwareInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Trait Eras.
 *
 * Era (moment.js style) helpers, used to read and describe the eras of the current locale.
 */
trait Eras
{
    /**
     * Return the era of the current locale the current date is in (null if none).
     *
     * Eras follow moment.js: a list of ['since', 'until', 'offset', 'name', 'narrow', 'abbr'] where since
     * and until are 'YYYY-MM-DD' dates (or INF/-INF for until) and since may be after until for eras counting
     * years backward (such as BC).
     *
     * @return array{name: string|null, narrow: string|null, abbr: string|null, offset: int, sinceYear: int, untilYear: int|float, direction: int}|null
     */
    private function getEra(): ?array
    {
        $date = $this->year * 10000 + $this->month * 100 + $this->day;

        foreach ($this->getEras() as $era) {
            $description = self::describeEra($era);

            if (($description['since'] <= $date && $date <= $description['until']) || ($description['until'] <= $date && $date <= $description['since'])) {
                unset($description['since'], $description['until']);

                return $description;
            }
        }

        return null;
    }

    /**
     * @param array<string, mixed> $era
     *
     * @return array{name: string|null, narrow: string|null, abbr: string|null, offset: int, sinceYear: int, untilYear: int|float, direction: int, since: int|float, until: int|float}
     */
    private static function describeEra(array $era): array
    {
        [$sinceYear, $since] = self::parseEraDate($era['since']);
        [$untilYear, $until] = self::parseEraDate($era['until'] ?? INF);

        return [
            'name' => $era['name'] ?? null,
            'narrow' => $era['narrow'] ?? null,
            'abbr' => $era['abbr'] ?? null,
            'offset' => (int) ($era['offset'] ?? 1),
            'sinceYear' => $sinceYear,
            'untilYear' => $untilYear,
            'direction' => $since <= $until ? 1 : -1,
            'since' => $since,
            'until' => $until,
        ];
    }

    /**
     * Return the "eras" of the current locale, taken as a whole from the first locale of the fallback chain
     * defining them, so a locale with fewer eras does not get the extra ones of its fallback.
     * Like in moment.js, Anno Domini / Before Christ are used if no locale defines eras.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getEras(): array
    {
        $translator = $this->getLocalTranslator();

        if (!($translator instanceof TranslatorBagInterface)) {
            return self::getDefaultEras();
        }

        $locale = $translator instanceof LocaleAwareInterface ? $translator->getLocale() : null;

        for ($catalogue = $translator->getCatalogue($locale); $catalogue; $catalogue = $catalogue->getFallbackCatalogue()) {
            if (!$catalogue->defines('eras.0.since')) {
                continue;
            }

            $eras = [];

            for ($index = 0; $catalogue->defines("eras.$index.since"); $index++) {
                $era = [];

                foreach (['since', 'until', 'offset', 'name', 'narrow', 'abbr'] as $field) {
                    $key = "eras.$index.$field";

                    if ($catalogue->defines($key)) {
                        $era[$field] = self::getFromCatalogue($translator, $catalogue, $key);
                    }
                }

                $eras[] = $era;
            }

            return $eras;
        }

        return self::getDefaultEras();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private static function getDefaultEras(): array
    {
        return [
            [
                'since' => '0001-01-01',
                'until' => INF,
                'offset' => 1,
                'name' => 'Anno Domini',
                'narrow' => 'AD',
                'abbr' => 'AD',
            ],
            [
                'since' => '0000-12-31',
                'until' => -INF,
                'offset' => 1,
                'name' => 'Before Christ',
                'narrow' => 'BC',
                'abbr' => 'BC',
            ],
        ];
    }

    /**
     * Parse an era limit ('YYYY-MM-DD', the year may be negative, or INF/-INF) into its year and a sortable value.
     *
     * @return array{0: int|float, 1: int|float}
     */
    private static function parseEraDate(mixed $date): array
    {
        if (\is_float($date) || \is_int($date)) {
            return [$date, $date];
        }

        if (!preg_match('/^([+-]?\d+)-(\d{1,2})-(\d{1,2})$/', (string) $date, $match)) {
            throw new InvalidArgumentException("Invalid era date '$date', expected YYYY-MM-DD.");
        }

        $year = (int) $match[1];

        return [$year, $year * 10000 + (int) $match[2] * 100 + (int) $match[3]];
    }

    /**
     * Replace the era tokens of an ISO format (and what they match in $time) by a Gregorian year, so the result
     * can be parsed by rawCreateFromFormat(). The era year is converted before parsing so a leap day is checked
     * against the right year (BE 2567-02-29 is valid, but CE 2567-02-29 is not).
     *
     * @throws InvalidFormatException
     *
     * @return array{0: string, 1: string} format and time without era tokens
     */
    private static function resolveIsoFormatEras(string $format, string $time, ?string $locale, ?TranslatorInterface $translator): array
    {
        // The "u" modifier below would fail with a format that is not valid UTF-8, it's left as before era tokens
        if (strpbrk($format, 'Ny') === false || !preg_match('//u', $format)) {
            return [$format, $time];
        }

        preg_match_all('/\\\\.|'.CarbonInterface::ISO_FORMAT_REGEXP.'|./su', $format, $matches);

        $tokens = $matches[0];
        $isEraToken = static fn (string $token): bool => $token[0] === 'N' || $token[0] === 'y';

        if (!array_filter($tokens, $isEraToken)) {
            return [$format, $time];
        }

        $date = static::now()->setLocalTranslator($translator ?? Translator::get($locale));
        $eras = array_map(self::describeEra(...), $date->getEras());
        $pattern = '';
        $generic = '';
        $eraTokens = [];

        foreach ($tokens as $index => $token) {
            if ($isEraToken($token)) {
                $eraTokens[$index] = $token;
                $eraPattern = $token[0] === 'N' ? self::getEraNamesPattern($eras, $token) : ($token === 'yo' ? '\\d+\\p{L}*' : '\\d+');
                $pattern .= "($eraPattern)";
                $generic .= $token[0] === 'N' ? '(.+?)' : '(\\d+\\p{L}*)';

                continue;
            }

            $part = self::getIsoTokenPattern($token);
            $pattern .= $part;
            $generic .= $part;
        }

        $captures = [];

        if (!preg_match("/^$pattern\$/siu", $time, $captures, \PREG_OFFSET_CAPTURE)) {
            if (preg_match("/^$generic\$/siu", $time, $captures)) {
                foreach (array_keys($eraTokens) as $position => $index) {
                    if ($tokens[$index][0] === 'N') {
                        throw new InvalidFormatException(
                            "Unknown era '".$captures[$position + 1]."' for locale '".$date->locale."' in '$time'.",
                        );
                    }
                }
            }

            throw new InvalidFormatException("Could not parse '$time' with format '$format'.");
        }

        $era = null;
        $position = 1;

        foreach ($eraTokens as $token) {
            $text = $captures[$position++][0];

            if ($token[0] === 'N') {
                $era ??= self::findEraByName($eras, $token, $text);
            }
        }

        $era ??= $date->getEra() ?? throw new InvalidFormatException("No era found today in locale '{$date->locale}'.");
        $replacements = [];
        $position = 1;

        foreach ($eraTokens as $index => $token) {
            [$text, $offset] = $captures[$position++];

            if ($token[0] === 'N') {
                $replacements[$offset] = [\strlen($text), ''];

                continue;
            }

            $eraYear = (int) $text;
            $year = $era['sinceYear'] + ($eraYear - $era['offset']) * $era['direction'];

            if (($year - $era['sinceYear']) * $era['direction'] < 0
                || (\is_int($era['untilYear']) && ($year - $era['untilYear']) * $era['direction'] > 0)
            ) {
                throw new InvalidFormatException("Year $eraYear is out of the era '".($era['abbr'] ?? $era['name'] ?? '')."'.");
            }

            if ($year < 0 || $year > 9999) {
                throw new InvalidFormatException("Year $eraYear of the era '".($era['abbr'] ?? $era['name'] ?? '')."' is Gregorian year $year, only years from 0 to 9999 can be created.");
            }

            $replacements[$offset] = [\strlen($text), \sprintf('%04d', $year)];
            $tokens[$index] = 'YYYY';
        }

        krsort($replacements);

        foreach ($replacements as $offset => [$length, $replacement]) {
            $time = substr_replace($time, $replacement, $offset, $length);
        }

        foreach ($eraTokens as $index => $token) {
            if ($token[0] === 'N') {
                $tokens[$index] = '';
            }
        }

        return [implode('', $tokens), $time];
    }

    /**
     * Pattern matching the era names (or abbreviations, or narrow names depending on the token) of the given eras.
     *
     * @param array<int, array<string, mixed>> $eras
     */
    private static function getEraNamesPattern(array $eras, string $token): string
    {
        $names = array_unique(array_filter(array_column($eras, self::getEraField($token)), 'is_string'));
        usort($names, static fn (string $first, string $second) => \strlen($second) <=> \strlen($first));

        return $names ? implode('|', array_map(static fn (string $name) => preg_quote($name, '/'), $names)) : '(?!)';
    }

    /**
     * @param array<int, array<string, mixed>> $eras
     *
     * @return array<string, mixed>
     */
    private static function findEraByName(array $eras, string $token, string $name): array
    {
        $field = self::getEraField($token);

        foreach ($eras as $era) {
            if (\is_string($era[$field]) && mb_strtolower($era[$field]) === mb_strtolower($name)) {
                return $era;
            }
        }

        // The pattern only matches the names of these eras
        throw new InvalidFormatException("Unknown era '$name'."); // @codeCoverageIgnore
    }

    private static function getEraField(string $token): string
    {
        return match (\strlen($token)) {
            4 => 'name',
            5 => 'narrow',
            default => 'abbr',
        };
    }

    /**
     * Pattern used to locate the era in a string, only to read what is around the era tokens (PHP does the parsing).
     */
    private static function getIsoTokenPattern(string $token): string
    {
        if ($token[0] === '\\') {
            return preg_quote(substr($token, 1), '/');
        }

        return match (true) {
            $token === 'YY' => '\d{2}',
            (bool) preg_match('/^(?:Y+|x|X)$/', $token) => '[+-]?\d+',
            (bool) preg_match('/^(?:DDD[Do]?|[Hh]mm(?:ss)?|S+|O[YMDHhms])$/', $token) => '\d+',
            (bool) preg_match('/^(?:[DMHhkms]{1,2}|[MD]o)$/', $token) => '\d{1,2}',
            $token === ' ' => '\s',
            $token === '?' => '.',
            $token === '!' || $token === '|' => '',
            $token === '+' => '.*',
            $token === '*' => '.*?',
            \strlen($token) === 1 && !ctype_alpha($token) => preg_quote($token, '/'),
            default => '.+?',
        };
    }
}
