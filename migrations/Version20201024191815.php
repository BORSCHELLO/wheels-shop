<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201024191815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DBB5D477C3');
        $this->addSql('ALTER TABLE tire CHANGE COLUMN thorns_id studs ENUM ("without", "possibility", "with") DEFAULT "without" not null');
        $this->addSql('DROP TABLE thorns');
    }

    public function down(Schema $schema) : void
    {
        throw new \RuntimeException('Net');
    }
}
