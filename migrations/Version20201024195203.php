<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201024195203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DB4EC001D1');
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DBE41DC9B2');
        $this->addSql('ALTER TABLE tire CHANGE COLUMN season_id season ENUM ("medium", "snow", "all") not null DEFAULT "medium"');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE design');
    }

    public function down(Schema $schema) : void
    {
        throw new \RuntimeException('Net');
    }
}
