<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Domain\Aggregate;

use MVLabs\ProophSkeleton\Domain\DomainEvent\AnEvent;
use MVLabs\ProophSkeleton\Domain\DomainEvent\AnotherEvent;
use MVLabs\ProophSkeleton\Domain\Value\AnAggregateId;
use Prooph\EventSourcing\AggregateRoot;

final class AnAggregate extends AggregateRoot
{
    /**
     * @var AnAggregateId
     */
    private $id;

    public static function new(): self
    {
        $instance = new self();

        $instance->recordThat(AnEvent::new(AnAggregateId::new()));

        return $instance;
    }

    public function something(): void
    {
        $this->recordThat(AnotherEvent::new(AnAggregateId::new()));
    }

    protected function aggregateId(): string
    {
        return (string) $this->id;
    }

    protected function whenAnEvent(AnEvent $event): void
    {
        $this->id = $event->anAggregateId();
    }

    protected function whenAnotherEvent(AnotherEvent $event): void
    {
    }
}
