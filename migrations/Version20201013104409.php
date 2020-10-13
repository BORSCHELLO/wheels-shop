<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013104409 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD status VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE tire ADD image_id INT NOT NULL');
        $this->addSql('ALTER TABLE tire ADD CONSTRAINT FK_A2CE96DB3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2CE96DB3DA5256D ON tire (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP created_at, DROP status');
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DB3DA5256D');
        $this->addSql('DROP INDEX UNIQ_A2CE96DB3DA5256D ON tire');
        $this->addSql('ALTER TABLE tire DROP image_id');
    }
}
