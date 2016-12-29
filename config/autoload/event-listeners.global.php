<?php

declare(strict_types = 1);

return [
    'dependencies' => [
        'factories' => [
            \MVLabs\ProophSkeleton\Domain\DomainEvent\AnEvent::class => \MVLabs\ProophSkeleton\Factory\Infrastructure\EventListener\AnEventListenerFactory::class,
        ]
    ]
];
