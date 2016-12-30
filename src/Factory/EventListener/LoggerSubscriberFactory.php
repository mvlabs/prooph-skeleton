<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\EventListener;

use Bernard\EventListener\LoggerSubscriber;
use Interop\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class LoggerSubscriberFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LoggerSubscriber($container->get(LoggerInterface::class));
    }
}
