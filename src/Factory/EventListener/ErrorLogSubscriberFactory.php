<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\EventListener;

use Bernard\EventListener\ErrorLogSubscriber;
use Interop\Container\ContainerInterface;

final class ErrorLogSubscriberFactory
{
    public function __invoke(ContainerInterface $container): ErrorLogSubscriber
    {
        return new ErrorLogSubscriber();
    }
}
