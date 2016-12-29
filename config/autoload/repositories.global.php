<?php

declare(strict_types = 1);

return [
    'dependencies' => [
        'factories' => [
            \MVLabs\ProophSkeleton\Domain\Repository\Repository::class => \MVLabs\ProophSkeleton\Factory\Infrastructure\Repository\EventSourcedRepositoryFactory::class,
        ]
    ]
];
