<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\QueueDriver;

use Bernard\Driver\FlatFileDriver;
use Interop\Container\ContainerInterface;

final class FlatFileDriverFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new FlatFileDriver($container->get('config')['bernard']['flat_file_path']);
    }
}
