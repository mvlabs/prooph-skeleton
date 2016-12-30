<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory;

use Bernard\Producer;
use Bernard\QueueFactory;
use Interop\Container\ContainerInterface;
use Prooph\ServiceBus\CommandBus;
use Prooph\ServiceBus\Message\Bernard\BernardMessageProducer;
use Prooph\ServiceBus\Plugin\MessageProducerPlugin;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class AsyncCommandBusFactory
{
    public function __invoke(ContainerInterface $container): CommandBus
    {
        $commandBus = new CommandBus();

        $eventDispatcher = new EventDispatcher();

        $config = $container->get('config');
        $eventDispatcherListeners = $config['bernard']['event_dispatcher_listeners'] ?? [];

        foreach ($eventDispatcherListeners as $listener) {
            $eventDispatcher->addSubscriber($container->get($listener));
        }

        $producer = new Producer(
            $container->get(QueueFactory::class),
            $eventDispatcher
        );

        $messageProducer = new BernardMessageProducer(
            $producer,
            PersistentQueueFactoryFactory::QUEUE_NAME
        );

        $commandBus->utilize(
            new MessageProducerPlugin($messageProducer)
        );

        return $commandBus;
    }
}
