<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory;

use Bernard\Consumer;
use Interop\Container\ContainerInterface;
use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Message\Bernard\BernardRouter;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class AsyncCommandBusConsumerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Consumer(
            new BernardRouter(
                $container->get(ImmediateCommandBusFactory::SERVICE_NAME),
                new EventBus()
            ),
            $container->get(EventDispatcher::class)
        );
    }
}
