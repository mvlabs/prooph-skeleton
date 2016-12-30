<?php

declare(strict_types = 1);

return [
    'dependencies' => [
        'factories' => [
            \MVLabs\ProophSkeleton\Infrastructure\Reader\Reader::class => \MVLabs\ProophSkeleton\Factory\Infrastructure\Reader\ReaderFactory::class,
        ]
    ]
];
