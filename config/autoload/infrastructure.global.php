<?php

declare(strict_types = 1);

return [
    'dependencies' => [
        'factories' => [
            \Prooph\ServiceBus\CommandBus::class => \MVLabs\ProophSkeleton\Factory\ImmediateCommandBusFactory::class,
            \Prooph\EventStore\EventStore::class => \MVLabs\ProophSkeleton\Factory\EventStoreFactory::class,
            \Prooph\ServiceBus\EventBus::class => \MVLabs\ProophSkeleton\Factory\ImmediateEventBusFactory::class,
            \Doctrine\DBAL\Connection::class => \MVLabs\ProophSkeleton\Factory\ConnectionFactory::class,
        ]
    ]
];

