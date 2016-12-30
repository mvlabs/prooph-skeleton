<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Domain\DomainEvent;

use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;
use Prooph\EventSourcing\AggregateChanged;

final class AnEvent extends AggregateChanged
{
    public static function new(AnAggregateId $id)
    {
        return self::occur((string) $id);
    }

    public function anAggregateId() : AnAggregateId
    {
        return AnAggregateId::fromString($this->aggregateId());
    }
}
