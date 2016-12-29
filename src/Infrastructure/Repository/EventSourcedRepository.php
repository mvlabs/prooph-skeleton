<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Infrastructure\Repository;

use MVLabs\ProophSkeleton\Domain\Aggregate\AnAggregate;
use MVLabs\ProophSkeleton\Domain\Repository\Exception\AggregateNotFound;
use MVLabs\ProophSkeleton\Domain\Repository\Repository;
use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;
use Prooph\EventStore\Aggregate\AggregateRepository;

final class EventSourcedRepository implements Repository
{
    /**
     * @var AggregateRepository
     */
    private $proophRepository;

    public function __construct(AggregateRepository $proophRepository)
    {
        $this->proophRepository = $proophRepository;
    }

    public function get(AnAggregateId $id): AnAggregate
    {
        $aggregate = $this->proophRepository->getAggregateRoot((string) $id);

        if (!$aggregate instanceof AnAggregate) {
            throw AggregateNotFound::fromAggregateId($id);
        }

        return $aggregate;
    }

    public function store(AnAggregate $aggregate): void
    {
        $this->proophRepository->addAggregateRoot($aggregate);
    }
}
