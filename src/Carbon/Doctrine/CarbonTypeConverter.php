<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Doctrine;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTimeInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Exception;

/**
 * @template T of CarbonInterface
 */
trait CarbonTypeConverter
{
    /**
     * @return class-string<T>
     */
    protected function getCarbonClassName(): string
    {
        return Carbon::class;
    }

    /**
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $precision = $fieldDeclaration['precision'] ?: 10;

        if ($fieldDeclaration['secondPrecision'] ?? false) {
            $precision = 0;
        }

        if ($precision === 10) {
            $precision = DateTimeDefaultPrecision::get();
        }

        $type = parent::getSQLDeclaration($fieldDeclaration, $platform);

        if (!$precision) {
            return $type;
        }

        if (str_contains($type, '(')) {
            return preg_replace('/\(\d+\)/', "($precision)", $type);
        }

        [$before, $after] = explode(' ', "$type ");

        return trim("$before($precision) $after");
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return T|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $class = $this->getCarbonClassName();

        if ($value === null || is_a($value, $class)) {
            return $value;
        }

        if ($value instanceof DateTimeInterface) {
            return $class::instance($value);
        }

        $date = null;
        $error = null;

        try {
            $date = $class::parse($value);
        } catch (Exception $exception) {
            $error = $exception;
        }

        if (!$date) {
            throw ConversionException::conversionFailedFormat(
                $value,
                $this->getName(),
                'Y-m-d H:i:s.u or any format supported by '.$class.'::parse()',
                $error
            );
        }

        return $date;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return $value;
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i:s.u');
        }

        throw ConversionException::conversionFailedInvalidType(
            $value,
            $this->getName(),
            ['null', 'DateTime', 'Carbon']
        );
    }
}
