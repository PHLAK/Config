<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$finder = PhpCsFixer\Finder::create()->in([
    __DIR__ . DIRECTORY_SEPARATOR . 'src',
    __DIR__ . DIRECTORY_SEPARATOR . 'tests',
]);

return PHLAK\CodingStandards\ConfigFactory::make($finder, [
    'declare_strict_types' => true,
])->setCacheFile(
    implode(DIRECTORY_SEPARATOR, [__DIR__, '.cache', 'php-cs-fixer.cache'])
)->setRiskyAllowed(true);
