<?php

require __DIR__.'/vendor/autoload.php';

use SLLH\StyleCIBridge\ConfigBridge;

$config = ConfigBridge::create();
$config->setUsingCache(true);

if (method_exists($config, 'setRiskyAllowed')) {
    $config->setRiskyAllowed(true);
}

return $config;
