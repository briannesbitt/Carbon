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

namespace Tests\Carbon\Fixtures;

use Symfony\Contracts\Translation\TranslatorInterface;

class NoLocaleTranslator implements TranslatorInterface
{
    public function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        return $id;
    }
}
