<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory;

use Interop\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class EventDispatcherFactory
{
    public function __invoke(ContainerInterface $container): EventDispatcher
    {
        $eventDispatcher = new EventDispatcher();

        $config = $container->get('config');
        $eventDispatcherListeners = $config['bernard']['event_dispatcher_listeners'] ?? [];

        foreach ($eventDispatcherListeners as $listener) {
            $eventDispatcher->addSubscriber($container->get($listener));
        }

        return $eventDispatcher;
    }
}
