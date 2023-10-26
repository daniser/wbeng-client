<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

return (new PhpCsFixer\Config)
    ->setRules([
        '@PhpCsFixer' => true,
        'explicit_string_variable' => false,
        'global_namespace_import' => [
            'import_classes' => true,
        ],
        'method_argument_space' => [
            'on_multiline' => 'ignore',
        ],
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        'new_with_parentheses' => [
            'anonymous_class' => false,
            'named_class' => false,
        ],
        'phpdoc_to_comment' => [
            'ignored_tags' => ['var'],
        ],
        'single_import_per_statement' => [
            'group_to_single_imports' => false,
        ],
    ])
    ->setFinder($finder);
