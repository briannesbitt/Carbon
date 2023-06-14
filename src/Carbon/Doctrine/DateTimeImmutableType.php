<?php

/**
 * Thanks to https://github.com/flaushi for his suggestion:
 * https://github.com/doctrine/dbal/issues/2873#issuecomment-534956358
 */
namespace Carbon\Doctrine;

use Carbon\CarbonImmutable;
use DateTimeImmutable;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\VarDateTimeImmutableType;

class DateTimeImmutableType extends VarDateTimeImmutableType implements CarbonDoctrineType
{
    /** @use CarbonTypeConverter<CarbonImmutable> */
    use CarbonTypeConverter
    {
        convertToPHPValue as private baseConvertToPHPValue;
    }

    /**
     * @return class-string<CarbonImmutable>
     */
    protected function getCarbonClassName(): string
    {
        return CarbonImmutable::class;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return T|null
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?DateTimeImmutable
    {
        return $this->baseConvertToPHPValue($value, $platform);
    }
}
