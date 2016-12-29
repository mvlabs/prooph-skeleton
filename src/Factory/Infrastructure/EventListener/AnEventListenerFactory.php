<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\Infrastructure\EventListener;

use MVLabs\ProophSkeleton\Infrastructure\EventListener\ProcessManager\AnEventProcessManager;
use MVLabs\ProophSkeleton\Infrastructure\EventListener\Projection\AnEventProjector;
use Interop\Container\ContainerInterface;

final class AnEventListenerFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        return [
            new AnEventProjector(),
            new AnEventProcessManager()
        ];
    }
}
