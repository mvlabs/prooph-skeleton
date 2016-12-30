<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory;

use Interop\Container\ContainerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

final class LoggerFactory
{
    public function __invoke(ContainerInterface $container) : Logger
    {
        $config = $container->get('config');

        if (!isset($config['bernard']['subscriber_log'])) {
            throw new ServiceNotCreatedException('Unable to create the Logger service. Please set the bernard/subscriber_log key in configuration');
        }

        return new Logger(
            'logger',
            [new StreamHandler($config['bernard']['subscriber_log'])]
        );
    }
}
