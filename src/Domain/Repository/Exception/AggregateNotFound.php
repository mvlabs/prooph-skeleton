<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Domain\Repository\Exception;

use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;

final class AggregateNotFound extends \UnexpectedValueException
{
    public static function fromAggregateId(AnAggregateId $id): self
    {
        return new self(sprintf('Could not find aggregate with id "%s"', (string) $id));
    }
}
