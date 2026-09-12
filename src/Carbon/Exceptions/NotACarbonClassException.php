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

use Carbon\CarbonInterface;
use Carbon\Traits\TogglableDetection;
use InvalidArgumentException as BaseInvalidArgumentException;
use Throwable;

class NotACarbonClassException extends BaseInvalidArgumentException implements InvalidArgumentException
{
    use TogglableDetection;

    /**
     * The className.
     *
     * @var string
     */
    protected $className;

    /**
     * Constructor.
     *
     * @param string         $className
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($className, $code = 0, ?Throwable $previous = null)
    {
        $this->className = $className;

        parent::__construct(
            \sprintf(
                'Given class does not implement %s: %s',
                CarbonInterface::class,
                $className,
            )."\nBehavior can be unpredictable and unsecure ".
            "(in particular if you are unserializing data from a source you can't fully trust)\n".
            "But if you're sure you want to allow it use \$result = ".
            'NotACarbonClassException::allow(static fn () => ...)',
            $code,
            $previous,
        );
    }

    public static function expectCarbonInterface(mixed $className): void
    {
        if (!self::$detectionEnabled) {
            return;
        }

        if (!\is_string($className)) {
            throw new self(\gettype($className));
        }

        if (!is_a($className, CarbonInterface::class, true)) {
            throw new self($className);
        }
    }

    /**
     * Get the className.
     *
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }
}
