<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeletonTest\Domain\DomainEvent;

use MVLabs\ProophSkeleton\Domain\DomainEvent\AnEvent;
use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;

final class AnEventTest extends \PHPUnit_Framework_TestCase
{
    public function testNew()
    {
        $aggregateId = AnAggregateId::new();

        $event = AnEvent::new($aggregateId);

        self::assertEquals($aggregateId, $event->anAggregateId());
    }
}
