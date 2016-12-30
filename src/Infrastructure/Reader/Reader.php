<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Infrastructure\Reader;

use Doctrine\DBAL\Connection;

final class Reader
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function retrieveAllData(): array
    {
        return $this->connection->fetchAll(
            'SELECT data FROM projection'
        );
    }
}
