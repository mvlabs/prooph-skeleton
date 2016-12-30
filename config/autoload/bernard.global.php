<?php

declare(strict_types = 1);

return [
    'dependencies' => [
        'factories' => [
            \Bernard\QueueFactory::class => \MVLabs\ProophSkeleton\Factory\PersistentQueueFactoryFactory::class,
            \Bernard\Driver::class => \MVLabs\ProophSkeleton\Factory\QueueDriver\FlatFileDriverFactory::class,
            \Bernard\EventListener\ErrorLogSubscriber::class => \MVLabs\ProophSkeleton\Factory\EventListener\ErrorLogSubscriberFactory::class,
            \Bernard\EventListener\FailureSubscriber::class => \MVLabs\ProophSkeleton\Factory\EventListener\FailureSubscriberFactory::class,
            \Bernard\EventListener\LoggerSubscriber::class => \MVLabs\ProophSkeleton\Factory\EventListener\LoggerSubscriberFactory::class,
            \Psr\Log\LoggerInterface::class => \MVLabs\ProophSkeleton\Factory\LoggerFactory::class
        ]
    ]
];
