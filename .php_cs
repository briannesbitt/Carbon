<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__);

return Symfony\CS\Config\Config::create()
    ->finder($finder)
    ->fixers(array('long_array_syntax'))
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->setUsingCache(true);
