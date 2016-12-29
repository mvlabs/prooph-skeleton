<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Domain\DomainEvent;

use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;
use Prooph\EventSourcing\AggregateChanged;

final class AnotherEvent extends AggregateChanged
{
    public static function new(AnAggregateId $id)
    {
        return self::occur((string) $id);
    }
}
