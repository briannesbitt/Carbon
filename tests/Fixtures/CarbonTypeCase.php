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

namespace Tests\Fixtures;

use Doctrine\DBAL\Types\Type;

final class CarbonTypeCase
{
    public function __construct(
        public readonly string $name,
        public readonly string $class,
        public readonly string $typeClass,
        public readonly bool $hintRequired,
    ) {
    }

    public function initialize(): void
    {
        Type::hasType($this->name)
            ? Type::overrideType($this->name, $this->typeClass)
            : Type::addType($this->name, $this->typeClass);
    }

    public function getType(): Type
    {
        return Type::getType($this->name);
    }

    public function __toString(): string
    {
        $hintRequired = json_encode($this->hintRequired);

        return "CarbonTypeCase('$this->name', '$this->class', '$this->typeClass', $hintRequired)";
    }
}
