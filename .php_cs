<?php

use Symfony\CS\Config\Config;
use Symfony\CS\Finder\DefaultFinder;
use Symfony\CS\Fixer\Contrib\HeaderCommentFixer;
use Symfony\CS\FixerInterface;

$finder = DefaultFinder::create()
    ->in(__DIR__);

$header = <<< EOF
This file is part of the Carbon package.

(c) Brian Nesbitt <brian@nesbot.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

HeaderCommentFixer::setHeader($header);

$fixers = array(
    '-psr0',
    'concat_without_spaces',
    'extra_empty_lines',
    'header_comment',
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
    'single_quote',
    'spaces_cast',
    'unalign_double_arrow',
    'unalign_equals',
    'unused_use',
    'whitespacy_lines',
);

return Config::create()
    ->finder($finder)
    ->fixers($fixers)
    ->level(FixerInterface::PSR2_LEVEL)
    ->setUsingCache(true);
