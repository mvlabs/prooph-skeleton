<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeletonTest\Domain\Aggregate;

use MVLabs\ProophSkeleton\Domain\Aggregate\AnAggregate;
use MVLabs\ProophSkeleton\Domain\DomainEvent\AnEvent;
use MVLabs\ProophSkeleton\Domain\DomainEvent\AnotherEvent;
use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;
use MVLabs\ProophSkeletonTest\ProophAggregateTestCase;
use MVLabs\ProophSkeletonTest\TestUtils;

final class AnAggregateTest extends ProophAggregateTestCase
{
    public function testNew()
    {
        $aggregate = AnAggregate::new();

        $this->assertEvents([AnEvent::class], $aggregate);

        $aggregateId = TestUtils::getPropertyThroughReflection($aggregate, 'id');

        self::assertInstanceOf(AnAggregateId::class, $aggregateId);
    }

    public function testSomething()
    {
        $aggregate = $this->reconstituteTripFromHistory([
            AnEvent::new(AnAggregateId::new())
        ], AnAggregate::class);

        $aggregate->something();

        $this->assertEvents([AnotherEvent::class], $aggregate);
    }
}
