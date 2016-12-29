<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\Infrastructure\CommandHandler;

use MVLabs\ProophSkeleton\Domain\Repository\Repository;
use MVLabs\ProophSkeleton\Infrastructure\CommandHandler\ACommandHandler;
use Interop\Container\ContainerInterface;

final class ACommandHandlerFactory
{
    public function __invoke(ContainerInterface $container): ACommandHandler
    {
        return new ACommandHandler(
            $container->get(Repository::class)
        );
    }
}
