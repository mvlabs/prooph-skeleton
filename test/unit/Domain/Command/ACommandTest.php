<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeletonTest\Domain\Command;

use DateTimeImmutable;
use MVLabs\ProophSkeleton\Domain\Command\ACommand;
use Rhumsaa\Uuid\Uuid;

final class ACommandTest extends \PHPUnit_Framework_TestCase
{
    public function testFromParameter()
    {
        $parameter = 'string';

        $command = ACommand::fromParameter($parameter);

        self::assertEquals($parameter, $command->parameter());

        self::assertEquals(['parameter' => $parameter], $command->payload());

        self::assertInstanceOf(Uuid::class, $command->uuid());
        self::assertSame(ACommand::class, $command->messageName());
        self::assertInstanceOf(DateTimeImmutable::class, $command->createdAt());
    }
}
