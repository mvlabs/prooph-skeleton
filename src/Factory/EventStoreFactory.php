<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory;

use Doctrine\DBAL\Connection;
use Interop\Container\ContainerInterface;
use Prooph\Common\Event\ProophActionEventEmitter;
use Prooph\Common\Messaging\FQCNMessageFactory;
use Prooph\Common\Messaging\NoOpMessageConverter;
use Prooph\EventStore\Adapter\Doctrine\DoctrineEventStoreAdapter;
use Prooph\EventStore\Adapter\PayloadSerializer\JsonPayloadSerializer;
use Prooph\EventStore\EventStore;
use Prooph\EventStoreBusBridge\Container\EventPublisherFactory;
use Prooph\EventStoreBusBridge\EventPublisher;

final class EventStoreFactory
{
    public function __invoke(ContainerInterface $container): EventStore
    {
        $adapter = new DoctrineEventStoreAdapter(
            $container->get(Connection::class),
            new FQCNMessageFactory(),
            new NoOpMessageConverter(),
            new JsonPayloadSerializer()
        );
        $eventEmitter = new ProophActionEventEmitter();

        $eventStore = new EventStore($adapter, $eventEmitter);

        // this plugin publishes all the events committed in the event store to
        // the event bus
        /**
         * @var EventPublisher $eventPublisher
         */
        $eventPublisher = (new EventPublisherFactory())($container);
        $eventPublisher->setUp($eventStore);

        return $eventStore;
    }
}
