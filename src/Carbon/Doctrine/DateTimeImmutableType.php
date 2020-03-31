<?php

/**
 * Thanks to https://github.com/flaushi for his suggestion:
 * https://github.com/doctrine/dbal/issues/2873#issuecomment-534956358
 */
namespace Carbon\Doctrine;

use Carbon\CarbonImmutable;
use Doctrine\DBAL\Types\VarDateTimeImmutableType;

class DateTimeImmutableType extends VarDateTimeImmutableType
{
    use CarbonType;

    protected function getCarbonClassName(): string
    {
        return CarbonImmutable::class;
    }
}
