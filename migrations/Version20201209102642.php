<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201209102642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE total_cost total_cost NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE tire CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE rating rating NUMERIC(2, 1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE total_cost total_cost DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE tire CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE rating rating DOUBLE PRECISION NOT NULL');
    }
}
