<?php

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
use DateTimeInterface;
use Throwable;

/**
 * Trait Options.
 *
 * Embed base methods to change settings of Carbon classes.
 *
 * Depends on the following methods:
 *
 * @method static shiftTimezone($timezone) Set the timezone
 */
trait Options
{
    use Localization;

    /**
     * Indicates if months should be calculated with overflow.
     * Specific setting.
     *
     * @var bool|null
     */
    protected ?bool $localMonthsOverflow;

    /**
     * Indicates if years should be calculated with overflow.
     * Specific setting.
     *
     * @var bool|null
     */
    protected ?bool $localYearsOverflow;

    /**
     * Indicates if the strict mode is in use.
     * Specific setting.
     *
     * @var bool|null
     */
    protected ?bool $localStrictModeEnabled = null;

    /**
     * Options for diffForHumans and forHumans methods.
     *
     * @var bool|null
     */
    protected ?bool $localHumanDiffOptions;

    /**
     * Format to use on string cast.
     *
     * @var string|callable|null
     */
    protected $localToStringFormat;

    /**
     * Format to use on JSON serialization.
     *
     * @var string|callable|null
     */
    protected $localSerializer;

    /**
     * Instance-specific macros.
     *
     * @var array|null
     */
    protected ?array $localMacros = null;

    /**
     * Instance-specific generic macros.
     *
     * @var array|null
     */
    protected ?array $localGenericMacros = null;

    /**
     * Function to call instead of format.
     *
     * @var string|callable|null
     */
    protected $localFormatFunction;

    /**
     * Set specific options.
     *  - strictMode: true|false|null
     *  - monthOverflow: true|false|null
     *  - yearOverflow: true|false|null
     *  - humanDiffOptions: int|null
     *  - toStringFormat: string|Closure|null
     *  - toJsonFormat: string|Closure|null
     *  - locale: string|null
     *  - timezone: \DateTimeZone|string|int|null
     *  - macros: array|null
     *  - genericMacros: array|null
     *
     * @param array $settings
     *
     * @return $this|static
     */
    public function settings(array $settings): static
    {
        $this->localStrictModeEnabled = $settings['strictMode'] ?? null;
        $this->localMonthsOverflow = $settings['monthOverflow'] ?? null;
        $this->localYearsOverflow = $settings['yearOverflow'] ?? null;
        $this->localHumanDiffOptions = $settings['humanDiffOptions'] ?? null;
        $this->localToStringFormat = $settings['toStringFormat'] ?? null;
        $this->localSerializer = $settings['toJsonFormat'] ?? null;
        $this->localMacros = $settings['macros'] ?? null;
        $this->localGenericMacros = $settings['genericMacros'] ?? null;
        $this->localFormatFunction = $settings['formatFunction'] ?? null;

        if (isset($settings['locale'])) {
            $locales = $settings['locale'];

            if (!\is_array($locales)) {
                $locales = [$locales];
            }

            $this->locale(...$locales);
        }

        if (isset($settings['innerTimezone'])) {
            return $this->setTimezone($settings['innerTimezone']);
        }

        if (isset($settings['timezone'])) {
            return $this->shiftTimezone($settings['timezone']);
        }

        return $this;
    }

    /**
     * Returns current local settings.
     *
     * @return array
     */
    public function getSettings(): array
    {
        $settings = [];
        $map = [
            'localStrictModeEnabled' => 'strictMode',
            'localMonthsOverflow' => 'monthOverflow',
            'localYearsOverflow' => 'yearOverflow',
            'localHumanDiffOptions' => 'humanDiffOptions',
            'localToStringFormat' => 'toStringFormat',
            'localSerializer' => 'toJsonFormat',
            'localMacros' => 'macros',
            'localGenericMacros' => 'genericMacros',
            'locale' => 'locale',
            'tzName' => 'timezone',
            'localFormatFunction' => 'formatFunction',
        ];

        foreach ($map as $property => $key) {
            $value = $this->$property ?? null;

            if ($value !== null && ($key !== 'locale' || $value !== 'en' || $this->localTranslator)) {
                $settings[$key] = $value;
            }
        }

        return $settings;
    }

    /**
     * Show truthy properties on var_dump().
     *
     * @return array
     */
    public function __debugInfo(): array
    {
        $infos = array_filter(get_object_vars($this), static function ($var) {
            return $var;
        });

        foreach (['dumpProperties', 'constructedObjectId', 'constructed', 'originalInput'] as $property) {
            if (isset($infos[$property])) {
                unset($infos[$property]);
            }
        }

        $this->addExtraDebugInfos($infos);

        if (\array_key_exists('carbonRecurrences', $infos)) {
            $infos['recurrences'] = $infos['carbonRecurrences'];
            unset($infos['carbonRecurrences']);
        }

        return $infos;
    }

    protected function addExtraDebugInfos(array &$infos): void
    {
        if ($this instanceof DateTimeInterface) {
            try {
                $infos['date'] ??= $this->format(CarbonInterface::MOCK_DATETIME_FORMAT);
                $infos['timezone'] ??= $this->tzName;
            } catch (Throwable) {
                // noop
            }
        }
    }
}
