<?php

declare(strict_types = 1);

return [
    'dependencies' => [
        'factories' => [
            \MVLabs\ProophSkeleton\Factory\ImmediateCommandBusFactory::SERVICE_NAME => \MVLabs\ProophSkeleton\Factory\ImmediateCommandBusFactory::class,
            \MVLabs\ProophSkeleton\Factory\AsyncCommandBusFactory::SERVICE_NAME => \MVLabs\ProophSkeleton\Factory\AsyncCommandBusFactory::class,
            \Prooph\EventStore\EventStore::class => \MVLabs\ProophSkeleton\Factory\EventStoreFactory::class,
            \Prooph\ServiceBus\EventBus::class => \MVLabs\ProophSkeleton\Factory\ImmediateEventBusFactory::class,
            \Doctrine\DBAL\Connection::class => \MVLabs\ProophSkeleton\Factory\ConnectionFactory::class,
            \Symfony\Component\EventDispatcher\EventDispatcher::class => \MVLabs\ProophSkeleton\Factory\EventDispatcherFactory::class,
        ],
        'aliases' => [
            \Prooph\ServiceBus\CommandBus::class => \MVLabs\ProophSkeleton\Factory\ImmediateCommandBusFactory::SERVICE_NAME
        ]
    ]
];

