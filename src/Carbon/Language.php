<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Carbon;

use JsonSerializable;
use ReturnTypeWillChange;

class Language implements JsonSerializable
{
    /**
     * @var array
     */
    protected static $languagesNames;

    /**
     * @var array
     */
    protected static $regionsNames;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string|null
     */
    protected $variant;

    /**
     * @var string|null
     */
    protected $region;

    /**
     * @var array
     */
    protected $names;

    /**
     * @var string
     */
    protected $isoName;

    /**
     * @var string
     */
    protected $nativeName;

    public function __construct(string $id)
    {
        $this->id = str_replace('-', '_', $id);
        $parts = explode('_', $this->id);
        $this->code = $parts[0];

        if (isset($parts[1])) {
            if (!preg_match('/^[A-Z]+$/', $parts[1])) {
                $this->variant = $parts[1];
                $parts[1] = $parts[2] ?? null;
            }
            if ($parts[1]) {
                $this->region = $parts[1];
            }
        }
    }

    /**
     * Get the list of the known languages.
     *
     * @return array
     */
    public static function all()
    {
        if (!static::$languagesNames) {
            static::$languagesNames = require __DIR__.'/List/languages.php';
        }

        return static::$languagesNames;
    }

    /**
     * Get the list of the known regions.
     *
     * @return array
     */
    public static function regions()
    {
        if (!static::$regionsNames) {
            static::$regionsNames = require __DIR__.'/List/regions.php';
        }

        return static::$regionsNames;
    }

    /**
     * Get both isoName and nativeName as an array.
     *
     * @return array
     */
    public function getNames(): array
    {
        if (!$this->names) {
            $this->names = static::all()[$this->code] ?? [
                'isoName' => $this->code,
                'nativeName' => $this->code,
            ];
        }

        return $this->names;
    }

    /**
     * Returns the original locale ID.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns the code of the locale "en"/"fr".
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Returns the variant code such as cyrl/latn.
     *
     * @return string|null
     */
    public function getVariant(): ?string
    {
        return $this->variant;
    }

    /**
     * Returns the variant such as Cyrillic/Latin.
     *
     * @return string|null
     */
    public function getVariantName(): ?string
    {
        if ($this->variant === 'Latn') {
            return 'Latin';
        }

        if ($this->variant === 'Cyrl') {
            return 'Cyrillic';
        }

        return $this->variant;
    }

    /**
     * Returns the region part of the locale.
     *
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * Returns the region name for the current language.
     *
     * @return string|null
     */
    public function getRegionName(): ?string
    {
        return $this->region ? (static::regions()[$this->region] ?? $this->region) : null;
    }

    /**
     * Returns the long ISO language name.
     *
     * @return string
     */
    public function getFullIsoName(): string
    {
        if (!$this->isoName) {
            $this->isoName = $this->getNames()['isoName'];
        }

        return $this->isoName;
    }

    /**
     * Set the ISO language name.
     *
     * @param string $isoName
     */
    public function setIsoName(string $isoName): self
    {
        $this->isoName = $isoName;

        return $this;
    }

    /**
     * Return the full name of the language in this language.
     *
     * @return string
     */
    public function getFullNativeName(): string
    {
        if (!$this->nativeName) {
            $this->nativeName = $this->getNames()['nativeName'];
        }

        return $this->nativeName;
    }

    /**
     * Set the name of the language in this language.
     *
     * @param string $nativeName
     */
    public function setNativeName(string $nativeName): self
    {
        $this->nativeName = $nativeName;

        return $this;
    }

    /**
     * Returns the short ISO language name.
     *
     * @return string
     */
    public function getIsoName(): string
    {
        $name = $this->getFullIsoName();

        return trim(strstr($name, ',', true) ?: $name);
    }

    /**
     * Get the short name of the language in this language.
     *
     * @return string
     */
    public function getNativeName(): string
    {
        $name = $this->getFullNativeName();

        return trim(strstr($name, ',', true) ?: $name);
    }

    /**
     * Get a string with short ISO name, region in parentheses if applicable, variant in parentheses if applicable.
     *
     * @return string
     */
    public function getIsoDescription()
    {
        $region = $this->getRegionName();
        $variant = $this->getVariantName();

        return $this->getIsoName().($region ? ' ('.$region.')' : '').($variant ? ' ('.$variant.')' : '');
    }

    /**
     * Get a string with short native name, region in parentheses if applicable, variant in parentheses if applicable.
     *
     * @return string
     */
    public function getNativeDescription()
    {
        $region = $this->getRegionName();
        $variant = $this->getVariantName();

        return $this->getNativeName().($region ? ' ('.$region.')' : '').($variant ? ' ('.$variant.')' : '');
    }

    /**
     * Get a string with long ISO name, region in parentheses if applicable, variant in parentheses if applicable.
     *
     * @return string
     */
    public function getFullIsoDescription()
    {
        $region = $this->getRegionName();
        $variant = $this->getVariantName();

        return $this->getFullIsoName().($region ? ' ('.$region.')' : '').($variant ? ' ('.$variant.')' : '');
    }

    /**
     * Get a string with long native name, region in parentheses if applicable, variant in parentheses if applicable.
     *
     * @return string
     */
    public function getFullNativeDescription()
    {
        $region = $this->getRegionName();
        $variant = $this->getVariantName();

        return $this->getFullNativeName().($region ? ' ('.$region.')' : '').($variant ? ' ('.$variant.')' : '');
    }

    /**
     * Returns the original locale ID.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getId();
    }

    /**
     * Get a string with short ISO name, region in parentheses if applicable, variant in parentheses if applicable.
     *
     * @return string
     */
    #[ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->getIsoDescription();
    }
}
