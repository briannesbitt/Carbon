<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$header = <<<'EOF'
This file is part of the Carbon package.

(c) Brian Nesbitt <brian@nesbot.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$rules = [
    '@PSR2' => true,
    '@PSR12' => true,
    '@PHP71Migration' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'blank_line_after_namespace' => true,
    'blank_line_before_statement' => true,
    'cast_spaces' => true,
    'class_definition' => false,
    'concat_space' => [
        'spacing' => 'none',
    ],
    'ereg_to_preg' => true,
    'general_phpdoc_tag_rename' => true,
    'header_comment' => [
        'comment_type' => 'PHPDoc',
        'header' => $header,
        'location' => 'after_declare_strict',
        'separate' => 'both',
    ],
    'is_null' => true,
    'line_ending' => true,
    'modernize_types_casting' => true,
    'native_function_invocation' => [
        'include' => ['@compiler_optimized', 'app'],
    ],
    'no_blank_lines_after_phpdoc' => true,
    'no_empty_phpdoc' => true,
    'no_extra_blank_lines' => true,
    'no_short_bool_cast' => true,
    'no_unneeded_control_parentheses' => true,
    'no_unused_imports' => true,
    'no_whitespace_in_blank_line' => true,
    'ordered_imports' => true,
    'php_unit_method_casing' => [
        'case' => 'camel_case',
    ],
    'php_unit_test_annotation' => [
        'style' => 'prefix',
    ],
    'php_unit_test_case_static_method_calls' => [
        'call_type' => 'this',
    ],
    'phpdoc_align' => [
        'align' => 'vertical',
        'tags' => [
            'param',
            'return',
            'throws',
            'type',
            'var',
        ],
    ],
    'phpdoc_indent' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'phpdoc_order' => true,
    'phpdoc_scalar' => true,
    'phpdoc_separation' => true,
    'phpdoc_tag_type' => [
        'tags' => [
            'inheritdoc' => 'inline',
        ],
    ],
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
    'self_accessor' => true,
    'single_quote' => true,
    'space_after_semicolon' => true,
    'standardize_not_equals' => true,
    'ternary_operator_spaces' => true,
    'trailing_comma_in_multiline' => true,
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'yoda_style' => [
        'always_move_variable' => false,
        'equal' => false,
        'identical' => false,
        'less_and_greater' => false,
    ],
];

return (new Config())->setRules($rules)
    ->setFinder(
        Finder::create()
            ->in(__DIR__)
            ->notPath([
                'src/Carbon/Doctrine/DateTimeImmutableType.php',
                'src/Carbon/Doctrine/DateTimeType.php',
            ]),
    )
    ->setUsingCache(true)
    ->setRiskyAllowed(true);
