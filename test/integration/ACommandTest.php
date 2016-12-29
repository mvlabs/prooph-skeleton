<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeletonTest\integration;

use Doctrine\DBAL\Connection;
use Interop\Container\ContainerInterface;
use MVLabs\ProophSkeleton\Domain\Command\ACommand;
use MVLabs\ProophSkeleton\Domain\DomainEvent\AnEvent;
use MVLabs\ProophSkeleton\Domain\Repository\Repository;
use MVLabs\ProophSkeleton\Factory\EventStoreFactory;
use MVLabs\ProophSkeleton\Factory\ImmediateCommandBusFactory;
use MVLabs\ProophSkeleton\Factory\ImmediateEventBusFactory;
use MVLabs\ProophSkeleton\Factory\Infrastructure\CommandHandler\ACommandHandlerFactory;
use MVLabs\ProophSkeleton\Factory\Infrastructure\EventListener\AnEventListenerFactory;
use MVLabs\ProophSkeleton\Factory\Infrastructure\Repository\EventSourcedRepositoryFactory;
use Prooph\EventStore\EventStore;
use Prooph\ServiceBus\EventBus;
use Zend\ServiceManager\ServiceManager;

final class ACommandTest extends \PHPUnit_Framework_TestCase
{
    public function testACommand()
    {
        $parameter = 'parameter';

        $container = new ServiceManager([
            'factories' => [
                EventStore::class => EventStoreFactory::class,
                Connection::class => function (ContainerInterface $container) use ($parameter) {
                    $connection = \Mockery::mock(Connection::class);

                    // INITIALIZATION
                    $connection->shouldReceive('getTransactionNestingLevel')->andReturn(0);
                    $connection->shouldReceive('beginTransaction');

                    // INSERT EVENT
                    $connection->shouldReceive('insert')->with('event_stream', \Mockery::on(function (array $record) use ($parameter) {
                        $payload = json_decode($record['payload']);

                        return $record['event_name'] === AnEvent::class &&
                            empty($payload) &&
                            $record['causation_name'] === ACommand::class &&
                            $record['version'] === 1;
                    }));
                    $connection->shouldReceive('commit');

                    return $connection;
                },
                EventBus::class => ImmediateEventBusFactory::class,
                ACommand::class => ACommandHandlerFactory::class,
                Repository::class => EventSourcedRepositoryFactory::class,
                AnEvent::class => AnEventListenerFactory::class,
            ]
        ]);

        $commandBus = (new ImmediateCommandBusFactory())($container);

        $command = ACommand::fromParameter('parameter');

        $commandBus->dispatch($command);
    }
}
