<?php

declare(strict_types=1);

namespace Carbon\Doc\Config;

[, $alias] = explode(' as ', json_decode(file_get_contents(__DIR__.'/../composer.json'), true)['require']['nesbot/carbon']);
const MASTER_BRANCH = 'dev-master';
define('MASTER_VERSION', $alias);
const BLACKLIST = [
    '1.23.1',
    '1.23.2',
    '1.25.2',
    '1.37.0',
    '1.38.3',
    '2.21.1',
    '2.22.2',
];
