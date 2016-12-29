<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Domain\Value;

use Rhumsaa\Uuid\Uuid;

final class AnAggregateId
{
    /**
     * @var Uuid
     */
    private $id;

    private function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public static function new(): self
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $id): self
    {
        return new self(Uuid::fromString($id));
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}
