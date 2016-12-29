<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Prooph\EventStore\Adapter\Doctrine\Schema\EventStoreSchema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161227174524 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        EventStoreSchema::createSingleStream($schema, 'event_stream', true);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        EventStoreSchema::dropStream($schema);
    }
}
