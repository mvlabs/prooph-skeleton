<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory\Infrastructure\Repository;

use Interop\Container\ContainerInterface;
use MVLabs\ProophSkeleton\Domain\Aggregate\AnAggregate;
use MVLabs\ProophSkeleton\Infrastructure\Repository\EventSourcedRepository;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\Aggregate\AggregateRepository;
use Prooph\EventStore\Aggregate\AggregateType;
use Prooph\EventStore\EventStore;

final class EventSourcedRepositoryFactory
{
    public function __invoke(ContainerInterface $container): EventSourcedRepository
    {
        return new EventSourcedRepository(new AggregateRepository(
            $container->get(EventStore::class),
            AggregateType::fromAggregateRootClass(AnAggregate::class),
            new AggregateTranslator()
        ));
    }
}
