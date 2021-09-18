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

namespace Illuminate\Support;

use Illuminate\Events\EventDispatcher;
use Tests\Laravel\App;

class ServiceProvider
{
    /**
     * @var App
     */
    public $app;

    public function __construct($dispatcher = null)
    {
        $this->app = new App();
        $this->app->setEventDispatcher($dispatcher ?: new EventDispatcher());
    }
}
