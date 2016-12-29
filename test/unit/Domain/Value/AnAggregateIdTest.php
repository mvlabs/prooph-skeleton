<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeletonTest\Domain\Value;

use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;
use Rhumsaa\Uuid\Uuid;

final class AnAggregateIdTest extends \PHPUnit_Framework_TestCase
{
    public function testFromObjectToStringAndBack()
    {
        $tripId = AnAggregateId::new();

        self::assertEquals($tripId, AnAggregateId::fromString((string) $tripId));
    }

    public function testFromStringAndBack()
    {
        $uuid = (string) Uuid::uuid4();

        self::assertEquals($uuid, (string) AnAggregateId::fromString($uuid));
    }
}
