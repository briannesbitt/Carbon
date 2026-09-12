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

namespace Carbon\Exceptions;

use Carbon\Traits\TogglableDetection;
use RuntimeException as BaseRuntimeException;
use Throwable;

final class PeriodFilterSafetyException extends BaseRuntimeException implements RuntimeException
{
    use TogglableDetection;

    public function __construct(
        public string $disallowedFilter,
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            "For safety reason, unserializing CarbonPeriod objects with $disallowedFilter is disallowed.\n".
            "If your serialized string is fully safe and you're sure you want to allow them, wrap the unseritalization".
            ' into $result = PeriodFilterSafetyException::allow(static fn () => unserialize($data))',
            $code,
            $previous,
        );
    }
}
