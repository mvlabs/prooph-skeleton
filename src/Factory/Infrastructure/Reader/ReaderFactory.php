<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\Infrastructure\Reader;

use Doctrine\DBAL\Connection;
use Interop\Container\ContainerInterface;
use MVLabs\ProophSkeleton\Infrastructure\Reader\Reader;

final class ReaderFactory
{
    public function __invoke(ContainerInterface $container): Reader
    {
        $connection = $container->get(Connection::class);

        return new Reader($connection);
    }
}
