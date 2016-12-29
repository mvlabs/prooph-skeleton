<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Domain\Repository;

use MVLabs\ProophSkeleton\Domain\Aggregate\AnAggregate;
use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;

interface Repository
{
    public function get(AnAggregateId $id): AnAggregate;

    public function store(AnAggregate $aggregate): void;
}
