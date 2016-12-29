<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeletonTest;

use Prooph\EventSourcing\AggregateRoot;

class ProophAggregateTestCase extends \PHPUnit_Framework_TestCase
{
    protected function assertEvents(array $eventClasses, AggregateRoot $aggregate)
    {
        $method = new \ReflectionMethod($aggregate, 'popRecordedEvents');
        $method->setAccessible(true);

        $events = $method->invoke($aggregate);

        self::assertCount(count($eventClasses), $events);
        self::assertEquals($eventClasses, array_map('get_class', $events));

        self::assertEmpty($method->invoke($aggregate));
    }

    protected function reconstituteTripFromHistory(array $events, string $class): AggregateRoot
    {
        $method = new \ReflectionMethod($class, 'reconstituteFromHistory');
        $method->setAccessible(true);

        return $method->invoke(null, new \ArrayIterator($events));
    }
}
