<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\Action;

use MVLabs\ProophSkeleton\Action\Test;
use Interop\Container\ContainerInterface;
use Prooph\ServiceBus\CommandBus;

final class TestFactory
{
    public function __invoke(ContainerInterface $container): Test
    {
        $commandBus = $container->get(CommandBus::class);

        return new Test($commandBus);
    }
}
