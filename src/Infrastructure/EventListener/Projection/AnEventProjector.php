<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Infrastructure\EventListener\Projection;

use Doctrine\DBAL\Connection;
use MVLabs\ProophSkeleton\Domain\DomainEvent\AnEvent;

final class AnEventProjector
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function __invoke(AnEvent $event) : void
    {
        $this->connection->insert('projection', [
            'data' => (string) $event->anAggregateId()
        ]);
    }
}
