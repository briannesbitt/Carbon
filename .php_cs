<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__);

$fixers = array(
    '-psr0',
    'extra_empty_lines',
    'long_array_syntax',
    'no_empty_lines_after_phpdocs',
    'phpdoc_align',
    'phpdoc_indent',
    'phpdoc_inline_tag',
    'phpdoc_no_access',
    'phpdoc_no_package',
    'phpdoc_order',
    'phpdoc_scalar',
    'phpdoc_separation',
    'phpdoc_to_comment',
    'phpdoc_trim',
    'phpdoc_type_to_var',
    'phpdoc_types',
    'phpdoc_var_without_name',
    'return',
);

return Symfony\CS\Config\Config::create()
    ->finder($finder)
    ->fixers($fixers)
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->setUsingCache(true);
