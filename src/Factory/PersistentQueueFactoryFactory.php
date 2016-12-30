<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory;

use Bernard\Driver;
use Bernard\QueueFactory\PersistentFactory;
use Interop\Container\ContainerInterface;
use Prooph\Common\Messaging\FQCNMessageFactory;
use Prooph\Common\Messaging\NoOpMessageConverter;
use Prooph\ServiceBus\Message\Bernard\BernardSerializer;

final class PersistentQueueFactoryFactory
{
    const QUEUE_NAME = 'commands';

    public function __invoke(ContainerInterface $container): PersistentFactory
    {
        return new PersistentFactory(
            $container->get(Driver::class),
            new BernardSerializer(
                new FQCNMessageFactory(),
                new NoOpMessageConverter()
            )
        );
    }
}
