<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\EventListener;

use Bernard\EventListener\FailureSubscriber;
use Bernard\Producer;
use Bernard\QueueFactory;
use Interop\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class FailureSubscriberFactory
{
    public function __invoke(ContainerInterface $container): FailureSubscriber
    {
        return new FailureSubscriber(
            new Producer(
                $container->get(QueueFactory::class),
                new EventDispatcher()
            )
        );
    }
}
