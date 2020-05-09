<?php

/**
 * Thanks to https://github.com/flaushi for his suggestion:
 * https://github.com/doctrine/dbal/issues/2873#issuecomment-534956358
 */
namespace Carbon\Doctrine;

class CarbonImmutableType extends DateTimeImmutableType
{
    public function getName()
    {
        return 'carbon_immutable';
    }
}
