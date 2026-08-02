<?php
/**
 * PHP-CS-Fixer Configuration (PSR-12 Standard)
 */

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/application',
        __DIR__ . '/tests',
    ])
    ->exclude('cache')
    ->exclude('logs');

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'single_quote' => true,
        'no_extra_blank_lines' => true,
    ])
    ->setFinder($finder);
