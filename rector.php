<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Stmt\RemoveConditionExactReturnRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__.'/src',
    ]);

    $rectorConfig->rules([
        InlineConstructorDefaultToPropertyRector::class,
    ]);

    $rectorConfig->sets([
        // LevelSetList::UP_TO_PHP_82,
        // SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
    ]);

    $rectorConfig->skip([
        // Misjudges `castType()`'s int/float branches as duplicate returns and
        // strips the float-cast branch entirely, changing runtime behaviour.
        RemoveConditionExactReturnRector::class,

        // Infers param types from league/uri's `Uri::new()` signature, which
        // includes PHP 8.5's native ext-uri classes (`Uri\Rfc3986\Uri`,
        // `Uri\WhatWg\Url`). Referencing those types breaks on PHP < 8.5,
        // which is still within our supported range.
        ParamTypeByMethodCallTypeRector::class,
    ]);
};
