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
    const SERVICE_NAME = 'AsyncCommandBus';

    public function __invoke(ContainerInterface $container): CommandBus
    {
        $commandBus = new CommandBus();

        $producer = new Producer(
            $container->get(QueueFactory::class),
            $container->get(EventDispatcher::class)
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
