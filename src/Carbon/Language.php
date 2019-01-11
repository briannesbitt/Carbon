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

    public static function all()
    {
        if (!static::$languagesNames) {
            // Add ISO 639-3 languages available in Carbon
            static::$languagesNames = array_merge(include __DIR__.'/List/languages.php', [
                'gom' => [
                    'isoName' => 'Konkani, Goan',
                    'nativeName' => 'ಕೊಂಕಣಿ',
                ],
                'tlh' => [
                    'isoName' => 'Klingon, tlhIngan-Hol',
                    'nativeName' => 'tlhIngan Hol',
                ],
                'tzl' => [
                    'isoName' => 'Talossan',
                    'nativeName' => 'Talossan',
                ],
                'tzm' => [
                    'isoName' => 'Tamazight, Central Atlas',
                    'nativeName' => 'ⵜⵎⴰⵣⵉⵖⵜ',
                ],
            ]);
        }

        return static::$languagesNames;
    }

    public static function regions()
    {
        if (!static::$regionsNames) {
            static::$regionsNames = include __DIR__.'/List/regions.php';
        }

        return static::$regionsNames;
    }

    /**
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getVariant(): ?string
    {
        return $this->variant;
    }

    /**
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
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string|null
     */
    public function getRegionName(): ?string
    {
        return $this->region ? (static::regions()[$this->region] ?? $this->region) : null;
    }

    /**
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
     * @param string $isoName
     */
    public function setIsoName(string $isoName): self
    {
        $this->isoName = $isoName;

        return $this;
    }

    /**
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
     * @param string $nativeName
     */
    public function setNativeName(string $nativeName): self
    {
        $this->nativeName = $nativeName;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsoName(): string
    {
        $name = $this->getFullIsoName();

        return trim(strstr($name, ',', true) ?: $name);
    }

    /**
     * @return string
     */
    public function getNativeName(): string
    {
        $name = $this->getFullNativeName();

        return trim(strstr($name, ',', true) ?: $name);
    }

    public function getIsoDescription()
    {
        $region = $this->getRegionName();
        $variant = $this->getVariantName();

        return $this->getIsoName().($region ? ' ('.$region.')' : '').($variant ? ' ('.$variant.')' : '');
    }

    public function getNativeDescription()
    {
        $region = $this->getRegionName();
        $variant = $this->getVariantName();

        return $this->getNativeName().($region ? ' ('.$region.')' : '').($variant ? ' ('.$variant.')' : '');
    }

    public function getFullIsoDescription()
    {
        $region = $this->getRegionName();
        $variant = $this->getVariantName();

        return $this->getFullIsoName().($region ? ' ('.$region.')' : '').($variant ? ' ('.$variant.')' : '');
    }

    public function getFullNativeDescription()
    {
        $region = $this->getRegionName();
        $variant = $this->getVariantName();

        return $this->getFullNativeName().($region ? ' ('.$region.')' : '').($variant ? ' ('.$variant.')' : '');
    }

    public function __toString()
    {
        return $this->getId();
    }

    public function jsonSerialize()
    {
        return $this->getIsoDescription();
    }
}
