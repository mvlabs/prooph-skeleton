<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\Action;

use MVLabs\ProophSkeleton\Action\Test;
use Interop\Container\ContainerInterface;
use MVLabs\ProophSkeleton\Infrastructure\Reader\Reader;
use Prooph\ServiceBus\CommandBus;

final class TestFactory
{
    public function __invoke(ContainerInterface $container): Test
    {
        $commandBus = $container->get(CommandBus::class);
        $reader = $container->get(Reader::class);

        return new Test($commandBus, $reader);
    }
}
